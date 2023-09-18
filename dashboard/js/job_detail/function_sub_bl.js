const function_sub_bl = {
    arr_fright_delete : [],
    add_detail_bl: async function () {
        let html_detail_bl = `
        <tr>
            <td><textarea class="form-control inp_container_no_and_seal" id="exampleFormControlTextarea1" rows="4"></textarea></td>
            <td><input type="text" class="form-control form-control-sm inp_container_or_package"></td>
            <td><textarea class="form-control inp_kind_of_package" id="exampleFormControlTextarea1" rows="4"></textarea></td>
            <td><input type="text" class="form-control form-control-sm inp_gross_Weight"></td>
            <td><input type="text" class="form-control form-control-sm inp_mesurement"></td>
        </tr>
        `;
        $('.table_detail_bl tbody').append(html_detail_bl)
    },


    get_save_data: async function (e) {
        let data_detail_obj = {}
        let data_detail_arr = []
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");


        let h_data = $(e).closest('.bl_tab_target')
        let data_find_table_detail_bl = $(h_data).find('.table_detail_bl > tbody > tr')
        let data_find_table_container = $(h_data).find('.table_container_bl > tbody > tr')
        let data_find_table_fright = $(h_data).find('.table_fright > tbody > tr')

        let bl_data = $(h_data).attr('bl_number')
        let shipper_bl = $('.inp_bl_shipping',h_data).val()
        let consignee_bl = $('.inp_bl_consingee',h_data).val()
        let notify = $('.inp_notify_bl',h_data).val()
        let carriage = $('.inp_pre_carriage',h_data).val()
        let bill_header = $('.inp_bill_header_bl',h_data).val()
        let delivery_agent = $('.inp_delivery_agent_bl',h_data).val()
        let shipper_on_board = $('.inp_shipper_on_board',h_data).val()
        let final_destination = $('.inp_final_destination',h_data).val()
        let on_board_date = $('.inp_on_board_date',h_data).val()
        let bl_number = $('.inp_bl_number',h_data).val()
        let des_of_god = $('.inp_description_of_good',h_data).val()
        let data_place = $('.inp_place',h_data).val()
        let payble_at = $('.inp_payble',h_data).val()
    
        data_detail_obj = {
            payble_at : payble_at,
            bl_data : bl_data,
            des_of_god: des_of_god,
            id_number: id_number,
            shipper_bl: shipper_bl,
            consignee_bl: consignee_bl,
            notify: notify,
            carriage: carriage,
            bill_header: bill_header,
            delivery_agent: delivery_agent,
            shipper_on_board: shipper_on_board,
            on_board_date : on_board_date,
            final_destination : final_destination,
            bl_number: bl_number,
            data_place : data_place,
        }
        data_detail_arr.push(data_detail_obj);

        let table_detail_obj = {}
        let table_detail_arr = []
        $(data_find_table_detail_bl).each(function (i, v) {
            let id_bl = $(this).closest('table').attr('id_list')
            let id_row = $(this).attr('id_row')
            let container_no_and_seal = $('.inp_container_no_and_seal', h_data).val()
            let container_or_package = $('.inp_container_or_package', h_data).val()
            let package_unit = $('.inp_unit_package',h_data).val()
            let kind_of_package = $('.inp_kind_of_package', h_data).val()
            let gross_Weight = $('.inp_gross_Weight', h_data).val()
            let gross_weight_unit = $('.inp_gross_weight_unit',h_data).val()
            let mesurement = $('.inp_mesurement', h_data).val()
            let mesurement_unit = $('.inp_mesurement_unit', h_data).val()

            table_detail_obj = {
                id_bl: id_bl,
                id_row : id_row,
                id_number: id_number,
                container_no_and_seal: container_no_and_seal,
                container_or_package: container_or_package,
                package_unit : package_unit,
                kind_of_package: kind_of_package,
                gross_Weight: gross_Weight,
                gross_weight_unit : gross_weight_unit,
                mesurement: mesurement,
                mesurement_unit : mesurement_unit
            }

            table_detail_arr.push(table_detail_obj)
        })

        let table_container_bl_obj = {}
        let table_container_bl_arr = []
        $(data_find_table_container).each(function (i, v) {
            let id_container = $(this).attr('container_id')
            
            let quantity_bl = $('.inp_quantity_bl', this).val()
            let unit_bl = $('.inp_bl_unit_data', this).val()
            let cbm_bl = $('.inp_cbm_bl', this).val()
            let weight = $('.inp_weight_bl', this).val()

            table_container_bl_obj = {
                id_container: id_container,
                quantity_bl: quantity_bl,
                unit_bl: unit_bl,
                cbm_bl: cbm_bl,
                weight: weight

            }

            table_container_bl_arr.push(table_container_bl_obj)
        })

        let table_fright_bl_arr = [];
        $(data_find_table_fright).each(function(i,v){
            let id_list =  $(this).attr('id_list')
            
            let charge = $('.inp_charge',this).val()
            let prepaid = $('.inp_prepaid',this).val()
            let collect = $('.inp_collect',this).val()
            let ref_id_row = $(data_find_table_fright,this).closest('.table').attr('ref_id_row')
            let ref_job_id = $(data_find_table_fright,this).closest('.table').attr('id_number')

            let obj_fright = {
                id_list : id_list,
                ref_id_row : ref_id_row,
                ref_job_id : ref_job_id,
                charge : charge,
                prepaid : prepaid,
                collect : collect,
            }

            table_fright_bl_arr.push(obj_fright)
            
        })

        console.log(data_detail_arr)
        console.log(table_detail_arr)
        console.log(table_container_bl_arr)
        console.log(table_fright_bl_arr)

        let res_data = await this.ajax_save_data_bl(data_detail_arr, table_detail_arr, table_container_bl_arr,table_fright_bl_arr,this.arr_fright_delete)
        if (res_data['arr_save_detail'] == '1' && res_data['arr_save_list'] == '1' && res_data['arr_save_container'] == '1' && res_data['arr_query_fright'] == '1') {
            Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
            var currentURL = window.location.href;
            var url = new URL(currentURL);
            var id_number = url.searchParams.get("job_number");
            await sub_job_detail.first_post_data(id_number);

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })
        }





    },

    ajax_save_data_bl: async function (data_detail_arr, table_detail_arr, table_container_bl_arr,table_fright_bl_arr,arr_fright_delete) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                data: {
                    data_detail_arr : data_detail_arr,
                    table_detail_arr : table_detail_arr,
                    table_container_bl_arr : table_container_bl_arr,
                    table_fright_bl_arr : table_fright_bl_arr,  
                    arr_fright_delete : arr_fright_delete,
                },
                url: "php/job_detail/save_data_bl.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    generate_bl: async function (e) {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let h_data = $(e).closest('.bl_tab_target').attr('bl_number')
        let id_list = $(e).closest('.bl_tab_target').find('.table_detail_bl > tbody > tr').attr('id_row')
        
        window.open(`php/job_detail/create_pdf_first_bl.php?job_number=${id_number}&bl_number_main=${h_data}&id_list=${id_list}`, "_blank")
    },

    generate_bl_line: async function (e) {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let h_data = $(e).closest('.bl_tab_target').attr('bl_number')
        let id_list = $(e).closest('.bl_tab_target').find('.table_detail_bl > tbody > tr').attr('id_row')



        window.open(`php/job_detail/create_pdf_first_bl_line.php?job_number=${id_number}&bl_number_main=${h_data}&id_list=${id_list}`, "_blank")
    },

    generate_telex_line: async function (e) {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let h_data = $(e).closest('.bl_tab_target').attr('bl_number')
        let id_list = $(e).closest('.bl_tab_target').find('.table_detail_bl > tbody > tr').attr('id_row')



        window.open(`php/job_detail/create_pdf_first_bl_telex.php?job_number=${id_number}&bl_number_main=${h_data}&id_list=${id_list}`, "_blank")
    },

    cal_container_package: async function () {
        let data_quantity_l = 0;
        $('.table_container_bl > tbody > tr > td > .inp_quantity_bl').each(function (){
            let data = $(this).val();
            console.log(data)
            if(data === 'NaN'){
                data = 0;
            }
            data_quantity_l = parseFloat(data_quantity_l) + parseFloat(data);
        })

        let data_unit = $('.table_container_bl > tbody > .containertr_row0 > td > .inp_unit_bl').val()

        // let data_quantity_l = 0;
        // $('.table_container_bl > tbody > tr ').each(function () {
        //     let data_quantity = $('.inp_quantity_bl').val();
        //     let data_unit = $('.inp_unit_bl').val();
        //     let obj_data = 

            // if (data === 'NaN') {
            //     data = 0;
            // }
            // data_quantity_l = parseFloat(data_quantity_l) + parseFloat(data);
        //})


        $('.inp_package_total').val(data_quantity_l)
        $('.inp_container_or_package').val(data_quantity_l)
        $('.inp_unit_package').val(data_unit)
    },

    cal_container_weight: async function (e) {
        let data_weight = 0;
        let table_data = $(e).closest('.bl_tab_target').find('.table_container_bl > tbody > tr > td > .inp_weight_bl')

        $(table_data).each(function () {
            let data = $(this).val();

            if (data === 'NaN') {
                data = 0;
            }
            data_weight = parseFloat(data_weight) + parseFloat(data);
        })
        //console.log(data_weight)

        $(e).closest('.bl_tab_target').find('.inp_weight_total').val(data_weight)
        $(e).closest('.bl_tab_target').find('.inp_gross_Weight').val(data_weight)
        $(e).closest('.bl_tab_target').find('.inp_gross_weight_unit').val('KGS')
    },

    cal_container_cbm: async function (e) {
        let table_data = $(e).closest('.bl_tab_target').find('.table_container_bl > tbody > tr > td > .inp_cbm_bl')

        let data_cbm = 0;
        $(table_data).each(function () {
            let data = $(this).val();

            if (data === 'NaN') {
                data = 0;
            }
            data_cbm = parseFloat(data_cbm) + parseFloat(data);
        })

        $(e).closest('.bl_tab_target').find('.inp_cbm_total').val(data_cbm)
        $(e).closest('.bl_tab_target').find('.inp_mesurement').val(data_cbm)
        $(e).closest('.bl_tab_target').find('.inp_mesurement_unit').val('CBM')
    },

    address_consignee: async function (e) {
        let data_consingee_address = $(e).closest('.bl_tab_target').find(`.inp_bl_consingee`).val()
        $(e).closest('.bl_tab_target').find('.inp_notify_bl').val(data_consingee_address)
    },

    add_fright : async function(e){        
        let html_fright = `
        <tr>
            <td><input type="text" class="form-control form-control-sm inp_charge"></td>
            <td><input type="text" class="form-control form-control-sm inp_prepaid"></td>
            <td><input type="text" class="form-control form-control-sm inp_collect"></td>
            <td><button class="btn btn-sm btn-danger" onclick="function_sub_bl.delete_fright(this)"><i class="bi bi-trash"></i> Del</button></td>
        </tr>
        `;
        $(e).closest('.bl_tab_target').find('.table_fright > tbody').append(html_fright)
 

    },

    delete_fright : async function(e){

        let data_id = $(e).closest('tr').attr('id_list')
        console.log(data_id)
        if(data_id != undefined){
            let obj_data_delete_fright = {
                data_id : data_id
            }

            this.arr_fright_delete.push(obj_data_delete_fright)
        }
        $(e).closest('tr').remove();     
    
    }



}
