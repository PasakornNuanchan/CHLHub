const function_sub_billing = {
    cal_billing_data_vat: async function (e) {
        let type_account = $(e).closest('tr').attr('type_data')
        
        let qtyy = $(e).closest('tr').find('.inp_qty').val();
        let unit_pricee = $(e).closest('tr').find('.inp_unit_price').val()
        let add_onn = $(e).closest('tr').find('.inp_add_on').val()
        let vatt = $(e).closest('tr').find('.inp_vat').val()

        // console.log(type_account)
        // console.log(qtyy)
        // console.log(unit_pricee)
        // console.log(add_onn)
        // console.log(vatt)

        let qty = qtyy == '' ? 0 : parseFloat(qtyy);
        let unit_price = unit_pricee == '' ? 0 : parseFloat(unit_pricee);
        let add_on = add_onn == '' ||add_onn == undefined ? 0 : parseFloat(add_onn);
        let vat = vatt == '' ? 0 : parseFloat(vatt)

        let res = (qty * unit_price) + add_on;
        $(e).closest('tr').find('.inp_amt').val(res)

        let res_amtinc = ((res * vat) / 100) + res;
        $(e).closest('tr').find('.inp_amtincv').val(res_amtinc)

        
        if(type_account == "AR"){
            // console.log('555')
            let data_cur = '';
            if($('input[id="radiocurar1"]:checked').val() == 'on'){
                data_cur = "thb";
            }else if($('input[id="radiocurar2"]:checked').val() == 'on'){
                data_cur = "usd";
            }else if($('input[id="radiocurar3"]:checked').val() == 'on'){
                data_cur = "rmb";
            }
        

            await this.cal_currency(data_cur,'ar')
            
        }else{
            

            let data_cur = '';
            if($('input[id="radiocurap1"]:checked').val() == 'on'){
                data_cur = "thb";
            }else if($('input[id="radiocurap2"]:checked').val() == 'on'){
                data_cur = "usd";
            }else if($('input[id="radiocurap3"]:checked').val() == 'on'){
                data_cur = "rmb";
            }
            await this.cal_currency(data_cur,'ap')
        }

    },

    add_new_list_ar: function () {
        let html_data_ar = '';
        html_data_ar = `
        <tr type_data = "AR">
            <td><input type="text" class="form-control form-control-sm inp_des_ar inp_des" maxlength="200"></td> <!-- Description -->
            <td><input type="text" class="form-control form-control-sm inp_billing_to_ar inp_billing_to" maxlength="200"></td> <!-- Bill to -->
            <td align="center"></td> <!-- Payble -->
            <td><select class="form-select form-select-sm inp_currency inp_currency_ar" onchange="function_sub_billing.cal_billing_data_vat(this)">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                </select></td> <!-- Currency -->
            <td><input type="number" class="form-control form-control-sm inp_qty inp_qty_ar" onchange="function_sub_billing.cal_billing_data_vat(this)"></td> <!-- QTY. -->
            <td><input type="number" class="form-control form-control-sm inp_unit_price inp_unit_price_ar" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- Unit Price -->
            <td><input type="number" class="form-control form-control-sm inp_add_on inp_add_on_ar" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- Add on profit -->
            <td><input type="number" class="form-control form-control-sm inp_amt inp_amt_ar" onchange="function_sub_billing.cal_billing_data_vat(this)" disabled></td><!-- AR AMT -->
            <td><input type="number" class="form-control form-control-sm inp_vat inp_vat_ar" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- AR VAT% -->
            <td><input type="number" class="form-control form-control-sm inp_amtincv inp_amtincv_ar" disabled></td><!-- AMT(INCL.vat) -->
            <td><input type="text" class="form-control form-control-sm inp_remark" maxlength="100"></td><!-- remark -->
            <td align="center"></td><!-- CHECK -->
            <td><span class="badge rounded-pill bg-danger" >Unpiad</span></td><!-- PAID -->
            <td><button class="btn btn-success btn-sm m-1" onclick="function_sub_billing.save_list(this)">Save</button><button class="btn btn-danger btn-sm" onclick="function_sub_billing.delete_list(this)">Del</button></td><!-- ACTION -->
            <td></td><!-- Create by. -->
            <td></td><!-- Create datetime -->
            <td></td><!-- Check by. -->
            <td></td><!-- Check datetime -->
            <td></td><!-- Paid Check by. -->
            <td></td><!-- Paid Check datetime -->
            <td></td><!-- Last update by. -->
            <td></td><!-- Last update datetime -->
        </tr>
        `;
        $('.table_billing_ar > tbody').append(html_data_ar)
    },

    add_new_list_ap: function () {
        let html_data_ap = '';
        html_data_ap = `
        <tr type_data = "AP">
            <td><input type="text" class="form-control form-control-sm inp_des_ap inp_des" maxlength="200"></td> <!-- Description -->
            <td><input type="text" class="form-control form-control-sm inp_billing_to_ap inp_billing_to" maxlength="200"></td> <!-- Bill to -->
            <td align="center"></td> <!-- Payble -->
            <td><select class="form-select form-select-sm inp_currency inp_currency_ap" onchange="function_sub_billing.cal_billing_data_vat(this)">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                </select></td> <!-- Currency -->
            <td><input type="number" class="form-control form-control-sm inp_qty inp_qty_ap" onchange="function_sub_billing.cal_billing_data_vat(this)"></td> <!-- QTY. -->
            <td><input type="number" class="form-control form-control-sm inp_unit_price inp_unit_price_ap" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- Unit Price -->
            <td><input type="number" class="form-control form-control-sm inp_amt inp_amt_ap" onchange="function_sub_billing.cal_billing_data_vat(this)" disabled></td><!-- AR AMT -->
            <td><input type="number" class="form-control form-control-sm inp_vat inp_vat_ap" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- AR VAT% -->
            <td><input type="number" class="form-control form-control-sm inp_amtincv inp_amtincv_ap" disabled></td><!-- AMT(INCL.vat) -->
            <td><input type="text" class="form-control form-control-sm inp_remark" maxlength="100"></td><!-- remark -->
            <td align="center"></td><!-- CHECK -->
            <td><span class="badge rounded-pill bg-danger" >Unpiad</span></td><!-- PAID -->
            <td><button class="btn btn-success btn-sm m-1" onclick="function_sub_billing.save_list(this)">Save</button><button class="btn btn-danger btn-sm" onclick="function_sub_billing.delete_list(this)">Del</button></td><!-- ACTION -->
            <td></td><!-- Create by. -->
            <td></td><!-- Create datetime -->
            <td></td><!-- Check by. -->
            <td></td><!-- Check datetime -->
            <td></td><!-- Paid Check by. -->
            <td></td><!-- Paid Check datetime -->
            <td></td><!-- Last update by. -->
            <td></td><!-- Last update datetime -->
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

                let res_data = await this.get_save_list_(e)
                // console.log(res_data)

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


            }
        })
    },

    get_save_list_: async function (e) {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let obj_save = {}
        let arr_save = []

        let get_tr = $(e).closest('tr')
        let get_id = $(get_tr).attr('list_id')
        let get_type = $(get_tr).attr('type_data')
        let get_description = $(get_tr).find('.inp_des').val()
        let inp_billing_to = $(get_tr).find('.inp_billing_to').val()
        let inp_add_on = $(get_tr).find('.inp_add_on').val() == '' ? 0 : $(get_tr).find('.inp_add_on').val();

        let inp_currency = $(get_tr).find('.inp_currency').val()
        let inp_qty = $(get_tr).find('.inp_qty').val()
        let inp_unit_price = $(get_tr).find('.inp_unit_price').val()
        let inp_amt = $(get_tr).find('.inp_amt').val()
        let inp_vat = $(get_tr).find('.inp_vat').val() == '' ? 0 : $(get_tr).find('.inp_vat').val();
        let inp_amtincv = $(get_tr).find('.inp_amtincv').val()
        let inp_remark = $(get_tr).find('.inp_remark').val()

        if (get_description == '' || inp_billing_to == '' || inp_qty == '' || inp_unit_price == '') {
            return false;
        }

        obj_save = {
            id_number: id_number,
            get_id: get_id,
            get_type: get_type,
            get_description: get_description,
            inp_billing_to: inp_billing_to,
            inp_add_on: inp_add_on,
            inp_currency: inp_currency,
            inp_qty: inp_qty,
            inp_unit_price: inp_unit_price,
            inp_amt: inp_amt,
            inp_vat: inp_vat,
            inp_amtincv: inp_amtincv,
            inp_remark: inp_remark,
        }
        arr_save.push(obj_save)


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

    cal_currency: async function (type_act, type_acc) {
        let val_usd = 0;
        let val_th = 0;
        let val_rmb = 0;

        if(type_act == "thb"){
            val_usd = 34.55;
            val_th = 1;
            val_rmb = 4.84;
        }else if(type_act == "usd"){
            val_usd = 1;
            val_th = 0.029;
            val_rmb = 0.14;
        }else if(type_act == "rmb"){
            val_usd = 7.13;
            val_th = 0.21;
            val_rmb = 1;
        }
        // console.log(type_act)
        // console.log(type_acc)
        

        if (type_acc === "ar") {
            // sub total
            let amt_rmb = 0;
            let amt_usd = 0;
            let amt_thb = 0;
            $('.table_billing_ar > tbody > tr').each(function (e) {
                let type_cur = $('.inp_currency_ar', this).val();
                let amt_ar = parseFloat($('.inp_amt_ar', this).val())

                if (type_cur == "THB") {
                    amt_thb = parseFloat(amt_thb) + parseFloat(amt_ar)
                } else if (type_cur == "USD") {
                    amt_usd = parseFloat(amt_usd) + parseFloat(amt_ar)
                } else if (type_cur == "RMB") {
                    amt_rmb = parseFloat(amt_rmb) + parseFloat(amt_ar)
                }
            })

            let cal_to_thb = parseFloat(amt_usd * val_usd) + parseFloat(amt_thb * val_th) + parseFloat(amt_rmb * val_rmb)
            let tof_all_amt_ar = cal_to_thb.toFixed(2)
            $('.inp_sub_total_ar').val(tof_all_amt_ar).attr('disabled', true)

            let amtincv_rmb = 0;
            let amtincv_usd = 0;
            let amtincv_thb = 0;

            $('.table_billing_ar > tbody > tr').each(function (e) {
                let type_cur = $('.inp_currency_ar', this).val();
                let amt_incv_ar = parseFloat($('.inp_amtincv_ar', this).val())

                if (type_cur == "THB") {
                    amtincv_thb = parseFloat(amtincv_thb) + parseFloat(amt_incv_ar)
                } else if (type_cur == "USD") {
                    amtincv_usd = parseFloat(amtincv_usd) + parseFloat(amt_incv_ar)
                } else if (type_cur == "RMB") {
                    amtincv_rmb = parseFloat(amtincv_rmb) + parseFloat(amt_incv_ar)
                }
            })
            let cal_to_thb_incv = parseFloat(amtincv_usd * val_usd) + parseFloat(amtincv_thb * val_th) + parseFloat(amtincv_rmb * val_rmb)

            let tof_all_amt_incv_ar = cal_to_thb_incv.toFixed(2)
            $('.inp_total').val(tof_all_amt_incv_ar).attr('disabled', true)


            let vat_all = tof_all_amt_incv_ar - tof_all_amt_ar;
            let tof_vat_all = vat_all.toFixed(2)
            $('.inp_vat_inc').val(tof_vat_all).attr('disabled', true)
        } else {
        // sub total
        let amt_rmb = 0;
        let amt_usd = 0;
        let amt_thb = 0;
        $('.table_billing_ap > tbody > tr').each(function (e){
            let type_cur = $('.inp_currency_ap',this).val();
            let amt_ar = parseFloat($('.inp_amt_ap',this).val())

            if(type_cur == "THB"){
                amt_thb = parseFloat(amt_thb) + parseFloat(amt_ar)                
            }else if(type_cur == "USD"){
                amt_usd = parseFloat(amt_usd) + parseFloat(amt_ar)
            }else if(type_cur == "RMB"){
                amt_rmb = parseFloat(amt_rmb) + parseFloat(amt_ar)
            }
        })

        let cal_to_thb = parseFloat(amt_usd*val_usd) + parseFloat(amt_thb*val_th) + parseFloat(amt_rmb*val_rmb)
        let tof_all_amt_ar = cal_to_thb.toFixed(2)
        $('.inp_sub_total_ap').val(tof_all_amt_ar).attr('disabled',true)



        let amtincv_rmb = 0;
        let amtincv_usd = 0;
        let amtincv_thb = 0;

        $('.table_billing_ap > tbody > tr').each(function (e){
            let type_cur = $('.inp_currency_ap',this).val();
            let amt_incv_ar = parseFloat($('.inp_amtincv_ap',this).val())
            
            if(type_cur == "THB"){
                amtincv_thb = parseFloat(amtincv_thb) + parseFloat(amt_incv_ar)                
            }else if(type_cur == "USD"){
                amtincv_usd = parseFloat(amtincv_usd) + parseFloat(amt_incv_ar)
            }else if(type_cur == "RMB"){
                amtincv_rmb = parseFloat(amtincv_rmb) + parseFloat(amt_incv_ar)
            }
        })
        let cal_to_thb_incv = parseFloat(amtincv_usd*val_usd) + parseFloat(amtincv_thb*val_th) + parseFloat(amtincv_rmb*val_rmb)

        let tof_all_amt_incv_ar = cal_to_thb_incv.toFixed(2)
        $('.inp_total_ap').val(tof_all_amt_incv_ar).attr('disabled',true)
        

        let vat_all = tof_all_amt_incv_ar - tof_all_amt_ar;
        let tof_vat_all = vat_all.toFixed(2)
        $('.inp_vat_inc_ap').val(tof_vat_all).attr('disabled',true)
        }
    }
}