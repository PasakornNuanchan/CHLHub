const currency_rate = {
    get_data_res: '',
    first_page: async function () {
        $('.head-of-menu').html('Currency Rate');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="currency_rate.php" target="" style="color:white;">Currency rate</a></li>
        `;
        $('.bcpage').append(html_bdpage);

        let res_data = await this.ajax_request_data_first();
        console.log(res_data['require'])

        this.get_data_res = res_data
        $('.table_rate tbody').html('');
        let html_data_table = '';
        if (res_data['require'] != "0 results") {
            $.each(res_data['require'], function (i, v) {
                let request_by = v['first_name'] ? v['first_name'] + " " + v['last_name'] : '';
                let create_datetime = v['create_datetime'] ? v['create_datetime'] : '';
                let start_date = v['start_date'] ? v['start_date'] : '';
                let end_date = v['end_date'] ? v['end_date'] : '';

                let usd_thb = v['usd_thb'] ? v['usd_thb'] : '';
                let usd_rmb = v['usd_rmb'] ? v['usd_rmb'] : '';
                let usd_yen = v['usd_yen'] ? v['usd_yen'] : '';
                let thb_usd = v['thb_usd'] ? v['thb_usd'] : '';
                let thb_rmb = v['thb_rmb'] ? v['thb_rmb'] : '';
                let thb_yen = v['thb_yen'] ? v['thb_yen'] : '';
                let rmb_usd = v['rmb_usd'] ? v['rmb_usd'] : '';
                let rmb_thb = v['rmb_thb'] ? v['rmb_thb'] : '';
                let rmb_yen = v['rmb_yen'] ? v['rmb_yen'] : '';
                let yen_usd = v['yen_usd'] ? v['yen_usd'] : '';
                let yen_thb = v['yen_thb'] ? v['yen_thb'] : '';
                let yen_rmb = v['yen_rmb'] ? v['yen_rmb'] : '';
                let ID = v['ID'] ? v['ID'] : '';

                
                html_data_table = `
                <tr id_data= "${ID}">
                    <td><input type="text" class=" form-control form-control-sm rounded inp_date_time_table"value="${create_datetime}" readonly></td>
                    <td><input type="date" class=" form-control form-control-sm rounded inp_start_date_table"value="${start_date}" readonly></td>
                    <td><input type="date" class=" form-control form-control-sm rounded inp_end_date_table"value="${end_date}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_usd_thb" value="${usd_thb}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_usd_rmb" value="${usd_rmb}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_usd_yen" value="${usd_yen}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_thb_usd" value="${thb_usd}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_thb_rmb" value="${thb_rmb}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_thb_yen" value="${thb_yen}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_rmb_usd" value="${rmb_usd}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_rmb_thb" value="${rmb_thb}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_rmb_yen" value="${rmb_yen}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_yen_usd" value="${yen_usd}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_yen_thb" value="${yen_thb}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded text-end inp_data_yen_rmb" value="${yen_rmb}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded inp_request_table " value="${request_by}" readonly></td>
                    <td><input type="nubmer" class=" form-control form-control-sm rounded inp_create_table "value="${create_datetime}" readonly></td>
                    <td>
                    <button class="btn btn-sm btn-warning btn_edit btn_edit${i}" onclick="currency_rate.edit_currency(this)" hidden>edit</button>
                    <button class="btn btn-sm btn-success btn_save_data_edit btn_save_data_edit${i}" onclick="currency_rate.save_currency_edit(this)" hidden>save</button></td>
                </tr>
                `;
                $('.table_rate tbody').append(html_data_table)
            })
        }

        $('.btn_edit0').attr('hidden',false)

        let data_date = res_data['require'][0]['end_date'];
        let parsedDate = new Date(data_date); 
        parsedDate.setDate(parsedDate.getDate() + 1);
        $('.inp_start_date').val(parsedDate.toISOString().slice(0, 10));


    },

    ajax_request_data_first: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/currency_rate/get_currency_rate.php",
                data: {

                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    get_load_currency: async function () {
        let usd_thb = this.get_data_res['require'][0]['usd_thb'];
        let usd_rmb = this.get_data_res['require'][0]['usd_rmb'];
        let usd_yen = this.get_data_res['require'][0]['usd_yen'];
        let thb_usd = this.get_data_res['require'][0]['thb_usd'];
        let thb_rmb = this.get_data_res['require'][0]['thb_rmb'];
        let thb_yen = this.get_data_res['require'][0]['thb_yen'];
        let rmb_usd = this.get_data_res['require'][0]['rmb_usd'];
        let rmb_thb = this.get_data_res['require'][0]['rmb_thb'];
        let rmb_yen = this.get_data_res['require'][0]['rmb_yen'];
        let yen_usd = this.get_data_res['require'][0]['yen_usd'];
        let yen_thb = this.get_data_res['require'][0]['yen_thb'];
        let yen_rmb = this.get_data_res['require'][0]['yen_rmb'];



        $('.inp_usd_thb').val(usd_thb)
        $('.inp_usd_rmb').val(usd_rmb)
        $('.inp_usd_yen').val(usd_yen)
        $('.inp_thb_usd').val(thb_usd)
        $('.inp_thb_rmb').val(thb_rmb)
        $('.inp_thb_yen').val(thb_yen)
        $('.inp_rmb_usd').val(rmb_usd)
        $('.inp_rmb_thb').val(rmb_thb)
        $('.inp_rmb_yen').val(rmb_yen)
        $('.inp_yen_usd').val(yen_usd)
        $('.inp_yen_thb').val(yen_thb)
        $('.inp_yen_rmb').val(yen_rmb)

    },


    get_to_save: async function () {

        let usd_thb = $('.inp_usd_thb').val()
        let usd_rmb = $('.inp_usd_rmb').val()
        let usd_yen = $('.inp_usd_yen').val()
        let thb_usd = $('.inp_thb_usd').val()
        let thb_rmb = $('.inp_thb_rmb').val()
        let thb_yen = $('.inp_thb_yen').val()
        let rmb_usd = $('.inp_rmb_usd').val()
        let rmb_thb = $('.inp_rmb_thb').val()
        let rmb_yen = $('.inp_rmb_yen').val()
        let yen_usd = $('.inp_yen_usd').val()
        let yen_thb = $('.inp_yen_thb').val()
        let yen_rmb = $('.inp_yen_rmb').val()
        let start_date = $('.inp_start_date').val()
        let end_date = $('.inp_end_date').val()

        let arr_data = [];
        if (usd_thb != '' && usd_rmb != '' && usd_yen != '' && thb_usd != '' && thb_rmb != '' && thb_yen != '' &&
            rmb_usd != '' && rmb_thb != '' && rmb_yen != '' && yen_usd != '' && yen_thb != '' && yen_rmb != '' && start_date != '' && end_date != '') {
            let data_obj = {
                start_date: start_date,
                end_date: end_date,
                usd_thb: usd_thb,
                usd_rmb: usd_rmb,
                usd_yen: usd_yen,
                thb_usd: thb_usd,
                thb_rmb: thb_rmb,
                thb_yen: thb_yen,
                rmb_usd: rmb_usd,
                rmb_thb: rmb_thb,
                rmb_yen: rmb_yen,
                yen_usd: yen_usd,
                yen_thb: yen_thb,
                yen_rmb: yen_rmb,
            }
            arr_data.push(data_obj)
            let res_data = await this.ajax_save_data(arr_data)
            if(res_data['arr_res'] == '1'){
                Swal.fire(
                    'saved!',
                    'Your data has been saved.',
                    'success'
                )
                await this.first_page();

                $('.inp_usd_thb').val('')
                $('.inp_usd_rmb').val('')
                $('.inp_usd_yen').val('')
                $('.inp_thb_usd').val('')
                $('.inp_thb_rmb').val('')
                $('.inp_thb_yen').val('')
                $('.inp_rmb_usd').val('')
                $('.inp_rmb_thb').val('')
                $('.inp_rmb_yen').val('')
                $('.inp_yen_usd').val('')
                $('.inp_yen_thb').val('')
                $('.inp_yen_rmb').val('')
                $('.inp_end_date').val('')
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'System has problem plese contact to thailand tech team ',
                })
            }

        } else {
            let arr_eq = [];
            if (start_date == '') arr_eq.push('Start date');
            if (end_date == '') arr_eq.push('End date');
            if (usd_thb == '') arr_eq.push('USD -> THB');
            if (usd_rmb == '') arr_eq.push('USD -> RMB');
            if (usd_yen == '') arr_eq.push('USD -> YEN');
            if (thb_usd == '') arr_eq.push('THB -> USD');
            if (thb_rmb == '') arr_eq.push('THB -> RMB');
            if (thb_yen == '') arr_eq.push('THB -> YEN');
            if (rmb_usd == '') arr_eq.push('RMB -> USD');
            if (rmb_thb == '') arr_eq.push('RMB -> THB');
            if (rmb_yen == '') arr_eq.push('RMB -> YEN');
            if (yen_usd == '') arr_eq.push('YEN -> USD');
            if (yen_thb == '') arr_eq.push('YEN -> THB');
            if (yen_rmb == '') arr_eq.push('YEN -> RMB');
            var result = arr_eq.join(", "); 

            Swal.fire({
                icon: 'error',
                title: 'Oops... Data is invalid Plase entry your data',
                text: `${result}`,
              })
        }


    },

    ajax_save_data: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/currency_rate/save_data_currency.php",
                data: {
                    arr_data: arr_data
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    edit_currency : async function (e){
        $(e).closest('tr').find('td > .form-control').attr('readonly',false)
        $(e).closest('tr').find('td > .inp_date_time_table').attr('readonly',true)
        // $(e).closest('tr').find('td > .inp_start_date_table').attr('readonly',true)
        // $(e).closest('tr').find('td > .inp_end_date_table').attr('readonly',true)
        $(e).closest('tr').find('td > .inp_request_table').attr('readonly',true)
        $(e).closest('tr').find('td > .inp_create_table').attr('readonly',true)

        $(e).closest('tr').find('td > .btn_edit').attr('hidden',true)
        $(e).closest('tr').find('td > .btn_save_data_edit').attr('hidden',false)
    },

    save_currency_edit : async function (e) {
        let arr_data = [];
        $(e).closest('tr').find('td > .form-control').attr('readonly',true)
        $(e).closest('tr').find('td > .btn_edit').attr('hidden',false)
        $(e).closest('tr').find('td > .btn_save_data_edit').attr('hidden',true)
        
        let data_id = $(e).closest('tr').attr('id_data')
        let usd_thb =  $(e).closest('tr').find('.inp_data_usd_thb').val()
        let usd_rmb =  $(e).closest('tr').find('.inp_data_usd_rmb').val()
        let usd_yen =  $(e).closest('tr').find('.inp_data_usd_yen').val()
        let thb_usd =  $(e).closest('tr').find('.inp_data_thb_usd').val()
        let thb_rmb =  $(e).closest('tr').find('.inp_data_thb_rmb').val()
        let thb_yen =  $(e).closest('tr').find('.inp_data_thb_yen').val()
        let rmb_usd =  $(e).closest('tr').find('.inp_data_rmb_usd').val()
        let rmb_thb =  $(e).closest('tr').find('.inp_data_rmb_thb').val()
        let rmb_yen =  $(e).closest('tr').find('.inp_data_rmb_yen').val()
        let yen_usd =  $(e).closest('tr').find('.inp_data_yen_usd').val()
        let yen_thb =  $(e).closest('tr').find('.inp_data_yen_thb').val()
        let yen_rmb =  $(e).closest('tr').find('.inp_data_yen_rmb').val()
        let start_date = $(e).closest('tr').find('.inp_start_date_table').val()
        let end_date = $(e).closest('tr').find('.inp_end_date_table').val()

        obj_data = {
            data_id : data_id,
            usd_thb : usd_thb,
            usd_rmb : usd_rmb,
            usd_yen : usd_yen,
            thb_usd : thb_usd,
            thb_rmb : thb_rmb,
            thb_yen : thb_yen,
            rmb_usd : rmb_usd,
            rmb_thb : rmb_thb,
            rmb_yen : rmb_yen,
            yen_usd : yen_usd,
            yen_thb : yen_thb,
            yen_rmb : yen_rmb,
            start_date : start_date,
            end_date : end_date,
        }
        arr_data.push(obj_data)        

        let res_data = await this.ajax_save_data_edit(arr_data)
        if(res_data['arr_res'] == '1'){
            Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })
        }
    },

    ajax_save_data_edit : async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/currency_rate/save_data_currency_edit.php",
                data: {
                    arr_data: arr_data
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}