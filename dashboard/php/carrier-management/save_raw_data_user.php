<?php
    include '../../core/conn.php';

    $uset_arr_temp = $_POST['uset_arr_temp'];
    

    
      $carrier_id = isset($_POST['uset_arr_temp']['carrier_id']) ? $_POST['uset_arr_temp']['carrier_id'] : '';
      //$carrier_number = isset($_POST['uset_arr_temp']['carrier_number']) ? $_POST['uset_arr_temp']['carrier_number'] : '';
      $corp_name = isset($_POST['uset_arr_temp']['corp_name']) ? $_POST['uset_arr_temp']['corp_name'] : '';
      $corp_sub_name = isset($_POST['uset_arr_temp']['corp_sub_name']) ? $_POST['uset_arr_temp']['corp_sub_name'] : '';
      $corp_em = isset($_POST['uset_arr_temp']['corp_em']) ? $_POST['uset_arr_temp']['corp_em'] : '';
      $phone_number = isset($_POST['uset_arr_temp']['phone_number']) ? $_POST['uset_arr_temp']['phone_number'] : '';
      $contact = isset($_POST['uset_arr_temp']['contact']) ? $_POST['uset_arr_temp']['contact'] : '';

        $data_type = "";
        $last_id = "";
            if ($carrier_id != '') {
                $sql_save = "
                UPDATE
                    `carrier`
                SET
                    `carrier_name` = '$corp_name',
                    `carrier_sub_name` = '$corp_sub_name',
                    `email` = '$corp_em',
                    `phone_number` = '$phone_number',
                    `contact_name` = '$contact'
                WHERE
                    `ID` = '$carrier_id'
                    ";
                $data_type = '1';
            } else {
                $sql_save = "
                INSERT INTO `carrier`(
                    `carrier_name`,
                    `carrier_sub_name`,
                    `email`,
                    `phone_number`,
                    `contact_name`
                )
                VALUES(
                    '$corp_name',
                    '$corp_sub_name',
                    '$corp_em',
                    '$phone_number',
                    '$contact'
                )
                            ";
                $data_type = '2';
            }
            // echo $sql_save;
            if ($con->query($sql_save) != 1) {
                $arr_suc['st'] = '0';
                
            } else {
                $arr_suc['st'] = '1';
                // echo $data_type;
                $last_id_insert = $con->insert_id;
                $last_id_update = $carrier_id;
                if($data_type == '1'){
                    $last_id = $last_id_update;
                }else{
                    $last_id = $last_id_insert;
                }
            }
            

        echo json_encode(array('arr_suc'=>$arr_suc,'last_id'=>$last_id));
//    
?>