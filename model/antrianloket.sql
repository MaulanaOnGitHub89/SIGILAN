-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2018 at 10:48 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrianloket`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `prcChangePwd` (IN `inIdOfficer` INT, IN `inCurPwd` VARCHAR(255), IN `inNewPwd` VARCHAR(255), IN `inConNewPwd` VARCHAR(255), IN `inCurPwdHash` VARCHAR(255), IN `inNewPwdHash` VARCHAR(255), IN `inConNewPwdHash` VARCHAR(255), OUT `outErrCode` VARCHAR(255), OUT `outErrMsg` VARCHAR(255))  start_point: BEGIN

	CALL `prcChangePwdValidation`(inIdOfficer, inCurPwd, inNewPwd, inConNewPwd, inCurPwdHash, inNewPwdHash, inConNewPwdHash, outErrCode, outErrMsg);
	IF(outErrCode IS NOT NULL) THEN
		LEAVE start_point;
	END IF;

	CALL `prcUpdMstLogin`(inIdOfficer, inNewPwdHash, 'F', 'F', outErrCode, outErrMsg);
	IF(outErrCode IS NOT NULL) THEN
		LEAVE start_point;
	END IF;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prcChangePwdValidation` (IN `inIdOfficer` INT, IN `inCurPwd` VARCHAR(255), IN `inNewPwd` VARCHAR(255), IN `inConNewPwd` VARCHAR(255), IN `inCurPwdHash` VARCHAR(255), IN `inNewPwdHash` VARCHAR(255), IN `inConNewPwdHash` VARCHAR(255), OUT `outErrCode` VARCHAR(255), OUT `outErrMsg` VARCHAR(255))  start_point: BEGIN

	IF(inIdOfficer IS NULL || inIdOfficer = 0 ) THEN
		SET outErrCode = "ERR-CHGPWD-001";
		SET outErrMsg = "Id Officer can't null";
		LEAVE start_point;
    END IF;

	IF(inCurPwd IS NULL || LENGTH(inCurPwd) = 0 ) THEN
		SET outErrCode = "ERR-CHGPWD-002";
		SET outErrMsg = "Current password can't null";
		LEAVE start_point;
    END IF;

	IF(inNewPwd IS NULL || LENGTH(inNewPwd) = 0 ) THEN
		SET outErrCode = "ERR-CHGPWD-003";
		SET outErrMsg = "New password can't null";
		LEAVE start_point;
    END IF;

	IF(inConNewPwd IS NULL || LENGTH(inConNewPwd) = 0 ) THEN
		SET outErrCode = "ERR-CHGPWD-004";
		SET outErrMsg = "Confirm new password can't null";
		LEAVE start_point;
    END IF;
    
    IF (GET_PSWD_OFFICER(inIdOfficer) != inCurPwdHash) THEN
		SET outErrCode = "ERR-CHGPWD-008";
		SET outErrMsg = "Wrong password!";
		LEAVE start_point;
    END IF;

	IF(inCurPwd = inNewPwd) THEN
		SET outErrCode = "ERR-CHGPWD-005";
		SET outErrMsg = "New password can't same with current password";
		LEAVE start_point;
    END IF;

	IF(LENGTH(inNewPwd) < 5) THEN
		SET outErrCode = "ERR-CHGPWD-006";
		SET outErrMsg = "New password requiered 5 character minimum";
		LEAVE start_point;
    END IF;

	IF(inNewPwd != inConNewPwd) THEN
		SET outErrCode = "ERR-CHGPWD-006";
		SET outErrMsg = "Your new password it's not same with confirm new password";
		LEAVE start_point;
    END IF;
    
    IF ITS_EXISTS_ID_OFFICER(inIdOfficer) = 0 THEN -- FALSE
		SET outErrCode = "ERR-CHGPWD-007";
		SET outErrMsg = CONCAT("Unknown id officer = ", inIdOfficer);
		LEAVE start_point;
    END IF;
        
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prcLogin` (IN `inNip` BIGINT, IN `inPswd` VARCHAR(255), IN `inSessId` VARCHAR(255), OUT `outIdOfficer` INT(11), OUT `outForceChangePwd` VARCHAR(1), OUT `outErrCode` VARCHAR(255), OUT `outErrMsg` VARCHAR(255))  start_point: BEGIN

	CALL `prcLoginValidation`(inNip, inPswd, inSessId, outErrCode, outErrMsg);
	IF(outErrCode IS NOT NULL) THEN
		LEAVE start_point;
	END IF;

	CALL `prcLoginLog`(inNip, inSessId, outErrCode, outErrMsg);
	IF(outErrCode IS NOT NULL) THEN
		LEAVE start_point;
	END IF;
    
    SET outIdOfficer = `GET_ID_OFFICER`(inNip);
    SET outForceChangePwd = `GET_FORCE_PWD_FLAG`(inNip);
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prcLoginFailure` (IN `inNip` BIGINT, IN `inSessId` VARCHAR(255), INOUT `outErrCode` VARCHAR(255), INOUT `outErrMsg` VARCHAR(255))  start_point: BEGIN
    DECLARE outErrCode2 VARCHAR(255);
    DECLARE outErrMsg2 VARCHAR(255);
    DECLARE vCountRec INT;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		SELECT "ERR-LGNFAIL-001" AS outErrCode, concat('Exception invoked with param', ' nip=', inNip) AS outErrMsg
		INTO outErrCode2, outErrMsg2;
    
		INSERT TRX_LOGIN_FAIL
        (ID_OFFICER, LOGIN_TIME, SESSION_ID)
        VALUES
        (`GET_ID_OFFICER`(inNip), NOW(), inSessId);
        
    END;
	
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		SELECT "ERR-LGNFAIL-002" AS outErrCode, concat('Exception invoked with param', ' nip=', inNip, ' ,session id=', inSessId) AS outErrMsg
		INTO outErrCode2, outErrMsg2;
    
		SELECT count(1)
		INTO vCountRec
		FROM trx_login_fail a
		WHERE a.id_officer = `GET_ID_OFFICER`(inNip)
        AND a.session_id = inSessId;
	
		IF (vCountRec=3) THEN
        
			BEGIN
				DECLARE EXIT HANDLER FOR SQLEXCEPTION
				SELECT "ERR-LGNFAIL-003" AS outErrCode, concat('Exception invoked with param', ' nip=', inNip) AS outErrMsg
				INTO outErrCode2, outErrMsg2;
			
				UPDATE MST_LOGIN SET IS_LOCKED = 'T' WHERE ID_OFFICER = `GET_ID_OFFICER`(inNip);
				
			END;
        
        END IF;        
    END;
    
    IF (outErrCode2 IS NOT NULL) THEN
		SET outErrCode = outErrCode2;
        SET outErrMsg = outErrMsg2;
        LEAVE start_point;
    END IF;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prcLoginLog` (IN `inNip` BIGINT, IN `inSessId` VARCHAR(255), OUT `outErrCode` VARCHAR(255), OUT `outErrMsg` VARCHAR(255))  start_point: BEGIN
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		SELECT "ERR-LGNLOG-001" AS outErrCode, concat('Exception invoked with param', ' nip=', inNip, ' session=', inSessId) AS outErrMsg
		INTO outErrCode, outErrMsg;
    
		INSERT trx_login_hist
        (ID_OFFICER, SESSION_ID)
        VALUES
        (`GET_ID_OFFICER`(inNip), inSessId);
        
    END;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		SELECT "ERR-LGNLOG-002" AS outErrCode, concat('Exception invoked with param', ' nip=', inNip, ' session=', inSessId) AS outErrMsg
		INTO outErrCode, outErrMsg;
    
		UPDATE mst_login SET last_login = NOW() WHERE ID_OFFICER = `GET_ID_OFFICER`(inNip);
        
    END;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prcLoginValidation` (IN `inNip` BIGINT, IN `inPswd` VARCHAR(255), IN `inSessId` VARCHAR(255), OUT `outErrCode` VARCHAR(255), OUT `outErrMsg` VARCHAR(255))  start_point: BEGIN

DECLARE vExistsRecord INT;
DECLARE vIsLocked CHAR;

	IF(inNip = 0) THEN
		SET outErrCode = "ERR-LOGIN-001";
		SET outErrMsg = "NIP can't empty";
		LEAVE start_point;
	END IF;
	
	IF(inPswd is null || length(inPswd) = 0) THEN
		SET outErrCode = concat("ERR-LOGIN-002", inPswd);
		SET outErrMsg = "Password can't empty";
		LEAVE start_point;
	END IF;
	
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		SELECT "ERR-LOGIN-003" AS outErrCode, concat('Exception invoked with param', ' nip=', inNip) AS outErrMsg
		INTO outErrCode, outErrMsg;
    
		SELECT 1
		INTO vExistsRecord
		FROM mst_officer a, mst_login b
		WHERE a.id_officer = b.id_officer
		AND a.nip = inNip;
	
		IF(vExistsRecord IS NULL) THEN
			SET outErrCode = "ERR-LOGIN-004";
			SET outErrMsg = "NIP doesn't exists";
			LEAVE start_point;
		END IF;
    END;
	
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		SELECT "ERR-LOGIN-005" AS outErrCode, concat('Exception invoked with param', ' nip=', inNip) AS outErrMsg
		INTO outErrCode, outErrMsg;
    
		SELECT b.is_locked
		INTO vIsLocked
		FROM mst_officer a, mst_login b
		WHERE a.id_officer = b.id_officer
		AND a.nip = inNip;
	
		IF(vIsLocked IS NULL) THEN
			SET vIsLocked = 'F';
		END IF;
        
        IF(vIsLocked='T') THEN
			SET outErrCode = "ERR-LOGIN-006";
			SET outErrMsg = "Account is locked";
			LEAVE start_point;
        END IF;
    END;
	
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		SELECT "ERR-LOGIN-007" AS outErrCode, concat('Exception invoked with param', ' nip=', inNip, ' ,pswd=', inPswd) AS outErrMsg
		INTO outErrCode, outErrMsg;
    
		SELECT count(1)
		INTO vExistsRecord
		FROM mst_officer a, mst_login b
		WHERE a.id_officer = b.id_officer
		AND a.nip = inNip
        AND b.pswd = inPswd;
	
		IF (vExistsRecord<1) THEN
			SET outErrCode = "ERR-LOGIN-008";
			SET outErrMsg = "Wrong password!";
            
            CALL `prcLoginFailure`(inNip, inSessId, outErrCode, outErrMsg);
			IF(outErrCode IS NOT NULL) THEN
				LEAVE start_point;
			END IF;
            
			LEAVE start_point;
        END IF;        
    END;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prcUpdMstLogin` (IN `inIdOfficer` INT, IN `inPswd` VARCHAR(255), IN `inIsLocked` VARCHAR(1), IN `inForceChangePswd` VARCHAR(1), OUT `outErrCode` VARCHAR(255), OUT `outErrMsg` VARCHAR(255))  start_point: BEGIN
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		SELECT "ERR-UPDMSTLOGIN-001" AS outErrCode, concat('Exception invoked with param', ' id officer=', inIdOfficer, ' pswd=', inPswd, ' is locked=', inIsLocked, ' force change pswd=', inForceChangePswd) AS outErrMsg
		INTO outErrCode, outErrMsg;
    
		UPDATE mst_login SET
			pswd = inPswd,
            is_locked = inIsLocked,
            force_change_pswd = inForceChangePswd
		WHERE id_officer = inIdOfficer;
        
    END;
    
 END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GET_CURR_QUEUE` (`inIdOfficer` INT) RETURNS INT(11) start_point: BEGIN 
	
    DECLARE vExists INT;
    DECLARE vQueueNum INT;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vExists = 0;
    
		SELECT count(1)
		INTO vExists
		FROM trx_counter a
		WHERE a.id_officer = inIdOfficer;
	
		IF (vExistsRecord<1) THEN
			LEAVE start_point;
        END IF;        
    END;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vQueueNum = "";
    
		SELECT a.queue_number
		INTO vQueueNum
		FROM trx_counter a
		WHERE a.id_officer = inIdOfficer;
        
    END;
    
    RETURN vQueueNum; 
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GET_FORCE_PWD_FLAG` (`inNip` BIGINT) RETURNS VARCHAR(1) CHARSET latin1 start_point: BEGIN 
	
    DECLARE vRet VARCHAR(1);
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vRet = NULL;
    
		SELECT
        CASE
			WHEN a.force_change_pswd IS NULL THEN "F"
			WHEN a.force_change_pswd = "" THEN "F"
			ELSE a.force_change_pswd
        END
		INTO vRet
		FROM mst_login a
		WHERE a.id_officer = `GET_ID_OFFICER`(inNip);     
    END;
    
    RETURN vRet; 
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GET_ID_OFFICER` (`inNip` BIGINT) RETURNS INT(11) start_point: BEGIN 
	
    DECLARE vExists INT;
    DECLARE vId_Officer INT;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vExists = 0;
    
		SELECT count(1)
		INTO vExists
		FROM mst_officer a
		WHERE a.nip = inNip;
	
		IF (vExists<1) THEN
			LEAVE start_point;
        END IF;        
    END;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vId_Officer = 0;
    
		SELECT a.id_officer
		INTO vId_Officer
		FROM mst_officer a
		WHERE a.nip = inNip;
        
    END;
    
    RETURN vId_Officer; 
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GET_OFFICER_DISP_NAME` (`inIdOfficer` INT) RETURNS VARCHAR(100) CHARSET latin1 start_point: BEGIN 
	
    DECLARE vExists INT;
    DECLARE vOfficer_Disp_Name VARCHAR(100);
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vExists = 0;
    
		SELECT count(1)
		INTO vExists
		FROM mst_officer a
		WHERE a.id_officer = inIdOfficer;
	
		IF (vExistsRecord<1) THEN
			LEAVE start_point;
        END IF;        
    END;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vOfficer_Disp_Name = "";
    
		SELECT a.displayed_name
		INTO vOfficer_Disp_Name
		FROM mst_officer a
		WHERE a.id_officer = inIdOfficer;
        
    END;
    
    RETURN vOfficer_Disp_Name; 
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GET_PSWD_OFFICER` (`inIdOfficer` BIGINT) RETURNS VARCHAR(100) CHARSET latin1 start_point: BEGIN 
	
    DECLARE vRet VARCHAR(100);
    
    IF ITS_EXISTS_ID_OFFICER(inIdOfficer) = 0 THEN -- FALSE
		SET vRet = NULL;
		RETURN vRet;
    END IF;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vRet = NULL;
    
		SELECT pswd
		INTO vRet
		FROM mst_login a
		WHERE a.id_officer = inIdOfficer;
        
    END;
    
    RETURN vRet; 
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GET_QUEUE_GROUP` (`inIdOfficer` INT) RETURNS VARCHAR(1) CHARSET latin1 start_point: BEGIN 
	
    DECLARE vExists INT;
    DECLARE vQueueGroup VARCHAR(1);
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vExists = 0;
    
		SELECT count(1)
		INTO vExists
		FROM trx_counter a
		WHERE a.id_officer = inIdOfficer;
	
		IF (vExistsRecord<1) THEN
			LEAVE start_point;
        END IF;        
    END;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vQueueGroup = "";
    
		SELECT a.queue_group
		INTO vQueueGroup
		FROM trx_counter a
		WHERE a.id_officer = inIdOfficer;
        
    END;
    
    RETURN vQueueGroup; 
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GET_SESSION_ID` () RETURNS INT(11) start_point: BEGIN 
	
    DECLARE vRet INT;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vRet = 0;
        
		SELECT param_value+1
		INTO vRet
		FROM mst_param
		WHERE param_name = 'SESSION_ID';
    END;
    
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vRet = 0;
        
		UPDATE mst_param SET param_value = vRet
		WHERE param_name = 'SESSION_ID';
    END;
    
    RETURN vRet; 
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `ITS_EXISTS_ID_OFFICER` (`inIdOfficer` INT) RETURNS TINYINT(1) start_point: BEGIN 
	
    DECLARE vExists INT;
    DECLARE vRet BOOLEAN;
    
    BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
        SET vRet = FALSE;
    
		SELECT count(1)
		INTO vExists
		FROM mst_officer a
		WHERE a.id_officer = inIdOfficer;
	
		IF (vExists<1) THEN
			SET vRet = FALSE;
        ELSE
			SET vRet = TRUE;
        END IF;  
    END;
    
    RETURN vRet; 
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mst_login`
--

CREATE TABLE `mst_login` (
  `id_officer` int(11) NOT NULL,
  `pswd` varchar(100) NOT NULL,
  `is_locked` varchar(1) NOT NULL,
  `force_change_pswd` varchar(1) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_login`
--

INSERT INTO `mst_login` (`id_officer`, `pswd`, `is_locked`, `force_change_pswd`, `last_login`) VALUES
(1, '202cb962ac59075b964b07152d234b70', 'F', 'T', '2018-12-19 07:16:00'),
(2, '202cb962ac59075b964b07152d234b70', 'F', 'T', '2018-12-19 07:16:00'),
(3, '202cb962ac59075b964b07152d234b70', 'F', 'T', '2018-12-19 07:16:00'),
(4, 'e10adc3949ba59abbe56e057f20f883e', 'F', 'F', '2018-12-26 07:38:09'),
(5, '202cb962ac59075b964b07152d234b70', 'F', 'T', '2018-12-19 07:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_officer`
--

CREATE TABLE `mst_officer` (
  `id_officer` int(11) NOT NULL,
  `nip` bigint(11) NOT NULL,
  `officer_name` varchar(100) NOT NULL,
  `displayed_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_officer`
--

INSERT INTO `mst_officer` (`id_officer`, `nip`, `officer_name`, `displayed_name`) VALUES
(1, 196608161989031001, 'AGOESMAN', 'AGOESMAN'),
(2, 198806302017121002, 'AKBAR SANJAYA, S.Ikom', 'AKBAR'),
(3, 199505142017121001, 'VANDIGA LUKSI ALMAHATMA, S.I.Kom', 'VANDIGA'),
(4, 198212162010121001, 'IVAN ILHANSYAH', 'IVAN'),
(5, 196509301990031001, 'AHMAD YANI', 'YANI');

-- --------------------------------------------------------

--
-- Table structure for table `mst_param`
--

CREATE TABLE `mst_param` (
  `id_param` int(11) NOT NULL,
  `param_name` varchar(100) NOT NULL,
  `param_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_param`
--

INSERT INTO `mst_param` (`id_param`, `param_name`, `param_value`) VALUES
(1, 'BLINK', 'F'),
(2, 'BLINK_ADMIN', 'F'),
(3, 'SESSION_ID', '2');

-- --------------------------------------------------------

--
-- Table structure for table `runningtext`
--

CREATE TABLE `runningtext` (
  `id_runnungtext` int(11) NOT NULL,
  `textdesc` varchar(500) NOT NULL,
  `activeflag` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trx_counter`
--

CREATE TABLE `trx_counter` (
  `id_loket` int(11) NOT NULL,
  `loket_name` varchar(100) NOT NULL,
  `id_officer` int(11) NOT NULL,
  `queue_group` varchar(1) NOT NULL,
  `queue_number` int(11) NOT NULL,
  `call_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blink_flag` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_counter`
--

INSERT INTO `trx_counter` (`id_loket`, `loket_name`, `id_officer`, `queue_group`, `queue_number`, `call_time`, `blink_flag`) VALUES
(1, 'CUSTOMER SERVICE 1', 1, 'A', 2, '2018-11-28 13:49:00', 'F'),
(2, 'CUSTOMER SERVICE 2', 2, 'A', 0, '2018-11-28 14:07:43', 'F'),
(3, 'CUSTOMER SERVICE 3', 3, 'A', 0, '2018-11-28 14:07:54', 'F'),
(4, 'PENGAMBILAN PASPOR', 4, 'C', 1, '2018-11-28 14:08:00', 'F'),
(5, 'LAYANAN WNI', 5, 'B', 100, '2018-11-28 14:08:05', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `trx_login_fail`
--

CREATE TABLE `trx_login_fail` (
  `id_officer` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_login_fail`
--

INSERT INTO `trx_login_fail` (`id_officer`, `login_time`, `session_id`) VALUES
(4, '2018-12-26 07:06:24', '1');

-- --------------------------------------------------------

--
-- Table structure for table `trx_login_hist`
--

CREATE TABLE `trx_login_hist` (
  `id_officer` int(11) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_login_hist`
--

INSERT INTO `trx_login_hist` (`id_officer`, `log_time`, `session_id`) VALUES
(4, '2018-12-26 06:13:17', 2),
(4, '2018-12-26 07:06:31', 1),
(4, '2018-12-26 07:06:53', 2),
(4, '2018-12-26 07:10:12', 2),
(4, '2018-12-26 07:25:19', 2),
(4, '2018-12-26 07:32:45', 2),
(4, '2018-12-26 07:38:09', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_login`
--
ALTER TABLE `mst_login`
  ADD PRIMARY KEY (`id_officer`);

--
-- Indexes for table `mst_officer`
--
ALTER TABLE `mst_officer`
  ADD PRIMARY KEY (`id_officer`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `mst_param`
--
ALTER TABLE `mst_param`
  ADD PRIMARY KEY (`id_param`),
  ADD UNIQUE KEY `MST_PARAM_IDX01` (`param_name`);

--
-- Indexes for table `runningtext`
--
ALTER TABLE `runningtext`
  ADD PRIMARY KEY (`id_runnungtext`);

--
-- Indexes for table `trx_counter`
--
ALTER TABLE `trx_counter`
  ADD PRIMARY KEY (`id_loket`),
  ADD UNIQUE KEY `LOKET_NAME_IDX01` (`loket_name`),
  ADD KEY `blink_flag` (`blink_flag`);

--
-- Indexes for table `trx_login_fail`
--
ALTER TABLE `trx_login_fail`
  ADD PRIMARY KEY (`id_officer`,`login_time`);

--
-- Indexes for table `trx_login_hist`
--
ALTER TABLE `trx_login_hist`
  ADD PRIMARY KEY (`id_officer`,`log_time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_officer`
--
ALTER TABLE `mst_officer`
  MODIFY `id_officer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_param`
--
ALTER TABLE `mst_param`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `runningtext`
--
ALTER TABLE `runningtext`
  MODIFY `id_runnungtext` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trx_counter`
--
ALTER TABLE `trx_counter`
  MODIFY `id_loket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
