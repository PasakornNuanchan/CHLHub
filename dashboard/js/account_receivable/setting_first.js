const setting_first = {
    data_in_table : '',
    get_res_data_table : '',
    first_set: async function () {


        $('.head-of-menu').html('Account Receivable (Acc)');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="account_receivable.php" target="" style="color:white;">Account receivable (Acc)</a></li>
        `;
        $('.bcpage').append(html_bdpage);


        
        let res_data = await this.ajax_first_set();
        console.log(res_data)
        this.data_in_table = res_data['table'];
        this.get_res_data_table = res_data['table'];
        $('.table_data_account tbody').html('')

        if (res_data['table'] != "0 results") {
            let html_append_data = '';
            $.each(res_data['table'], function (i, v) {
                i++

                let job_number = v['job_number'] ? v['job_number'] : '';
                let id_number = v['ID'] ? v['ID'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let qty = v['qty'] ? v['qty'] : 0;
                let unit_price = v['unit_price'] ? v['unit_price'] : 0;
                let vat = v['vat'] ? v['vat'] : 0;
                let remark = v['remark'] ? v['remark'] : '';
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                let action_paid_by = v['action_paid_by'] ? v['action_paid_by'] : '';
                let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '';
                let vat_show = vat != '' ? vat+"%" : '';
                let with_holding_tax_show = with_holding_tax != '' ? with_holding_tax+"%" : '';
                let hbl_data = v['hbl_data'] ? v['hbl_data'] : '';
                let booking_number = v['booking_number'] ? v['booking_number'] : '';
                let billing_item_name = v['billing_des_name'] ? v['billing_des_name'] : '';
                let create_by_name = v['create_by_name'] ? v['create_by_name'] : '';
                let check_by_name = v['check_by_name'] ? v['check_by_name'] : '';
                let cs_support_name = v['cs_support_name'] ? v['cs_support_name'] : '';
                let sale_support_name = v['sale_support_name'] ? v['sale_support_name'] : '';
                let container_data = v['container_data'] ? v['container_data'] : '';
                let bill_to_c =  v['bill_to_c'] ? v['bill_to_c'] : '';
                let create_date = v['create_date'] ? v['create_date'] : '';
                let status_data = v['status'] ? v['status'] : '';
                let approve_by = v['approve_by'] ? v['approve_by'] : '';
                let approve_datetime = v['approve_date_time'] ? v['approve_date_time'] : '';
                let pre_approve_status = v['pre_approve_status'] ? v['pre_approve_status'] : '';
                let ap_amt = qty * unit_price;
                let ap_amt_incvat = 0;
                let cal_vat = 0;
                let cal_wh = 0;
                let tax_exc = 0;
                let ap_amt_incvat_cal = 0;
                if(with_holding_tax == 0){
                    cal_vat = ap_amt * (vat/100)
                    ap_amt_incvat = cal_vat + ap_amt
                    ap_amt_incvat_cal = ap_amt_incvat
                }else{
                    cal_vat = ap_amt * (vat/100)
                    cal_wh = ap_amt * (with_holding_tax/100)
                    tax_exc = cal_vat - cal_wh
                    ap_amt_incvat = ap_amt + cal_vat - cal_wh
                    ap_amt_incvat_cal = ap_amt_incvat
                }
            
           
                ap_amt = ap_amt.toFixed(2)
                ap_amt_incvat = ap_amt_incvat.toFixed(2)





                html_append_data = `
                <tr class="text-center data_id${id_number}" data_id = "${id_number}">
                    
                    <td>${i}</td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${job_number}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${bill_to_c}" disabled></td>                                    Bill to
                    <td><input type="text" class="form-control form-control form-control-sm" value="${billing_item_name}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-center inp_currency" value="${currency}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${qty}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${unit_price}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${ap_amt}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${vat_show}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${with_holding_tax_show}" disabled> </td>                                    WH%
                    <td><input type="text" class="form-control form-control form-control-sm text-end inp_ap_amt_incvat" value="${ap_amt_incvat}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm"></td>
                    <td><input type="checkbox" class="form-input-check tb_pre_app" onclick="ar_function.pre_approve(this)" style="zoom:200%"></td>

                    <td>
                        <input type="radio" class="form-check-input data_sela data_sela_1" name="bsradio1_${id_number}" id="radio1_${id_number}" name_data="1" checked="">
                        <label for="radio1" class="form-check-label pl-2">Waiting</label>
                        <input type="radio" class="form-check-input data_sela data_sela_2" name="bsradio1_${id_number}" id="radio2_${id_number}" name_data="2" onclick="ar_function.select_approve(this)">
                        <label for="radio2" class="form-check-label pl-2">Approve</label>
                        <input type="radio" class="form-check-input data_sela data_sela_3" name="bsradio1_${id_number}" id="radio3_${id_number}" name_data="3" onclick="ar_function.select_approve(this)">
                        <label for="radio3" class="form-check-label pl-2">Reject</label>
                    </td>                              
                    <td><input type="text" class="form-control form-control form-control-sm" value="${remark}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${cs_support_name}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${sale_support_name}" disabled></td>
                    <td><input type="date" class="form-control form-control form-control-sm" value="${create_date}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${create_by_name}" disabled></td>
                    <td><input type="datetime" class="form-control form-control form-control-sm" value="${create_data_time}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${check_by_name}" disabled></td>
                    <td><input type="datetime" class="form-control form-control form-control-sm" value="${check_date_time}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${booking_number}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${container_data}" disabled></td>                                    Container No.
                    <td><input type="text" class="form-control form-control form-control-sm" value="${hbl_data}" disabled></td>                         
                    <td><input type="checkbox" class="form-input-check tb_in_tb"></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="" disabled></td>                                    
                    <td><input type="text" class="form-control form-control form-control-sm" value="${action_paid_date_time}" disabled></td>                                    Request payble
                </tr>
                `;

                $('.table_data_account tbody').append(html_append_data)

                if(pre_approve_status == '1'){
                    $(`.data_id${id_number} > td > .tb_pre_app`).prop('checked',true)
                }

                if(action_paid_by != ''){
                    $(`.data_id${id_number} > td >.tb_in_tb`).prop('checked',true)
                }
                
                
                if(status_data == '2'){
                    $(`.data_id${id_number} > td > .data_sela_2`).prop('checked',true)
                }else if(status_data == '3'){
                    $(`.data_id${id_number} > td > .data_sela_3`).prop('checked',true)
                }else{
                    $(`.data_id${id_number} > td > .data_sela_1`).prop('checked',true)
                }

                // action_paid_date_time
                // check_date_time
                $(`.data_id${id_number} > td > .data_sela`).attr('disabled',true)

                if(action_paid_date_time != '' || check_date_time != ''){
                    $(`.data_id${id_number} > td > .data_sela`).attr('disabled',false)
                }
                
                console.log(status_data)
                if(status_data == '2'){
                    $(`.data_id${id_number} > td > .data_sela`).attr('disabled',true)
                }

            })
        }
        await this.cal_total();
        await $('.sel_st_7').prop('checked',true)
    },

    ajax_first_set: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_receivable/get_data_table.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    cal_total : async function (){
        let e = $('.table_data_account > tbody > tr')

        let data_total_usd = 0;
        let data_total_thb = 0;
        let data_total_rmb = 0;
        let data_total_hkd = 0;
        let data_approve_usd = 0;
        let data_approve_thb = 0;
        let data_approve_rmb = 0;
        let data_approve_hkd = 0;

        $.each(e,function(){
            let id_number = $(this).attr('data_id')
            let currency = $(this).find('.inp_currency').val()
            let inp_ap_amt_incvat = parseFloat($(this).find('.inp_ap_amt_incvat').val())
            let data_check1 = $(this).find(`#radio1_${id_number}`).is(":checked") ? '1' : '0';
            let data_check2 = $(this).find(`#radio2_${id_number}`).is(":checked") ? '1' : '0';
            let data_check3 = $(this).find(`#radio3_${id_number}`).is(":checked") ? '1' : '0';
            
        
            if(data_check1 == "1"){
                if(currency == "THB"){
                    data_total_thb = data_total_thb + inp_ap_amt_incvat;
                }else if(currency == "USD"){
                    data_total_usd = data_total_usd + inp_ap_amt_incvat;
                }else if(currency == "RMB"){
                    data_total_rmb = data_total_rmb + inp_ap_amt_incvat;
                }else if(currency == "HKD"){
                    data_total_hkd = data_total_hkd + inp_ap_amt_incvat;
                }
            }else if(data_check2 == "1"){
                if(currency == "THB"){
                    data_approve_thb = data_approve_thb + inp_ap_amt_incvat;
                }else if(currency == "USD"){
                    data_approve_usd = data_approve_usd + inp_ap_amt_incvat;
                }else if(currency == "RMB"){
                    data_approve_rmb = data_approve_rmb + inp_ap_amt_incvat;
                }else if(currency == "HKD"){
                    data_approve_hkd = data_approve_hkd + inp_ap_amt_incvat;
                }
            }
        })

        data_total_usd = data_total_usd.toFixed(2)
        data_total_thb = data_total_thb.toFixed(2)
        data_total_rmb = data_total_rmb.toFixed(2)
        data_total_hkd = data_total_hkd.toFixed(2)
        data_approve_usd = data_approve_usd.toFixed(2)
        data_approve_thb = data_approve_thb.toFixed(2)
        data_approve_rmb = data_approve_rmb.toFixed(2)
        data_approve_hkd = data_approve_hkd.toFixed(2)

        $('.total_payble_usd').val(data_total_usd)
        $('.total_payble_thb').val(data_total_thb)
        $('.total_payble_rmb').val(data_total_rmb)
        $('.total_payble_hkd').val(data_total_hkd)
        $('.verfied_usd').val(data_approve_usd)
        $('.verfied_thb').val(data_approve_thb)
        $('.verfied_rmb').val(data_approve_rmb)
        $('.verfied_hkd').val(data_approve_hkd)
    }


}


