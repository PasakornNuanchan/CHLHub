const sub_withdraw = {

    get_val_petty_cash: async function (data) {
        const res_data_pt = await this.ajax_request_petty_cash(data)
        

        $('.row_set').remove();
        if(res_data_pt != "0 results"){
            let html_data_petty_cash = '';
            $.each(res_data_pt['petty_cash_data'],function(i,v){
                html_data_petty_cash = `
                <option type_data_pt="pt" class="row_set"amt_val='${v['amount']}' amt_cur="${v['currency']}" value="${v['ID']}">Petty Cash No. ${v['petty_cash_number']} (${v['amount']+' '+v['currency']})</option>
                `;
            })
            $('.inp_type_wd').append(html_data_petty_cash)
        }
    },

    show_petty_cash : async function(e){
        $('.set_petty_cash').remove()
        let html_data_petty_cash = '';
        let data_petty_cash = $('option:selected',e).attr('type_data_pt')
        let data_petty_cash_amt = $('option:selected',e).attr('amt_val')
        let data_petty_cash_cur = $('option:selected',e).attr('amt_cur')
        let id_get = $(e).val();
        let res_data = await this.ajax_get_val_petty_cash_balance(id_get)
        
        let data_val_all = 0;

        if(res_data['petty_cash_val'] != "0 results"){
            $.each(res_data['petty_cash_val'],function(i,v){
                let petty_cash_data = v['amount_payble'];
                data_val_all = parseFloat(data_val_all)+parseFloat(petty_cash_data)
                
            })
        }
        
        let data_show = parseFloat(data_petty_cash_amt) - parseFloat(data_val_all)
    
        if(data_petty_cash == 'pt'){
            html_data_petty_cash = `
            <div class="form-group row set_petty_cash">
                <label class="control-label col-sm-3 col-md-2 col-lg-3 align-self-center">balance: </label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input class="form-control form-control-sm inp_petty_cash" list="description_list" value="${data_show}"  disabled>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input class="form-control form-control-sm inp_petty_cash_cur" list="description_list" value="${data_petty_cash_cur}"  disabled>
                        </div>
                    </div>
                </div>
            </div>
            `;
            $('.data_petty_cash').append(html_data_petty_cash)
        }else{
            $('.data_petty_cash').html('')

        }
        
    },

    ajax_get_val_petty_cash_balance : async function (id_get) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_value_cash_balance.php",
                data: { id_get: id_get },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_request_petty_cash : async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_petty_cash.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    first_post_data: async function (data) {
        
        let res_data = await this.ajax_save_data(data)
        console.log(res_data)
        $(`.table_wd_payble tbody`).html('');
        let html_data_wd = '';
        if (res_data['data_withdraw'] != "0 results") {
            $.each(res_data['data_withdraw'], function (i, v) {
                i++;
                let id = v['ID'] ? v['ID'] : '';
                let payto_payble = v['payto_payble'] ? v['payto_payble'] : '';
                let description_payble = v['description_payble'] ? v['description_payble'] : '';
                let amount_payble = parseFloat(v['amount_payble']) ? parseFloat(v['amount_payble']) : '';
                let currency_payble = v['currency_payble'] ? v['currency_payble'] : '';
                let remark_payble = v['remark_payble'] ? v['remark_payble'] : '';
                let imgpayble = v['img_payble'] ? v['img_payble'] : '';
                let paid_by = v['paid_by'];

                let request_by = v['cbfn'] ? v['cbfn'] + ' ' + v['cbln'] : '';
                let paid_by_data = v['pbfn'] ? v['pbfn'] + ' ' + v['pbln'] : '';

                let datetime_create = v['create_datetime'] ? v['create_datetime'] : '';
                let datetime_paid = v['datetime_paid'] ? v['datetime_paid'] : '';

                let bc_pay = paid_by == null ? '<span class="badge rounded-pill bg-danger" >Unpiad</span>' : '<span class="badge rounded-pill bg-success">Paid</span>';
                let btn_del_wd = paid_by == null ? `<button class="btn btn-danger btn-sm" onclick="function_sub_withdraw.delete_list_wd(${id})"><i class="bi bi-trash"></i> Del</button>` : '';

                let data_amount = amount_payble.toFixed(2)
                let data_paste = data_amount + ' ' + currency_payble
                html_data_wd = `
            <tr>
                <td class="text-center">${i}</td>
                <td>${payto_payble}</td>
                <td>${description_payble}</td>
                <td class="text-end">${data_paste}</td>
                <td class="text-center"><i class="bi bi-files i_show" onclick="function_sub_withdraw.open_pic(${id})"></i></td>
                <td>${remark_payble}</td>
                <td class="text-center">${bc_pay}</td>
                <td class="text-center">${btn_del_wd}</td>
                <td>${request_by}</td>
                <td>${datetime_create}</td>
                <td>${paid_by_data}</td>
                <td>${datetime_paid}</td>
            </tr>
            `;
                $(`.table_wd_payble tbody`).append(html_data_wd)
                if (imgpayble == '') {
                    $('.i_show').attr('hidden', true)
                }
            })
        }

        
        let html_data_wd_a = '';
        $(`.table_wd_advancecash tbody`).html('');
        if (res_data['data_advancecash'] != "0 results") {
            $.each(res_data['data_advancecash'], function (i, v) {
                i++;
                let id = v['ID'] ? v['ID'] : '';
                let payto_payble = v['payto_payble'] ? v['payto_payble'] : '';
                let description_payble = v['description_payble'] ? v['description_payble'] : '';
                let amount_payble = parseFloat(v['amount_payble']) ? parseFloat(v['amount_payble']) : '';
                let currency_payble = v['currency_payble'] ? v['currency_payble'] : '';
                let remark_payble = v['remark_payble'] ? v['remark_payble'] : '';
                let imgpayble = v['img_payble'] ? v['img_payble'] : '';
                let paid_by = v['paid_by'];

                let request_by = v['cbfn'] ? v['cbfn'] + ' ' + v['cbln'] : '';
                let paid_by_data = v['pbfn'] ? v['pbfn'] + ' ' + v['pbln'] : '';

                let datetime_create = v['create_datetime'] ? v['create_datetime'] : '';
                let datetime_paid = v['datetime_paid'] ? v['datetime_paid'] : '';

                let bc_pay = paid_by == null ? '<span class="badge rounded-pill bg-danger" >Unpiad</span>' : '<span class="badge rounded-pill bg-success">Paid</span>';
                let btn_del_wd = paid_by == null ? `<button class="btn btn-danger btn-sm" onclick="function_sub_withdraw.delete_list_wd(${id})"><i class="bi bi-trash"></i> Del</button>` : '';

                let data_amount = amount_payble.toFixed(2)
                let data_paste = data_amount + ' ' + currency_payble
                html_data_wd_a = `
            <tr>
                <td class="text-center">${i}</td>
                <td>${payto_payble}</td>
                <td>${description_payble}</td>
                <td class="text-end">${data_paste}</td>
                <td class="text-center"><i class="bi bi-files i_show" onclick="function_sub_withdraw.open_pic(${id})"></i></td>
                <td>${remark_payble}</td>
                <td class="text-center">${bc_pay}</td>
                <td class="text-center">${btn_del_wd}</td>
                <td>${request_by}</td>
                <td>${datetime_create}</td>
                <td>${paid_by_data}</td>
                <td>${datetime_paid}</td>
            </tr>
            `;
                $(`.table_wd_advancecash tbody`).append(html_data_wd_a)
                if (imgpayble == '') {
                    $('.i_show').attr('hidden', true)
                }
            })
        }

        $(`.petty_cash_data_all`).html('');
        if(res_data['data_petty_cash'] != "0 results"){
            $.each(res_data['data_petty_cash'],function(i,v){
                let html_data_petty_cash = '';
                let html_row_data_petty_cash = '';
                let val_amount_all = 0;
                if(res_data['arr_data_petty_cash'] != "0 results"){
                    $.each(res_data['arr_data_petty_cash'][v['ID']],function(i1,v1){
                        i1++;

                        let data_amount = parseFloat(v1['amount_payble']);
                        val_amount_all = parseFloat(val_amount_all)+data_amount;
                        // let create_by = v1['create_by'] ? v1['create_by'] : '';
                        // let status = v1['status'] ? v1['status'] : ''
                        let create_by_f = v1['cbfn'] ? v1['cbfn'] : '';
                        let create_by_l = v1['cbln'] ? v1['cbln'] : '';
                        let create_datetime = v1['create_datetime'] ? v1['create_datetime'] : '';
                        let paid_by = v1['paid_by'] ? v1['paid_by'] : '';
                        let paid_by_datetime = v1['datetime_paid'] ? v1['datetime_paid'] : '';
                        let paid_by_f = v1['pbfn'] ? v1['pbfn'] : '';
                        let paid_by_l = v1['pbln'] ? v1['pbln'] : '';

                        let bc_pay = paid_by == '' ? '<span class="badge rounded-pill bg-danger" >Unpiad</span>' : '<span class="badge rounded-pill bg-success">Paid</span>';

                        html_row_data_petty_cash += 
                        `
                        <tr>
                            <td>${i1}</td>
                            <td>${v1['description_payble']}</td>
                            <td>${v1['amount_payble']}</td>
                            <td>${v1['currency_payble']}</td>
                            <td class="text-center"><i class="bi bi-files i_show" onclick="function_sub_withdraw.open_pic(${v1['ID']})"></i></td>
                            <td>${v1['remark_payble']}</td>
                            <td>${bc_pay}</td>
                            <td><button class="btn btn-danger btn-sm" onclick="function_sub_withdraw.delete_list_wd(${v1['ID']})"><i class="bi bi-trash"></i> Del</button></td>
                            <td>${create_by_f+' '+create_by_l}</td>
                            <td>${create_datetime}</td>
                            <td>${paid_by_f+' '+paid_by_l}</td>
                            <td>${paid_by_datetime}</td>
                        </tr>
                        `;
                        
                    })
                }
            
                let data_amt_show = parseFloat(v['amount']) - val_amount_all
                data_amt_show = data_amt_show.toFixed(2)
                data_amt_show = data_amt_show+' '+v['currency']
                html_data_petty_cash = `
                <div class="card p-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col text-start"><h4>Petty Cash list : ${v['petty_cash_number']}</h4></div>
                                <div class="col text-end"><h5>Balance : ${data_amt_show} </h5></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="db-example table-responsive">
                                <table class="table table-hover table_wd_pettycash">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>currency</th>
                                            <th>picture</th>
                                            <th>Remark</th>
                                            <th>status</th>
                                            <th>action</th>
                                            <th>create by.</th>
                                            <th>datetime create</th>
                                            <th>paid by.</th>
                                            <th>paid datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${html_row_data_petty_cash}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                `;

                $('.petty_cash_data_all').append(html_data_petty_cash)
            })
        }
        
        
        
        await this.get_val_petty_cash(data)
    },

    ajax_save_data: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_withdraw.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}