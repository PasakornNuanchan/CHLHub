const function_sub_transport = {

    arr_delete_driver_transport: [],
    arr_delete_route_transport: [],

    // delete_row_table_container : async function(data){
    //     let tr_master = $(data).closest('tr')
    //     let get_container = tr_master.attr('container_id')

    //     if(get_container != ''){
    //         obj_delete_container = {
    //             raw_data_delete : get_container
    //         }
    //         this.arr_delete_container.push(obj_delete_container)
    //     }

    //     $(tr_master).remove()
    //     console.log(this.arr_delete_container)
    // },


    // get_data_all_page : async function (){
    //     let job_number = $('.inp_jobnumber').val()
    //     let booking_number = $('.inp_bookingnumber').val()
    //     let consignee = $('.inp_consignee').val()
    //     let shipper = $('.inp_shipper').val()
    //     let shipment = $('.inp_shipment').val()
    //     let remark = $('.inp_remark').val()
    //     let carrier = $('.inp_carrier').val()
    //     let port_of_receipt = $('.inp_port_of_receipt').val()
    //     let port_of_loading = $('.inp_port_of_loading').val()
    //     let ts_port = $('.inp_ts_port').val()
    //     let port_of_delivery = $('.inp_port_of_delivery').val()
    //     let mother = $('.inp_mother_vessel').val()
    //     let feeder = $('.inp_feeder_vessel').val()
    //     let etd = $('.inp_etd').val()
    //     let eta = $('.inp_eta').val()
    //     let inv = $('.inp_inv').val()
    //     let mbl = $('.inp_mbl').val()
    //     let hbl = $('.inp_hbl').val()
    //     let cargo_des = $('.inp_cargo_des').val()
    //     let cargo_type = $('.inp_cargo_type').val()
    //     let quantity = $('.inp_quantity').val()
    //     let gw = $('.inp_gw').val()
    //     let vol = $('.inp_vol').val()
    //     let remark_container = $('.inp_remark_container').val()
    //     let booking_agent = $('.inp_booking_agent').val()

    //     let arr_detail_save = []
    //     obj_detail_save = {
    //         job_number : job_number,
    //         booking_number : booking_number,
    //         consignee : consignee,
    //         shipper : shipper,
    //         shipment : shipment,
    //         remark : remark,
    //         carrier : carrier,
    //         port_of_receipt : port_of_receipt,
    //         port_of_loading : port_of_loading,
    //         ts_port : ts_port,
    //         port_of_delivery : port_of_delivery,
    //         mother : mother,
    //         feeder : feeder,
    //         etd : etd,
    //         eta : eta,
    //         inv : inv,
    //         mbl : mbl,
    //         hbl : hbl,
    //         cargo_des : cargo_des,
    //         cargo_type : cargo_type,
    //         quantity : quantity,
    //         gw : gw,
    //         vol : vol,
    //         remark_container : remark_container,
    //         booking_agent : booking_agent
    //     }

    //     arr_detail_save.push(obj_detail_save)

    //     let arr_detail_container = [];
    //     let obj_detail_container = {};

    //     $('.table_data_container > tbody > tr').each(function (e) {

    //         let container_id = $(this).attr('container_id')
    //         let container_type = $(".inp_container_type option:selected", this).val();
    //         let container_number = $('.inp_container_number',this).val();
    //         let cntw = $('.inp_cntr',this).val();
    //         let soc = $('.inp_soc',this).attr('checked') == "checked" ? '1' : '2';
    //         let ow = $('.inp_ow',this).attr('checked') == "checked" ? '1' : '2';
    //         let cy = $('.inp_cy',this).val();
    //         let rtn = $('.inp_rtn',this).val();

    //         obj_detail_container = {
    //             container_id : container_id,
    //             container_type : container_type,
    //             container_number : container_number,
    //             cntw : cntw,
    //             soc : soc,
    //             ow : ow,
    //             cy : cy,
    //             rtn : rtn,
    //         }

    //         arr_detail_container.push(obj_detail_container)

    //     });


    //         var currentURL = window.location.href;
    //         var url = new URL(currentURL);
    //         var id_number = url.searchParams.get("job_number");

    //     let res_return = await this.ajax_sent_data_raw(arr_detail_save,arr_detail_container,this.arr_delete_container,id_number)
    //     console.log(res_return);
    // },

    // ajax_sent_data_raw: function (arr_detail_save,arr_detail_container,delete_data,id_number) {
    //     return new Promise(function (resolve, reject) {
    //         $.ajax({
    //             type: "post",
    //             url: "php/job_detail/save_data_job_detail.php",
    //             data: {
    //                 arr_detail_save: arr_detail_save,
    //                 arr_detail_container : arr_detail_container,
    //                 delete_data : delete_data,
    //                 id_number : id_number
    //             },
    //             dataType: "json",
    //             success: function (res) {
    //                 resolve(res);
    //             },
    //         });
    //     });
    // },


    add_new_route: function () {
        //let get_last_route = 1;
        let html_new_route = '';
        let html_driver_data = '';

        let get_last_route = $('.transport_booking_detail > .card_transport').length
        get_last_route++;
        html_driver_data = `
        <div class="form-group mt-4 row data_driver_count">
            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Driver: </label>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm inp_driver_name" placeholder="name" maxlength="100">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm inp_driver_phone" placeholder="phone" maxlength="20">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm" placeholder="Plate">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <select class="form-select form-select-sm">
                                <option value="">-- select container --</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm" placeholder="Seal" disabled>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12">
                        <button class="bi bi-trash btn btn-outline-danger" onclick="function_sub_transport.delete_driver(this)"></button>
                    </div>
                </div>
            </div>
        </div>
        `;

        html_new_route = `
        <div class="card p-4 card_transport">
            <h5>Transport Booking Detail (route ${get_last_route})</h5>
            <div class="form-group mt-4 row">
                <label class="control-label col-sm-3 col-lg-3 align-self-center ">Supplier:</label>
                <div class="col-sm-9 col-md-5 col-lg-4">
                    <div class="ds_supplier">
                        ${data_sel_supplier}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Pickup Empty Container Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_peca" value="" list="" maxlength="200">
                        </div>
                        <datalist id="data_inp_peca" class="data_list_inp_peca">
                            ${setting_data_default.html_data_address_pick_container}
                        </datalist>
                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_pecar" value="" maxlength="200">
                        </div>
                    </div>
                </div>
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Google Maps Pickup Empty Container Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <input type="text" class="form-control form-control-sm inp_ggpeca" value="" maxlength="200">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Loading Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_pca" list="data_inp_pca" value="" maxlength="200">
                        </div>
                        <datalist id="data_inp_pca" class="data_list_inp_pca">
                        ${setting_data_default.html_data_address_load_container}
                        </datalist>
                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_pcar" value="" maxlength="200">
                        </div>
                    </div>
                </div>
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Google Maps Pickup Loading Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <input type="text" class="form-control form-control-sm inp_ggpca" value="" maxlength="200">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Delivery Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_doca" list="data_inp_doca" value="" maxlength="200">
                        </div>
                        <datalist id="data_inp_doca" class="data_list_inp_doca">
                        ${setting_data_default.html_data_address_delivery_container}
                        </datalist>
                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_docar" value="" maxlength="200">
                        </div>
                    </div>
                </div>
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Google Maps Delivery Container Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <input type="text" class="form-control form-control-sm inp_ggdoca" value="" maxlength="200">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Drop off Empty Containe Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_deca" value="data_inp_deca" maxlength="200">
                        </div>
                        <datalist id="data_inp_deca" class="data_list_inp_deca">
                        ${setting_data_default.html_data_address_return_container}
                        </datalist>

                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_decar" value="" maxlength="200">
                        </div>
                    </div>
                </div>
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Google Maps Drop off Empty Containe Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <input type="text" class="form-control form-control-sm inp_ggdeca" value="" maxlength="200">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Type Truck: *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <div class="ds_transport">
                            ${data_sel_truck}
                            </div>
                        </div>
                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_remark" value="" maxlength="100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Quantity: *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <input type="number" class="form-control form-control-sm inp_quantity" value="">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Budget: *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 ">
                            <input type="text" class="form-control form-control-sm inp_bg" value="">
                        </div>
                        <div class="col-lg-2 col-md-3 ">
                            <select class="form-select form-select-sm">
                                <option value="THB">THB</option>
                                <option value="USD">USD</option>
                                <option value="RMB">RMB</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-end float-end">
                <button class="btn btn-danger btn-sm" onclick="function_sub_transport.delete_route(this)"><i class="bi bi-trash"></i> del</button>
                <button class="btn btn-success btn-sm" onclick="function_sub_transport.save_transport()"><i class="bi bi-save"></i> save</button>
            </div>
        </div>
        `;

        $('.transport_booking_detail').append(html_new_route)

    },

    add_new_driver: function (data) {

        let html_new_driver = ``;
        let count_data_driver = $(`.data_driver${data} > .data_driver_count`).length
        count_data_driver++;
        html_new_driver = `
        <div class="form-group mt-4 row data_driver_count">
            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Driver: ${count_data_driver}</label>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <div class="row driver_detail">
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm inp_driver_name" placeholder="Name" maxlength="100">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm inp_driver_phone" placeholder="Phone" maxlength="20">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm inp_plate" placeholder="Plate">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <select class="form-select form-select-sm" onchange="function_sub_transport.change_seal(this)">
                                <option value="">-- select container --</option>
                                ${sub_transport.data_container_transport_driver_data_function}
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm inp_seal_transport" placeholder="Seal" disabled>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12">
                        <button class="bi bi-trash btn btn-outline-danger" onclick="function_sub_transport.delete_driver(this)"></button>
                    </div>
                </div>
            </div>
        </div>
        `;
        $(`.data_driver${data}`).append(html_new_driver)
    },

    delete_driver: function (e, a) {
        let obj_delete_driver_transport = {};

        if (a !== undefined) {
            obj_delete_driver_transport = {
                driver_id: a
            }
            this.arr_delete_driver_transport.push(obj_delete_driver_transport)
        }

        $(e).closest('.data_driver_count').remove();

    },

    delete_route: function (e, a) {
        let obj_delete_route_transport = {};

        if (a !== undefined) {
            obj_delete_route_transport = {
                route_id: a
            }
            this.arr_delete_route_transport.push(obj_delete_route_transport)
        }

        $(e).closest('.card_transport').remove();


    },

    change_seal: async function (e) {

        let data_find = $(e).val()
        let val_seal_set = '';
        $.each(sub_job_detail.data_container_for_transport, function (i, v) {
            if (data_find == v['ID']) {
                val_seal_set = v['seal_number']
            }
        })
        $(e).closest('.driver_detail').find('.inp_seal_transport').val(val_seal_set)
    },

    save_transport: async function () {
        arr_transport_detail = [];
        obj_transport_detail = {};

        $('.card_transport').each(function () {
            let transport_id = $(this).attr('transport_id')
            let supplier_id = $('#sel_supplier', this).val()
            let inp_peca = $('.inp_peca', this).val()
            let inp_pecar = $('.inp_pecar', this).val()
            let inp_pca = $('.inp_pca', this).val()
            let inp_pcar = $('.inp_pcar', this).val()
            let inp_doca = $('.inp_doca', this).val()
            let inp_docar = $('.inp_docar', this).val()
            let inp_deca = $('.inp_deca', this).val()
            let inp_decar = $('.inp_decar', this).val()
            let db_type_truck = $('#db_type_truck', this).val()
            let inp_remark = $('.inp_remark', this).val()
            let inp_quantity = $('.inp_quantity', this).val()
            let inp_bg = $('.inp_bg', this).val()
            let inp_cur = $('.inp_cur', this).val()
            let inp_ggpeca = $('.inp_ggpeca', this).val()
            let inp_ggpca = $('.inp_ggpca', this).val()
            let inp_ggdoca = $('.inp_ggdoca', this).val()
            let inp_ggdeca = $('.inp_ggdeca', this).val()

            let arr_container_transport = [];
            let arr_hbl_transport = [];
            $(this).find('.data_container_transport > button').each(function(){
                let id_number_container = $(this).attr('data_select_id')
                arr_container_transport.push(id_number_container)
            })

            $(this).find('.data_hbl_transport > button').each(function(){
                let id_number_hbl = $(this).attr('data_select_id')
                arr_hbl_transport.push(id_number_hbl)
            })

            let text_conatiner_transport = arr_container_transport.join(',')
            let text_hbl_transport = arr_hbl_transport.join(',')
            
            // data_hbl_transport
            // data_container_transport
            obj_transport_detail = {
                transport_id: transport_id,
                supplier_id: supplier_id,
                inp_peca: inp_peca,
                inp_pecar: inp_pecar,
                inp_pca: inp_pca,
                inp_pcar: inp_pcar,
                inp_doca: inp_doca,
                inp_docar: inp_docar,
                inp_deca: inp_deca,
                inp_decar: inp_decar,
                db_type_truck: db_type_truck,
                inp_remark: inp_remark,
                inp_quantity: inp_quantity,
                inp_bg: inp_bg,
                inp_cur: inp_cur,
                inp_ggpeca: inp_ggpeca,
                inp_ggpca: inp_ggpca,
                inp_ggdoca: inp_ggdoca,
                inp_ggdeca: inp_ggdeca,
                text_conatiner_transport : text_conatiner_transport,
                text_hbl_transport : text_hbl_transport,
            }

            arr_transport_detail.push(obj_transport_detail)
        })


        arr_driver_detail = [];
        obj_driver_detail = {};
        $('.data_driver_count').each(function () {
            let route_id = $(this).closest('.card_transport').attr('transport_id')
            let driver_id = $(this).attr('driver_id')
            let driver_name = $(`.inp_driver_name`, this).val()
            let driver_phone = $(`.inp_driver_phone`, this).val()
            let driver_plate = $('.inp_plate', this).val()
            let driver_container = $('.inp_select_container_transport', this).val()


            obj_driver_detail = {
                route_id: route_id,
                driver_id: driver_id,
                driver_name: driver_name,
                driver_phone: driver_phone,
                driver_plate: driver_plate,
                driver_container: driver_container
            }
            arr_driver_detail.push(obj_driver_detail)



        })


        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let res_data = await this.ajax_save_data(this.arr_delete_driver_transport, this.arr_delete_route_transport, arr_transport_detail, arr_driver_detail, id_number)


        if (res_data['arr_data_delete_transport'] == '1' || res_data['arr_data_driver_detail'] == '1' || res_data['arr_data_transport_detail'] == '1' || res_data['arr_delete_driver'] == '1') {
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

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        await sub_transport.first_post_data(id_number);
    },

    ajax_save_data: async function (arr_delete_driver_transport, arr_delete_route_transport, arr_transport_detail, arr_driver_detail, id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/save_data_transport.php",
                data: {
                    arr_delete_driver_transport: arr_delete_driver_transport,
                    arr_delete_route_transport: arr_delete_route_transport,
                    arr_transport_detail: arr_transport_detail,
                    arr_driver_detail: arr_driver_detail,
                    id_number: id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    generate_qr: async function (e,t) {
        // สร้าง QR code

        $('#add_moda').remove();
        $('#qrcode').html('')
        let a = "http://www.uat-chlop.com/chlhub/dashboard/transport_mode.php" + '?dsfkodsf=' + e+ '&fkosdf='+t;
        // สร้าง HTML ของ Modal
        var html = `
            <div class="modal fade" data_list="${e}" id="add_moda_transport_mode">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Generate Qr code</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body mx-auto text-center">
                            <div class="mx-auto text-center"  id="qrcode"></div>
                            <button class="btn btn-outline-secondary mt-3" style="border-radius:1300px;" dan="123" onclick="function_sub_transport.get_to_copy('${e}','${t}')"><i class="bi bi-clipboard"></i></button>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>`;

        // เพิ่ม HTML ของ Modal ไปยัง body
        $('body').append(html);
        // <input type="text" class=" form-control form-control-sm mt-3" value="${a}">

        // แสดง Modal
        $('#add_moda_transport_mode').modal('show');
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: a,
            width: 250,
            height: 250,
        });
    },

    get_to_copy: async function (e,t) {

        let dataToCopy = "http://www.uat-chlop.com/chlhub/dashboard/transport_mode.php" + "?dsfkodsf=" + e+ '&fkosdf='+t;
        var copyTextArea = $("<textarea/>");// สร้าง element textarea สำหรับใช้คัดลอกข้อมูล
        copyTextArea.text(dataToCopy);// กำหนดข้อมูลให้กับ textarea
        $("#add_moda_transport_mode").append(copyTextArea);// นำ textarea ไปแทรกใน DOM (เปิด textarea ในหน้าจอ)
        copyTextArea.select();// เลือกข้อความใน textarea
        document.execCommand("copy");// คัดลอกข้อมูล
        copyTextArea.remove();// นำ textarea ออกจาก DOM (ปิด textarea ในหน้าจอ)
    },


    open_url_gg: async function (e) {
        let data_gg = $(e).closest('.form-group').find('.gg_data').val();
        window.open(data_gg)
    },

    change_address: async function (e) {

        let list_name = $(e).attr('list');
        let val_data = $(e).val()
        // console.log(list_name)
        if (list_name == 'data_inp_peca') {
            let result = $.grep(setting_data_default.address_pick_container, function (data_a) { return data_a.pick_con_empty_address == val_data; });
            $('.inp_pecar').val(result[0]['pick_con_empty_remark'])
            $('.inp_ggpeca').val(result[0]['ggpick_con_empty_address'])
        } else if (list_name == 'data_inp_pca') {
            let result = $.grep(setting_data_default.address_load_container, function (data_a) { return data_a.pick_con_address == val_data; });
            $('.inp_pcar').val(result[0]['pick_con_remark'])
            $('.inp_ggpca').val(result[0]['ggpick_con_address'])

        } else if (list_name == 'data_inp_doca') {
            let result = $.grep(setting_data_default.address_delivery_container, function (data_a) { return data_a.drop_con_address == val_data; });
            $('.inp_docar').val(result[0]['drop_con_remark'])
            $('.inp_ggdoca').val(result[0]['ggdrop_con_address'])
        } else if (list_name == 'data_inp_deca') {
            let result = $.grep(setting_data_default.address_return_container, function (data_a) { return data_a.drop_con_empty_address == val_data; });
            $('.inp_decar').val(result[0]['drop_con_empty_remark'])
            $('.inp_ggdeca').val(result[0]['drop_con_empty_address'])
        }


    },


    generate_transport: async function (e) {

        let arr_select = []
        
        $('.hbl_sel_data').each(function (i, v) {
            let data = $(this).val();

            let obk_select = {
                value : data,
                label : data,
            }
            arr_select.push(obk_select)

        })
       

        let inputOptions = arr_select.reduce((obj, item) => {
            obj[item.value] = item.label
            return obj
        }, {})

        let { value: selectedFruit } = await Swal.fire({
            title: 'Select hbl',
            input: 'select',
            inputOptions: inputOptions,
            inputPlaceholder: 'Please select your data',
            showCancelButton: true,
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value !== '') {
                        resolve()
                    } else {
                        resolve('คุณต้องเลือกผลไม้')
                    }
                })
            }
        })

        if (selectedFruit) {
            let selectedFruitLabel = arr_select.find(hbl => hbl.value === selectedFruit).label
            var currentURL = window.location.href;
            var url = new URL(currentURL);
            var id_number = url.searchParams.get("job_number");
            let h_data = $(e).closest('.card').attr('transport_id')
            window.open(`php/job_detail/create_pdf_generate_transport.php?job_number=${id_number}&transport_number=${h_data}&lskdhblf=${selectedFruitLabel}`, "_blank")    
        }
    },



    select_hbl_data_transport : async function(e){
        let val_this_data = $(e).find(':selected').val()
        let val_this_data_text = $(e).find(':selected').text()
        if(val_this_data != ''){
            html_data_badge_hbl = `<button class="btn btn-sm btn-outline-danger m-2 hbl_data_selected" data_select_id="${val_this_data}" onclick="function_sub_transport.delete_hbl_data_transport(this)" style="zoom:90%">${val_this_data_text} <i class="bi bi-trash "></i></button>`
            // $('.data_hbl_transport').append(html_data_badge_hbl)
            $(e).closest('.card').find('.data_hbl_transport').append(html_data_badge_hbl)
        }
        $(e).val('')
    },

    delete_hbl_data_transport : async function(e){
        $(e).remove()
    },

    select_container_data_transport : async function(e){
        let val_this_data = $(e).find(':selected').val()
        let val_this_data_text = $(e).find(':selected').text()
        if(val_this_data != ''){
            html_data_badge_hbl = `<button class="btn btn-sm btn-outline-danger m-2 container_data_selected" data_select_id="${val_this_data}" onclick="function_sub_transport.delete_container_data_transport(this)" style="zoom:90%">${val_this_data_text} <i class="bi bi-trash "></i></button>`
            // $('.data_hbl_transport').append(html_data_badge_hbl)
            $(e).closest('.card').find('.data_container_transport').append(html_data_badge_hbl)
        }
        $(e).val('')
    },

    delete_container_data_transport : async function(e){
        $(e).remove()
    },
}