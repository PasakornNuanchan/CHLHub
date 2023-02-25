const customs_set_sub_cash = {

    ajax_set_preview_data: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/set_sub_cash.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    set_sub_cash_preview_data: async function (job_number) {
        let res_data = await customs_set_sub_cash.ajax_set_preview_data(job_number);
        console.log(res_data);

        
        //$('.sel-pcn').html('');
        let db_sel_pc_number = '';
        
        if(res_data['pcn'] != "0 results"){
        $.each(res_data['pcn'], function (i, k) {
            db_sel_pc_number += `
            <option value="${k['ID']}">${k['petty_cash_number']}</option>
            `;
        });
        $('.sel-pcn').append(db_sel_pc_number);
        }

        html_petty_cash_nubmer = $('.del_pcn').parent().html();
        html_select_cur = $('.sel-cur-balance').parent().html();
        $('.add_pcn').html('');
        $('.pcb-add').html('');

        await customs_set_sub_cash.type_change_cash()


        



        // Petty Cash&Advance
        $('[name =cash_payment_table] tbody').html('');
        html_description_payment = '';
        let num = 1;


        $('.pcb-add').html('');

        if (res_data['pay'] != "0 results") {
            $.each(res_data['pay'], function (i, v) {
                let amount = parseFloat(v['amount']);
                let type = v['type'] || '';
                let billing_item_name = v['billing_item_name'] || '';
                let pay_to = v['pay_to'] || '';
                //let first_name = v['first_name'] || '';
                //let last_name = v['last_name'] || '';
                let ID = v['ID'] || '';
                //let datetime_create = v['datetime_create'] || '';
                let remark = v['remark'] || '';
                html_description_payment = `
            <tr>
                <td>${num}</td>
                <td>${type}</td>
                <td>${billing_item_name}</td>
                <td>${pay_to}</td>
                <td></td>
                <td align="right">${number_format(amount.toFixed(2))}</td>
                <td>${remark}</td>
                
                <td>
                    <button type="button" class="btn btn-danger rounded-pill btn-xs" onclick="customs_set_sub_cash.push_del_cash(${ID});"><i class="bi bi-pencil-fill"></i> Delete</button>
                </td>
            </tr>
            `;

                num++;
                $('[name =cash_payment_table] tbody').append(html_description_payment);
            });


            // $('.inp-cash-balance').val(cash_val).attr('readonly', true);
            // $('.sel-cur-balance').val(cur_balance).attr('disabled', true);
            // $('.inp-req-cash').val(req_cash).attr('readonly', true);
            //$('.inp-shper').val(res_data['booking']['shipper_number']).attr('disabled',true);
        } else {
            // $('.inp-cash-balance').val(cash_val).attr('readonly', true);
            // $('.sel-cur-balance').val(cur_balance).attr('disabled', true);
            // $('.inp-req-cash').val(req_cash).attr('readonly', true);
        }



    },

    set_data_balance: async function () {

        res_data_cbl = await customs_set_sub_cash.ajax_set_balance(customs.job_number_global)
        console.log(res_data_cbl)
        $('.pcb-add').html('');
        html_pcb = '';
        if(res_data_cbl['cbl'] != "0 results"){
        $.each(res_data_cbl['cbl'], function (i, v) {
            html_pcb =
                `<div class="pcb-del">
            <div class="form-group row">
                <label class="control-label col-sm-3 align-self-center ">Petty Cash Balance :</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-lg-3">
                            <input type="text" class="form-control form-control-sm inp-cash-balance" value="${v['cash_balance']}" disabled>
                        </div>
                        <div class="col-lg-2">
                            <div class="db-sel-cur-pcn${i}" >
                            ${html_select_cur}
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control form-control-sm inp-req-cash" value="${v['petty_cash_number']}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
            $('.pcb-add').append(html_pcb);
            $(`.db-sel-cur-pcn${i} > select`).val(v['currency']);
        })
    }

    },

    ajax_set_balance: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/set_sub_cash_balance.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {

                    resolve(res);

                },
            });
        });
    },

    push_del_cash: async function (del_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await customs_set_sub_cash.ajax_del_cash(del_id)
                console.log(res);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                customs_set_sub_cash.set_sub_cash_preview_data(customs.job_number_global);
            }
        })
    },

    ajax_del_cash: function (del_id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/del_cash_list.php",
                data: { 'del_id': del_id },
                dataType: "json",
                success: function (res) {
                    resolve(res);

                },
            });
        });
    },

    type_change_cash: async function (e) {
        $('.add_pcn').html('');
        $('.pcb-add').html('');
        let value_change = $(e).val();
        if (value_change == "Petty Cash") {
            $('.add_pcn').append(html_petty_cash_nubmer)
            await customs_set_sub_cash.set_data_balance()
        }



    },
    push_save_cash_list: async function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let balance = parseFloat($('.inp-cash-balance').val());
                let type = $('.inp-pcn-type').val();
                let description = $('.sel-des-cash').val();
                let pay_to = $('.inp-pcn-pay').val();
                let amount = parseFloat($('.inp-pcn-amount').val());
                let currency_get = $('.inp-pcn-amount-cur').val();
                if (type == "Petty Cash") {
                    let get_val_amount = $('.sel-pcn').val();
                    console.log(get_val_amount)
                    if(get_val_amount == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Plese select petty cash number!',
                        })
                    }else{

                    let amount_balance = '';

                    var result = res_data_cbl.cbl.find(obj => obj.ID == get_val_amount);
                    amount_balance = result['cash_balance']
                    currency = result['currency']


                  

                    if (amount_balance <= amount) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Petty Cash less than is amount in use!',
                        })
                    }else if(currency != currency_get) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Currency not match plese change currency request',
                        })
                    } else if (type == "" || description == "" || pay_to == "" || amount == "") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'May be data type , description , pay to or amount is missing',
                        })
                    }
                    else {

                        let res = await customs_set_sub_cash.get_val_cash()
                        console.log(res);
                        Swal.fire(
                            'saved!',
                            'Your file has been saved.',
                            'success'
                        )
                        customs_set_sub_cash.set_sub_cash_preview_data(customs.job_number_global);
                    }
                    }
                }else if(type == "Advance Cash"){
                    if (type == "" || description == "" || pay_to == "" || amount == "") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'May be data type , description , pay to or amount is missing',
                        })
                    }else {

                        let res = await customs_set_sub_cash.get_val_cash()
                        console.log(res);
                        Swal.fire(
                            'saved!',
                            'Your file has been saved.',
                            'success'
                        )
                        customs_set_sub_cash.set_sub_cash_preview_data(customs.job_number_global);
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'May be data type , description , pay to or amount is missing',
                    })
                }



            }
        })
    },
    reset_val_cash: function () {
        $('.inp-pcn-type').val('');
        $('.sel-des-cash').val('');
        $('.inp-pcn-pay').val('');
        $('.inp-pcn-pic').val('');
        $('.inp-pcn-amount').val('');
        $('.inp-pcn-amount-cur').val("THB");
        $('.sel-pcn-pcn').val('');
        $('.inp-pcn-remark').val('');
    },
    get_val_cash: async function () {

        let arr_get_val_cash = [];
        let arr_get_val_cash_tmp = {};
        let job_number_pcn = customs.job_number_global
        let type = $('.inp-pcn-type').val();
        let description = $('.sel-des-cash').val();
        let pay_to = $('.inp-pcn-pay').val();
        let pic = $('.inp-pcn-pic').val();
        let amount = $('.inp-pcn-amount').val();
        let amount_cur = $('.inp-pcn-amount-cur').val();
        let petty_cash_number_cash = $('.sel-pcn-pcn').val();
        let remark = $('.inp-pcn-remark').val();

        arr_get_val_cash_tmp = {
            type: type,
            description: description,
            pay_to: pay_to,
            pic: pic,
            amount: amount,
            amount_cur: amount_cur,
            petty_cash_number_cash: petty_cash_number_cash,
            job_number_pcn: job_number_pcn,
            remark: remark
        };

        arr_get_val_cash.push(arr_get_val_cash_tmp)
        console.log(arr_get_val_cash)
        await customs_set_sub_cash.ajax_save_pcn(arr_get_val_cash)
        await customs_set_sub_cash.reset_val_cash()


    },



    ajax_save_pcn: function (arr_get_val_cash) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/save_cash_list.php",
                data: { 'arr_get_val_cash': arr_get_val_cash },
                dataType: "json",
                success: function (res) {

                    resolve(res);

                },
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
