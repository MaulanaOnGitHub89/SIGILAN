update mst_login set is_locked = 'F', force_change_pswd = 'T' where id_officer <= 10;

update mst_param set param_value = '0' where param_name  = 'SESSION_ID';

TRUNCATE TABLE TRX_LOGIN_FAIL;

TRUNCATE TABLE TRX_LOGIN_HIST;