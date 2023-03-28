<?php
    include '../../core/conn.php';

    $uset_arr_temp = $_POST['uset_arr_temp'];
    

    // foreach($dem_save as $k => $v){
      $un = isset($_POST['uset_arr_temp']['un']) ? $_POST['uset_arr_temp']['un'] : '';
      $inp_fn = isset($_POST['uset_arr_temp']['inp_fn']) ? $_POST['uset_arr_temp']['inp_fn'] : '';
      $inp_ln = isset($_POST['uset_arr_temp']['inp_ln']) ? $_POST['uset_arr_temp']['inp_ln'] : '';
      $inp_mp = isset($_POST['uset_arr_temp']['inp_mp']) ? $v['inp_mp'] : '';
      $inp_em = isset($_POST['uset_arr_temp']['inp_em']) ? $_POST['uset_arr_temp']['inp_em'] : '';
      $inp_ad = isset($_POST['uset_arr_temp']['inp_ad']) ? $_POST['uset_arr_temp']['inp_ad'] : '';
      $sel_de = isset($_POST['uset_arr_temp']['sel_den']) ? $_POST['uset_arr_temp']['sel_de'] : '';
      $sel_st = isset($_POST['uset_arr_temp']['sel_st']) ? $_POST['uset_arr_temp']['sel_st'] : '';
      $inp_un = isset($_POST['uset_arr_temp']['inp_un']) ? $_POST['uset_arr_temp']['inp_un'] : '';
      $inp_pw = isset($_POST['uset_arr_temp']['inp_pw']) ? $_POST['uset_arr_temp']['inp_pw'] : '';
      $inp_pwf = isset($_POST['uset_arr_temp']['inp_pwf']) ? $_POST['uset_arr_temp']['inp_pwf'] : '';
      $inp_bk = isset($_POST['uset_arr_temp']['inp_bk']) ? $_POST['uset_arr_temp']['inp_bk'] : '';
      $inp_bn = isset($_POST['uset_arr_temp']['inp_bn']) ? $_POST['uset_arr_temp']['inp_bn'] : '';

      echo  $sql_save = "
        UPDATE
            `user`
        SET
            `user_number` = '$un',
            `first_name` = '$inp_fn',
            `last_name` = '$inp_ln',
            `address` = '$inp_ad',
            `mobile_number` = '$inp_ad',
            `email` = '$inp_em',
            `sec_user_id` = '$inp_un',
            `sec_user_pass` = '$inp_pw',
            `pincode_forgot` = '$inp_pwf',
            `status_user` = '$sel_st',
            `department_number` = '$sel_de',
            `bank_number` = '$inp_bn',
            `bank_name` = '$inp_bk'
        WHERE
            1
        ";
      

    //}
    
    // $sql_request_raw_user = "
    // SELECT * FROM user WHERE ID = $user_number";

  
      //echo json_encode(array('sqru'=>$sqru));
?>