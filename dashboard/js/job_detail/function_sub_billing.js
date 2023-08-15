const function_sub_billing = {
    cal_billing_data_vat: async function (e) {
        let type_account = $(e).closest('tr').attr('type_data')
        
        let qtyy = $(e).closest('tr').find('.inp_qty').val();
        let unit_pricee = $(e).closest('tr').find('.inp_unit_price').val()
        let add_onn = $(e).closest('tr').find('.inp_add_on').val()
        let vatt = $(e).closest('tr').find('.inp_vat').val()

        let qty = qtyy == '' ? 0 : parseFloat(qtyy);
        let unit_price = unit_pricee == '' ? 0 : parseFloat(unit_pricee);
        let add_on = add_onn == '' ||add_onn == undefined ? 0 : parseFloat(add_onn);
        let vat = vatt == '' ? 0 : parseFloat(vatt)

        let res = (qty * unit_price) + add_on;
        $(e).closest('tr').find('.inp_amt').val(res)

        let res_amtinc = ((res * vat) / 100) + res;
        $(e).closest('tr').find('.inp_amtincv').val(res_amtinc)

        
        if(type_account == "AR"){
            
            let data_cur = '';
            if($('input[id="radiocurar1"]:checked').val() == 'on'){
                data_cur = "thb";
            }else if($('input[id="radiocurar2"]:checked').val() == 'on'){
                data_cur = "usd";
            }else if($('input[id="radiocurar3"]:checked').val() == 'on'){
                data_cur = "rmb";
            }
        

          //  await this.cal_currency(data_cur,'ar')
            
        }else{
            

            let data_cur = '';
            if($('input[id="radiocurap1"]:checked').val() == 'on'){
                data_cur = "thb";
            }else if($('input[id="radiocurap2"]:checked').val() == 'on'){
                data_cur = "usd";
            }else if($('input[id="radiocurap3"]:checked').val() == 'on'){
                data_cur = "rmb";
            }
           // await this.cal_currency(data_cur,'ap')
        }

    },

    add_new_list_ar: function () {
        let html_data_ar = '';
        let rows_cal = $('.table_billing_ar > tbody >tr ').length
        rows_cal++;
        
        html_data_ar = `
        <tr list_id = "" type = "AR">
                <td class="text-center">${rows_cal}</td> <!-- No -->
                <td>${sub_billing.html_select_code_billing_ar}</td>
                <td><input type="text" class="form-control form-control-sm inp_data_item" disabled></td> <!-- item -->
                <td>${sub_billing.html_select_bill_to_ar}</td>
                <td align="center"></td> <!-- Payble -->
                <td><select class="form-select form-select-sm inp_currency_ar ">
                        <option value="THB">THB</option>
                        <option value="USD">USD</option>
                        <option value="RMB">RMB</option>
                    </select></td> <!-- Currency -->
                <td><input type="number" class="form-control form-control-sm inp_qty_ar inp_qty text-center" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)" ></td> <!-- QTY. -->
                <td><input type="number" class="form-control form-control-sm inp_unit_price text-end" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)"></td><!-- Unit Price -->
                <td><input type="text" class="form-control form-control-sm inp_data_amt text-end inp_ar_amt" disabled></td><!-- AR AMT -->
                <td><input type="number" class="form-control form-control-sm inp_vat_ar inp_vat text-center" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)"></td><!-- VAT% -->
                <td><input type="text" class="form-control form-control-sm inp_amt_inc_vat_ar  text-end " disabled></td><!-- AMT(INCL.vat) -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- Billing Date -->
                <td><input type="text" class="form-control form-control-sm inp_sys_rate_ar" onchange="function_sub_billing.sys_rate_ar(this)" ></td><!-- sysrate -->
                <td class="text-center"><input type="checkbox" class="fotm-input-check text-center ch_need_vat_ar"></td><!-- need vat -->
                <td><input type="checkbox" class="form-input-check text-center ch_revd_amt_ar" ></td><!-- rcvd amt -->
                <td><input type="text" class="form-control form-control-sm inp_remark"></td>  <!-- remark -->
                <td><input type="checkbox" class="form-input-check ch_check_ar"></td>
                <td>status</td>
                <td></td><!-- Create by. -->
                <td></td><!-- Create datetime -->
                <td></td><!-- Check by. -->
                <td></td><!-- Check datetime -->
                <td></td><!-- Paid Check by. -->
                <td></td><!-- Paid Check datetime -->
                <td></td><!-- Last update by. -->
                <td></td><!-- Last update datetime -->
                <td><button class="btn btn-success btn-sm btn_save_ar m-1" onclick="function_sub_billing.save_list(this)">Save</button><button class="btn btn-danger btn-sm btn_del_ar">Del</button></td><!-- ACTION -->
            </tr>
        `;
        $('.table_billing_ar > tbody').append(html_data_ar)
    },

    add_new_list_ap: function () {
        let rows_cal = $('.table_billing_ap > tbody >tr ').length
        rows_cal++;
        let html_data_ap = '';
        
        
        html_data_ap = `
        <tr class="text-center">
                <td>${rows_cal}</td>
                <td>${sub_billing.select_billing_des_ap}</td>
                <td><input type="text" class="form-control form-control-sm inp_des_ap" disabled></td> <!-- Description -->
                <td>${sub_billing.select_bill_to_ap}</td> <!-- Bill to -->
                <td><div class="paid_status"></div></td> <!-- Payble -->
                <td><select class="form-select form-select-sm inp_currency_ap">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                    <option value="JP">JP</option>
                </select></td> <!-- Currency -->
                <td><input type="number" class="form-control form-control-sm text-center inp_qty " onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td> <!-- QTY. -->
                <td><input type="number" class="form-control form-control-sm text-end inp_unit_price "  onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td><!-- Unit Price -->
                <td><input type="text" class="form-control form-control-sm text-end inp_ap_amt " disabled></td><!-- AR AMT -->
                <td><input type="number" class="form-control form-control-sm text-center inp_vat "  onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td><!-- AR VAT% -->
                <td><input type="text" class="form-control form-control-sm text-end inp_amt_inc_vat_ap " disabled ></td><!-- AMT(INCL.vat) -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- Billing Date -->
                <td><input type="text" class="form-control form-control-sm text-end inp_sys_rate_ap"  onchange="function_sub_billing.sys_rate_ap(this)"></td><!-- Sys rate -->
                <td><input type="checkbox" class="form-input-check chb_apply "></td><!-- apply -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- apply date -->
                <td><input type="text" class="form-control form-control-sm text-end inp_paid_amt " disabled></td><!-- paid amt -->
                <td><input type="text" class="form-control form-control-sm inp_remark_ap"></td><!-- remark -->
                <td><input type="checkbox" class="form-input-check chb_check "></td><!-- CHECK -->
                <td><span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Paid</span></td><!-- status -->
                <td><input type="checkbox" class="form-input-check chb_tax_hold "></td><!-- tax invoice with hole -->
                <td><input type="text" class="form-control form-control-sm inp_commit"></td><!-- commision sale -->
                <td><input type="text" class="form-control form-control-sm text-center"  disabled></td><!-- branch -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- creater -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- creater date -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- last modifier -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- last modifier date -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- checker  -->
                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- checker date -->
                <td><button class="btn btn-success btn-sm rounded"><i class="bi bi-save"></i> save</button>
                <button class="btn btn-danger btn-sm rounded"><i class="bi bi-trash"></i> Del</button></td><!--  action -->
            </tr>
        `;
        $('.table_billing_ap > tbody').append(html_data_ap)
    },

    delete_list: function (e) {
        Swal.fire({
            title: `Are you sure delete list`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let clo_tr_del = $(e).closest('tr')
                let clo_tr_del_id = $(clo_tr_del).attr('list_id')
                // console.log(clo_tr_del_id)
                let res_data = '';
                if (clo_tr_del_id == undefined) {
                    res_data = '1'
                    clo_tr_del.remove();

                } else {
                    let res_data_result = await this.ajax_delete_list(clo_tr_del_id)
                    res_data = res_data_result['arr_res'];
                    clo_tr_del.remove();
                }

                if (res_data == '1') {
                    Swal.fire(
                        'saved!',
                        'Your data has been saved.',
                        'success'
                    )
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'System has problem plese contact to thailand tech team ',
                    })
                }
            }
        })
    },

    ajax_delete_list: async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/delete_list_billing.php",
                data: {
                    id_number: id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    save_list: async function (e) {
        Swal.fire({
            title: `Are you sure save list`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {

                let res_data = await this.get_save_list(e)
                // console.log(res_data)

                // if (res_data['arr_res'] == '1') {
                //     Swal.fire(
                //         'saved!',
                //         'Your data has been saved.',
                //         'success'
                //     )
                //     var currentURL = window.location.href;
                //     var url = new URL(currentURL);
                //     var id_number = url.searchParams.get("job_number");
                //     await sub_billing.first_post_data_ar(id_number)
                //     await sub_billing.first_post_data_ap(id_number)

                // } else if (res_data == false) {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Oops...',
                //         text: 'plese enter your data',
                //     })
                // } else {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Oops...',
                //         text: 'System has problem plese contact to thailand tech team ',
                //     })
                // }


            }
        })
    },

    get_save_list: async function (e) {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let obj_save = {}
        let arr_save = []

        let get_tr = $(e).closest('tr')

        let get_id = $(get_tr).attr('id_list')
        let get_type = $(get_tr).attr('type')

        let get_data_description = '';
        let get_data_bill_to = '';        
        let get_data_bill_to_type = '';
        let get_currency = '';
        let get_qty = '';
        let get_unit_price = '';
        let get_ap_amt = '';
        let get_vat = '';
        let get_amt_inc_vat = '';
        let get_sys_rate = '';
        let get_data_apply = '';
        let get_data_apply_attr = '';
        let get_remark = '';
        let get_with_hold = '';
        let get_with_hold_attr = '';
        let get_commit = '';
        let currency_main_ap = '';
        let get_need_vat = '';
        let get_revd_amt ='';
        let get_check_attr = '';

        if(get_type == "AP"){
            get_data_description = $(get_tr).find('.sel_data_billing_ap').val()
            get_data_bill_to = $(get_tr).find('.inp_billing_to_ap').val()
            get_data_bill_to_type = $(get_tr).find('.inp_billing_to_ap :selected').attr('type')
            get_currency = $(get_tr).find('.inp_currency_ap').val()
            get_qty = $(get_tr).find('.inp_qty').val()
            get_unit_price = $(get_tr).find('.inp_unit_price').val()
            get_ap_amt = $(get_tr).find('.inp_ap_amt').val()
            get_vat = $(get_tr).find('.inp_vat').val()
            get_amt_inc_vat = $(get_tr).find('.inp_amt_inc_vat_ap').val()
            
            get_sys_rate = $(get_tr).find('.inp_sys_rate_ap').val()
            get_data_apply = $(get_tr).find('.chb_apply').is(':checked') ? '1' : '0';
            get_data_apply_attr = $(get_tr).find('.chb_apply').attr('ischedkedon');
            get_remark = $(get_tr).find('.inp_remark_ap').val()
            get_check = $(get_tr).find('.chb_check').is(':checked') ? '1' : '0';
            get_check_attr = $(get_tr).find('.chb_check').attr('ischeckdone');
            get_with_hold = $(get_tr).find('.chb_tax_hold').is(':checked') ? '1' : '0';
            get_with_hold_attr = $(get_tr).find('.chb_tax_hold').attr('ischeckwithhold');
            get_commit = $(get_tr).find('.inp_commit').val()
            currency_main_ap = $('.inp_currency_main_ap').val()
        }else{
            get_data_description = $(get_tr).find('.select_code_billing_ar').val()
            get_data_bill_to = $(get_tr).find('.select_bill_to_ar').val()
            get_data_bill_to_type = $(get_tr).find('.select_bill_to_ar :selected').attr('type')
            get_currency = $(get_tr).find('.inp_currency_ar').val()
            get_qty = $(get_tr).find('.inp_qty_ar').val()
            get_unit_price = $(get_tr).find('.inp_unit_price').val()
            get_ap_amt = $(get_tr).find('.inp_ar_amt').val()
            get_vat = $(get_tr).find('.inp_vat_ar').val()
            get_amt_inc_vat = $(get_tr).find('.inp_amt_inc_vat_ar').val()
            
            get_sys_rate = $(get_tr).find('.inp_sys_rate_ar').val()
            get_remark = $(get_tr).find('.inp_remark').val()


            get_need_vat = $(get_tr).find('.ch_need_vat_ar').is(':checked') ? '1' : '0';
            get_revd_amt = $(get_tr).find('.ch_revd_amt_ar').is(':checked') ? '1' : '0';
            get_check = $(get_tr).find('.ch_check_ar').is(':checked') ? '1' : '0';
        
            
        }
        
        obj_save = {
            id_number : id_number,
            get_id : get_id,
            get_type : get_type,
            get_data_description : get_data_description,
            get_data_bill_to : get_data_bill_to,
            get_data_bill_to_type : get_data_bill_to_type,
            get_currency : get_currency,
            get_qty : get_qty,
            get_unit_price : get_unit_price,
            get_ap_amt : get_ap_amt,
            get_vat : get_vat,
            get_amt_inc_vat : get_amt_inc_vat,
            get_sys_rate : get_sys_rate,
            get_data_apply : get_data_apply,
            get_data_apply_attr : get_data_apply_attr,
            get_remark : get_remark,
            get_check : get_check,
            get_check_attr : get_check_attr,
            get_with_hold : get_with_hold,
            get_with_hold_attr : get_with_hold_attr,
            get_commit : get_commit,
            currency_main_ap : currency_main_ap,
            get_need_vat : get_need_vat,
            get_revd_amt : get_revd_amt
        }
        arr_save.push(obj_save)
        console.log(arr_save)
        

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/save_data_billing.php",
                data: {
                    arr_save: arr_save,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    check_box_status: function (e) {
        Swal.fire({
            title: `Are you sure save list`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let data_id = $(e).closest('tr').attr('list_id')
                let data_type = $(e).hasClass("inp_payble_checkbox")
                let type_action = data_type == true ? '1' : '0';
                // console.log(data_id)
                // console.log(type_action)
                let res_data = await this.ajax_update_check_list(data_id, type_action)

                if (res_data['arr_res'] == '1') {
                    Swal.fire(
                        'saved!',
                        'Your data has been saved.',
                        'success'
                    )
                    var currentURL = window.location.href;
                    var url = new URL(currentURL);
                    var id_number = url.searchParams.get("job_number");
                    await sub_billing.first_post_data_ar(id_number)
                    await sub_billing.first_post_data_ap(id_number)

                } else if (res_data == false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'plese enter your data',
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'System has problem plese contact to thailand tech team ',
                    })
                }
            } else {
                $(e).prop("checked", false);
            }
        })
    },

    ajax_update_check_list: async function (data_id, type_action) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/update_status_billing.php",
                data: {
                    data_id: data_id,
                    type_action: type_action
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    change_sub_billing_ar : async function (e){
        let target = $(e).val()
        
        let data_requeset = '';
        $.each(setting_data_default.data_billing_des_ar,function(i,v){
            if(target == v['ID']){
                data_requeset =  v['billing_item_name'];
            }
        })
        $(e).closest('tr').find('.inp_data_item').val(data_requeset)
    },

    change_sub_billing : async function (e){
        let target = $(e).val()
        let data_requeset = '';
        $.each(setting_data_default.data_billing_des,function(i,v){
            if(target == v['ID']){
                data_requeset =  v['billing_item_name'];
            }
        })
        $(e).closest('tr').find('.inp_des_ap').val(data_requeset)
    },

    billing_ap_function_cal_row_ar : async function(e){
        
        let ap_amt = 0;
        let amt_inc_vat = 0;
        let data_qty = parseFloat($(e).closest('tr').find('.inp_qty').val())
        let data_unit_price = parseFloat($(e).closest('tr').find('.inp_unit_price').val())
        let vat = parseFloat($(e).closest('tr').find('.inp_vat').val())

        ap_amt = data_qty * data_unit_price;
        amt_inc_vat = (ap_amt*vat/100)+ap_amt
        ap_amt = ap_amt.toFixed(2)
        amt_inc_vat = amt_inc_vat.toFixed(2)
        
        $(e).closest('tr').find('.inp_ar_amt').val(ap_amt)
        $(e).closest('tr').find('.inp_amt_inc_vat_ar').val(amt_inc_vat)
        this.cal_result_ar()
    },


    billing_ap_function_cal_row : async function(e){
        
        let ap_amt = 0;
        let amt_inc_vat = 0;
        let data_qty = parseFloat($(e).closest('tr').find('.inp_qty').val())
        let data_unit_price = parseFloat($(e).closest('tr').find('.inp_unit_price').val())
        let vat = parseFloat($(e).closest('tr').find('.inp_vat').val())

        ap_amt = data_qty * data_unit_price;
        amt_inc_vat = (ap_amt*vat/100)+ap_amt
        ap_amt = ap_amt.toFixed(2)
        amt_inc_vat = amt_inc_vat.toFixed(2)
        
        $(e).closest('tr').find('.inp_ap_amt').val(ap_amt)
        $(e).closest('tr').find('.inp_amt_inc_vat_ap').val(amt_inc_vat)
        this.cal_result_ap()
    },

    sys_rate_ar : async function(e){
        let sys_rate = parseFloat($(e).val());
        let amt_inc_vat = parseFloat($(e).closest('tr').find('.inp_amt_inc_vat_ap').val())
        let data_result = 0;
        sys_rate = sys_rate == NaN ? 0 : sys_rate;
        amt_inc_vat = amt_inc_vat == NaN ? 0 : amt_inc_vat;
        
        
        data_result = parseFloat(amt_inc_vat*sys_rate )
        // $('.inp_paid_amt',$(e).closest('tr')).val(data_result)
        await this.cal_result_ar()
    },

    sys_rate_ap : async function(e){
        let sys_rate = parseFloat($(e).val());
        let amt_inc_vat = parseFloat($(e).closest('tr').find('.inp_amt_inc_vat_ap').val())
        let data_result = 0;
        
        data_result = parseFloat(amt_inc_vat*sys_rate )
        $('.inp_paid_amt',$(e).closest('tr')).val(data_result)
        await this.cal_result_ap()
    },


    cal_result_ar : async function(e){
        
        
        let inp_ap_amt =0;
        let inp_amt_inc_vat_ap = 0;
        let add_tax = 0;

        let data_obj = {}
        let data_arr = []
        $(`.table_billing_ar > tbody > tr`).each(function(i,v){


            let data_ar_amt = parseFloat($('.inp_ar_amt',this).val())
            let data_amt_inc_vat = parseFloat($('.inp_amt_inc_vat_ar',this).val())
            let sys_rate = parseFloat($('.inp_sys_rate_ar',this).val())
            data_ar_amt = data_ar_amt === NaN ? 0 : data_ar_amt;
            data_amt_inc_vat = data_amt_inc_vat != NaN ? data_amt_inc_vat : 0 ;
            sys_rate = sys_rate == 'NaN' ? 0 : sys_rate;

            

            let keep_amt = data_ar_amt * sys_rate
            let keep_amt_inc = data_amt_inc_vat * sys_rate
            
            data_obj={
                keep_amt : keep_amt,
                keep_amt_inc : keep_amt_inc
            }
            data_arr.push(data_obj)
        })
        
        $.each(data_arr,function(i,v){
            let data_keep_amt = v['keep_amt']
            let data_keep_amt_inc = v['keep_amt_inc']

            inp_ap_amt = inp_ap_amt +data_keep_amt;
            inp_amt_inc_vat_ap = inp_amt_inc_vat_ap +data_keep_amt_inc;
        })


        add_tax = inp_amt_inc_vat_ap - inp_ap_amt;

        inp_ap_amt = inp_ap_amt.toFixed(2)
        add_tax = add_tax.toFixed(2)
        inp_amt_inc_vat_ap = inp_amt_inc_vat_ap.toFixed(2)
        
        $('.inp_sub_total_ar').val(inp_ap_amt)
        $('.inp_vat_inc_ar').val(add_tax)
        $('.inp_total_ar').val(inp_amt_inc_vat_ap)

    },


    cal_result_ap : async function(e){
        
        let find_targer = $(e).find('tbody > tr') 
        let inp_ap_amt =0;
        let inp_amt_inc_vat_ap = 0;
        let add_tax = 0;

        let data_obj = {}
        let data_arr = []
        $(find_targer).each(function(i,v){
            let data_ap_amt = parseFloat($('.inp_ap_amt',this).val())
            let data_amt_inc_vat = parseFloat($('.inp_amt_inc_vat_ap',this).val())
            let sys_rate = parseFloat($('.inp_sys_rate_ap',this).val())

            let keep_amt = data_ap_amt * sys_rate
            let keep_amt_inc = data_amt_inc_vat * sys_rate
            
            data_obj={
                keep_amt : keep_amt,
                keep_amt_inc : keep_amt_inc
            }
            data_arr.push(data_obj)
        })

        $.each(data_arr,function(i,v){
            let data_keep_amt = v['keep_amt']
            let data_keep_amt_inc = v['keep_amt_inc']

            inp_ap_amt = inp_ap_amt +data_keep_amt;
            inp_amt_inc_vat_ap = inp_amt_inc_vat_ap +data_keep_amt_inc;
        })


        add_tax = inp_amt_inc_vat_ap - inp_ap_amt;

        inp_ap_amt = inp_ap_amt.toFixed(2)
        add_tax = add_tax.toFixed(2)
        inp_amt_inc_vat_ap = inp_amt_inc_vat_ap.toFixed(2)
        
        $('.inp_sub_total_ap').val(inp_ap_amt)
        $('.inp_vat_inc_ap').val(add_tax)
        $('.inp_total_ap').val(inp_amt_inc_vat_ap)

    }



}