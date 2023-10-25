const first_setting = {
    start_page : async function (){

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");


        $('.head-of-menu').html('Account Payable (Check)');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="account_check_payable.php" target="" style="color:white;">Account Payable (check)</a></li>
        `;
        $('.bcpage').append(html_bdpage);
    },

    setting_default : async function(){
        let res_data = await this.ajax_setting_default()
        
        let html_data_job_number = '';
        let html_data_bill_to  = '';

        let res_data_job_number = removeDuplicatejob_number(res_data['job_number']);
        let res_data_bill_to = removeDuplicatebill_to(res_data['bill_to'])
    
        $.each(res_data_bill_to,function(i,v){
            html_data_job_number += `<option data_type="${v['bill_to_type']}" data_id="${v['bill_to']}" value="${v['bill_to_c']}" >${v['bill_to_c']}</option>`;
        })        

        $.each(res_data_job_number,function(i,v){
            html_data_bill_to +=  `<option real_data="${v['ref_job_id']}" value="${v['job_number']}" >${v['job_number']}</option>`;
        })            

        
        $('.bill_to_list_option').append(html_data_job_number)
        $('.job_number_list_option').append(html_data_bill_to)

},

    ajax_setting_default : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_payable/get_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    setting_data_table : async function (e){
        let res_data = '';
        
        if(e == undefined){
            res_data = await this.ajax_setting_data_table()
        }else{
            res_data = e;            
        }

        console.log(res_data)
        if(res_data['table'] != "0 result"){
            let currency_exchange_thb = 0;            
            let currency_exchange_usd = 0;
            let currency_exchange_rmb = 0;
            let currency_exchange_hkd = 0;

            $('.table_data_account tbody').html('')
            $.each(res_data['table'],function(i,v){
                let job_number = v['job_number'] ? v['job_number'] : '';
                let sale_support = v['sale_support'] ? v['sale_support'] : '';
                let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
                let billing_des_name = v['billing_des_name'] ? v['billing_des_name'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let id_number = v['ID'] ? v['ID'] : '';
                let qty = v['qty'] ? v['qty'] : '';
                let unit_price = v['unit_price'] ? v['unit_price'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                let remark = v['remark'] ? v['remark'] : '';
                let create_by = v['create_by'] ? v['create_by'] : '';
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
                let sys_rate_currency = v['sys_rate_currency'] ? v['sys_rate_currency'] : '';
                let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                let billing_payment_check = v['billing_payment_check'] ? v['billing_payment_check'] : '';

                let data_amt_incv = ((qty*unit_price)*(vat/100)+(qty*unit_price));
                let data_amt_incv_exchange_rate = data_amt_incv*sys_rate


                if(sys_rate_currency == "THB"){
                    currency_exchange_thb = currency_exchange_thb + data_amt_incv_exchange_rate
                }
                if(sys_rate_currency == "RMB"){
                    currency_exchange_rmb = currency_exchange_rmb + data_amt_incv_exchange_rate
                }
                if(sys_rate_currency == "USD"){
                    currency_exchange_usd = currency_exchange_usd + data_amt_incv_exchange_rate
                }
                if(sys_rate_currency == "HKD"){
                    currency_exchange_hkd = currency_exchange_hkd + data_amt_incv_exchange_rate
                }

                i++;
                let data_html_paste = `
                <tr class=" row_master_${id_number}" id_number="${id_number}" ref_id="${ref_job_id}">
                    <td class="text-center">${i}</td>
                    <td class="text-center"><input type="checkbox" class="form-check-input cbx_sel" style="zoom:150%"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_job_no"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_bill_to"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_code"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_currency"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_amt_incv text-end"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_rate text-end"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_currency_can text-end"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_amt_incv_can text-end"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_remark"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_create_by"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_create_datetime"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_sale"></td>
                </tr>
                `;
                $('.table_data_account tbody').append(data_html_paste)

                data_amt_incv = data_amt_incv.toFixed(2)
                data_amt_incv_exchange_rate = data_amt_incv_exchange_rate.toFixed(2)

                if(billing_payment_check == ''){
                    $(`.row_master_${id_number} > td > .cbx_sel`).prop('checked',true).attr('disabled',true)
                }

                $(`.row_master_${id_number} > td > .inp_job_no`).val(job_number).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_bill_to`).val(bill_to_c).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_code`).val(billing_des_name).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_currency`).val(currency).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_amt_incv`).val(data_amt_incv).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_rate`).val(sys_rate).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_currency_can`).val(sys_rate_currency).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_amt_incv_can`).val(data_amt_incv_exchange_rate).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_remark`).val(remark).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_create_by`).val(create_by).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_create_datetime`).val(create_data_time).attr('disabled',true)
                $(`.row_master_${id_number} > td > .inp_sale`).val(sale_support).attr('disabled',true)


            }) 
            currency_exchange_thb = currency_exchange_thb.toFixed(2)
            currency_exchange_rmb = currency_exchange_rmb.toFixed(2)
            currency_exchange_usd = currency_exchange_usd.toFixed(2)
            currency_exchange_hkd = currency_exchange_hkd.toFixed(2)

            $('.total_incv_thb').val(currency_exchange_thb)
            $('.total_incv_rmb').val(currency_exchange_rmb)
            $('.total_incv_usd').val(currency_exchange_usd)
            $('.total_incv_hkd').val(currency_exchange_hkd)
            
        }
        

    },

    ajax_setting_data_table : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_payable/get_data_table.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}
function removeDuplicatejob_number(array) {
    let uniqueObjects = {};

    array.forEach(function(obj) {
        if (!uniqueObjects[obj.ref_job_id]) {
            uniqueObjects[obj.ref_job_id] = obj;
        }
    });

    return Object.values(uniqueObjects);
}

function removeDuplicatebill_to(array) {
    let uniqueObjects = {};

    array.forEach(function(obj) {
        if (!uniqueObjects[obj.bill_to_c]) {
            uniqueObjects[obj.bill_to_c] = obj;
        }
    });

    return Object.values(uniqueObjects);
}



