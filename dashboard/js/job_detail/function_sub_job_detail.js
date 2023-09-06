const function_sub_job_detail = {

    arr_delete_container: [],




    get_data_all_page: async function () {

        Swal.fire({
            title: `Are you sure save this data`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let job_number = $('.inp_jobnumber').val()
                let booking_number = $('.inp_bookingnumber').val()
                let consignee = $('.inp_consignee').val()
                let shipper = $('.inp_shipper').val()
                let shipment = $('.inp_shipment').val()
                let remark = $('.inp_remark').val()
                let carrier = $('.inp_carrier').val()
                let port_of_receipt = $('.inp_port_of_receipt').val()
                let port_of_loading = $('.inp_port_of_loading').val()
                let ts_port = $('.inp_ts_port').val()
                let port_of_discharge = $('.inp_port_of_discharge').val()
                let port_of_delivery = $('.inp_port_of_delivery').val()
                let mother = $('.inp_mother_vessel').val()
                let feeder = $('.inp_feeder_vessel').val()
                let etd = $('.inp_etd').val()
                let eta = $('.inp_eta').val()
                let inv = $('.inp_inv').val()
                let mbl = $('.inp_mbl').val()
                let hbl = $('.inp_hbl').val()
                let cargo_des = $('.inp_cargo_des').val()
                let cargo_type = $('.inp_cargo_type').val()
                let quantity = $('.inp_quantity').val()
                let gw = $('.inp_gw').val()
                let vol = $('.inp_vol').val()
                let remark_container = $('.inp_remark_container').val()
                let booking_agent = $('.inp_booking_agent').val()
                let cs_data_user = $('.inp_cs_user').val()
                let sale_data_user = $('.inp_sale_user').val()
                let commodity = $('.inp_commodity').val()
                let delivery_place = $('.inp_delivery_place').val()
                let notify = $('.inp_notify').val()
                let arr_detail_save = []

                obj_detail_save = {
                    job_number: job_number,
                    booking_number: booking_number,
                    consignee: consignee,
                    shipper: shipper,
                    shipment: shipment,
                    remark: remark,
                    carrier: carrier,
                    port_of_receipt: port_of_receipt,
                    port_of_loading: port_of_loading,
                    ts_port: ts_port,
                    port_of_discharge : port_of_discharge,
                    port_of_delivery: port_of_delivery,
                    mother: mother,
                    feeder: feeder,
                    etd: etd,
                    eta: eta,
                    inv: inv,
                    mbl: mbl,
                    hbl: hbl,
                    cargo_des: cargo_des,
                    cargo_type: cargo_type,
                    quantity: quantity,
                    gw: gw,
                    vol: vol,
                    remark_container: remark_container,
                    booking_agent: booking_agent,
                    cs_data_user: cs_data_user,
                    sale_data_user: sale_data_user,
                    commodity:commodity,
                    delivery_place:delivery_place,
                    notify:notify
                }

                arr_detail_save.push(obj_detail_save)
                let arr_detail_container = [];
                let obj_detail_container = {};

                $('.table_container_module > tbody > tr').each(function (e) {
                    let id_container = $(this).attr('id_container_module')
                    let inp_container_type = $('.inp_container_type', this).val()
                    let inp_cargo_des = $('.inp_cargo_description', this).val()
                    let inp_container_number = $('.inp_container_number', this).val()
                    let inp_single_weight = $('.inp_single_weight', this).val()
                    let inp_package = $('.inp_package', this).val()
                    let inp_gw = $('.inp_gw', this).val()
                    let inp_volume = $('.inp_volume', this).val()
                    let inp_seal_number = $('.inp_seal_number', this).val()
                    let inp_cy = $('.inp_cy', this).val()
                    let inp_rtn = $('.inp_rtn', this).val()
                    let inp_remark = $('.inp_remark', this).val()

                    obj_detail_container = {
                        id_container: id_container,
                        inp_container_type: inp_container_type,
                        inp_cargo_des: inp_cargo_des,
                        inp_container_number: inp_container_number,
                        inp_single_weight: inp_single_weight,
                        inp_package: inp_package,
                        inp_gw: inp_gw,
                        inp_volume: inp_volume,
                        inp_seal_number: inp_seal_number,
                        inp_cy: inp_cy,
                        inp_rtn: inp_rtn,
                        inp_remark: inp_remark,
                    }



                    arr_detail_container.push(obj_detail_container)

                });


                var currentURL = window.location.href;
                var url = new URL(currentURL);
                var id_number = url.searchParams.get("job_number");

                let res_return = await this.ajax_sent_data_raw(arr_detail_save, arr_detail_container, this.arr_delete_container, id_number)

                if (res_return['arr_data_container_information'] == '1' || res_return['arr_data_delete_container'] == '1' || res_return['arr_data_job_title'] == '1' || res_return['arr_data_save_container'] == '1') {
                    Swal.fire(
                        'saved!',
                        'Your data has been saved.',
                        'success'
                    )
                    var currentURL = window.location.href;
                    var url = new URL(currentURL);
                    var id_number = url.searchParams.get("job_number");
                    await sub_bl.first_post_data(id_number);
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

    ajax_sent_data_raw: function (arr_detail_save, arr_detail_container, delete_data, id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/save_data_job_detail.php",
                data: {
                    arr_detail_save: arr_detail_save,
                    arr_detail_container: arr_detail_container,
                    delete_data: delete_data,
                    id_number: id_number
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    add_row_new_container: function () {

        let html_add_new_container = "";
        html_add_new_container = `
    <tr class="text-center header_container_data">
        <td>${html_container_type}</td>
        <td><input type="text" class="form-control form-control-sm inp_container_number" maxlength="20"></td>
        <td><input type="number" class="form-control form-control-sm inp_cntr"></td>
        <td><input type="checkbox" class="form-check-input inp_soc"></td>
        <td><input type="checkbox" class="form-check-input inp_ow"></td>
        <td><input type="date" class="form-control form-control-sm inp_cy"></td>
        <td><input type="date" class="form-control form-control-sm inp_rtn"></td>
        <td><button class="btn btn-sm btn-danger" onclick="function_sub_job_detail.delete_container_main(this)"><i class="bi bi-trash text-white"></i></button></td>
    </tr>
    `;

        $('.table_data_container > tbody').append(html_add_new_container)
    },

    add_container_v2: async function () {
        let length_container_table = $('.table_container_v2 tbody tr').length
        length_container_table++;
        //    let data_select_container = $('.inp_container_type').parent().html();
        let html_new_container = `
        <tr>
            <td class="text-center"><div class="q_container"></div></td>
            <td>${sub_job_detail.data_select_container}</td>
            <td><input type="number" class="form-control form-control-sm text-center inp_num_q"></td>
            <td class="text-center"><button class="btn btn-success btn-sm" onclick="function_sub_job_detail.add_container_module(this,${length_container_table})"><i class="bi bi-plus-circle"></i></button> <button class="btn btn-danger btn-sm" onclick="function_sub_job_detail.delete_container_main(this,${length_container_table})"><i class="bi bi-trash"></i></button></td>
        </tr>
        `;
        $('.table_container_v2 tbody').append(html_new_container)
        await this.cal_number_container_rows();
    },

    delete_row_table_container: async function (data) {
        let tr_master = $(data).closest('tr')
        let get_container = tr_master.attr('container_id')

        if (get_container != '') {
            obj_delete_container = {
                raw_data_delete: get_container
            }
            this.arr_delete_container.push(obj_delete_container)
        }

        $(tr_master).remove()
    },

    delete_container_main: async function (e, a) {


        let check_on_data_base = $(e).closest('tr').attr('container_have_data')
        let check_select = $(e).closest('tr').find('.inp_container_type').val()
        let obj_delete_container = {};

        if (check_on_data_base == "1") {
            obj_delete_container = {
                check_select: check_select
            }
            this.arr_delete_container.push(obj_delete_container)
        }

        $(`.table_container_module > tbody > .container_data_q${a}`).remove()

        await this.cal_number_container_rows()
        await this.cal_number_container_module_rows()
        $(e).closest('tr').remove()

    },

    cal_number_container_rows: async function () {
        let i = 0;
        $('.table_container_v2 tbody tr').each(function () {
            i++;
            $(this).find('td .q_container').html('')
            $(this).find('td .q_container').html(i)
        })

    },

    cal_number_container_module_rows: async function () {
        let i = 0;
        $('.table_container_module tbody tr').each(function () {
            i++;
            $(this).find('td .q_container_module').html('')
            $(this).find('td .q_container_module').html(i)
        })

    },

    add_container_module: async function (e, a) {

        let number_req = $(e).closest('tr').find('.inp_num_q').val()
        let type_selected = $(e).closest('tr').find('.inp_container_type').val()

        for (let i = 0; i < number_req; i++) {
            let html_container_module = `
        <tr class="container_data_q${a}" >
            <td class="text-center"><div class="q_container_module"></div></td>
            <td>${sub_job_detail.data_select_container}</td>
            <td><input type="text" class="form-control form-control-sm text-center inp_container_number " maxlength="30"></td>
            <td><input type="text" class="form-control form-control-sm text-center inp_seal_number" maxlength="30"></td>
            <td><input type="number" class="form-control form-control-sm text-center inp_single_weight" onchange="function_sub_job_detail.cal_vgm(this)"></td>
            <td><input type="number" class="form-control form-control-sm text-center inp_package" maxlength="40"></td>
            <td><input type="number" class="form-control form-control-sm text-center inp_gw" onchange="function_sub_job_detail.cal_vgm(this)"></td>
            <td><input type="number" class="form-control form-control-sm text-center inp_volume"></td>
            <td><input type="number" class="form-control form-control-sm text-center inp_vgm"></td>
            <td><input type="date" class="form-control form-control-sm text-center inp_cy"></td>
            <td><input type="date" class="form-control form-control-sm text-center inp_rtn"></td>
            <td><input type="text" class="form-control form-control-sm text-center inp_remark" maxlength="200"></td>
        </tr>
        `;


            $('.table_container_module tbody').append(html_container_module)

        }
        $(`.table_container_module > tbody > .container_data_q${a} > td > .inp_container_type`).val(type_selected).attr('disabled', true)

        $(e).closest('tr').find('.inp_container_type').attr('disabled', true)
        $(e).closest('tr').find('.inp_num_q').attr('disabled', true)
        $(e).remove()

        await this.cal_number_container_rows()
        await this.cal_number_container_module_rows()

    },

    cal_cargo_information: async function () {
        let cargo_description_all = '';
        let volume_all = 0;
        let gw_all = 0;
        let single_w_all = 0;
        $('.table_container_module tbody tr').each(function (e) {
            let cargo_des = $('.inp_cargo_description', this).val()
            let volume = parseFloat($('.inp_volume', this).val())
            let gw = parseFloat($('.inp_gw', this).val())
            let single_w = parseFloat($('.inp_single_weight', this).val())

            volume_all = parseFloat(volume_all) + volume;
            gw_all = parseFloat(gw_all) + gw;
            single_w_all = parseFloat(single_w_all) + single_w
            cargo_description_all = cargo_description_all + ',' + cargo_des;


        })

        //$('.inp_cargo_des').val(cargo_description_all)
        $('.inp_gw_container').val(gw_all)
        $('.inp_vol').val(volume_all)
        $('.inp_scntrw_container').val(single_w_all)
    },


    generate_first_bl: async function () {

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        window.open(`php/job_detail/create_pdf_first_bl.php?id_create=${id_number}`, "_blank")


    },

    cal_vgm : async function(e){
        let data_tare_weight = $(e).closest('tr').find('.inp_single_weight').val()
        let data_gross_weight = $(e).closest('tr').find('.inp_gw').val()

        data_tare_weight = data_tare_weight === NaN ? 0 : data_tare_weight;
        data_gross_weight = data_gross_weight === NaN ? 0 : data_gross_weight;

        console.log(data_tare_weight)
        console.log(data_gross_weight)
        data_tare_weight = parseFloat(data_tare_weight) 
        data_gross_weight = parseFloat(data_gross_weight)

        let data_vgm = data_tare_weight + data_gross_weight
        //console.log(data_vgm)
        $(e).closest('tr').find('.inp_vgm').val(data_vgm)
    },
}