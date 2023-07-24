<?php

require '../../core/conn.php';
require '../../function/auth/get_session.php';



$sql_header = "SELECT * FROM `chl_pageth_header`";
$result = $con->query($sql_header);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $header[] = $row;
  }
} else {
  $header = "0 results";
}

$sql_service = "SELECT * FROM `chl_pageth_service`";
$result = $con->query($sql_service);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $service[] = $row;
  }
} else {
  $service = "0 results";
}

$sql_event = "SELECT * FROM chl_pageth_event";
$result = $con->query($sql_event);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $event[] = $row;
  }
} else {
  $event = "0 results";
}

$sql_event = "SELECT * FROM chl_pageth_event_photo";
$result = $con->query($sql_event);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $photo[] = $row; 
  }

  foreach ($photo as $k => $v) {
    $photo_arr[$v['ref_id_event']][] = $v;
  }
} else {
  $photo = "0 results";
}


$sql_about = "SELECT * FROM `chl_pageth_about`";
$result = $con->query($sql_about);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $about = $row;
  }
} else {
  $about = "0 results";
}

$sql_contact = "SELECT * FROM `chl_pageth_contact`";
$result = $con->query($sql_contact);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $contact = $row;
  }
} else {
  $contact = "0 results";
}


echo json_encode(array('header' => $header, 'service' => $service, 'about' => $about, 'contact' => $contact,'event'=>$event,'photo'=>$photo_arr));
