<?php
    include '../../core/conn.php';

    $arr_data = $_POST['arr_data'];
    
    foreach($arr_data as $k => $v){
        
        $inp_fn = isset($v['inp_fn']) ? $v['inp_fn'] : '';
        $inp_ln = isset($v['inp_ln']) ? $v['inp_ln'] : '';
        $inp_mp = isset($v['inp_mp']) ? $v['inp_mp'] : '';
        $inp_em = isset($v['inp_em']) ? $v['inp_em'] : '';
        $inp_ad = isset($v['inp_ad']) ? $v['inp_ad'] : '';
        $sel_de = isset($v['sel_de']) ? $v['sel_de'] : '';
        $sel_st = isset($v['sel_st']) ? $v['sel_st'] : '';
        $inp_new_password = isset($v['inp_new_password']) ? $v['inp_new_password'] : '';
        $inp_bk = isset($v['inp_bk']) ? $v['inp_bk'] : '';
        $inp_bn = isset($v['inp_bn']) ? $v['inp_bn'] : '';
        $id_number = isset($v['id_number']) ? $v['id_number'] : '';


        if($id_number != ''){
            if($inp_new_password != ''){
                $sql_save = "
                UPDATE
                    `user`
                SET
                    `first_name` = '$inp_fn',
                    `last_name` = '$inp_ln',
                    `address` = '$inp_ad',
                    `mobile_number` = '$inp_mp',
                    `email` = '$inp_em',
                    `sec_user_pass` = '$inp_new_password',
                    `status_user` = '$sel_st',
                    `department_number` = '$sel_de',
                    `bank_number` = '$inp_bn',
                    `bank_name` = '$inp_bk'
                WHERE
                    ID = '$id_number'
                ";
            }else{
                $sql_save = "
                UPDATE
                    `user`
                SET
                    `first_name` = '$inp_fn',
                    `last_name` = '$inp_ln',
                    `address` = '$inp_ad',
                    `mobile_number` = '$inp_mp',
                    `email` = '$inp_em',
                    `status_user` = '$sel_st',
                    `department_number` = '$sel_de',
                    `bank_number` = '$inp_bn',
                    `bank_name` = '$inp_bk'
                WHERE
                    ID = '$id_number'
                ";
            }
        }else{
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
        }
    }
    
    // echo $sql_save;
    if ($con->query($sql_data_query) != 1) {
        $arr_suc = '0';
    } else {
        $arr_suc = '1';
    }
    echo json_encode($arr_suc);
      
        // if($check_pass == 0){
        //     if ($user_number != 'undefined') {
        //         $sql_save = "
        //                     UPDATE
        //                         `user`
        //                     SET
        //                         `user_number` = '$un',
        //                         `first_name` = '$inp_fn',
        //                         `last_name` = '$inp_ln',
        //                         `address` = '$inp_ad',
        //                         `mobile_number` = '$inp_mp',
        //                         `email` = '$inp_em',
        //                         `sec_user_id` = '$inp_un',
        //                         `sec_user_pass` = '$inp_pw',
        //                         `pincode_forgot` = '$inp_pwf',
        //                         `status_user` = '$sel_st',
        //                         `department_number` = '$sel_de',
        //                         `bank_number` = '$inp_bn',
        //                         `bank_name` = '$inp_bk'
        //                     WHERE
        //                         ID = '$user_number'
        //                     ";
        //     } else {
        //         $sql_save = "
        //                     INSERT INTO `user`(
        //                         `user_number`,
        //                         `first_name`,
        //                         `last_name`,
        //                         `address`,
        //                         `mobile_number`,
        //                         `email`,
        //                         `sec_user_id`,
        //                         `sec_user_pass`,
        //                         `pincode_forgot`,
        //                         `status_user`,
        //                         `department_number`,
        //                         `bank_number`,
        //                         `bank_name`
        //                     )
        //                     VALUES(
        //                         '$un',
        //                         '$inp_fn',
        //                         '$inp_ln',
        //                         '$inp_ad',
        //                         '$inp_mp',
        //                         '$inp_em',
        //                         '$inp_un',
        //                         '$inp_pw',
        //                         '$inp_pwf',
        //                         '$sel_st',
        //                         '$sel_de',
        //                         '$inp_bn',
        //                         '$inp_bk'
        //                     )
        //                     ";

        //         if ($con->query($sql_save) != 1) {
        //             $arr_suc['st'] = '0';
        //         } else {
        //             $arr_suc['st'] = '1';
        //         }
        //     }
        // }


      

        // echo json_encode($arr_suc);
   
?>