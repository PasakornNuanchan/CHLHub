<?php
    require '../../core/conn.php';
    require '../../function/auth/get_session.php';

    $st = array('st'=>'1','err'=>'');
    $quo_no = $_POST['quo_no'];

    function create_job_no(){
        include '../../core/conn.php';
        $date = date("Ym");
        $search = $date;
        $sql = "
            SELECT MAX(`job_number`) as 'job_no' FROM `job_title` WHERE `job_number` like '$search%';
        ";
        $query = $con -> query($sql);
        $result = $query->fetch_assoc();
        if($result['job_no'] == null){
            $job_no = $search.'0001';

        }else{
            $job = substr($result['job_no'],-4,4);
            $job_no = str_pad((int)$job + 1, strlen($job), '0', STR_PAD_LEFT);
            $new_job = $job_no;
            $job_no = $search.$new_job;
        }
        return $job_no;

    }


    $con->begin_transaction();
    try {
        //update sign status
        $sql = "UPDATE `quartation_title` SET `status` = '1' WHERE `quartation_title`.`quartation_number` = '$quo_no'";
        $stmt_update_sign = $con->prepare($sql);
        $stmt_update_sign->execute();

        //create job title
        $sql_get_base_quotation = "SELECT * from quartation_detail_base WHERE `quartation_number` = ?";
        $stmt = $con->prepare($sql_get_base_quotation);
        $stmt->bind_param("s", $quo_no);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $result_arr[] = $row;
        }
        $job_no = create_job_no();
        foreach ($result_arr as $k => $v) {
            $date = date("Y-m-d");
            $qdb_id = $v['ID'];
            $creator = $_SESSION['ID'];
            $sql_job = "
            INSERT INTO `job_title`(
                `quo_no`,
                `job_number`,
                `consignee_number`,
                `carrier_number`,
                `port_of_loading_number`,
                `ts_port_number`,
                `type_import_export`,
                `remark`,
                `create_date`,
                `last_save_by`
            )
            (
                SELECT
                    qdb.quartation_number,
                    ?,
                    qt.consignee_number,
                    r.carrier_number,
                    r.pol,
                    r.pod,
                    qt.type,
                    '',
                    '$date',
                    '$creator'
                FROM
                    quartation_title qt
                    LEFT JOIN `quartation_detail_base` qdb on qdb.quartation_number = qt.quartation_number
                    LEFT JOIN route r on r.route_number = qdb.base_service_route
                WHERE qt.quartation_number = ? AND qdb.ID = ?
            )"; 
        
        $stmt = $con->prepare($sql_job);
        $stmt->bind_param("sss", $job_no, $quo_no,$qdb_id);
        $stmt->execute();
        
        //Job Status
        $sql_job_status = "
        INSERT INTO `job_status`(
            `job_number`
        )
        VALUES(
            ?
        )
        ";
        $stmt = $con->prepare($sql_job_status);
        $stmt->bind_param("s", $job_no);
        $stmt->execute();
        
        //Cargo Information
         $sql_cargo_info = "
         INSERT INTO `container_information`(
            `job_number`
         )
         VALUES(
            ?
         )
         ";
         $stmt = $con->prepare($sql_cargo_info);
         $stmt->bind_param("s", $job_no);
         $stmt->execute();

        // Job number +1
        // Prevent loop query 
        $date = date("Ym");
        $search = $date;
        $job = substr($job_no,-4,4);
        $job_no = str_pad((int)$job + 1, strlen($job), '0', STR_PAD_LEFT);
        $new_job = $job_no;
        $job_no = $search.$new_job;
        }



        $con->commit();

        echo json_encode($st);
    } catch (Exception $e) {
         // Rollback the transaction
        $con->rollback();
        $st = array('st'=>'0','err'=>$e->getMessage());

        // Handle the exception
        echo json_encode($st);

    }
