const setup = {
    data_job_number_option : '',
    data_description_option: '',
    data_bill_to_option: '',
    data_setup_table : '',
    main_setup: async function () {
        await setup.setting_default();
        await setup.setting_first();
        
    },
    

    delete_data_statement : async function(e){
        let data_id_number = $(e).closest('tr').attr('id_number')
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then(async(result) => {
            if (result.isConfirmed) {

                let res_data = await this.ajax_delete_data_statement(data_id_number)
                await setup.setting_first();
                if(res_data == '1'){
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                      });
                }
            }
          });
    },

    ajax_delete_data_statement : async function (data_id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv/delete_statement.php",
                data: {
                    data_id_number : data_id_number
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    setting_default: async function () {
        let res_data_default = await this.ajax_setting_default()
        let html_data_job_number = '';
        let html_data_bill_to = '';
        let html_data_description = '';

        $('.sel_job_number').html('');
        $('.sel_bill_to').html('');
        $('.sel_description').html('');
        $('.data_list_job').html('');
        $('.data_list_bill_to').html('');
        $('.data_list_description').html('');

        $.each(res_data_default['job_number'], function (i, v) {
            html_data_job_number += `<option value="${v['ID']}">${v['job_number'] + ' / ' + v['consignee_name']}</option>`;
        })
        $('.sel_job_number').append(html_data_job_number)


        $.each(res_data_default['bill_to'], function (i, v) {
            html_data_bill_to += `<option value="${v['ID']}">${v['corp_name']}</option>`;
        })
        $('.sel_bill_to').append(html_data_bill_to)


        $.each(res_data_default['description'],function(i,v){
            html_data_description += `<option value="${v['ID']}">${v['description_name']}</option>`;
        })
        $('.sel_description').append(html_data_description)

        setup.data_job_number_option = html_data_job_number
        setup.data_description_option = html_data_description
        setup.data_bill_to_option = html_data_bill_to


        let html_job_number_list_search = '';
        $.each(res_data_default['job_number'], function (i, v) {
            html_job_number_list_search += `<option id_job_number="${v['ID']}" data_search="${v['job_number'] + ' / ' + v['consignee_name']}">${v['job_number'] + ' / ' + v['consignee_name']}</option>`;
        })
        $('.data_list_job').append(html_job_number_list_search)

        let html_bill_to_list_search = '';
        $.each(res_data_default['bill_to'], function (i, v) {
            html_bill_to_list_search += `<option id_bill_to="${v['ID']}" data_search="${v['corp_name']}">${v['corp_name']}</option>`;
        })
        $('.data_list_bill_to').append(html_bill_to_list_search)

        let html_description_search = '';
        $.each(res_data_default['description'],function(i,v){
            html_description_search += `<option id_description="${v['ID']}" data_search="${v['description_name']}">${v['description_name']}</option>`;
        })
        $('.data_list_description').append(html_description_search)
    },


    setting_first: async function () {
        
        // let start_date = $('.inp_start_date').val()
        // let end_date = $('.inp_end_date').val()
    
        // let obj_serach_filter = {
        //     start_date : start_date, 
        //     end_date : end_date,
        // }
        let job_number = $('.inp_job_number').val()
        let description = $('.inp_description').val()
        let applied_person = $('.inp_applied_person').val()
        let start_date = $('.inp_start_date').val()
        let end_date = $('.inp_end_date').val()                      
        let data_job_number = $(`.data_list_job option[data_search="${job_number}"]`).attr('id_job_number') ? $(`.data_list_job option[data_search="${job_number}"]`).attr('id_job_number') : '';
        let data_description = $(`.data_list_description option[data_search="${description}"]`).attr('id_description') ? $(`.data_list_description option[data_search="${description}"]`).attr('id_description') : '';
        let data_applied_person = $(`.data_list_bill_to option[data_search="${applied_person}"]`).attr('id_bill_to') ? $(`.data_list_bill_to option[data_search="${applied_person}"]`).attr('id_bill_to') : '';

        obj_serach_filter = {
            data_job_number : data_job_number,
            data_description : data_description,
            data_applied_person : data_applied_person,
            start_date : start_date,
            end_date : end_date,
        }

        $('.table_expen > tbody').html('')
        let res_data = await this.ajax_setting_first(obj_serach_filter)
        

        setup.data_setup_table = res_data
        $.each(res_data['list_table'], function (i, v) {
            let id_number = v['ID'] ? v['ID'] : '';
            let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
            let description = v['description'] ? v['description'] : '';
            let pay_to = v['pay_to'] ? v['pay_to'] : '';
            let qty = v['qty'] ? v['qty'] : '';
            let price = v['price'] ? v['price'] : '';
            let vat = v['vat'] ? v['vat'] : '';
            let total = v['total'] ? v['total'] : '';
            let currency = v['currency'] ? v['currency'] : '';
            let receipt = v['receipt'] ? v['receipt'] : '';
            let type_file = v['type_file'] ? v['type_file'] : '';
            let remark = v['remark'] ? v['remark'] : '';
            let create_by = v['create_by'] ? v['create_by'] : '';
            let create_datetime = v['create_datetime'] ? v['create_datetime'] : '';
            let check_by = v['check_by'] ? v['check_by'] : '';
            let check_date = v['check_date'] ? v['check_date'] : '';
            let generate_by = v['generate_by'] ? v['generate_by'] : '';
            let generate_date = v['generate_date'] ? v['generate_date'] : '';
            
            let create_by_first_name = v['create_by_first_name'] ? v['create_by_first_name'] : '';
            let create_by_last_name = v['create_by_last_name'] ? v['create_by_last_name'] : '';
            let check_by_first_name = v['check_by_first_name'] ? v['check_by_first_name'] : '';
            let check_by_last_name = v['check_by_last_name'] ? v['check_by_last_name'] : '';
            let gen_by_first_name = v['gen_by_first_name'] ? v['gen_by_first_name'] : '';
            let gen_by_last_name = v['gen_by_last_name'] ? v['gen_by_last_name'] : '';

            let create_by_name = create_by_first_name ? create_by_first_name+' '+create_by_last_name:'';
            let check_by_name = check_by_first_name ? check_by_first_name+' '+check_by_last_name:'';
            let gen_by_name = gen_by_first_name ? gen_by_first_name+' '+gen_by_last_name:'';
            i++;

            // console.log(receipt)
            let html_data = `
        <tr class="text-center id_number${id_number}" id_number="${id_number}" data_list="${i}">
            <td>${i}</td>
            <td><input type="checkbox" class="form-input-check input_check_data" style="zoom:200%"></td>
            <td><select class="form-select form-select-sm sel_job_number">
                    <option value="">-- select job number --</option>
                    ${setup.data_job_number_option}
                </select></td>
            <td><select class="form-select form-select-sm sel_description">
                    <option value="">-- select description --</option>
                    ${setup.data_description_option}
                </select>
            </td>
            <td><select class="form-select form-select-sm sel_bill_to">
                    <option value="">-- select bill to --</option>
                    ${setup.data_bill_to_option}
                </select>
            </td>
            <td><select class="form-select form-select-sm sel_currency text-center">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="HKD">HKD</option>
                    <option value="RMB">RMB</option>
                    <option value="YEN">YEN</option>
            </select></td>
            <td><input type="number" class="form-control form-control-sm inp_qty text-end" onchange="setup.cal_data_list()"></td>
            <td><input type="number" class="form-control form-control-sm inp_unit_price text-end" onchange="setup.cal_data_list()"></td>
            <td><input type="text" class="form-control form-control-sm inp_sub_total text-end" disabled></td>
            <td><input type="number" class="form-control form-control-sm inp_vat text-center" onchange="setup.cal_data_list()"></td>
            <td><input type="text" class="form-control form-control-sm inp_vat_ex text-end" disabled></td>
            <td><input type="text" class="form-control form-control-sm inp_total text-end" disabled></td>
            <td><div class="photo_preview"></div></td>
            <td><input type="text" class="form-control form-control-sm inp_remark"></td>
            <td><button class="btn btn-outline-danger" onclick="setup.delete_data_statement(this)"><i class="bi bi-trash"></i></button></td>
            <td><button class="btn btn-outline-warning" onclick="setup.edit_data(this)"><i class="bi bi-pencil"></i></button></td>
            <td><input type="text" class="form-control form-control-sm inp_create_by text-end" disabled></td>
            <td><input type="text" class="form-control form-control-sm inp_create_date text-end" disabled></td>
            <td><input type="text" class="form-control form-control-sm inp_check_by text-end" disabled></td>
            <td><input type="text" class="form-control form-control-sm inp_check_date text-end" disabled></td>
            <td><input type="text" class="form-control form-control-sm inp_gen_inv_by text-end" disabled></td>
            <td><input type="text" class="form-control form-control-sm inp_gen_inv_date text-end" disabled></td>     
        </tr>
        `;

            $('.table_expen tbody').prepend(html_data)
            price = parseFloat(price)
            price = price.toFixed(2)
            $(`.table_expen > tbody > .id_number${id_number} > td > .sel_job_number`).val(ref_job_id).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .sel_description`).val(description).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .sel_bill_to`).val(pay_to).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .sel_currency`).val(currency).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_qty`).val(qty).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_unit_price`).val(price).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_vat`).val(vat).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_remark`).val(remark).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_create_by`).val(create_by_name).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_create_date`).val(create_datetime).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_check_by`).val(check_by_name).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_check_date`).val(check_date).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_gen_inv_by`).val(gen_by_name).attr('disabled',true)
            $(`.table_expen > tbody > .id_number${id_number} > td > .inp_gen_inv_date`).val(generate_date).attr('disabled',true)

            if(receipt != ''){
                $(`.table_expen > tbody > .id_number${id_number} > td > .photo_preview`).html(`<img id="blah" src="#" alt="your image" style="width:60%" onclick="setup.show_photo(this)" /> `);
                $(`.table_expen > tbody > .id_number${id_number} > td > .photo_preview > img`).attr("src",`${receipt}`)
            }else{
                $(`.table_expen > tbody > .id_number${id_number} > td > .photo_preview`).html(`No photo`);

            }
            
        })
        await setup.cal_data_list();
    },

    cal_data_list : async function(){
        let path = $('.table_expen > tbody > tr')
        $.each(path,function(){
            let qty = $(this).find('.inp_qty').val() ? $(this).find('.inp_qty').val() : 0;
            let unit_price = $(this).find('.inp_unit_price').val() ? $(this).find('.inp_unit_price').val() : 0;
            let vat = $(this).find('.inp_vat').val() ? $(this).find('.inp_vat').val() : 0;

            qty = parseFloat(qty)
            unit_price = parseFloat(unit_price)
            vat = parseFloat(vat)

            let data_sub_total = qty * unit_price
            let data_excl = ((data_sub_total * vat)/100)
            let data_total = data_sub_total + data_excl
            data_sub_total = data_sub_total.toFixed(2)
            data_excl = data_excl.toFixed(2)
            data_total = data_total.toFixed(2)
            $(this).find('.inp_sub_total').val(data_sub_total)
            $(this).find('.inp_vat_ex').val(data_excl)
            $(this).find('.inp_total').val(data_total)

        })
       
    },

    cal_data_add : async function(){
        let qty_add = $('.inp_qty_add').val() ? $('.inp_qty_add').val() : '0';
        let unit_price_add = $('.inp_unit_price_add').val() ? $('.inp_unit_price_add').val() : '0';
        let vat_add = $('.inp_vat_add').val() ? $('.inp_vat_add').val() : '0';

        qty_add = parseFloat(qty_add)
        unit_price_add = parseFloat(unit_price_add)
        vat_add = parseFloat(vat_add)
        
        let data_sub_total = qty_add * unit_price_add
        data_sub_total = parseFloat(data_sub_total)

        let vat_ex = ((data_sub_total*vat_add)/100)
        vat_ex = parseFloat(vat_ex)
        
        let data_total = data_sub_total + vat_ex
        data_total = parseFloat(data_total)

        data_sub_total = data_sub_total.toFixed(2)
        vat_ex = vat_ex.toFixed(2)
        data_total = data_total.toFixed(2)


        $('.inp_sub_total_add').val(data_sub_total)
        $('.inp_vat_ex_add').val(vat_ex)
        $('.inp_total_add').val(data_total)
        
    },


    ajax_setting_first: async function (obj_serach_filter) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv/get_data_setup.php",
                data: obj_serach_filter,
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_setting_default: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv/get_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    edit_data : async function (e) {
        let data_get_body = $('.card_body_save').length
        if(data_get_body == '0'){
            this.add_list()
        }

        let id_number_find = $(e).closest('tr').attr('id_number')

        $.each(setup.data_setup_table['list_table'],function(i,v){
            let id_number = v['ID'] ? v['ID'] : '';
            if(id_number == id_number_find){
                let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                let description = v['description'] ? v['description'] : '';
                let pay_to = v['pay_to'] ? v['pay_to'] : '';
                let qty = v['qty'] ? v['qty'] : '';
                let price = v['price'] ? v['price'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                let total = v['total'] ? v['total'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let receipt = v['receipt'] ? v['receipt'] : '';
                let type_file = v['type_file'] ? v['type_file'] : '';
                let name_file = v['name_file'] ? v['name_file'] : '';
                let remark = v['remark'] ? v['remark'] : '';
                let create_by = v['create_by'] ? v['create_by'] : '';
                let create_datetime = v['create_datetime'] ? v['create_datetime'] : '';
                let check_by = v['check_by'] ? v['check_by'] : '';
                let check_date = v['check_date'] ? v['check_date'] : '';
                let generate_by = v['generate_by'] ? v['generate_by'] : '';
                let generate_date = v['generate_date'] ? v['generate_date'] : '';
                
                $('.sel_job_number_add').val(ref_job_id)
                $('.sel_description_add').val(description)
                $('.sel_bill_to_add').val(pay_to)
                $('.sel_currency').val(currency)
                $('.inp_qty_add').val(qty)
                $('.inp_unit_price_add').val(price)
                $('.inp_vat_add').val(vat)
                $('.inp_total_add').val(total)
                $('.inp_remark_add').val(remark)
                // $('.inp_file_add').val(name_file)

                if(receipt != ''){
                    $(`.card-preview`).html(`<img id="blah" src="#" alt="your image" style="width:400px"" onclick="setup.show_photo(this)" /> `);
                    $(`.card-preview > img`).attr("src",`${receipt}`)
                }else{
                    $(`.card-preview`).html(`No photo`);
    
                }
                setup.cal_data_add() 
            }
        })
    },

    
    show_photo : async function(e){

        let data_pho = $(e).attr('src')
      //  console.log($(e)
        var newTab = window.open();
        newTab.document.write('<html><body><img id="imageDisplay" src="' + data_pho + '"></body></html>');


    },

    select_filter : async function(){
        let job_number = $('.inp_job_number').val()
        let description = $('.inp_description').val()
        let applied_person = $('.inp_applied_person').val()
        let start_date = $('.inp_start_date').val()
        let end_date = $('.inp_end_date').val()                      
        let data_job_number = $(`.data_list_job option[data_search="${job_number}"]`).attr('id_job_number') ? $(`.data_list_job option[data_search="${job_number}"]`).attr('id_job_number') : '';
        let data_description = $(`.data_list_description option[data_search="${description}"]`).attr('id_description') ? $(`.data_list_description option[data_search="${description}"]`).attr('id_description') : '';
        let data_applied_person = $(`.data_list_bill_to option[data_search="${applied_person}"]`).attr('id_bill_to') ? $(`.data_list_bill_to option[data_search="${applied_person}"]`).attr('id_bill_to') : '';

        obj_serach_filter = {
            data_job_number : data_job_number,
            data_description : data_description,
            data_applied_person : data_applied_person,
            start_date : start_date,
            end_date : end_date,
        }
        
        let res_data = await this.ajax_setting_first(obj_serach_filter)
        console.log(res_data)
        
    },

    checked_all_data : async function(e){
        let path = $('.table_expen tbody tr')
        $.each(path,function(){
            let data_input_check = $(this).find('.input_check_data').attr('disabled') ? '1' : '0';
            // console.log(data_input_check)
            if(data_input_check == 0){
                if(e == 't'){
                    $(this).find('.input_check_data').prop('checked',true)
                }else{
                    $(this).find('.input_check_data').prop('checked',false)
                }
            }
        })
    }
    
    
}
function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $('.card-preview').html(`<img id="blah" src="#" alt="your image" style="width:400px" /> `);
        $('#blah').attr('src', e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
}

