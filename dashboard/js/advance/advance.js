const advance_cash = {
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
    addadhtml: function () {
        let html_select = $(".td-sel-conttype").html();
        let sl_des_pettycash = $(".db-select-des").html();
        html = `
        <tr class="pettycash_detail">
            <td>${sl_des_pettycash}</td>
        <td><input type="input" class="form-control form-control-sm"></td>
        <td><select name="" id="" class="form-select">
            <option value="" selected>THB</option>
            <option value="">USD</option>
            <option value="">RMB</option>
        </select></td>
        <td onclick="petty_cash.del_pettycash_row(this);" align="center">
            <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
        </td>
        </tr>
        `;
        $('[name="advance-cash-tbl"]>tbody').append(html);
    
        },
    del_pettycash_row: function (e = null) {
        $(e).closest("tr").remove();
     },

    popuptest:function (){
        alert("test");
        },
};
