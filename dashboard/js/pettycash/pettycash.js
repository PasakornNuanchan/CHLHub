const petty_cash = {
    select_port: function () {
        $.ajax({
            type: "post",
            url: "../ajax_request/booking.php",
            data: "data",
            dataType: "text",
            success: function (response) {
                alert(response);
            },
        });
    },
    addpthtml: function () {
        // let html_select = $(".td-sel-conttype").html();
        // html = `
        // <tr class="text-center">
        //     <td>1</td>
        //     <td><select name="" id="" class="form-select shadow-none">
        //         <option value="" selected>Plese select description</option>
        //         <option value=""></option>
        //     </select></td>
        //     <td><select name="" id="" class="form-select shadow-none">
        //         <option value="" selected>Plese select description</option>
        //         <option value=""></option>
        //     </select></td>
        //     <td>Prepaid</td>
        //     <td><select name="" id="" class="form-select shadow-none">
        //         <option value="" selected>THB</option>
        //         <option value="">USD</option>
        //         <option value="">RMB</option>
        //     </select></td>
        //     <td><input type="text" class="form-control"></td>
        //     <td><input type="text" class="form-control"></td>
        //     <td></td>
        //     <td></td>
        //     <td></td>
        //     <td><input type="text" class="form-control"></td>
        //     <td><input type="checkbox" class="form-check-input"></td>
        //     <td onclick="billing.del_container_row(this);">
        //         <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
        //     </td>
        //     <td>
        //         <button type="button" class="btn btn-success rounded-pill btn-xs" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
        //     </td>
        //     </tr>
        // `;
        // $('[name="pettycash-tbl"]>tbody').append(html);
        alert("55555");
        },
    del_container_row: function (e = null) {
        $(e).closest("tr").remove();
     },


};
