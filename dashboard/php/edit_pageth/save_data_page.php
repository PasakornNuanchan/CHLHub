<?php
require '../../core/conn.php';
require '../../function/auth/get_session.php';

$header_data_arr = $_POST['header_data_arr'];
$service_data_arr = $_POST['service_data_arr'];
$about_data_arr = $_POST['about_data_arr'];
$contact_data_arr = $_POST['contact_data_arr'];
$delete_header = $_POST['delete_header'];
$delete_service = $_POST['delete_service'];
$event_data_arr = $_POST['event_data_arr'];
$event_data_photo_arr = $_POST['event_data_photo_arr'];

$delete_event_arr = $_POST['delete_event_arr'];
$delete_event_photo_arr = $_POST['delete_event_photo_arr'];

foreach($delete_event_arr as $k => $v){
    $data_id = isset($v['keep_set']) ? $v['keep_set'] : '';
    $sql_delete_event = "
    DELETE
    FROM 
        `chl_pageth_event` 
    WHERE 
        ID '$data_id'";
    
    $sql_delete_event_photo = "
    DELETE FROM `chl_pageth_event_photo` WHERE ref_id_event = '$data_id'";

    if($con->query($sql_delete_event,$sql_delete_event_photo) != 1){
        $arr_suc['stde'] = '0';
    } else {
        $arr_suc['stde'] = '1';
    };
}

foreach($delete_event_photo_arr as $k => $v){
    $data_id = isset($v['keep_set']) ? $v['keep_set'] : '';
    $sql_delete_event_photo = "
    DELETE
    FROM
        `chl_pageth_event_photo`
    WHERE
        ID = '$data_id'";

    if($con->query($sql_delete_event_photo) != 1){
        $arr_suc['stdep'] = '0';
    } else {
        $arr_suc['stdep'] = '1';
    };

}

// print_r($delete_header);
// print_r($delete_service);

// print_r($header_data_arr);
// print_r($service_data_arr);
// print_r($about_data_arr);
// print_r($contact_data_arr);

// print_r($event_data_arr);
// print_r($event_data_photo_arr);
//print_r($event_data_photo_arr);
// foreach($event_data_photo_arr as $k => $v){
//     $photo_id_raw = isset($v['photo_id_raw']) ? $v['photo_id_raw'] : '';
//     $photo_e_raw = isset($v['photo_e_raw']) ? $v['photo_e_raw'] : '';
//     $photo_name = isset($v['photo_name']) ? $v['photo_name'] : '';

//     // if($photo_e_raw == '2'){
//     //     $sql = "$photo_id_raw    $photo_e_raw    $photo_name  ";
//     //     echo $sql;   
//     // }
//     $sql = "$photo_id_raw    $photo_e_raw    $photo_name  ";
//     echo $sql;   
// }

foreach($event_data_arr as $k => $v){
    $event_id_raw = isset($v['event_id_raw']) ? $v['event_id_raw'] : '';
    $event_e_raw = isset($v['event_e_raw']) ? $v['event_e_raw'] : '';
    $event_name = isset($v['event_name']) ? $v['event_name'] : '';

    if($event_id_raw == ''){
        $sql_event = "
        INSERT INTO `chl_pageth_event`(`event_name`)
        VALUES('$event_name')
        ";
        
        if($con->query($sql_event) != 1){
            $arr_suc['stev'] = '0';
        } else {
            $arr_suc['stev'] = '1';
        };

        $sql_get_last_row_chl_page_th_event = "SELECT ID FROM `chl_pageth_event`  ORDER BY ID DESC LIMIT 1";     
        
        $result = $con->query($sql_get_last_row_chl_page_th_event);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $last_id = $row['ID'];
        }
        } else {
            $service = "0 results";
        }

        foreach($event_data_photo_arr as $ka => $va){
            $photo_id_raw = isset($va['photo_id_raw']) ? $va['photo_id_raw'] : '';
            $photo_e_raw = isset($va['photo_e_raw']) ? $va['photo_e_raw'] : '';
            $photo_name = isset($va['photo_name']) ? $va['photo_name'] : '';

            if($photo_e_raw == $event_e_raw){
                $sql_photo = "
                INSERT INTO `chl_pageth_event_photo`(`ref_id_event`, `photo_name`) VALUES ('$last_id','$photo_name')
                ";
                
                if($con->query($sql_photo) != 1){
                    $arr_suc['stevp'] = '0';
                } else {
                    $arr_suc['stevp'] = '1';
                };
                
            }
        }
        
    }else{
        $sql_event = "
        UPDATE
            `chl_pageth_event`
        SET
            `event_name` = '$event_name'
        WHERE
            ID = '$event_id_raw'
        ";

        if($con->query($sql_event) != 1){
            $arr_suc['stev'] = '0';
        } else {
            $arr_suc['stev'] = '1';
        };

        foreach($event_data_photo_arr as $ka => $va){
            $photo_id_raw = isset($va['photo_id_raw']) ? $va['photo_id_raw'] : '';
            $photo_e_raw = isset($va['photo_e_raw']) ? $va['photo_e_raw'] : '';
            $photo_name = isset($va['photo_name']) ? $va['photo_name'] : '';

            if($photo_e_raw == $event_e_raw){
                $sql_photo = "
                UPDATE
                    `chl_pageth_event_photo`
                SET
                    `ref_id_event` = '$event_id_raw',
                    `photo_name` = '$photo_name'
                WHERE
                    ID = '$photo_id_raw'
                ";
                if($con->query($sql_photo) != 1){
                    $arr_suc['stevp'] = '0';
                } else {
                    $arr_suc['stevp'] = '1';
                };
            }
        }
    }
}


foreach($header_data_arr as $k => $v){
    $header_raw = isset($v['header_raw']) ? $v['header_raw'] : '';
    $header_context_raw = isset($v['header_context_raw']) ? $v['header_context_raw'] : '';
    $size_sel_raw = isset($v['size_sel_raw']) ? $v['size_sel_raw'] : '';
    if($header_raw == '' ){
        $sql_header = "
        INSERT INTO `chl_pageth_header`(`context`, `size`)
            VALUES(
                '$header_context_raw',
                '$size_sel_raw'
            )
        ";
    }else{
        $sql_header = "
        UPDATE
            `chl_pageth_header`
        SET
            `context` = '$header_context_raw',
            `size` = '$size_sel_raw'
        WHERE
            ID = '$header_raw'
        ";
        
    }

    if($con->query($sql_header) != 1){
        $arr_suc['sth'] = '0';
    } else {
        $arr_suc['sth'] = '1';
    };
}

foreach($service_data_arr as $k => $v){
    $service_raw = isset($v['service_raw']) ? $v['service_raw'] : '';
    $service_name_raw = isset($v['service_name_raw']) ? $v['service_name_raw'] : '';
    $service_symbol_raw = isset($v['service_symbol_raw']) ? $v['service_symbol_raw'] : '';
    $service_context_raw = isset($v['service_context_raw']) ? $v['service_context_raw'] : '';

    if($service_raw == '' ){
        $sql_sevice = "
        INSERT INTO `chl_pageth_service`(
            `service_name`,
            `sym_bol`,
            `context`
        )
        VALUES(
            '$service_name_raw',
            '$service_symbol_raw',
            '$service_context_raw'
        )
        ";
    }else{
        $sql_sevice = "
        UPDATE
            `chl_pageth_service`
        SET
            
            `service_name` = '$service_name_raw',
            `sym_bol` = '$service_symbol_raw',
            `context` = '$service_context_raw'
        WHERE
            ID = '$service_raw'
        ";
    }
    // echo $sql_sevice;
    if($con->query($sql_sevice) != 1){
        $arr_suc['sts'] = '0';
    } else {
        $arr_suc['sts'] = '1';
    };
}

foreach($about_data_arr as $k => $v){
    $about_raw = isset($v['about_raw']) ? $v['about_raw'] : '';
    $about_context_raw = isset($v['about_context_raw']) ? $v['about_context_raw'] : '';

    $sql_about = "
    UPDATE
        `chl_pageth_about`
    SET
        `context` = '$about_context_raw'
    WHERE
        ID = '$about_raw'
    ";
    
    // echo $sql_about;
    if($con->query($sql_about) != 1){
        $arr_suc['sta'] = '0';
    } else {
        $arr_suc['sta'] = '1';
    };
}

foreach($contact_data_arr as $k => $v){
    $address_id_raw = isset($v['address_id_raw']) ? $v['address_id_raw'] : '';
    $address_raw = isset($v['address_raw']) ? $v['address_raw'] : '';
    $moblie_raw = isset($v['moblie_raw']) ? $v['moblie_raw'] : '';
    $email_raw = isset($v['email_raw']) ? $v['email_raw'] : '';
    $tel_raw = isset($v['tel_raw']) ? $v['tel_raw'] : '';

    $sql_contact = "
    UPDATE
        `chl_pageth_contact`
    SET
        `address` = '$address_raw',
        `tel` = '$tel_raw',
        `mobile` = '$moblie_raw',
        `email` = '$email_raw'
    WHERE
       ID = '$address_id_raw'
    ";
    // echo $sql_contact;
    if($con->query($sql_contact) != 1){
        $arr_suc['stc'] = '0';
    } else {
        $arr_suc['stc'] = '1';
    };

}

foreach($delete_header as $k => $v){
    $keep_set = isset($v['keep_set']) ? $v['keep_set'] : '';

    $sql_delete_header = "
    DELETE
    FROM
        `chl_pageth_header`
    WHERE
        ID = '$keep_set'
    ";

    // echo $sql_delete_header;
    if($con->query($sql_delete_header) != 1){
        $arr_suc['stdh'] = '0';
    } else {
        $arr_suc['stdh'] = '1';
    };
}

foreach($delete_service as $k => $v){
    $keep_set = isset($v['keep_set']) ? $v['keep_set'] : '';

    $sql_delete_service = "
    DELETE
    FROM
        `chl_pageth_service`
    WHERE
        ID = '$keep_set'
    ";

    // echo $sql_delete_service;
    if($con->query($sql_delete_service) != 1){
        $arr_suc['stds'] = '0';
    } else {
        $arr_suc['stds'] = '1';
    };
}



echo json_encode(array('arr_suc'=>$arr_suc))
?>