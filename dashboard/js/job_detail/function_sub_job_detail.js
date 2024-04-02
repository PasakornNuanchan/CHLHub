const function_sub_job_detail = {

    arr_delete_container: [],
    arr_delete_hbl: [],

    get_data_all_page: async function () {

        let arr_detail_container = [];
        let obj_detail_container = {};

        $('.table_container_module > tbody > tr').each(function (e) {
            let id_container = $(this).attr('id_container_module')
            let inp_container_type = $('.inp_container_type', this).val()
            let inp_cargo_des = $('.inp_cargo_description', this).val()
            let inp_container_number = $('.inp_container_number', this).val()
            let inp_single_weight = $('.inp_single_weight', this).val()
            let inp_package = $('.inp_package', this).val()
            let inp_select_packing = $('.inp_select_packing', this).val()
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
                inp_select_packing: inp_select_packing,
                inp_gw: inp_gw,
                inp_volume: inp_volume,
                inp_seal_number: inp_seal_number,
                inp_cy: inp_cy,
                inp_rtn: inp_rtn,
                inp_remark: inp_remark,
            }



            arr_detail_container.push(obj_detail_container)

        });

        var duplicateNames = checkDuplicateNames(arr_detail_container);
        
        let data_dupcontainer = duplicateNames.length
        if(data_dupcontainer >= 1){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `Container nubmer is duplicate please change container number`,
            })
            return;
        }
        

        let arr_hbl = []
        $('.hbl_added > .form-group').each(function (e) {

            let id_hbl = $(this).attr('id_hbl')
            let hbl_data = $('.inp_hbl', this).val()
            let obj_hbl = {}
            obj_hbl = {
                id_hbl: id_hbl,
                hbl_data: hbl_data
            }
            arr_hbl.push(obj_hbl)
        })

        var duplicatehbl = checkDuplicatehbl(arr_hbl);
        let data_duphbl = duplicatehbl.length
        if(data_duphbl >= 1){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `HBL is duplicate please change HBL`,
            })
            return;
        }


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
                let final_destination = $('.inp_finaldestination').val()
                //let notify = $('.inp_notify').val()

                let client_value = $('.inp_client :selected').val()
                let client_type = $('.inp_client :selected').attr('type_data')
                let notify_value = $('.inp_notify_job_detail :selected').val()
                let notify_type = $('.inp_notify_job_detail :selected').attr('type_data')

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
                    port_of_discharge: port_of_discharge,
                    port_of_delivery: port_of_delivery,
                    mother: mother,
                    feeder: feeder,
                    etd: etd,
                    eta: eta,
                    inv: inv,
                    mbl: mbl,
                    cargo_des: cargo_des,
                    cargo_type: cargo_type,
                    quantity: quantity,
                    gw: gw,
                    vol: vol,
                    remark_container: remark_container,
                    booking_agent: booking_agent,
                    cs_data_user: cs_data_user,
                    sale_data_user: sale_data_user,
                    commodity: commodity,
                    delivery_place: delivery_place,
                    client_value: client_value,
                    client_type: client_type,
                    notify_value: notify_value,
                    notify_type: notify_type,
                    final_destination: final_destination,
                }

                arr_detail_save.push(obj_detail_save)
                

                

                var currentURL = window.location.href;
                var url = new URL(currentURL);
                var id_number = url.searchParams.get("job_number");
                
                await this.ajax_sent_data_raw(arr_detail_save, arr_detail_container, this.arr_delete_container, id_number, arr_hbl, this.arr_delete_hbl)
                await Swal.fire(
                    'saved!',
                    'Your data has been saved.',
                    'success'
                )
                var currentURL = window.location.href;
                var url = new URL(currentURL);
                var id_number = url.searchParams.get("job_number");
                await sub_job_detail.first_post_data(id_number);
                

            }
        })
    },

    ajax_sent_data_raw: function (arr_detail_save, arr_detail_container, delete_data, id_number, arr_hbl, arr_delete_hbl) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/save_data_job_detail.php",
                data: {
                    arr_detail_save: arr_detail_save,
                    arr_detail_container: arr_detail_container,
                    delete_data: delete_data,
                    id_number: id_number,
                    arr_hbl: arr_hbl,
                    arr_delete_hbl: arr_delete_hbl,
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
            <td>${sub_job_detail.select_packing_global}</td>
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
        let package_all = 0;
        $('.table_container_module tbody tr').each(function (e) {
            let cargo_des = $('.inp_cargo_description', this).val()
            let volume = parseFloat($('.inp_volume', this).val())
            let gw = parseFloat($('.inp_gw', this).val())
            let single_w = parseFloat($('.inp_single_weight', this).val())
            let package = parseFloat($('.inp_package', this).val())

            package_all = parseFloat(package_all) + parseFloat(package)

            volume_all = parseFloat(volume_all) + volume;
            gw_all = parseFloat(gw_all) + gw;
            single_w_all = parseFloat(single_w_all) + parseFloat(single_w)
            cargo_description_all = cargo_description_all + ',' + cargo_des;

            volume_all = volume_all.toFixed(2)
            gw_all = gw_all.toFixed(2)
            single_w_all = single_w_all.toFixed(2)
        }) 
        $('.inp_quantity').val(package_all)
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

    cal_vgm: async function (e) {
        let data_tare_weight = $(e).closest('tr').find('.inp_single_weight').val()
        let data_gross_weight = $(e).closest('tr').find('.inp_gw').val()

        data_tare_weight = data_tare_weight === NaN ? 0 : data_tare_weight;
        data_gross_weight = data_gross_weight === NaN ? 0 : data_gross_weight;

        
        data_tare_weight = parseFloat(data_tare_weight)
        data_gross_weight = parseFloat(data_gross_weight)

        let data_vgm = data_tare_weight + data_gross_weight
        $(e).closest('tr').find('.inp_vgm').val(data_vgm)
    },

    add_hbl: async function () {

        let html_add_hbl = `
        <div class="form-group row" >
                    <label class="control-label col-sm-3 col-lg-3 align-self-center " maxlength="100">H B/L:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <div class="row">
                            <div class="col-sm-11 col-md-10 col-lg-11">
                                <input type="text" class="form-control form-control-sm inp_hbl hbl_sel_data">
                            </div>
                            <div class="col-sm-1 col-md-2 col-lg-1 text-end">
                                <button class="btn btn-outline-danger btn-sm " onclick="function_sub_job_detail.delete_data_hbl(this)"><i class="bi bi-trash text-danger" "></i></button>
                            </div>
                        </div>
                    </div>
                </div>
        `;
        $('.hbl_added').append(html_add_hbl)
    },

    generate_job: async function () {

        let data_type_gen = $('.inp_type_generate').val()
        if (data_type_gen == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select type before generate.',
            })
        } else {
            let data_month = $('.inp_month_check').val()
            let data_type = $('.inp_type_generate').val()

            let data_year = data_month.substr(0, 4)
            let data_monthly = data_month.substr(5, 3)
            let full_my = data_year + data_monthly;

            let res_data = await this.ajax_request_generate_job(full_my)

            let job_cal = '';
            if (res_data == "0 results") {
                job_cal = full_my + "000";
            } else {
                job_cal = res_data.substr(1)
            }

            job_cal = parseFloat(job_cal)
            job_cal = job_cal + 1

            let text_job = data_type + (job_cal);
            $('.inp_jobnumber').val(text_job)
        }


    },

    ajax_request_generate_job: function (full_my) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/request_generate_job.php",
                data: {
                    full_my: full_my,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    get_to_copy: async function (e) {
        let dataToCopy = $(e).closest('.form-group').find('.inp_copy_data :selected').text()
        var copyTextArea = $("<textarea/>");// สร้าง element textarea สำหรับใช้คัดลอกข้อมูล
        copyTextArea.text(dataToCopy);// กำหนดข้อมูลให้กับ textarea
        $("body").append(copyTextArea);// นำ textarea ไปแทรกใน DOM (เปิด textarea ในหน้าจอ)
        copyTextArea.select();// เลือกข้อความใน textarea
        document.execCommand("copy");// คัดลอกข้อมูล
        copyTextArea.remove();// นำ textarea ออกจาก DOM (ปิด textarea ในหน้าจอ)
    },


    delete_data_hbl: async function (e) {
        let data_id_hbl = $(e).closest('.form-group').attr('id_hbl');

        if (data_id_hbl != undefined) {
            let obj_data = {
                data_id_hbl: data_id_hbl,
            }
            this.arr_delete_hbl.push(obj_data)
        }


        $(e).closest('.form-group').remove()
    },


    load_save_data: async function () {

        if ($('#add_modal_load_data').length >= 1) {
            $('#add_modal_load_data').remove()
        }

        let res_data = await this.ajax_request_job_load();

        data_modal_detail_load = res_data;

        let tbody_data_html = '';
        $.each(res_data['load_data'], function (i, v) {
            let id_number = v['ID'] ? v['ID'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let client_name = v['client_name'] ? v['client_name'] : '';
            let shipper_name = v['shipper_name'] ? v['shipper_name'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let notify_name = v['notify_name'] ? v['notify_name'] : '';
            let st_name = v['st_name'] ? v['st_name'] : '';
            let carrier_name = v['carrier_name'] ? v['carrier_name'] : '';
            let port_of_receipt_name = v['port_of_receipt_name'] ? v['port_of_receipt_name'] : '';
            let port_of_loading_name = v['port_of_loading_name'] ? v['port_of_loading_name'] : '';
            let ts_port_name = v['ts_port_name'] ? v['ts_port_name'] : '';
            let port_of_discharge_name = v['port_of_discharge_name'] ? v['port_of_discharge_name'] : '';
            let port_of_delivery_name = v['port_of_delivery_name'] ? v['port_of_delivery_name'] : '';
            let final_destination = v['final_destination'] ? v['final_destination'] : '';
            let booking_agent_name = v['booking_agent_name'] ? v['booking_agent_name'] : '';
            let delivery_place = v['delivery_place'] ? v['delivery_place'] : '';
            let remark = v['remark'] ? v['remark'] : '';

            tbody_data_html += `
            <tr>
                <td><button class="btn btn-outline-primary btn-sm rounded" onclick="function_sub_job_detail.select_load_data(${id_number})">Select</button></td>
                <td>${job_number}</td>
                <td>${client_name}</td>
                <td>${shipper_name}</td>
                <td>${consignee_name}</td>
                <td>${notify_name}</td>
                <td>${st_name}</td>
                <td>${carrier_name}</td>
                <td>${port_of_receipt_name}</td>
                <td>${port_of_loading_name}</td>
                <td>${ts_port_name}</td>
                <td>${port_of_discharge_name}</td>
                <td>${port_of_delivery_name}</td>
                <td>${final_destination}</td>
                <td>${booking_agent_name}</td>
                <td>${delivery_place}</td>
                <td>${remark}</td>
            </tr>
            `;
        })



        html = `
            <div class="modal fade" id="add_modal_load_data" >
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <div class="row col-12">
                                <div class="col-3"><h4 class="modal-title">load document</h4></div>
                                <div class="col-8">
                                    <div class="row">
                                    <div class="col-2"><label>serach : </label></div>
                                    <div class="col-7"><input type="text" class="form-control form-control-sm inp_searching_data_job"></div>
                                    <div class="col-3"><button class="btn btn-sm btn-outline-primary" onclick="function_sub_job_detail.searching_data_on_load_job()">search</button></div>
                                    </div>
                                </div>
                                <div class="col-1 text-end"><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                            </div>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body ">
                            <div class="bd-example table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Job number</th>
                                        <th>Client</th>
                                        <th>Shipper</th>
                                        <th>Consignee</th>
                                        <th>Notify</th>
                                        <th>shipment terms</th>
                                        <th>Carrier</th>
                                        <th>Port of Receipt</th>
                                        <th>Port of Loading</th>
                                        <th>T/S Port</th>
                                        <th>Port of Discharge</th>
                                        <th>Port of Delivery</th>
                                        <th>Final destinatino</th>
                                        <th>Booking agent</th>
                                        <th>Delivery place</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody_job_number_select">
                                    ${tbody_data_html}
                                </tbody>
                            </table>
                            </div>
                        </div>
                
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                
                    </div>
                </div>
            </div>`

        $('body').append(html)
        $('#add_modal_load_data').modal('show')
    },

    searching_data_on_load_job : async function(){
        let data_seraching_job = $('.inp_searching_data_job').val()
        let tbody_data_html = '';
        let res_data = await this.ajax_request_job_load(data_seraching_job);
        $('.tbody_job_number_select').html('')

        $.each(res_data['load_data'], function (i, v) {
            let id_number = v['ID'] ? v['ID'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let client_name = v['client_name'] ? v['client_name'] : '';
            let shipper_name = v['shipper_name'] ? v['shipper_name'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let notify_name = v['notify_name'] ? v['notify_name'] : '';
            let st_name = v['st_name'] ? v['st_name'] : '';
            let carrier_name = v['carrier_name'] ? v['carrier_name'] : '';
            let port_of_receipt_name = v['port_of_receipt_name'] ? v['port_of_receipt_name'] : '';
            let port_of_loading_name = v['port_of_loading_name'] ? v['port_of_loading_name'] : '';
            let ts_port_name = v['ts_port_name'] ? v['ts_port_name'] : '';
            let port_of_discharge_name = v['port_of_discharge_name'] ? v['port_of_discharge_name'] : '';
            let port_of_delivery_name = v['port_of_delivery_name'] ? v['port_of_delivery_name'] : '';
            let final_destination = v['final_destination'] ? v['final_destination'] : '';
            let booking_agent_name = v['booking_agent_name'] ? v['booking_agent_name'] : '';
            let delivery_place = v['delivery_place'] ? v['delivery_place'] : '';
            let remark = v['remark'] ? v['remark'] : '';

            tbody_data_html += `
            <tr>
                <td><button class="btn btn-outline-primary btn-sm rounded" onclick="function_sub_job_detail.select_load_data(${id_number})">Select</button></td>
                <td>${job_number}</td>
                <td>${client_name}</td>
                <td>${shipper_name}</td>
                <td>${consignee_name}</td>
                <td>${notify_name}</td>
                <td>${st_name}</td>
                <td>${carrier_name}</td>
                <td>${port_of_receipt_name}</td>
                <td>${port_of_loading_name}</td>
                <td>${ts_port_name}</td>
                <td>${port_of_discharge_name}</td>
                <td>${port_of_delivery_name}</td>
                <td>${final_destination}</td>
                <td>${booking_agent_name}</td>
                <td>${delivery_place}</td>
                <td>${remark}</td>
            </tr>
            `;
        })
        $('.tbody_job_number_select').append(tbody_data_html)

    },


    select_load_data: async function (e) {
        
        $('#add_modal_load_data').modal('toggle')
        $.each(data_modal_detail_load['load_data'], async function (i, v) {
            let id_number = v['ID'] ? v['ID'] : '';
            let client_type = v['client_type'] ? v['client_type'] : '';
            let client_number = v['client_number'] ? v['client_number'] : '';
            let shipper_number = v['shipper_number'] ? v['shipper_number'] : '';
            let consignee_number = v['consignee_number'] ? v['consignee_number'] : '';
            let notify_type = v['notify_type'] ? v['notify_type'] : '';
            let notify_number = v['notify_number'] ? v['notify_number'] : '';
            let st_number = v['st_number'] ? v['st_number'] : '';
            let carrier_number = v['carrier_number'] ? v['carrier_number'] : '';
            let port_of_receipt_number = v['port_of_receipt_number'] ? v['port_of_receipt_number'] : '';
            let port_of_loading_number = v['port_of_loading_number'] ? v['port_of_loading_number'] : '';
            let ts_port_number = v['ts_port_number'] ? v['ts_port_number'] : '';
            let port_of_discharge = v['port_of_discharge'] ? v['port_of_discharge'] : '';
            let port_of_delivery_number = v['port_of_delivery_number'] ? v['port_of_delivery_number'] : '';
            let final_destination = v['final_destination'] ? v['final_destination'] : '';
            let booking_agent = v['booking_agent'] ? v['booking_agent'] : '';
            let delivery_place = v['delivery_place'] ? v['delivery_place'] : '';
            let remark = v['remark'] ? v['remark'] : '';
            let sale_support = v['sale_support'] ? v['sale_support'] : '';



            if (e == id_number) {

                if (client_type == '' && client_number == '') {
                    $(`.inp_client option[value=""]`).prop('selected', true)
                } else {
                    $(`.inp_client option[type_data="${client_type}"][value="${client_number}"]`).prop('selected', true)
                }

                if (notify_type == '' && notify_number == '') {
                    $(`.inp_notify_job_detail option[value=""]`).prop('selected', true)
                } else {
                    $(`.inp_notify_job_detail option[type_data="${notify_type}"][value="${notify_number}"]`).prop('selected', true)

                }

                $(`.inp_shipper option[value="${shipper_number}"]`).prop('selected', true)
                $(`.inp_consignee option[value="${consignee_number}"]`).prop('selected', true)

                $(`.inp_shipment option[value="${st_number}"]`).prop('selected', true)
                $(`.inp_carrier option[value="${carrier_number}"]`).prop('selected', true)
                $(`.inp_port_of_receipt option[value="${port_of_receipt_number}"]`).prop('selected', true)
                $(`.inp_port_of_loading option[value="${port_of_loading_number}"]`).prop('selected', true)
                $(`.inp_ts_port option[value="${ts_port_number}"]`).prop('selected', true)
                $(`.inp_port_of_discharge option[value="${port_of_discharge}"]`).prop('selected', true)
                $(`.inp_port_of_delivery option[value="${port_of_delivery_number}"]`).prop('selected', true)
                $(`.inp_finaldestination`).val(final_destination)
                $(`.inp_booking_agent option[value="${booking_agent}"]`).prop('selected', true)
                $(`.inp_delivery_place`).val(delivery_place)
                $(`.inp_remark`).val(remark)
                $(`.inp_sale_user option[value="${sale_support}"]`).prop('selected', true)

            }






        })




    },



    ajax_request_job_load: function (data_job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_job_load.php",
                data: {
                    data_job_number: data_job_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    generate_job_detail_document: async function (e) {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");
        window.open(`php/job_detail/create_pdf_generate_job_detail.php?job_number=${id_number}`, "_blank")
    },


    carrier_web : async function(){
        let data_val_search = $(`.inp_carrier`).val()
        let data = $(`.inp_carrier option[value="${data_val_search}"]`).attr('web_checl')
        $(`.btn_carrier_daata`).attr('href',data)
        
    },


    change_sale : async function(){
        let data_shipper = $('.inp_shipper').val()
        let data_user_sale = $(`.inp_shipper > option[value=${data_shipper}]`).attr('data_sale') != 'null'? $(`.inp_shipper > option[value=${data_shipper}]`).attr('data_sale') : '';

        $('.inp_sale_user').val(data_user_sale)
        // if(data_user_sale == 'null'){
        //     
        //     
        //     
        //     
        //     
        // }
    },

    change_job_number : async function(){
        
        let value_job_number = $('.inp_jobnumber').attr('disabled') ? '1' : '0'
        if(value_job_number == '1'){
            $('.inp_jobnumber').attr('disabled',false)
        }else{
            $('.inp_jobnumber').attr('disabled',true)
        }
    }
}

function checkDuplicateNames(arr) {
    var existingNames = {};
    var duplicateNames = [];

    for (var i = 0; i < arr.length; i++) {
        var currentName = arr[i].inp_container_number;
        if (existingNames[currentName] === undefined) {
            existingNames[currentName] = 1;
        } else {
            if (existingNames[currentName] === 1) {
                duplicateNames.push(currentName);
            }
            existingNames[currentName]++;
        }
    }

    return duplicateNames;
}

function checkDuplicatehbl(arr) {
    var existingNames = {};
    var duplicateNames = [];

    for (var i = 0; i < arr.length; i++) {
        var currentName = arr[i].hbl_data;
        if (existingNames[currentName] === undefined) {
            existingNames[currentName] = 1;
        } else {
            if (existingNames[currentName] === 1) {
                duplicateNames.push(currentName);
            }
            existingNames[currentName]++;
        }
    }

    return duplicateNames;
}

