const petty_cash = {
    check_get: async function () {
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
        let get_doc_pt = getUrlParameter('petty_cash_number');
        let get_action = getUrlParameter('action');

        let job_doc_pt = get_doc_pt == false ? null : get_doc_pt;
        let action = get_action == false ? null : get_action;

        console.log(action);
        console.log(job_doc_pt);

        if (action == 'preview' && job_doc_pt == 'undefined') {

            console.log(2)
            await petty_cash_set_sel_job.set_job();
            await petty_cash.set_head_title(job_doc_pt);
            await petty_cash.change_amount();



        } else {
            console.log(1)
            await petty_cash_set_sel_job.set_job();
            await petty_cash.set_head_title(job_doc_pt)
            await petty_cash.set_preview_data(job_doc_pt);
            await petty_cash.change_amount();



        }
    },

    // set_create : async function(){
    //     first_sl_des_pettycash = $('.sel-description').parent().html();
    //     $('[name = "petty-cash-tbl-description"] tbody').html('');
    //     html = `
    //     <tr class="pettycash_detail">
    //         <td>${first_sl_des_pettycash}</td>
    //     <td><input type="input" class="form-control form-control-sm" onchange="petty_cash.amount_total();"></td>
    //     <td><select name="" id="" class="form-select">
    //         <option value="" selected>THB</option>
    //         <option value="">USD</option>
    //         <option value="">RMB</option>
    //     </select></td>
    //     <td onclick="petty_cash.del_pettycash_row(this);" align="center">
    //         <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
    //     </td>
    //     </tr>
    //     `;
    //     $('[name="petty-cash-tbl-description"]>tbody').append(html);
    // },

    addpthtml: async function () {
        let html_select = $(".td-sel-conttype").html();
        let sl_des_pettycash = $('.sel-description').parent().html();
        html = `
        <tr class="pettycash_detail">
            <td>${sl_des_pettycash}</td>
        <td><input type="number" class="form-control form-control-sm inp-amount" style="text-align:right;" onchange="petty_cash.change_amount();" ></td>
        <td><select name="" id="" class="form-select sel_cur">
            <option value="THB">THB</option>
            <option value="USD">USD</option>
            <option value="RMB">RMB</option>
        </select></td>
        <td onclick="petty_cash.del_pettycash_row(this);" align="center">
            <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
        </td>
        </tr>
        `;
        $('[name="petty-cash-tbl-description"]>tbody').append(html);

        await petty_cash.change_amount()
    }, del_pettycash_row: function (e = null) {
        $(e).closest("tr").remove();
    },


    set_head_title: async function (job_doc_pt) {
        $('.head-of-menu').html('Petty Cash');
        $('.bcpage').html('');
        if (job_doc_pt == "undefined") {
            html_bdpage = `
            <li class="breadcrumb-item"><a href="CHL-PettyCash-list.php" target="" style="color:white;">Petty Cash List</a></li>
            <li class="breadcrumb-item active page-item" aria-current="page">Petty Cash (Petty Cash Number New Create )</li>`;

        } else {
            html_bdpage = `
            <li class="breadcrumb-item"><a href="CHL-PettyCash-list.php" target="" style="color:white;">Petty Cash List</a></li>
            <li class="breadcrumb-item active page-item" aria-current="page">Petty Cash (Petty Cash Number ${job_doc_pt})</li>`;
        }
        $('.bcpage').append(html_bdpage);
    },

    set_preview_data: async function (job_doc_pt) {

        let res_data = await petty_cash.ajax_set_preview_data(job_doc_pt);

        $('.btn_add_new_list').html('')



        console.log(res_data);

        $('.inp-pt_number').val(res_data['pct']['petty_cash_number']).attr('disabled', true);
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method']).attr('disabled', true);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        html_des = '';

        var sel_description_petty_cash = $('.sel-description').parent().html();
        var sel_description_petty_cash_cur = $('.sel_cur').parent().html();

        $('[name = "petty-cash-tbl-description"] tbody').html('');

        $.each(res_data['pcd'], async function (i, v) {
            amount = parseFloat(v['amount']);
            html_des = `
            <tr class="pettycash_detail pettycash_detail${i}">
                <td>
                        ${sel_description_petty_cash}
                </td>
                <td><input type="number" class="form-control form-control-sm inp-amount" style="text-align:right;" value="${amount.toFixed(2)}"onchange="petty_cash.amount_total();" disabled></td>
                <td>
                        ${sel_description_petty_cash_cur}
                </td>
                
            </tr>`;
            await $('[name = "petty-cash-tbl-description"] tbody').append(html_des);



            $(`.pettycash_detail${i} .sel-description`).val(v['job_number']).attr('disabled', true);
            $(`.pettycash_detail${i} .sel_cur`).val(v['currency']).attr('disabled', true);
        });

    },

    change_amount: async function () {
        let val_total = 0;
        var inputs = $('.inp-amount');

        for (var i = 0; i < inputs.length; i++) {
            let testtest = $(inputs[i]).val() == '' ? 0 : $(inputs[i]).val();
            val_total = parseFloat(val_total) + parseFloat(testtest);
        }
        //val_total = parseFloat(val_total = null ? 0 : val_total)


        var rowCount = $('[name = "petty-cash-tbl-description"] tr').length;

        let count_row = (rowCount - 1);

        $('.inp-total-amt').val(number_format(val_total.toFixed(2)))
        $('.inp-count').val(count_row)
    },


    ajax_set_preview_data: function (job_doc_pt) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash/get_preview_data.php",
                data: { 'petty_number': job_doc_pt },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    save_petty_cash: async function () {

        let save_arr_detail = [];
        let save_arr_tmp = {};

        let save_arr_title = [];
        let save_arr_title_tmp = {};


        let tranfer_method = $('.sel_tranfer_mt').val();

        $('[name = petty-cash-tbl-description] tbody > tr').each(function (i, e) {


            let get_description = $('.sel-description', this).val();
            let get_amount = $('.inp-amount', this).val();
            let get_currency = $('.sel_cur', this).val();

            save_arr_tmp = {
                get_description: get_description,
                get_amount: get_amount,
                get_currency: get_currency,
            }

            save_arr_detail.push(save_arr_tmp)
        });

        let sel_tranfer_mt = $('.sel_tranfer_mt').val()

        save_arr_title_tmp = {
            sel_tranfer_mt : sel_tranfer_mt,
        }
        save_arr_title.push(save_arr_title_tmp)

        await petty_cash.ajax_save_list(save_arr_detail,save_arr_title)
    },

    ajax_save_list: async function (save_arr_detail,save_arr_title) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash/save_list.php",
                data: { 'save_arr_detail': save_arr_detail,
                        'save_arr_title' : save_arr_title},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },


};



function number_format(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}