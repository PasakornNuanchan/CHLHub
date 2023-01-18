<?php
require_once('../../core/ctc_init.php'); // add by CTC
require_once('../../language/Lang_Lib.php');
require('../../language/conn.inc');

$comp = ctc_get_session_comp(); // add by CTC

$query_cusno1 = "
	SELECT DISTINCT cusno1 from awscusmas where Owner_Comp = 'TK0';
";  // edit by CTC
$sqlResult_cusno1 = mysqli_query($msqlcon,$query_cusno1);
while ($cusno1_number = mysqli_fetch_assoc($sqlResult_cusno1)) {
    print_r($cusno1_number);
}




$query = "
	INSERT INTO awsexc(
		Owner_comp,
		itnbr,
		cusno1,
		sell,
		cusgrp
	)
	SELECT DISTINCT
		sellprice.Owner_Comp,
		sellprice.itnbr,
		awscusmas.cusno1,
		'1',
		awscusmas.cusgrp
	FROM
		awscusmas
	JOIN sellprice ON awscusmas.cusno1 = sellprice.cusno
	WHERE
		sellprice.Owner_Comp = 'TK0' AND sellprice.Cusno = '23011300' AND sellprice.Itnbr NOT IN(
		SELECT DISTINCT
			itnbr
		FROM
			awsexc
		WHERE
			cusno1 = '23011300'
	)
";  // edit by CTC
$sqlResult = mysqli_query($msqlcon,$query);
while ($axQuery = mysqli_fetch_assoc($sqlResult)) {
    print_r($axQuery);
}
?>