<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link src="https://code.jquery.com/jquery-3.7.0.js" />
	<link src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" />
	<link src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js" />
	<link src="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
	<link src="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css" />


</head>

<body>
	<!-- เพิ่มไฟล์ CSS และ JavaScript -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>

	<!-- สร้างตาราง -->
	<div class="container">
		<table id="example" class="display nowrap col-xl-8" style="width:100%">
			<thead>
				<tr>
					<th>First name</th>
					<th>Last name</th>
					<th>Position</th>
					<th>Office</th>
					<th>Age</th>
					<th>Start date</th>
					<th>Salary</th>
					<th>Extn.</th>
					<th>E-mail</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Tiger</td>
					<td>Nixon</td>
					<td>System Architect</td>
					<td>Edinburgh</td>
					<td>61</td>
					<td>2011-04-25</td>
					<td>$320,800</td>
					<td>5421</td>
					<td>t.nixon@datatables.net</td>
				</tr>
				<tr>
					<td>Garrett</td>
					<td>Winters</td>
					<td>Accountant</td>
					<td>Tokyo</td>
					<td>63</td>
					<td>2011-07-25</td>
					<td>$170,750</td>
					<td>8422</td>
					<td>g.winters@datatables.net</td>
				</tr>
				<tr>
					<td>Ashton</td>
					<td>Cox</td>
					<td>Junior Technical Author</td>
					<td>San Francisco</td>
					<td>66</td>
					<td>2009-01-12</td>
					<td>$86,000</td>
					<td>1562</td>
					<td>a.cox@datatables.net</td>
				</tr>
				<tr>
					<td>Cedric</td>
					<td>Kelly</td>
					<td>Senior Javascript Developer</td>
					<td>Edinburgh</td>
					<td>22</td>
					<td>2012-03-29</td>
					<td>$433,060</td>
					<td>6224</td>
					<td>c.kelly@datatables.net</td>
				</tr>
				<tr>
					<td>Airi</td>
					<td>Satou</td>
					<td>Accountant</td>
					<td>Tokyo</td>
					<td>33</td>
					<td>2008-11-28</td>
					<td>$162,700</td>
					<td>5407</td>
					<td>a.satou@datatables.net</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>

</html>

<script>
	$(document).ready(function() {
		var table = $('#example').DataTable({
			scrollY: "300px",
			scrollX: true,
			scrollCollapse: true,
			paging: false,
			fixedColumns: {
				leftColumns: 2, // จำนวนคอลัมน์ที่ต้องการตรึงด้านซ้าย
				rightColumns: 1 // จำนวนคอลัมน์ที่ต้องการตรึงด้านขวา
			}
		});
	});
</script>