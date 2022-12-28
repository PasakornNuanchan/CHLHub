<?php
session_start();
require_once('./../../core/ctc_init.php'); // add by CTC

require_once('../../language/Lang_Lib.php');
$comp = ctc_get_session_comp(); // add by CTC
$supno = $_SESSION['supno'];
if (isset($_SESSION['cusno'])) {
	if ($_SESSION['redir'] == 'Order-SG') {
		$cusno =  $_SESSION['cusno'];
		$type = $_SESSION['type'];
		$user = $_SESSION['user'];
	} else {
		echo "<script> document.location.href='../" . redir . "'; </script>";
	}
} else {
	header("Location:../login.php");
}
?>
<html>

<head>
	<title>Denso Ordering System</title>
	<link rel="stylesheet" type="text/css" href="../css/dnia.css">
	</style>
	<!--[if IE]>
<style type="text/css"> 
#twocolLeft{ padding-top: 0px; }
#twocolRight { zoom: 1; padding-top:10px; }
</style>	
<![endif]-->
	<script type="text/javascript" language="javascript" src="../lib/jquery-1.4.2.js"></script>
</head>

<body>

	<?php ctc_get_logo_new() ?>

	<div id="mainNav">


		<ul>
			<li id="current"><a href="maincusadm.php" target="_self">Administration</a></li>
			<li><a href="Profile.php" target="_self">User Profile</a></li>
			<li><a href="../logout.php" target="_self">Log out</a></li>

		</ul>
	</div>
	<div id="isi">

		<div id="twocolLeft">
			<div class="hmenu">
				<h3 class="headerbar">Administration</h3>
				<?
				$MYROOT = $_SERVER['DOCUMENT_ROOT'];
				$_GET['current'] = "partcatalogue";
				include("navAdm.php");
				?>
			</div>
			<div id="twocolRight">

				<h3>Supplier Upload</h3>


				<?php
				include "../db/conn.inc";
				include "../admin/db/Quick_CSV_import.php";
				$query = 'delete from cataloguetemp';
				mysqli_query($msqlcon, $query);
				if (isset($_POST['submit'])) {
					$rdfirstrow = $_POST['rdfirstrow'];
					$rdreplace = $_POST['rdreplace'];
					$userfile = $_FILES['userfile']['name'];
					$ext = strtolower(end(explode('.', $userfile)));
					if ($ext != 'csv') {
						echo get_lng($_SESSION["lng"], "E0068"); // Error File Type, Only allow CSV File";	
					} else {
						//Create Table
						$csv = new Quick_CSV_import();
						$csv->file_name = $_FILES['userfile']['tmp_name'];
						$csv->table_name = 'cataloguetemp';
						$csv->create_importtable();

						$ctc_csv = new CTC_CSV();
						$ctc_csv->file_name = $_FILES['userfile']['tmp_name'];
						$ctc_csv->use_csv_header = isset($_POST["use_csv_header"]);
						$ctc_csv->line_enclose_char = "'\\n'";
						if ($rdfirstrow == 'yesrow') {
							$ctc_csv->use_csv_header = true;
						} else {
							$ctc_csv->use_csv_header = false;
						}
						$ctc_csv->table_name = 'cataloguetemp';
						$ctc_csv->import();

						$qc2 = "SELECT * FROM cataloguetemp "
							. " group by 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17  having count(*) > 1";
						$sqlqc2 = mysqli_query($msqlcon, $qc2);
						$arqc2 = mysqli_fetch_array($sqlqc2);
						if ($arqc2[0]) {
							echo '<form method="POST" enctype="multipart/form-data" action="admimportPartCate.php">';
							echo '<input type="submit" name="nobtn" value="' . get_lng($_SESSION["lng"], "L0521") . '">';
							echo '</form>';
							echo '<br>';
							echo '<table class="tbl1" >';
							echo '<tr class="arial11grey" bgcolor="#AD1D36">';
							echo '<th width="5%" align="center">CarMaker</th>';
							echo '<th width="5%" align="center">ModelName</th>';
							echo '<th width="5%" align="center">Vincode</th>';
							echo '<th width="5%" align="center">ModelCode</th>';
							echo '<th width="5%" align="center">EngineCode</th>';
							echo '<th width="5%" align="center">Cc</th>';
							echo '<th width="5%" align="center">Start</th>';
							echo '<th width="5%" align="center">End</th>';
							echo '<th width="5%" align="center">Genuine Part No.</th>';
							echo '<th width="5%" align="center">DENSO Part No.</th>';
							echo '<th width="5%" align="center">CG Part No.</th>';
							echo '<th width="5%" align="center">Part Name</th>';
							echo '<th width="5%" align="center">Brand</th>';
							echo '<th width="5%" align="center">Order Part No.</th>';
							echo '<th width="5%" align="center">Remark</th>';
							echo '<th width="5%" align="center">Part Pic.</th>';

							echo '<th width="5%" align="center">Prtnohis</th>';
							echo '<th width="5%" align="center">cgprtnohis</th>';
							echo '<th width="5%" align="center">Custprthis</th>';
							echo '</tr>';
							$qa2 = "SELECT * FROM cataloguetemp  LIMIT 10";
							//echo $qa2."<br/><br/>";
							$sqlqa2 = mysqli_query($msqlcon, $qa2);
							while ($arrqa2 = mysqli_fetch_array($sqlqa2)) {
								$Columnnull .= $arrqa2['Columnname'] . ' ';
								$vcarmaker      = $arrqa2['CarMaker'];
								$vmodelname     = $arrqa2['ModelName'];
								$vmodelcode     = $arrqa2['ModelCode'];
								$venginecode    = $arrqa2['EngineCode'];
								$vcc            = $arrqa2['Cc'];
								$vstart         = $arrqa2['Start'];
								$vend           = $arrqa2['End'];
								$vCustprthis  = $arrqa2['Custprthis'];
								$vCprtn      = $arrqa2['Cprtn'];
								$vPrtnohis    = $arrqa2['Prtnohis'];
								$vPrtno      = $arrqa2['Prtno'];
								$vcgprtnohis  = $arrqa2['cgprtnohis'];
								$vCgprtno    = $arrqa2['Cgprtno'];
								$vPrtnm      = $arrqa2['Prtnm'];
								$vordprtno    = $arrqa2['ordprtno'];
								$vVincode    = $arrqa2['Vincode'];
								$vBrand      = $arrqa2['Brand'];
								$vremark        = $arrqa2['Remark'];
								$vpartpic        = $arrqa2['Prtpic'];

								echo "<tr class=\"arial11black\">
									<td>$vcarmaker</td>
									<td>$vmodelname</td>
									<td>$vVincode</td>
									<td>$vmodelcode</td>
									<td>$venginecode</td>
									<td>$vcc</td>
									<td>$vstart</td>
									<td>$vend</td>
									<td>$vCprtn</td>
									<td>$vPrtno</td>
									<td>$vCgprtno</td>
									<td>$vPrtnm</td>
									<td>$vBrand</td>
									<td>$vordprtno</td>
									<td>$vremark</td>
									<td>$vpartpic</td>
									
									<td>$vPrtnohis</td>
									<td>$vcgprtnohis</td>
									<td>$vCustprthis</td>
								</tr>";
							}
							echo "</table>";
							echo "<br/><span class='arial21redbold' width='200px'> " . get_lng($_SESSION["lng"], "E0069") . "</span><br/>";
							echo "<br/><span class='arial21redbold' width='200px'>" . get_lng($_SESSION["lng"], "E0070") . "</span>";
						} else {
							$sqlchknull = "SELECT * FROM cataloguetemp where `CarMaker` = '' or `ModelName` = '' or `ModelCode` = '' or `Prtnm` = '' or `Brand` = '' or `ordprtno` = ''";

							$querynotnull = mysqli_query($msqlcon, $sqlchknull);

							$rowcount = mysqli_num_rows($querynotnull);
							if ($rowcount > 0) {

								echo '<form method="POST" enctype="multipart/form-data" action="admimportPartCate.php">';
								echo '<input type="submit" name="nobtn" value="' . get_lng($_SESSION["lng"], "L0521") . '">';
								echo '</form>';
								echo '<br>';
								echo '<table class="tbl1" >';
								echo '<tr class="arial11grey" bgcolor="#AD1D36">';
								echo '<th width="5%" align="center">CarMaker1</th>';
								echo '<th width="5%" align="center">ModelName</th>';
								echo '<th width="5%" align="center">Vincode</th>';
								echo '<th width="5%" align="center">ModelCode</th>';
								echo '<th width="5%" align="center">EngineCode</th>';
								echo '<th width="5%" align="center">Cc</th>';
								echo '<th width="5%" align="center">Start</th>';
								echo '<th width="5%" align="center">End</th>';
								echo '<th width="5%" align="center">Genuine Part No.</th>';
								echo '<th width="5%" align="center">DENSO Part No.</th>';
								echo '<th width="5%" align="center">CG Part No.</th>';
								echo '<th width="5%" align="center">Part Name</th>';
								echo '<th width="5%" align="center">Brand</th>';
								echo '<th width="5%" align="center">Order Part No.</th>';
								echo '<th width="5%" align="center">Remark</th>';
								echo '<th width="5%" align="center">Part Pic.</th>';

								echo '<th width="5%" align="center">Prtnohis</th>';
								echo '<th width="5%" align="center">cgprtnohis</th>';
								echo '<th width="5%" align="center">Custprthis</th>';
								echo '</tr>';
								$qa2 = "SELECT CASE WHEN
													`CarMaker` = '' THEN 'CarMaker, ' WHEN `ModelName` = '' THEN 'ModelName, ' WHEN `ModelCode` = '' THEN 'ModelCode, ' WHEN `Prtnm` = '' THEN 'PartName, ' WHEN `Brand` = '' THEN 'ProductBrand, ' WHEN `ordprtno` = '' THEN 'Order Part No, ' 
												END AS 'Columnname',
												cataloguetemp.*
												FROM
													cataloguetemp
												LIMIT 10";
								//echo $qa2."<br/><br/>";
								$sqlqa2 = mysqli_query($msqlcon, $qa2);
								$Columnnull = "";
								while ($arrqa2 = mysqli_fetch_array($sqlqa2)) {
									$Columnnull .= $arrqa2['Columnname'] . ' ';
									$vcarmaker      = $arrqa2['CarMaker'];
									$vmodelname     = $arrqa2['ModelName'];
									$vmodelcode     = $arrqa2['ModelCode'];
									$venginecode    = $arrqa2['EngineCode'];
									$vcc            = $arrqa2['Cc'];
									$vstart         = $arrqa2['Start'];
									$vend           = $arrqa2['End'];
									$vCustprthis  = $arrqa2['Custprthis'];
									$vCprtn      = $arrqa2['Cprtn'];
									$vPrtnohis    = $arrqa2['Prtnohis'];
									$vPrtno      = $arrqa2['Prtno'];
									$vcgprtnohis  = $arrqa2['cgprtnohis'];
									$vCgprtno    = $arrqa2['Cgprtno'];
									$vPrtnm      = $arrqa2['Prtnm'];
									$vordprtno    = $arrqa2['ordprtno'];
									$vVincode    = $arrqa2['Vincode'];
									$vBrand      = $arrqa2['Brand'];
									$vremark        = $arrqa2['Remark'];
									$vpartpic        = $arrqa2['Prtpic'];

									echo "<tr class=\"arial11black\">
											<td>$vcarmaker</td>
											<td>$vmodelname</td>
											<td>$vVincode</td>
											<td>$vmodelcode</td>
											<td>$venginecode</td>
											<td>$vcc</td>
											<td>$vstart</td>
											<td>$vend</td>
											<td>$vCprtn</td>
											<td>$vPrtno</td>
											<td>$vCgprtno</td>
											<td>$vPrtnm</td>
											<td>$vBrand</td>
											<td>$vordprtno</td>
											<td>$vremark</td>
											<td>$vpartpic</td>
											
											<td>$vPrtnohis</td>
											<td>$vcgprtnohis</td>
											<td>$vCustprthis</td>
										</tr>";
								}
								echo "</table>";
								echo "<br/><span class='arial21redbold' width='200px'> Column " . $Columnnull . " " . get_lng($_SESSION["lng"], "E0071") . "</span><br/>";
								echo "<br/><span class='arial21redbold' width='200px'>" . get_lng($_SESSION["lng"], "E0070") . "</span>";
							} else {
								$sqlchklotsize = "SELECT * FROM cataloguetemp  where `LotSize` <= 0  ";
								$querylotsize = mysqli_query($msqlcon, $sqlchklotsize);

								$rowcount = mysqli_num_rows($querylotsize);
								if ($rowcount > 0) {

									echo '<form method="POST" enctype="multipart/form-data" action="admimportPartCate.php">';
									echo '<input type="submit" name="nobtn" value="' . get_lng($_SESSION["lng"], "L0521") . '">';
									echo '</form>';
									echo '<br>';
									echo '<table class="tbl1" >';
									echo '<tr class="arial11grey" bgcolor="#AD1D36">';
									echo '<th width="5%" align="center">CarMaker1</th>';
									echo '<th width="5%" align="center">ModelName</th>';
									echo '<th width="5%" align="center">Vincode</th>';
									echo '<th width="5%" align="center">ModelCode</th>';
									echo '<th width="5%" align="center">EngineCode</th>';
									echo '<th width="5%" align="center">Cc</th>';
									echo '<th width="5%" align="center">Start</th>';
									echo '<th width="5%" align="center">End</th>';
									echo '<th width="5%" align="center">Genuine Part No.</th>';
									echo '<th width="5%" align="center">DENSO Part No.</th>';
									echo '<th width="5%" align="center">CG Part No.</th>';
									echo '<th width="5%" align="center">Part Name</th>';
									echo '<th width="5%" align="center">Brand</th>';
									echo '<th width="5%" align="center">Order Part No.</th>';
									echo '<th width="5%" align="center">Remark</th>';
									echo '<th width="5%" align="center">Part Pic.</th>';

									echo '<th width="5%" align="center">Prtnohis</th>';
									echo '<th width="5%" align="center">cgprtnohis</th>';
									echo '<th width="5%" align="center">Custprthis</th>';
									echo '</tr>';
									$qa2 = "SELECT cataloguetemp.* FROM cataloguetemp  LIMIT 10";
									//echo $qa2."<br/><br/>";
									$sqlqa2 = mysqli_query($msqlcon, $qa2);
									$Columnnull = "";
									while ($arrqa2 = mysqli_fetch_array($sqlqa2)) {
										$Columnnull .= $arrqa2['Columnname'] . ' ';
										$vcarmaker      = $arrqa2['CarMaker'];
										$vmodelname     = $arrqa2['ModelName'];
										$vmodelcode     = $arrqa2['ModelCode'];
										$venginecode    = $arrqa2['EngineCode'];
										$vcc            = $arrqa2['Cc'];
										$vstart         = $arrqa2['Start'];
										$vend           = $arrqa2['End'];
										$vCustprthis  = $arrqa2['Custprthis'];
										$vCprtn      = $arrqa2['Cprtn'];
										$vPrtnohis    = $arrqa2['Prtnohis'];
										$vPrtno      = $arrqa2['Prtno'];
										$vcgprtnohis  = $arrqa2['cgprtnohis'];
										$vCgprtno    = $arrqa2['Cgprtno'];
										$vPrtnm      = $arrqa2['Prtnm'];
										$vordprtno    = $arrqa2['ordprtno'];
										$vVincode    = $arrqa2['Vincode'];
										$vBrand      = $arrqa2['Brand'];
										$vremark        = $arrqa2['Remark'];
										$vpartpic        = $arrqa2['Prtpic'];

										echo "<tr class=\"arial11black\">
													<td>$vcarmaker</td>
													<td>$vmodelname</td>
													<td>$vVincode</td>
													<td>$vmodelcode</td>
													<td>$venginecode</td>
													<td>$vcc</td>
													<td>$vstart</td>
													<td>$vend</td>
													<td>$vCprtn</td>
													<td>$vPrtno</td>
													<td>$vCgprtno</td>
													<td>$vPrtnm</td>
													<td>$vBrand</td>
													<td>$vordprtno</td>
													<td>$vremark</td>
													<td>$vpartpic</td>
													
													<td>$vPrtnohis</td>
													<td>$vcgprtnohis</td>
													<td>$vCustprthis</td>
												</tr>";
									}
									echo "</table>";
									echo "<br/><span class='arial21redbold' width='200px'>" . get_lng($_SESSION["lng"], "E0074") . "</span><br/>";
									echo "<br/><span class='arial21redbold' width='200px'>" . get_lng($_SESSION["lng"], "E0070") . "</span>";
								} else {
									$qc1 = "SELECT count(*) FROM cataloguetemp ";
									$sqlqc1 = mysqli_query($msqlcon, $qc1);
									$arqc1 = mysqli_fetch_array($sqlqc1);
									$tmpcount = $arqc1[0];
									echo "<div class='arial21redbold'>" . get_lng($_SESSION["lng"], "L0527");
									echo '<form method="POST" enctype="multipart/form-data" action="replace-all-catalogue.php">';
									echo '<input type="hidden" name="replace" value="' . $rdreplace . '">';

									echo '<input type="submit" name="yesbtn" value="' . get_lng($_SESSION["lng"], "L0473") . '">';
									echo '<input type="submit" name="nobtn" value="' . get_lng($_SESSION["lng"], "L0474") . '">';

									echo '</form>';
									echo '<br>';
									if ($tmpcount <= 10) {
										echo ' Displayed ' . $tmpcount . ' from ' . $tmpcount . '  records!';
									} else {
										echo ' Displayed 10 from ' . $tmpcount . '  records!';
									}

									echo '<table class="tbl1" >';
									echo '<tr class="arial11grey" bgcolor="#AD1D36">';
									echo '<th width="5%" align="center">CarMaker1</th>';
									echo '<th width="5%" align="center">ModelName</th>';
									echo '<th width="5%" align="center">Vincode</th>';
									echo '<th width="5%" align="center">ModelCode</th>';
									echo '<th width="5%" align="center">EngineCode</th>';
									echo '<th width="5%" align="center">Cc</th>';
									echo '<th width="5%" align="center">Start</th>';
									echo '<th width="5%" align="center">End</th>';
									echo '<th width="5%" align="center">Genuine Part No.</th>';
									echo '<th width="5%" align="center">DENSO Part No.</th>';
									echo '<th width="5%" align="center">CG Part No.</th>';
									echo '<th width="5%" align="center">Part Name</th>';
									echo '<th width="5%" align="center">Brand</th>';
									echo '<th width="5%" align="center">Order Part No.</th>';
									echo '<th width="5%" align="center">Remark</th>';
									echo '<th width="5%" align="center">Part Pic.</th>';

									echo '<th width="5%" align="center">Prtnohis</th>';
									echo '<th width="5%" align="center">cgprtnohis</th>';
									echo '<th width="5%" align="center">Custprthis</th>';
									echo '</tr>';
									$qa2 = "SELECT * FROM cataloguetemp  LIMIT 10";
									//echo $qa2."<br/><br/>";
									$sqlqa2 = mysqli_query($msqlcon, $qa2);
									while ($arrqa2 = mysqli_fetch_array($sqlqa2)) {
										$Columnnull .= $arrqa2['Columnname'] . ' ';
										$vcarmaker      = $arrqa2['CarMaker'];
										$vmodelname     = $arrqa2['ModelName'];
										$vmodelcode     = $arrqa2['ModelCode'];
										$venginecode    = $arrqa2['EngineCode'];
										$vcc            = $arrqa2['Cc'];
										$vstart         = $arrqa2['Start'];
										$vend           = $arrqa2['End'];
										$vCustprthis  = $arrqa2['Custprthis'];
										$vCprtn      = $arrqa2['Cprtn'];
										$vPrtnohis    = $arrqa2['Prtnohis'];
										$vPrtno      = $arrqa2['Prtno'];
										$vcgprtnohis  = $arrqa2['cgprtnohis'];
										$vCgprtno    = $arrqa2['Cgprtno'];
										$vPrtnm      = $arrqa2['Prtnm'];
										$vordprtno    = $arrqa2['ordprtno'];
										$vVincode    = $arrqa2['Vincode'];
										$vBrand      = $arrqa2['Brand'];
										$vremark        = $arrqa2['Remark'];
										$vpartpic        = $arrqa2['Prtpic'];

										echo "<tr class=\"arial11black\">
												<td>$vcarmaker</td>
												<td>$vmodelname</td>
												<td>$vVincode</td>
												<td>$vmodelcode</td>
												<td>$venginecode</td>
												<td>$vcc</td>
												<td>$vstart</td>
												<td>$vend</td>
												<td>$vCprtn</td>
												<td>$vPrtno</td>
												<td>$vCgprtno</td>
												<td>$vPrtnm</td>
												<td>$vBrand</td>
												<td>$vordprtno</td>
												<td>$vremark</td>
												<td>$vpartpic</td>
												
												<td>$vPrtnohis</td>
												<td>$vcgprtnohis</td>
												<td>$vCustprthis</td>
											</tr>";
									}
									echo "</table>";
								}
							}
						}
						//}
					}
				}

				?>



				<div id="footerMain1">
					<ul>

						<li><a href="../Footer/ContactUs.html">Contact Us</a></li>
						<li class="last"><a href="../Footer/Terms.html">Legal and Policy</a></li>
					</ul>

					<div id="footerDesc">

						<p>
							Copyright © 2013 DENSO SINGAPORE. All rights reserved

					</div>
				</div>
			</div>
</body>

</html>