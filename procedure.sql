DROP PROCEDURE prcLogin;

DELIMITER //
CREATE PROCEDURE prcLogin(IN inNip VARCHAR(255), IN inPswd VARCHAR(255), OUT outErrCode VARCHAR(255), OUT outErrMsg VARCHAR(255))
start_point: BEGIN

DECLARE vExistsRecord INT;
	
DECLARE EXIT HANDLER FOR 1172
SELECT "ERR-LOGIN-004" AS outErrCode, 'MySQL error code 1172 invoked' AS outErrMsg;

	IF(inNip IS NULL) THEN
		SET outErrCode = "ERR-LOGIN-001";
		SET outErrMsg = "NIP can't null";
		LEAVE start_point;
	END IF;
	
	IF(inPswd IS NULL) THEN
		SET outErrCode = "ERR-LOGIN-002";
		SET outErrMsg = "Password can't null";
		LEAVE start_point;
	END IF;
	
	SELECT 1
	INTO vExistsRecord
	FROM mst_officer a, mst_login b
	WHERE a.id_officer = b.id_officer
	AND a.nip = '196608161989031001'
    OR a.nip = '198806302017121002';
	
	IF(vExistsRecord IS NULL) THEN
		SET outErrCode = "ERR-LOGIN-003";
		SET outErrMsg = "NIP doesn't exists";
		LEAVE start_point;
	END IF;
 END //
DELIMITER ;

CALL prcLogin('196608161989031001', 'imigrasi123',@outErrCode,@outErrMsg);
SELECT @outErrCode AS  outErrCode, @outErrMsg AS  outErrMsg;