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
        $('[name="petty-cash-tbl"]>tbody').append(html);

    },del_pettycash_row: function (e = null) {
        $(e).closest("tr").remove();
    }, 







    check_get: function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        let get_job = getUrlParameter('petty_cash_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job == false ? null : get_job;
        let action = get_action == false ? null : get_action;

        if (action == 'preview') {
            petty_cash.set_preview_data(job_number);
        } else {

        }
    },

    set_preview_data: async function (job_number) {
        let res_data = await petty_cash.ajax_set_preview_data(job_number);
        console.log(res_data);
        $('.inp-bankname').val(res_data["'job_number'"]);
        $('.inp-banknumber').val(res_data['booking_number']).attr('readonly', true);

        // $('.inp-prtload').val(res_data['port_of_loading_number']).attr('disabled',true);
        // $('.inp-ts_port').val(res_data['ts_port_number']).attr('disabled',true);
        // $('.inp-etd').val(res_data['etd']).attr('readonly',true);
        // $('.inp-eta').val(res_data['eta']).attr('readonly',true);

    },

    ajax_set_preview_data: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash/get_preview_data.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },



};