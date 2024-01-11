const start = {
    start_setting: async function () {
        $('.head-of-menu').html('OP Review')
        $('.bcpage > .breadcrumb-item > a').html('OP Review Check')
    },

    data_start: async function (e) {
        let res_data = '';
        if (e != undefined) {
            res_data = e
        } else {
            res_data = await this.ajax_setting_data_table()
        }
        $('.table thead').html('');

        let html_head = `
        <tr class="text-center">
            <th class="sticky-top">Check</th>
            <th class="sticky-top">Reverse</th>
            <th class="sticky-top">No</th>
            <th class="sticky-top">Job Number</th>
            <th class="sticky-top">Bill to</th>
            <th class="sticky-top">Description</th>
            <th class="sticky-top">Cur.</th>
            <th class="sticky-top">Qty</th>
            <th class="sticky-top">unit price</th>
            <th class="sticky-top">Vat%</th>
            <th class="sticky-top">W/H</th>
            <th class="sticky-top">Total</th>
            <th class="sticky-top">Create By</th>
            <th class="sticky-top">Create Datetime</th>
            <th class="sticky-top">Apply By</th>
            <th class="sticky-top">Apply Datetime</th>
            <th class="sticky-top">Check by</th>
            <th class="sticky-top">Check Datetime</th>
            
        </tr>
        `;

        $('.table thead').html(html_head)

        $('.table tbody').html('')


        // สร้างออบเจ็กต์เพื่อเก็บข้อมูลที่เหมือนกัน
        var groupedData = {};

        // วนลูปข้อมูลใน array
        $.each(res_data['table'], function (index, item) {
            // ตรวจสอบว่ากลุ่มนี้มีอยู่แล้วหรือไม่
            var key = item.job_number + '-' + item.bill_to_c;
            if (!groupedData[key]) {
                // ถ้าไม่มี สร้าง array ใหม่สำหรับกลุ่มนี้
                groupedData[key] = [];
            }
            // เพิ่มข้อมูลลงในกลุ่มที่เหมือนกัน
            groupedData[key].push(item.ID);

        });
        // console.log(groupedData)
        let data_count_show = 0;
        if (res_data['table'] != "0 results") {
            $.each(groupedData, function (im, vm) {
                data_count_show++;
                if (vm.length > 1) {
                    let data_job_number_main = '';
                    let data_bill_to_main = '';
                    let obj_billing_description = []
                    let data_vm = vm.join('_')
                    let data_head_html = `
                    
                    <tr class="main_table${data_vm}" style="background-color:#E4E4E4" >
                        <td class="sticky-left text-center" style="background-color:#E4E4E4"><input type="checkbox" class="data_check" onchange="start.cal_currency()" style="zoom:200%"></td>
                        <td class="sticky-left text-center" style="background-color:#E4E4E4"><button class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse${data_vm}" aria-expanded="false" aria-controls="collapse${data_vm}">List</button></td>
                        <td class="sticky-left text-center" style="background-color:#E4E4E4">${data_count_show}</td>
                        <td class="sticky-left" style="background-color:#E4E4E4"><input type="text" class="form-control form-control-sm text-start inp_job_number_main" disabled></td>
                        <td class="sticky-left" style="background-color:#E4E4E4"><input type="text" class="form-control form-control-sm text-start inp_bill_to_main" disabled></td>
                        <td class="sticky-left" style="background-color:#E4E4E4"><input type="text" class="form-control form-control-sm text-start inp_description_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-center inp_cur_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-end inp_qty_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-end inp_unit_price_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-center inp_vat_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-center inp_wh_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-end inp_total_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_create_b_mainy" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_apply_by_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_check_by_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime_main" disabled></td>
                    </tr>
                    
                    `;
                    $(`.table > tbody`).append(data_head_html)
                    $.each(vm, function (imm, vmm) {
                        $.each(res_data['table'], function (i, v) {
                            let id_number = v['ID'] ? v['ID'] : '';
                            if (vmm == id_number) {
                                let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                                let job_number = v['job_number'] ? v['job_number'] : '';
                                let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
                                let currency = v['currency'] ? v['currency'] : '';
                                let qty = v['qty'] ? v['qty'] : '';
                                let unit_price = v['unit_price'] ? v['unit_price'] : '';
                                let vat = v['vat'] ? v['vat'] : '';
                                let amtinclvat = v['amtinclvat'] ? v['amtinclvat'] : '';
                                let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '0';
                                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                                let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                                let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                                let create_by_f = v['create_by_f'] ? v['create_by_f'] : '';
                                let create_by_l = v['create_by_l'] ? v['create_by_l'] : '';
                                let check_by_f = v['check_by_f'] ? v['check_by_f'] : '';
                                let check_by_l = v['check_by_l'] ? v['check_by_l'] : '';
                                let action_paid_by_f = v['action_paid_by_f'] ? v['action_paid_by_f'] : '';
                                let action_paid_by_l = v['action_paid_by_l'] ? v['action_paid_by_l'] : '';

                                data_job_number_main = job_number
                                data_bill_to_main = bill_to_c
                                let billing_description = v['billing_description'] ? v['billing_description'] : '';
                                obj_billing_description.push(billing_description)
                                
                                data_html = `
                                <tr id_number="${id_number}" id="collapse${data_vm}" class="table_number_${data_count_show+i} collapse collapse_data_${data_vm}" style="background-color:#B5CAFF">
                                    <td class="sticky-left text-center" style="background-color:#B5CAFF"><input type="checkbox" class="data_check" onchange="start.cal_currency()" disabled style="zoom:200%"></td>
                                    <td class="sticky-left text-center" style="background-color:#B5CAFF"><button class="btn btn-sm btn-warning btn_sent_job" onclick="start.sent_to_job_detail(${ref_job_id},${id_number})">reverse</button></td>
                                    <td class="sticky-left text-center" style="background-color:#B5CAFF">${data_count_show}</td>
                                    <td class="sticky-left" style="background-color:#B5CAFF"><input type="text" class="form-control form-control-sm text-start inp_job_number" disabled></td>
                                    <td class="sticky-left" style="background-color:#B5CAFF"><input type="text" class="form-control form-control-sm text-start inp_bill_to" disabled></td>
                                    <td class="sticky-left" style="background-color:#B5CAFF"><input type="text" class="form-control form-control-sm text-start inp_description" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_cur" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-end inp_qty" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-end inp_unit_price" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_vat" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_wh" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-end inp_total" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_create_by" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_apply_by" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_check_by" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime" disabled></td>
                        
                                </tr>
                                `;
                                $(`.table > tbody`).append(data_html)
                                $(`.table_number_${data_count_show+i} > td > .inp_job_number`).val(job_number)
                                $(`.table_number_${data_count_show+i} > td > .inp_bill_to`).val(bill_to_c)
                                $(`.table_number_${data_count_show+i} > td > .inp_description`).val(billing_description)
                                $(`.table_number_${data_count_show+i} > td > .inp_cur`).val(currency)
                                $(`.table_number_${data_count_show+i} > td > .inp_qty`).val(qty)
                                $(`.table_number_${data_count_show+i} > td > .inp_unit_price`).val(unit_price)
                                $(`.table_number_${data_count_show+i} > td > .inp_vat`).val(vat)
                                $(`.table_number_${data_count_show+i} > td > .inp_wh`).val(with_holding_tax)
                                $(`.table_number_${data_count_show+i} > td > .inp_total`).val(amtinclvat)
                                $(`.table_number_${data_count_show+i} > td > .inp_create_by`).val(create_by_f+" "+create_by_l)
                                $(`.table_number_${data_count_show+i} > td > .inp_create_datetime`).val(create_data_time)
                                $(`.table_number_${data_count_show+i} > td > .inp_apply_by`).val(action_paid_by_f+" "+action_paid_by_l)
                                $(`.table_number_${data_count_show+i} > td > .inp_apply_datetime`).val(action_paid_date_time)
                                $(`.table_number_${data_count_show+i} > td > .inp_check_by`).val(check_by_f+" "+check_by_l)
                                $(`.table_number_${data_count_show+i} > td > .inp_check_datetime`).val(check_date_time)


                            }
                        })
                        
                    })
                    let data_join_billing_description = obj_billing_description.join(',');
                    $(`.main_table${data_vm} > td > .inp_job_number_main`).val(data_job_number_main)
                    $(`.main_table${data_vm} > td > .inp_bill_to_main`).val(data_bill_to_main)
                    $(`.main_table${data_vm} > td > .inp_description_main`).val(obj_billing_description)

                } else {
                    $.each(res_data['table'],function(i,v){
                        let id_number = v['ID'] ? v['ID'] : '';
                        if(vm[0] == id_number){
                            let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                            let job_number = v['job_number'] ? v['job_number'] : '';
                            let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
                            let billing_description = v['billing_description'] ? v['billing_description'] : '';
                            let currency = v['currency'] ? v['currency'] : '';
                            let qty = v['qty'] ? v['qty'] : '';
                            let unit_price = v['unit_price'] ? v['unit_price'] : '';
                            let vat = v['vat'] ? v['vat'] : '';
                            let amtinclvat = v['amtinclvat'] ? v['amtinclvat'] : '';
                            let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '0';
                            let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                            let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                            let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                            let create_by_f = v['create_by_f'] ? v['create_by_f'] : '';
                            let create_by_l = v['create_by_l'] ? v['create_by_l'] : '';
                            let check_by_f = v['check_by_f'] ? v['check_by_f'] : '';
                            let check_by_l = v['check_by_l'] ? v['check_by_l'] : '';
                            let action_paid_by_f = v['action_paid_by_f'] ? v['action_paid_by_f'] : '';
                            let action_paid_by_l = v['action_paid_by_l'] ? v['action_paid_by_l'] : '';
                            data_html = `
                                <tr id_number="${id_number}" class="id_number_row_${id_number} table_number_${data_count_show}" >
                                    <td class="sticky-left text-center"><input type="checkbox" class="data_check" onchange="start.cal_currency()" style="zoom:200%"></td>
                                    <td class="sticky-left text-center"><button class="btn btn-sm btn-warning btn_sent_job" onclick="start.sent_to_job_detail(${ref_job_id},${id_number})">reverse</button></td>
                                    <td class="sticky-left text-center">${data_count_show}</td>
                                    <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_job_number" disabled></td>
                                    <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_bill_to" disabled></td>
                                    <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_description" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_cur" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-end inp_qty" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-end inp_unit_price" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_vat" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_wh" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-end inp_total" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_create_by" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_apply_by" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_check_by" disabled></td>
                                    <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime" disabled></td>
                        
                                </tr>
                                `;
                                $(`.table > tbody`).append(data_html)

                                $(`.id_number_row_${id_number} > td > .inp_job_number`).val(job_number)
                                $(`.id_number_row_${id_number} > td > .inp_bill_to`).val(bill_to_c)
                                $(`.id_number_row_${id_number} > td > .inp_description`).val(billing_description)
                                $(`.id_number_row_${id_number} > td > .inp_cur`).val(currency)
                                $(`.id_number_row_${id_number} > td > .inp_qty`).val(qty)
                                $(`.id_number_row_${id_number} > td > .inp_unit_price`).val(unit_price)
                                $(`.id_number_row_${id_number} > td > .inp_vat`).val(vat)
                                $(`.id_number_row_${id_number} > td > .inp_wh`).val(with_holding_tax)
                                $(`.id_number_row_${id_number} > td > .inp_total`).val(amtinclvat)
                                $(`.id_number_row_${id_number} > td > .inp_create_by`).val(create_by_f+" "+create_by_l)
                                $(`.id_number_row_${id_number} > td > .inp_create_datetime`).val(create_data_time)
                                $(`.id_number_row_${id_number} > td > .inp_apply_by`).val(action_paid_by_f+" "+action_paid_by_l)
                                $(`.id_number_row_${id_number} > td > .inp_apply_datetime`).val(action_paid_date_time)
                                $(`.id_number_row_${id_number} > td > .inp_check_by`).val(check_by_f+" "+check_by_l)
                                $(`.id_number_row_${id_number} > td > .inp_check_datetime`).val(check_date_time)
                        }
                    })
                    // console.log(vm[0])
                }

            })
        }

        // data_html = `
        // <tr id_number="${id_number}" class="table_number_${i}" style="background-color:#fab">
        //     <td class="sticky-left text-center"><input type="checkbox" class="data_check" onchange="start.cal_currency()" style="zoom:200%"></td>
        //     <td class="sticky-left text-center"><button class="btn btn-sm btn-warning btn_sent_job" onclick="start.sent_to_job_detail(${ref_job_id},${id_number})">reverse</button></td>
        //     <td class="sticky-left text-center">${i}</td>
        //     <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_job_number" disabled></td>
        //     <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_bill_to" disabled></td>
        //     <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_description" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-center inp_cur" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-end inp_qty" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-end inp_unit_price" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-center inp_vat" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-center inp_wh" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-end inp_total" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_create_by" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_apply_by" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_check_by" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime" disabled></td>

        // </tr>
        // `;

        // if (res_data['table'] != "0 results") {
        //     $.each(res_data['table'], function (i, v) {
        //         i++;
        //         let id_number = v['ID'] ? v['ID'] : '';
        //         let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
        //         let job_number = v['job_number'] ? v['job_number'] : '';

        //         let billing_description = v['billing_description'] ? v['billing_description'] : '';
        //         let billing_des_id = v['billing_des_id'] ? v['billing_des_id'] : '';
        //         let bill_to_type = v['bill_to_type'] ? v['bill_to_type'] : '';
        //         let bill_to = v['bill_to'] ? v['bill_to'] : '';
        //         let payble = v['payble'] ? v['payble'] : '';

        //         let currency = v['currency'] ? v['currency'] : '';
        //         let qty = v['qty'] ? v['qty'] : '';
        //         let unit_price = v['unit_price'] ? v['unit_price'] : '';
        //         let amount = v['amount'] ? v['amount'] : '';
        //         let vat = v['vat'] ? v['vat'] : '';
        //         let amtinclvat = v['amtinclvat'] ? v['amtinclvat'] : '';
        //         let remark = v['remark'] ? v['remark'] : '';
        //         let type = v['type'] ? v['type'] : '';
        //         let create_by = v['create_by'] ? v['create_by'] : '';
        //         let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
        //         let check_by = v['check_by'] ? v['check_by'] : '';
        //         let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
        //         let action_paid_by = v['action_paid_by'] ? v['action_paid_by'] : '';
        //         let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
        //         let approve_by = v['approve_by'] ? v['approve_by'] : '';
        //         let approve_date_time = v['approve_date_time'] ? v['approve_date_time'] : '';
        //         let delete_date_time = v['delete_date_time'] ? v['delete_date_time'] : '';
        //         let delete_by = v['delete_by'] ? v['delete_by'] : '';
        //         let status_data = v['status'] ? v['status'] : '';
        //         let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
        //         let add_on = v['add_on'] ? v['add_on'] : '';
        //         let last_update_by = v['last_update_by'] ? v['last_update_by'] : '';
        //         let last_update_datetime = v['last_update_datetime'] ? v['last_update_datetime'] : '';
        //         let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
        //         let Billing_date = v['Billing_date'] ? v['Billing_date'] : '';
        //         let sys_rate_currency = v['sys_rate_currency'] ? v['sys_rate_currency'] : '';
        //         let tax_with_hold_by = v['tax_with_hold_by'] ? v['tax_with_hold_by'] : '';
        //         let commit_sale = v['commit_sale'] ? v['commit_sale'] : '';
        //         let tax_with_hold_date_time = v['tax_with_hold_date_time'] ? v['tax_with_hold_date_time'] : '';
        //         let currency_main = v['currency_main'] ? v['currency_main'] : '';
        //         let need_vat = v['need_vat'] ? v['need_vat'] : '';
        //         let refer = v['refer'] ? v['refer'] : '';
        //         let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '0';
        //         let paid_amt = v['paid_amt'] ? v['paid_amt'] : '';
        //         let pre_approve_by = v['pre_approve_by'] ? v['pre_approve_by'] : '';
        //         let pre_approve_dt = v['pre_approve_dt'] ? v['pre_approve_dt'] : '';
        //         let pre_approve_statu = v['pre_approve_statu'] ? v['pre_approve_statu'] : '';

        //         let create_by_f = v['create_by_f'] ? v['create_by_f'] : '';
        //         let create_by_l = v['create_by_l'] ? v['create_by_l'] : '';
        //         let check_by_f = v['check_by_f'] ? v['check_by_f'] : '';
        //         let check_by_l = v['check_by_l'] ? v['check_by_l'] : '';
        //         let action_paid_by_f = v['action_paid_by_f'] ? v['action_paid_by_f'] : '';
        //         let action_paid_by_l = v['action_paid_by_l'] ? v['action_paid_by_l'] : '';

        //         amtinclvat = parseFloat(amtinclvat)
        //         amtinclvat = amtinclvat.toFixed(2)
        //         let data_html = ``;

        // data_html = `
        // <tr id_number="${id_number}" class="table_number_${i}">
        //     <td class="sticky-left text-center"><input type="checkbox" class="data_check" onchange="start.cal_currency()" style="zoom:200%"></td>
        //     <td class="sticky-left text-center"><button class="btn btn-sm btn-warning btn_sent_job" onclick="start.sent_to_job_detail(${ref_job_id},${id_number})">reverse</button></td>
        //     <td class="sticky-left text-center">${i}</td>
        //     <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_job_number" disabled></td>
        //     <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_bill_to" disabled></td>
        //     <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_description" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-center inp_cur" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-end inp_qty" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-end inp_unit_price" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-center inp_vat" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-center inp_wh" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-end inp_total" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_create_by" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_apply_by" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_check_by" disabled></td>
        //     <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime" disabled></td>

        // </tr>
        // `;


        //         $(`.table > tbody`).append(data_html)

        //         $(`.table > tbody > .table_number_${i} > td > .inp_job_number`).val(job_number).attr('job_number_data', `${job_number}`)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_bill_to`).val(bill_to_c).attr({ 'bill_to_type': `${bill_to_type}`, 'bill_to': `${bill_to}` })
        //         $(`.table > tbody > .table_number_${i} > td > .inp_description`).val(billing_description).attr({ 'billing_des_id': `${billing_des_id}` })
        //         $(`.table > tbody > .table_number_${i} > td > .inp_cur`).val(currency)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_qty`).val(qty)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_unit_price`).val(unit_price)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_vat`).val(vat)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_wh`).val(with_holding_tax)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_total`).val(amtinclvat)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_create_by`).val(create_by_f + " " + create_by_l)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_create_datetime`).val(create_data_time)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_check_by`).val(check_by_f + " " + check_by_l)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_check_datetime`).val(check_date_time)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_apply_by`).val(action_paid_by_f + " " + action_paid_by_l)
        //         $(`.table > tbody > .table_number_${i} > td > .inp_apply_datetime`).val(action_paid_date_time)
        //         if (check_by != '') {
        //             $(`.table > tbody > .table_number_${i} > td > .data_check`).prop('checked', true).attr('disabled', true)
        //         }

        //         console.log(approve_by)
        //         if(approve_by != ''){
        //             $(`.table > tbody > .table_number_${i} > td > .btn_sent_job`).remove()
        //         }
        //     })




        // }

        await this.cal_currency();
    },

    sent_to_job_detail: async function (data, id_number) {
        window.location = "job_detail.php" + "?job_number=" + data + "&action=invoice_mode&mode_check=check&id_number=" + id_number;
    },

    select_filter: async function () {



        // let data_radio_process = $('input[name="radio_process"]:checked').val();
        // let data_radio_select_type = $('input[name="radio_function_select"]:checked').val();
        // let data_radio_act = $('input[name="radio_select_act"]:checked').val();

        let data_data_id = '';
        let data_data_type = '';
        let data_name_type = '';

        let job_number = $('.inp_job_number').val() ? $('.inp_job_number').val() : '';
        let data_applied_person = $('.inp_applied_person').val()
        data_applied_person = $(`.data_list_applied_person option[item_search="${data_applied_person}"]`).attr('id_search')
        data_applied_person = data_applied_person ? data_applied_person : '';

        let data_date_applied = $('.inp_date_applied').val()
        let radio_p = $('input[name="radio_p"]:checked').val();



        let billing_code = $('.inp_billing_code').val() ? $('.inp_billing_code').val() : '';
        // console.log(billing_code)
        // billing_code = $(`.data_list_billing_list option[billing_item_name="${billing_code}"]`).attr('number_des')
        // billing_code = billing_code ? billing_code : '';

        $.each($('.data_sic > div > button'), function () {
            let data_hasclass = $(this).hasClass('active_side')
            if (data_hasclass == true) {
                data_data_id = $(this).attr('data_id')
                data_data_type = $(this).attr('data_type')
                data_name_type = $(this).attr('name_type')
            }

        })


        let res_data = await this.ajax_setting_data_table(data_data_id, data_data_type, data_name_type, job_number, billing_code, data_applied_person, data_date_applied, radio_p)

        await this.data_start(res_data)

    },

    ajax_setting_data_table: async function (data_data_id, data_data_type, data_name_type, job_number, billing_code, data_applied_person, data_date_applied, radio_p) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_approve/get_data_table.php",
                data: {
                    data_data_id: data_data_id,
                    data_data_type: data_data_type,
                    data_name_type: data_name_type,
                    job_number: job_number,
                    billing_code: billing_code,
                    data_applied_person: data_applied_person,
                    data_date_applied: data_date_applied,
                    radio_p: radio_p
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    start_default: async function () {
        let res_data_default = await this.ajax_default_data();
        let data_default = '';
        $.each(res_data_default['default'], function (i, v) {
            let name_type = v['name_type'] ? v['name_type'] : '';
            let TYPE = v['TYPE'] ? v['TYPE'] : '';
            let ID = v['ID'] ? v['ID'] : '';
            let NAME = v['NAME'] ? v['NAME'] : '';
            data_default += `
            <div class="form-group">
                <button class="btn btn-sm" data_id="${ID}" data_type="${TYPE}" name_type="${NAME}" onclick="start.mark_active(this)"><i class="bi bi-folder text-warning" style="zoom:135%"></i> ${NAME}</button>
            </div>
            `;
        })

        $('.data_sic').append(data_default)


        let html_data_job = '';
        let html_data_des = '';
        let html_data_search = '';
        $.each(res_data_default['job_number'], function (i, v) {
            html_data_job += `<option realdata="${v['job_number']}">${v['job_number']}</option>`;
        })
        $.each(res_data_default['description'], function (i, v) {
            html_data_des += `<option number_des="${v['ID']}" billing_item_name="${v['billing_code']}">${v['billing_code']}</option>`;
        })
        $.each(res_data_default['user_search'], function (i, v) {
            html_data_search += `<option item_search="${v['first_name'] + ' ' + v['last_name']}" id_search="${v['ID']}">${v['first_name'] + ' ' + v['last_name']}</option>`
        })

        $('.data_list_job_number').append(html_data_job)
        $('.data_list_billing_list').append(html_data_des)
        $('.data_list_applied_person').append(html_data_search)
    },

    mark_active: async function (e) {

        $('.active_side').removeClass('active_side');
        $(e).addClass("active_side")
        await this.select_filter()
    },

    ajax_default_data: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_approve/get_data_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    cal_currency: async function () {

        let data_radio_select_type = $('input[name="radio_select_act"]:checked').val();
        // console.log(data_radio_select_type)



        let e_path = $('.table > tbody > tr');


        let data_currency_usd = 0;
        let data_currency_thb = 0;
        let data_currency_rmb = 0;
        let data_currency_yen = 0;
        let data_currency_hkd = 0;

        let data_currency_usd_review = 0;
        let data_currency_thb_review = 0;
        let data_currency_rmb_review = 0;
        let data_currency_yen_review = 0;
        let data_currency_hkd_review = 0;

        $.each(e_path, function () {
            let inp_cur = $(this).find('.inp_cur').val()
            let inp_unit_price = $(this).find('.inp_total').val()
            inp_unit_price = parseFloat(inp_unit_price)

            if (inp_cur == "USD") {
                data_currency_usd = data_currency_usd + inp_unit_price;
            } else if (inp_cur == "THB") {
                data_currency_thb = data_currency_thb + inp_unit_price;
            } else if (inp_cur == "RMB") {
                data_currency_rmb = data_currency_rmb + inp_unit_price;
            } else if (inp_cur == "YEN") {
                data_currency_yen = data_currency_yen + inp_unit_price;
            } else if (inp_cur == "HKD") {
                data_currency_hkd = data_currency_hkd + inp_unit_price;
            }
        })

        $.each(e_path, function () {
            let inp_cur = $(this).find('.inp_cur').val()
            let inp_unit_price = $(this).find('.inp_total').val()
            let data_check = '';


            data_check = $(this).find('.data_check').prop("checked") ? '1' : '0';


            inp_unit_price = parseFloat(inp_unit_price)

            if (data_check == '1') {
                if (inp_cur == "USD") {
                    data_currency_usd_review = data_currency_usd_review + inp_unit_price;
                } else if (inp_cur == "THB") {
                    data_currency_thb_review = data_currency_thb_review + inp_unit_price;
                } else if (inp_cur == "RMB") {
                    data_currency_rmb_review = data_currency_rmb_review + inp_unit_price;
                } else if (inp_cur == "YEN") {
                    data_currency_yen_review = data_currency_yen_review + inp_unit_price;
                } else if (inp_cur == "HKD") {
                    data_currency_hkd_review = data_currency_hkd_review + inp_unit_price;
                }
            }

        })
        data_currency_usd = data_currency_usd.toFixed(2)
        data_currency_thb = data_currency_thb.toFixed(2)
        data_currency_rmb = data_currency_rmb.toFixed(2)
        data_currency_yen = data_currency_yen.toFixed(2)
        data_currency_hkd = data_currency_hkd.toFixed(2)

        $('.data_currency_usd').html(data_currency_usd)
        $('.data_currency_thb').html(data_currency_thb)
        $('.data_currency_rmb').html(data_currency_rmb)
        $('.data_currency_yen').html(data_currency_yen)
        $('.data_currency_hkd').html(data_currency_hkd)

        data_currency_usd_review = data_currency_usd_review.toFixed(2)
        data_currency_thb_review = data_currency_thb_review.toFixed(2)
        data_currency_rmb_review = data_currency_rmb_review.toFixed(2)
        data_currency_yen_review = data_currency_yen_review.toFixed(2)
        data_currency_hkd_review = data_currency_hkd_review.toFixed(2)


        $('.data_currency_review_usd').html(data_currency_usd_review)
        $('.data_currency_review_thb').html(data_currency_thb_review)
        $('.data_currency_review_rmb').html(data_currency_rmb_review)
        $('.data_currency_review_yen').html(data_currency_yen_review)
        $('.data_currency_review_hkd').html(data_currency_hkd_review)
    },

    select_all: async function (e) {
        let e_path = $('.table > tbody > tr')
        $.each(e_path, function () {
            let data_dis = $(this).find('.data_check').attr('disabled') ? '1' : '0';
            if (data_dis == '0') {
                if (e == "select") {
                    $(this).find('.data_check').attr('checked', true)
                } else {
                    $(this).find('.data_check').attr('checked', false)

                }
            }
        })
    },

}