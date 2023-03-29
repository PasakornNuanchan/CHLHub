<?php
    include '../../core/conn.php';

    $uset_arr_temp = $_POST['uset_arr_temp'];
    

    
      $user_number = isset($_POST['uset_arr_temp']['user_number']) ? $_POST['uset_arr_temp']['user_number'] : '';
      $un = isset($_POST['uset_arr_temp']['un']) ? $_POST['uset_arr_temp']['un'] : '';
      $inp_fn = isset($_POST['uset_arr_temp']['inp_fn']) ? $_POST['uset_arr_temp']['inp_fn'] : '';
      $inp_ln = isset($_POST['uset_arr_temp']['inp_ln']) ? $_POST['uset_arr_temp']['inp_ln'] : '';
      $inp_mp = isset($_POST['uset_arr_temp']['inp_mp']) ? $_POST['uset_arr_temp']['inp_mp'] : '';
      $inp_em = isset($_POST['uset_arr_temp']['inp_em']) ? $_POST['uset_arr_temp']['inp_em'] : '';
      $inp_ad = isset($_POST['uset_arr_temp']['inp_ad']) ? $_POST['uset_arr_temp']['inp_ad'] : '';
      $sel_de = isset($_POST['uset_arr_temp']['sel_de']) ? $_POST['uset_arr_temp']['sel_de'] : '';
      $sel_st = isset($_POST['uset_arr_temp']['sel_st']) ? $_POST['uset_arr_temp']['sel_st'] : '';
      $inp_un = isset($_POST['uset_arr_temp']['inp_un']) ? $_POST['uset_arr_temp']['inp_un'] : '';
      $inp_pw = isset($_POST['uset_arr_temp']['inp_pw']) ? $_POST['uset_arr_temp']['inp_pw'] : '';
      $inp_pwf = isset($_POST['uset_arr_temp']['inp_pwf']) ? $_POST['uset_arr_temp']['inp_pwf'] : '';
      $inp_bk = isset($_POST['uset_arr_temp']['inp_bk']) ? $_POST['uset_arr_temp']['inp_bk'] : '';
      $inp_bn = isset($_POST['uset_arr_temp']['inp_bn']) ? $_POST['uset_arr_temp']['inp_bn'] : '';

        $check_username = "
            SELECT sec_user_id FROM user WHERE sec_user_id = '$inp_un'";
        $result_check_sec_id = $con->query($check_username);

        $check_user_number = "
            SELECT user_number FROM user WHERE user_number = '$un'
        ";
        $result_check_user_number = $con->query($check_user_number);

        $check_pass = 0;

        if ($result_check_user_number->num_rows > 0) {
            $arr_suc['st'] = '4';
            $check_pass = 1;
        }
        if ($result_check_sec_id->num_rows > 0) {
            $arr_suc['st'] = '3';
            $check_pass = 1;
        }

        if($check_pass == 0){
            if ($user_number != 'undefined') {
                $sql_save = "
                            UPDATE
                                `user`
                            SET
                                `user_number` = '$un',
                                `first_name` = '$inp_fn',
                                `last_name` = '$inp_ln',
                                `address` = '$inp_ad',
                                `mobile_number` = '$inp_mp',
                                `email` = '$inp_em',
                                `sec_user_id` = '$inp_un',
                                `sec_user_pass` = '$inp_pw',
                                `pincode_forgot` = '$inp_pwf',
                                `status_user` = '$sel_st',
                                `department_number` = '$sel_de',
                                `bank_number` = '$inp_bn',
                                `bank_name` = '$inp_bk'
                            WHERE
                                ID = '$user_number'
                            ";
            } else {
                $sql_save = "
                            INSERT INTO `user`(
                                `user_number`,
                                `first_name`,
                                `last_name`,
                                `address`,
                                `mobile_number`,
                                `email`,
                                `sec_user_id`,
                                `sec_user_pass`,
                                `pincode_forgot`,
                                `status_user`,
                                `department_number`,
                                `bank_number`,
                                `bank_name`
                            )
                            VALUES(
                                '$un',
                                '$inp_fn',
                                '$inp_ln',
                                '$inp_ad',
                                '$inp_mp',
                                '$inp_em',
                                '$inp_un',
                                '$inp_pw',
                                '$inp_pwf',
                                '$sel_st',
                                '$sel_de',
                                '$inp_bn',
                                '$inp_bk'
                            )
                            ";

                if ($con->query($sql_save) != 1) {
                    $arr_suc['st'] = '0';
                } else {
                    $arr_suc['st'] = '1';
                }
            }
        }


      

        echo json_encode($arr_suc);
   
?>