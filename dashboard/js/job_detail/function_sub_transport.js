const function_sub_transport = {

     arr_delete_driver_transport : [],
     arr_delete_route_transport : [],

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
    

    add_new_route : function (){
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
                    <div class="col-lg-2 col-md-3 ">
                        <input type="text" class="form-control form-control-sm" placeholder="name">
                    </div>
                    <div class="col-lg-2 col-md-3 ">
                        <input type="text" class="form-control form-control-sm" placeholder="phone">
                    </div>
                    <div class="col-lg-1 col-md-3">
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
                            <input type="text" class="form-control form-control-sm inp_peca" value="">
                        </div>
                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_pecar" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Pickup Container Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_pca" value="">
                        </div>
                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_pcar" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Drop off Container Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_doca" value="">
                        </div>
                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_docar" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Drop off Empty Containe Address *</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_deca" value="">
                        </div>
                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                        <div class="col-lg-5 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_decar" value="">
                        </div>
                    </div>
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
                            <input type="text" class="form-control form-control-sm inp_remark" value="">
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

    add_new_driver : function (data){
        let html_new_driver = ``;
        let count_data_driver = $(`.data_driver${data} > .data_driver_count`).length
        count_data_driver++;
        html_new_driver = `
        <div class="form-group mt-4 row data_driver_count">
            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Driver: ${count_data_driver}</label>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-lg-2 col-md-3 ">
                        <input type="text" class="form-control form-control-sm inp_driver_name" placeholder="name">
                    </div>
                    <div class="col-lg-2 col-md-3 ">
                        <input type="text" class="form-control form-control-sm inp_driver_phone" placeholder="phone">
                    </div>
                    <div class="col-lg-1 col-md-3">
                        <button class="bi bi-trash btn btn-outline-danger" onclick="function_sub_transport.delete_driver(this)"></button>
                    </div>
                </div>
            </div>
        </div>
        `;
        $(`.data_driver${data}`).append(html_new_driver)
    },

    delete_driver : function (e,a){
    let obj_delete_driver_transport = {};

        if(a !== undefined){
            obj_delete_driver_transport = {
                driver_id : a
            } 
            this.arr_delete_driver_transport.push(obj_delete_driver_transport)       
        }

        $(e).closest('.data_driver_count').remove();
        
    },

    delete_route : function(e,a){
    let obj_delete_route_transport = {};

        if(a !== undefined){
            obj_delete_route_transport = {
                route_id : a
            }
            this.arr_delete_route_transport.push(obj_delete_route_transport)
        }

        $(e).closest('.card_transport').remove();
        
        
    },

    save_transport : async function(){
        arr_transport_detail = [];
        obj_transport_detail = {};
        
        $('.card_transport').each(function(){
            let transport_id = $(this).attr('transport_id')
            let supplier_id = $('#sel_supplier',this).val()
            let inp_peca = $('.inp_peca',this).val()
            let inp_pecar = $('.inp_pecar',this).val()
            let inp_pca = $('.inp_pca',this).val()
            let inp_pcar = $('.inp_pcar',this).val()
            let inp_doca = $('.inp_doca',this).val()
            let inp_docar = $('.inp_docar',this).val()
            let inp_deca = $('.inp_deca',this).val()
            let inp_decar = $('.inp_deca',this).val()
            let db_type_truck = $('#db_type_truck',this).val()
            let inp_remark = $('.inp_remark',this).val()
            let inp_quantity = $('.inp_quantity',this).val()
            let inp_bg = $('.inp_bg',this).val()
            let inp_cur = $('.inp_cur',this).val()

            obj_transport_detail = {
                transport_id : transport_id,
                supplier_id : supplier_id,
                inp_peca : inp_peca,
                inp_pecar : inp_pecar,
                inp_pca : inp_pca,
                inp_pcar : inp_pcar,
                inp_doca : inp_doca,
                inp_docar : inp_docar,
                inp_deca : inp_deca,
                inp_decar : inp_decar,
                db_type_truck : db_type_truck,
                inp_remark : inp_remark,
                inp_quantity : inp_quantity,
                inp_bg : inp_bg,
                inp_cur : inp_cur
            }

            arr_transport_detail.push(obj_transport_detail)
        })
        

        arr_driver_detail = [];
        obj_driver_detail = {};
        $('.data_driver_count').each(function(){
            let route_id = $(this).closest('.card_transport').attr('transport_id')
            let driver_id = $(this).attr('driver_id')
            let driver_name = $(`.inp_driver_name`,this).val()
            let driver_phone = $(`.inp_driver_phone`,this).val()
            if(driver_name != ''){
                obj_driver_detail = {
                    route_id : route_id,
                    driver_id : driver_id,
                    driver_name : driver_name,
                    driver_phone : driver_phone,
    
                }
                arr_driver_detail.push(obj_driver_detail)
            }
            
            
        })
        

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let res_data = await this.ajax_save_data(this.arr_delete_driver_transport,this.arr_delete_route_transport,arr_transport_detail,arr_driver_detail,id_number)
        

        if (res_data['arr_data_delete_transport'] == '1' ||res_data['arr_data_driver_detail'] == '1' ||res_data['arr_data_transport_detail'] == '1' ||res_data['arr_delete_driver'] == '1' ) {
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

    ajax_save_data : async function (arr_delete_driver_transport,arr_delete_route_transport,arr_transport_detail,arr_driver_detail,id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/save_data_transport.php",
                data: {
                    arr_delete_driver_transport: arr_delete_driver_transport,
                    arr_delete_route_transport : arr_delete_route_transport,
                    arr_transport_detail : arr_transport_detail,
                    arr_driver_detail : arr_driver_detail,
                    id_number : id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    
    
}