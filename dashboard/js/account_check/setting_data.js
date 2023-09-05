const setting_data = {
    data_in_table:[],

    setting_first_title: async function () {
        $('#status_rd_1').attr('checked', true)
        $('#type_rd_1').attr('checked', true)
    },


    

    setting_data_first: async function () {
        let data_load_job_number = $('.inp_job_number').val()
        let data_load_mbl = $('.inp_mbl').val()
        let data_load_container = $('.inp_container').val()
        let rd_st = $('input[name="status_rd"]:checked').val();
        let rd_ty = $('input[name="type_rd"]:checked').val();

        rd_st = rd_st ? rd_st : '';
        rd_ty = rd_ty ? rd_ty : '';
        
        $('.table_data tbody').html('');
        $('.job_number_data_list').html('');
        $('.container_data_list').html('');
        $('.mbl_data_list').html('');
        $('.request_data_list').html('');
        let res_data = await this.ajax_setting_data_first(data_load_job_number,data_load_mbl,data_load_container,rd_st,rd_ty);
        console.log(res_data)

        let data_job_number = '';
        $.each(res_data['data_job_number'],function (i,v){
            data_job_number += `<option value="${v['job_number']}">`;
        })
        $('.job_number_data_list').append(data_job_number);

        let data_mbl = '';
        $.each(res_data['data_mbl'],function(i,v){
            data_mbl += `<option value="${v['mbl']}">`;
        })
        $('.mbl_data_list').append(data_mbl)

        let data_container = '';
        $.each(res_data['data_container'],function(i,v){
            data_container +=`<option value="${v['container_number']}">`;
        })
        $('.container_data_list').append(data_container)
        
        let data_request = '';
        $.each(res_data['data_user'],function(i,v){
            data_request += `<option value="${v['ID']}">${v['first_name']} ${v['last_name']}</option>` 
        })
        $('.request_data_list').append(`<option value="">ALL</option>`)
        $('.request_data_list').append(data_request)
        
        
        this.data_in_table = res_data['data_list'];
    

        $.each(res_data['data_list'], function (i, v) {
            let html_data_paste = '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
            let billing_item_name = v['billing_item_name'] ? v['billing_item_name'] : '';
            let currency = v['currency'] ? v['currency'] : '';
            let qty = v['qty'] ? v['qty'] : '';
            let unit_price = v['unit_price'] ? v['unit_price'] : '';
            let vat = v['vat'] ? v['vat'] : '';
            let remark = v['remark'] ? v['vat'] : '';
            let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
            let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
            let create_by = v['create_f'] ? v['create_f'] + ' ' + v['create_l'] : '';
            let paid_by = v['paid_f'] ? v['paid_f']+' '+v['paid_l'] : '';
            let id_number = v['ID'] ? v['ID'] : '';
            let sale_support = v['sale_support'] ? v['sale_support'] : '';
            let status_data = v['status'] ? v['status'] : '';


            let amt = parseFloat(qty) * parseFloat(unit_price);

            let amt_incv = ((amt * vat) / 100) + amt;

            i++;




            qty = parseFloat(qty).toFixed(2)
            unit_price = parseFloat(unit_price).toFixed(2)
            amt = parseFloat(amt).toFixed(2)
            amt_incv = parseFloat(amt_incv).toFixed(2)

            html_data_paste = `
        <tr class="text-center" data_row="${id_number}">
            <td class="sticky-left">${i}</td>
            <td class="sticky-left"><input type="text" class="form-control form-control-sm rounded" value="${job_number}" disabled></td>
            <td class="sticky-left"><input type="text" class="form-control form-control-sm rounded" value="${bill_to_c}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded" value="${billing_item_name}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded inp_currency text-center" value="${currency}" disabled disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded text-end" value="${qty}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded text-end" value="${unit_price}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded text-end" value="${amt}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded text-center" value="${vat}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded inp_amt_incv text-end" value="${amt_incv}" disabled></td>
            <td>
                <input type="radio" class="form-check-input" onclick="function_account_check.status_change(this)" name="status_row_rd${id_number}" status_data="0" id_find="radio_status_id_${id_number}" id="radio_status_id_${id_number}_0" checked>
                <label for="radio1" class="form-check-label pl-2">Waiting</label>
                <input type="radio" class="form-check-input" onclick="function_account_check.status_change(this)" name="status_row_rd${id_number}" status_data="1" id_find="radio_status_id_${id_number}" id="radio_status_id_${id_number}_1">
                <label for="radio2" class="form-check-label pl-2">Approve</label>
                <input type="radio" class="form-check-input" onclick="function_account_check.status_change(this)" name="status_row_rd${id_number}" status_data="2" id_find="radio_status_id_${id_number}" id="radio_status_id_${id_number}_2">
                <label for="radio3" class="form-check-label pl-2">Reject</label>
            </td>
            <td><input type="number" class="form-control form-control-sm rounded inp_paid_amt inp_paid_amt${i} text-end" value=""></td>
            <td><input type="text" class="form-control form-control-sm rounded" value="${remark}"></td>
            <td><input type="text" class="form-control form-control-sm rounded" value="${create_data_time}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded" value="${create_by}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded" value="${sale_support}" disabled></td>
            <td><input type="text" class="form-control form-control-sm rounded" value="${paid_by}" disabled></td>
        </tr>`;

            $('.table_data tbody').append(html_data_paste)

            if (status_data == '') {
                $(`#radio_status_id_${id_number}_0`).prop('checked', true)
            }else if(status_data == '1'){
                $(`#radio_status_id_${id_number}_1`).prop('checked', true)
                $(`.inp_paid_amt${i}`).attr('disabled',true)

                $(`#radio_status_id_${id_number}_0`).prop('disabled', true)
                $(`#radio_status_id_${id_number}_1`).prop('disabled', true)
                $(`#radio_status_id_${id_number}_2`).prop('disabled', true)



            }else if(status_data == '2'){
                $(`#radio_status_id_${id_number}_2`).prop('checked', true)
                
                $(`#radio_status_id_${id_number}_0`).prop('disabled', true)
                $(`#radio_status_id_${id_number}_1`).prop('disabled', true)
                $(`#radio_status_id_${id_number}_2`).prop('disabled', true)
            }

        })
    },

    ajax_setting_data_first: async function (data_load_job_number,data_load_mbl,data_load_container,rd_st,rd_ty) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check/setting_data_first.php",
                data : {
                    data_load_job_number : data_load_job_number,
                    data_load_mbl : data_load_mbl,
                    data_load_container : data_load_container,
                    rd_st : rd_st,
                    rd_ty : rd_ty
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}