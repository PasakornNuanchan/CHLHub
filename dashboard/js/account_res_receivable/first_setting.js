const first_setting = {

    
    start_page : async function (){


        $('.head-of-menu').html('Account Receivable Report');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="account_res_receivable.php" target="" style="color:white;">Account Receivable Report</a></li>
        `;
        $('.bcpage').append(html_bdpage);
    },

    setting_data_table : async function(e){
        let res_data = '';
        
        if(e == undefined){
            res_data = await this.ajax_setting_data_table()
        }else{
            res_data = e;            
        }

        console.log(res_data)
        if(res_data != "0 results"){
            $('.table_data_account tbody').html('')
            let html_data_tr = '';

            $.each(res_data['table'],function(i,v){
                let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
                let consginee_tel = v['consginee_tel'] ? v['consginee_tel'] : '';
                let job_number = v['job_number'] ? v['job_number'] : '';
                let sale_support = v['sale_support'] ? v['sale_support'] : '';
                let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
                let billing_des_name = v['billing_des_name'] ? v['billing_des_name'] : '';
                let create_by = v['create_by'] ? v['create_by'] : '';
                let mbl = v['mbl'] ? v['mbl'] : '';
                let vessel = v['vessel'] ? v['vessel'] : '';
                let etd = v['ETD'] ? v['ETD'] : '';
                let eta = v['ETA'] ? v['ETA'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                let id_number = v['ID'] ? v['ID'] : '';
                let qty = v['qty'] ? v['qty'] : '';
                let unit_price = v['unit_price'] ? v['unit_price'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                let remark = v['remark'] ? v['remark'] : '';
                let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
                let sys_rate_currency = v['sys_rate_currency'] ? v['sys_rate_currency'] : '';
                let data_total = qty*unit_price
                let data_incv = (data_total*(vat/100))+data_total
                let data_currency = data_incv*sys_rate

                
                i++;
                html_data_tr = `
                <tr class="id_row_${i}" id_nubmer="${id_number}">
                    <td class="text-center">${i}</td>
                    <td class="text-center"><input type="checkbox" class="form-check-input cbx_select"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_job_number"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_bill_to"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_code"></td>
                    <td class="text-center"><input type="text" class="form-control form-control text-end inp_amount"></td>
                    <td class="text-center"><input type="text" class="form-control form-control text-center inp_currency"></td>
                    <td class="text-center"><input type="text" class="form-control form-control text-end inp_usd"></td>
                    <td class="text-center"><input type="text" class="form-control form-control text-end inp_thb"></td>
                    <td class="text-center"><input type="text" class="form-control form-control text-end inp_rmb"></td>
                    <td class="text-center"><input type="text" class="form-control form-control text-end inp_hkd"></td>
                    <td class="text-center"><input type="text" class="form-control form-control text-end inp_amount_currency"></td>  
                    <td class="text-center"><input type="text" class="form-control form-control text-end inp_exchage_rate"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_so"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_bl"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_sailing_date"></td>  
                    <td class="text-center"><input type="text" class="form-control form-control inp_vessel"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_etd"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_eta"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_request_by"></td>  
                    <td class="text-center"><input type="text" class="form-control form-control inp_customer_address"></td>
                    <td class="text-center"><input type="text" class="form-control form-control inp_customer_phone"></td>
                </tr>
                `;

                data_incv = data_incv.toFixed(2)
                data_currency = data_currency.toFixed(2)
                

                $('.table_data_account tbody').append(html_data_tr)

                if(currency == "THB"){
                    $(`.id_row_${i} > td > .inp_thb`).val(data_incv)
                }else if(currency == "USD"){
                    $(`.id_row_${i} > td > .inp_usd`).val(data_incv)
                }else if(currency == "RMB"){
                    $(`.id_row_${i} > td > .inp_rmb`).val(data_incv)
                }else if(currency == "HKD"){
                    $(`.id_row_${i} > td > .inp_hkd`).val(data_incv)
                }
consignee_name
                $(`.id_row_${i} > td > .inp_thb`).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_usd`).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_rmb`).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_hkd`).attr('disabled',true)

                $(`.id_row_${i} > td > .inp_job_number`).val(job_number).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_bill_to`).val(consignee_name).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_code`).val(billing_des_name).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_amount`).val(data_incv).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_currency`).val(currency).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_amount_currency`).val(data_currency).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_exchage_rate`).val(sys_rate).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_so`).val(mbl).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_bl`).val(mbl).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_sailing_date`).val(etd).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_vessel`).val(vessel).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_etd`).val(etd).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_eta`).val(eta).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_request_by`).val(create_by).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_customer_address`).val(consignee_name).attr('disabled',true)
                $(`.id_row_${i} > td > .inp_customer_phone`).val(consginee_tel).attr('disabled',true)

                

            })
        }else{

        }
            
        $('.cb_st_6').prop('checked',true)

    },

    ajax_setting_data_table : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_res_receivable/get_data_table.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    default_setting : async function(){
        let res_data = await this.ajax_setting_default();

        let res_bill_to = await removeDuplicate_bill_to(res_data['bill_to']);
        let res_job_detail = await removeDuplicate_job_number(res_data['job_number']);
        

        let html_data_bill_to = '';
        let html_data_job_number = '';
        $.each(res_bill_to,function(i,v){
            html_data_bill_to += `<option value="${v['bill_to_c']}" data_type="${v['bill_to_type']}" data_row="${v['bill_to']}">${v['bill_to_c']}</option>`;
        })

        $.each(res_job_detail,function(i,v){
            html_data_job_number += `<option value="${v['job_number']}" data_row="${v['id_number']}">${v['job_number']}</option>`;
        })

        $('.bill_to_list_option').append(html_data_bill_to)
        $('.job_number_list_option').append(html_data_job_number)




    },

    ajax_setting_default : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_res_receivable/get_data_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}

async function removeDuplicate_bill_to(array) {
    let uniqueObjects = {};

    array.forEach(function(obj) {
        if (!uniqueObjects[obj.bill_to_c]) {
            uniqueObjects[obj.bill_to_c] = obj;
        }
    });

    return Object.values(uniqueObjects);
}

async function removeDuplicate_job_number(array) {
    let uniqueObjects = {};

    array.forEach(function(obj) {
        if (!uniqueObjects[obj.id_number]) {
            uniqueObjects[obj.id_number] = obj;
        }
    });

    return Object.values(uniqueObjects);
}