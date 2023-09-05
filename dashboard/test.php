<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">
	<link href="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.css" rel="stylesheet">

	<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
	<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js"></script>

	<style>
		.mr10 {
			margin-right: 10px;
		}
	</style>

</head>

<body>

	<div class="toolbar">
		<div>
			<label class="checkbox">
				<input id="height" type="checkbox" checked> Enable Height
			</label>
		</div>
		<div class="form-inline">
			<span class="mr10">Fixed Number: </span>
			<input class="form-control mr10" id="fixedNumber" type="number" value="2" min="1" max="5">
			<span class="mr10">Fixed Right Number: </span class="mr10">
			<input class="form-control" id="fixedRightNumber" type="number" value="1" min="0" max="5">
		</div>
		<div class="form-inline">
			<span class="mr10">Cells: </span>
			<input class="form-control mr10" id="cells" type="number" value="20" min="1" max="30">
			<span class="mr10">Rows: </span class="mr10">
			<input class="form-control mr10" id="rows" type="number" value="20" min="1" max="50">
			<button id="build" class="btn btn-secondary">Rebuild Table</button>
		</div>
	</div>
	<table class="table table-hover table_data" id="table">
		<thead>
			<tr class="text-center sticky-top">
				<th class="sticky-left">No.</th>
				<th class="sticky-left">Inv No.</th>
				<th class="sticky-left">Description</th>
				<th>Bill to</th>
				<th>Currency</th>
				<th>Qty.</th>
				<th>Unit Price</th>
				<th>Amt.</th>
				<th>Vat(%)</th>
				<th>Amt Incv.</th>
				<th>Status</th>
				<th>Paid Amt</th>
				<th>Remark</th>
				<th>Request Datetime</th>
				<th>Request By</th>
				<th>Sale Support</th>
				<th>Operation By</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-center">
				<td></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="T2023011231"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="BINDING FEE"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="Air port of thailand(PAT)"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="THB"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1.01"></td>
				<td>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio1" checked=>
					<label for="radio1" class="form-check-label pl-2">Waiting</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio2">
					<label for="radio2" class="form-check-label pl-2">Approve</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio3">
					<label for="radio3" class="form-check-label pl-2">Reject</label>
				</td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
			</tr>
			<tr class="text-center">
				<td></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="T2023011231"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="BINDING FEE"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="Air port of thailand(PAT)"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="THB"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1.01"></td>
				<td>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio1" checked=>
					<label for="radio1" class="form-check-label pl-2">Waiting</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio2">
					<label for="radio2" class="form-check-label pl-2">Approve</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio3">
					<label for="radio3" class="form-check-label pl-2">Reject</label>
				</td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
			</tr>
			<tr class="text-center">
				<td></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="T2023011231"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="BINDING FEE"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="Air port of thailand(PAT)"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="THB"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1.01"></td>
				<td>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio1" checked=>
					<label for="radio1" class="form-check-label pl-2">Waiting</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio2">
					<label for="radio2" class="form-check-label pl-2">Approve</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio3">
					<label for="radio3" class="form-check-label pl-2">Reject</label>
				</td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
			</tr>
			<tr class="text-center">
				<td></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="T2023011231"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="BINDING FEE"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="Air port of thailand(PAT)"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="THB"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1.01"></td>
				<td>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio1" checked=>
					<label for="radio1" class="form-check-label pl-2">Waiting</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio2">
					<label for="radio2" class="form-check-label pl-2">Approve</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio3">
					<label for="radio3" class="form-check-label pl-2">Reject</label>
				</td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
			</tr>
			<tr class="text-center">
				<td></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="T2023011231"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="BINDING FEE"></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="Air port of thailand(PAT)"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="THB"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-center" value="1"></td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value="1.01"></td>
				<td>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio1" checked=>
					<label for="radio1" class="form-check-label pl-2">Waiting</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio2">
					<label for="radio2" class="form-check-label pl-2">Approve</label>
					<input type="radio" class="form-check-input" name="status_row_rd" id="radio3">
					<label for="radio3" class="form-check-label pl-2">Reject</label>
				</td>
				<td><input type="text" class="form-control form-control-sm rounded text-end" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value=""></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
				<td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
			</tr>
		</tbody>
	</table>

</body>

</html>
<script>
	var $table = $('#table')

	function buildTable($el) {
		var cells = +$('#cells').val()
		var rows = +$('#rows').val()
		var i
		var j
		var row
		var columns = [{
			field: 'state',
			checkbox: true,
			valign: 'middle'
		}]
		var data = []

		for (i = 0; i < cells; i++) {
			columns.push({
				field: 'field' + i,
				title: 'Cell' + i,
				sortable: true,
				valign: 'middle',
				formatter: function(val) {
					return '<div class="item">' + val + '</div>'
				},
				events: {
					'click .item': function() {
						console.log('click')
					}
				}
			})
		}
		for (i = 0; i < rows; i++) {
			row = {}
			for (j = 0; j < cells + 3; j++) {
				row['field' + j] = 'Row-' + i + '-' + j
			}
			data.push(row)
		}
		$el.bootstrapTable('destroy').bootstrapTable({
			height: $('#height').prop('checked') ? 400 : undefined,
			columns: columns,
			data: data,
			search: true,
			showColumns: true,
			showToggle: true,
			clickToSelect: true,
			fixedColumns: true,
			fixedNumber: +$('#fixedNumber').val(),
			fixedRightNumber: +$('#fixedRightNumber').val()
		})
	}

	$(function() {
		buildTable($table)

		$('#build').click(function() {
			buildTable($table)
		})
	})
</script>