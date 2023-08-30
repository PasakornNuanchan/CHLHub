const function_sub_bl = {
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


    get_save_data: async function () {
        let data_detail_obj = {}
        let data_detail_arr = []
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");



        let shipper_bl = $('.inp_bl_shipping').val()
        let consignee_bl = $('.inp_bl_consingee').val()
        let notify = $('.inp_notify_bl').val()
        let carriage = $('.inp_pre_carriage').val()
        let bill_header = $('.inp_bill_header_bl').val()
        let delivery_agent = $('.inp_delivery_agent_bl').val()
        let shipper_on_board = $('.inp_shipper_on_board').val()
        let final_destination = $('.inp_final_destination').val()
        let on_board_date = $('.inp_on_board_date').val()
        let bl_number = $('.inp_bl_number').val()
        let des_of_god = $('.inp_description_of_good').val()

        data_detail_obj = {
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
        }
        data_detail_arr.push(data_detail_obj);

        let table_detail_obj = {}
        let table_detail_arr = []
        $('.table_detail_bl > tbody > tr ').each(function (i, v) {
            let id_row = $(this).attr('id_number')
            let container_no_and_seal = $('.inp_container_no_and_seal', this).val()
            let container_or_package = $('.inp_container_or_package', this).val()
            let package_unit = $('.inp_unit_package',this).val()
            let kind_of_package = $('.inp_kind_of_package', this).val()
            let gross_Weight = $('.inp_gross_Weight', this).val()
            let gross_weight_unit = $('.inp_gross_weight_unit',this).val()
            let mesurement = $('.inp_mesurement', this).val()
            let mesurement_unit = $('.inp_mesurement_unit', this).val()




            table_detail_obj = {
                id_row: id_row,
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
        $('.table_container_bl > tbody > .containertr_row').each(function (i, v) {
            let id_container = $(this).attr('container_id')
            let quantity_bl = $('.inp_quantity_bl', this).val()
            let unit_bl = $('.inp_unit_bl', this).val()
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

        // console.log(table_detail_arr)
        let res_data = await this.ajax_save_data_bl(data_detail_arr, table_detail_arr, table_container_bl_arr)
        if (res_data['arr_save_detail'] == '1' && res_data['arr_save_list'] == '1' && res_data['arr_save_container'] == '1') {
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

    ajax_save_data_bl: async function (data_detail_arr, table_detail_arr, table_container_bl_arr) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                data: {
                    data_detail_arr: data_detail_arr,
                    table_detail_arr: table_detail_arr,
                    table_container_bl_arr: table_container_bl_arr
                },
                url: "php/job_detail/save_data_bl.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    generate_bl: async function () {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        window.open(`php/job_detail/create_pdf_first_bl.php?job_number=${id_number}`, "_blank")
    },

    generate_bl_line: async function () {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        window.open(`php/job_detail/create_pdf_first_bl_line.php?job_number=${id_number}`, "_blank")
    },

    generate_telex_line: async function () {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        window.open(`php/job_detail/create_pdf_first_bl_telex.php?job_number=${id_number}`, "_blank")
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

    cal_container_weight: async function () {
        let data_weight = 0;
        $('.table_container_bl > tbody > tr > td > .inp_weight_bl').each(function () {
            let data = $(this).val();

            if (data === 'NaN') {
                data = 0;
            }
            data_weight = parseFloat(data_weight) + parseFloat(data);
        })
        //console.log(data_weight)

        $('.inp_weight_total').val(data_weight)
        $('.inp_gross_Weight').val(data_weight)
        $('.inp_gross_weight_unit').val('KGS')
    },

    cal_container_cbm: async function () {
        let data_cbm = 0;
        $('.table_container_bl > tbody > tr > td > .inp_cbm_bl').each(function () {
            let data = $(this).val();

            if (data === 'NaN') {
                data = 0;
            }
            data_cbm = parseFloat(data_cbm) + parseFloat(data);
        })

        $('.inp_cbm_total').val(data_cbm)
        $('.inp_mesurement').val(data_cbm)
        $('.inp_mesurement_unit').val('CBM')


    },

    address_consignee: async function () {
        // let data_name = '';
        // let data_addres = '';

        // $.each(sub_bl.data_as_consignee, function (i, v) {
        //     data_name = v['name_data'] ? v['name_data'] : '';
        //     data_addres = v['address_data'] ? v['address_data'] : '';
        // })


        // $('.inp_bl_consingee').val(data_name + '\n' + data_addres)


        let data_consingee_address = $('.inp_bl_consingee').val();
        $('.inp_notify_bl').val(data_consingee_address)
    }



}

// if(unit = "BAGS"){

            // }else if(unit = "BALES"){

            // }else if(unit = "BOXES"){

            // }else if(unit = "BUNDLES"){

            // }else if(unit = "CANS"){

            // }else if(unit = "CATRONS"){

            // }else if(unit = "CASES"){

            // }else if(unit = "CRATES"){

            // }else if(unit = "CARTON"){

            // }else if(unit = "CTNS"){

            // }else if(unit = "DOZENS"){

            // }else if(unit = "DRUMS"){

            // }else if(unit = "LOTS"){

            // }else if(unit = "PACKAGES"){

            // }else if(unit = "PAIRS"){

            // }else if(unit = "PALLET(S)"){

            // }else if(unit = "PAPER PLTS"){

            // }else if(unit = "PCS"){

            // }else if(unit = "PIECES"){

            // }else if(unit = "PKGS"){

            // }else if(unit = "PLASTIC PLTS"){

            // }else if(unit = "PLTS"){

            // }else if(unit = "PLYWOOD CASE(S)"){

            // }else if(unit = "RACKS"){

            // }else if(unit = "REELS"){

            // }else if(unit = "ROLLS"){

            // }else if(unit = "SACKS"){

            // }else if(unit = "SETS"){

            // }else if(unit = "SHEET"){

            // }else if(unit = "STEEL CASES"){

            // }else if(unit = "TANKS"){

            // }else if(unit = "TINS"){

            // }else if(unit = "TRAYS"){

            // }else if(unit = "UNIT"){

            // }else if(unit = "CREATE"){

            // }else if(unit = "WOODEN CASES"){

            // }e 