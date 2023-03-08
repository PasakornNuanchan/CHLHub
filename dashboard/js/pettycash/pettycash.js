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

    
    addpthtml: async function () {
        let html_select = $(".td-sel-conttype").html();
        let sl_des_pettycash = $('.sel-description').parent().html();
        html = `
        <tr class="pettycash_detail">
            <td>${sl_des_pettycash}</td>
        <td><input type="number" class="form-control form-control-sm inp-amount" style="text-align:right;" onchange="petty_cash.change_amount();" ></td>
        <td><select name="" id="" class="form-select sel_cur" onchange="petty_cash.change_amount();">
            <option value="THB">THB</option>
            <option value="USD">USD</option>
            <option value="RMB">RMB</option>
        </select></td>
        <td onclick="petty_cash.del_pettycash_row(this);"  align="center">
        <div class="del_action_tr">
            <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
        </div>
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

        $('.btn_save_list').html('');
      
    },

    change_amount: async function () {
        let val_total = 0;
        var inputs = $('.inp-amount');
        var currency = $('.sel_cur');
        let thb_cur = 0;
        let usd_cur = 0;
        let rmb_cur = 0;

        for (var i = 0; i < inputs.length; i++) {
            let amount = $(inputs[i]).val();
            let currencyz = $(currency[i]).val();

            if (currencyz == "THB") {
                thb_cur = parseFloat(thb_cur) + parseFloat(amount)
            } else if (currencyz == "USD") {
                usd_cur = parseFloat(usd_cur) + parseFloat(amount)
            } else if (currencyz == "RMB") {
                rmb_cur = parseFloat(rmb_cur) + parseFloat(amount)
            }

        }

        now_usd = 1;
        now_thb = 34.42;
        now_rmb = 6.86;

        var rowCount = $('[name = "petty-cash-tbl-description"] tr').length;
        let count_row = (rowCount - 1);

        total_val_usd = usd_cur + thb_cur / now_thb + rmb_cur / now_rmb
        total_val_thb = thb_cur + usd_cur * now_thb + (rmb_cur / now_rmb) * now_thb
        total_val_rmb = rmb_cur + usd_cur * now_rmb + (thb_cur / now_thb) * now_rmb


        console.log(thb_cur)
        $('.inp-amt-thb').val(number_format(thb_cur))
        $('.inp-amt-usd').val(number_format(usd_cur))
        $('.inp-amt-rmb').val(number_format(rmb_cur))

        $('.inp-total-amt-thb').val(number_format(total_val_thb.toFixed(2)))
        $('.inp-total-amt-usd').val(number_format(total_val_usd.toFixed(2)))
        $('.inp-total-amt-rmb').val(number_format(total_val_rmb.toFixed(2)))


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
    push_action_save: async function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            let check_val = '';
            if (result.isConfirmed) {
                $('[name = petty-cash-tbl-description] tbody > tr').each(async function (i, e) {
                    if($('.sel-description', this).val() == "" || $('.inp-amount', this).val() == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data Description or Amount is missing ',
                        })
                        check_val = 1;
                        return false; 
                    }else{
                        check_val = 0;
                    }
                })
                if(check_val != 1){
                    await petty_cash.save_petty_cash()
                    Swal.fire(
                        'saved!',
                        'Your file has been saved.',
                        'success'
                      )
                } 
                
            }
        })
    },

    save_petty_cash: async function () {

        let save_arr_detail = [];
        let save_arr_tmp = {};

        let save_arr_title = [];
        let save_arr_title_tmp = {};

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
            sel_tranfer_mt: sel_tranfer_mt,
        }
        save_arr_title.push(save_arr_title_tmp)
        pcn_doc = '';
        await petty_cash.ajax_save_list(save_arr_detail, save_arr_title)

        //after save
        $('.inp-pt_number').val(pcn_doc)
        $('.inp-amount').attr('disabled',true)
        $('.sel_cur').attr('disabled',true)
        $('.sel-description').attr('disabled',true)
        $('.btn_add_new_list').html('');
        $('.btn_save_list').html('');
        $('.del_action_tr').html('');
        $('.sel_tranfer_mt').attr('disabled',true);

    },

    ajax_save_list: async function (save_arr_detail, save_arr_title) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash/save_list.php",
                data: {
                    'save_arr_detail': save_arr_detail,
                    'save_arr_title': save_arr_title
                },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                    pcn_doc = response;
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