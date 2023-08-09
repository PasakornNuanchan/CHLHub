const sub_transport = {
    data_container_transport_driver_data_function : '',
    first_post_data: async function (data) {
        let res_data = await this.ajax_request_first(data);

        console.log(res_data)        
        
        var data_container_transport_driver = '';
        $.each(sub_job_detail.data_container_for_transport,function(i,v){
            data_container_transport_driver += `<option value="${v['ID']}">No.${i} ${v['container_number']} </option>`;
        })
        this.data_container_transport_driver_data_function = data_container_transport_driver;
        

        data_sel_supplier = $('#sel_supplier').parent().html()
        data_sel_truck = $('#db_type_truck').parent().html()
        $('.transport_booking_detail').html('');
        
        if (res_data['get_route_data'] != "0 results") {

            $.each(res_data['get_route_data'], function (i, v) {

                i++;
                let html_driver_data = ``;

                let tq = v['truck_quantity'] ? v['truck_quantity'] : '';
                let bg = v['budget'] ? v['budget'] : '';
                

                if (res_data['get_contact'] == null) {
                    html_driver_data = `
                    <div class="form-group mt-4 row data_driver_count">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Driver: 1</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row driver_detail">
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm inp_driver_name" placeholder="Name" maxlength="100">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm inp_driver_phone" placeholder="Phone" maxlength="20">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm inp_plate" placeholder="Plate" maxlength="20">
                                </div>
                                <div class="col">
                                    <select class="form-select form-select-sm inp_select_container_transport" onchange="function_sub_transport.change_seal(this)">
                                            <option value="">-- select container --</option>
                                            ${data_container_transport_driver}
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm inp_seal_transport" placeholder="Seal" disabled>
                                </div>
                                <div class="col">
                                    <button class="bi bi-trash btn btn-outline-danger" onclick="function_sub_transport.delete_driver(this)"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                        `;
                } else {
                    $.each(res_data['get_contact'][v['ID']], function (i1, v1) {
                        i1++;
                        let id_number = v1['ID'] ? v1['ID'] : '';
                        let name_data = v1['Driver_name'] ? v1['Driver_name'] : '';
                        let phone_number = v1['phone_number'] ? v1['phone_number'] : '';
                        let plate_number = v1['plate_number'] ? v1['plate_number'] : '';
                        let container_id = v['container_id'] ? v['container_id'] : '';
                        
                        html_driver_data += `
                        <div class="form-group mt-4 row data_driver_count" driver_id="${v1['ID']}">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Driver: ${i1}</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <div class="row driver_detail driver_detail${i}">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_driver_name" placeholder="Name" value="${name_data}" maxlength="100">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_driver_phone" placeholder="Phone" value="${phone_number}" maxlength="20">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_plate" placeholder="Plate" value="${plate_number}">
                                    </div>
                                    <div class="col select_transport${i}">
                                        <select class="form-select form-select-sm inp_select_container_transport inp_select_container_transport${id_number}" onchange="function_sub_transport.change_seal(this)">
                                            <option value="">-- select container --</option>
                                            ${data_container_transport_driver}
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_seal_transport" placeholder="Seal" disabled>
                                    </div>
                                    <div class="col">
                                        <button class="bi bi-trash btn btn-outline-danger" onclick="function_sub_transport.delete_driver(this,'${v1['ID']}')"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `;
                    })

                }


                let html_transport_data = ``;
                html_transport_data = `
                <div class="card p-4 card_transport " transport_id=${v['ID']}>
                    <h5 route="${i}">Transport Booking Detail (route ${i})</h5>
                    <div class="form-group mt-4 row">
                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Supplier:</label>
                        <div class="col-sm-9 col-md-5 col-lg-4">
                            <div class="ds_supplier${i} ds_supplier">
                                ${data_sel_supplier}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Pickup Empty Container Address *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_peca" value="${v['pick_con_empty_address']}" maxlength="200">
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_pecar" value="${v['pick_con_empty_remark']}" maxlength="200">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Loading Address *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_pca" value="${v['pick_con_address']}" maxlength="200">
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_pcar" value="${v['pick_con_remark']}" maxlength="200">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Delivery Container Address *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_doca" value="${v['drop_con_address']}" maxlength="200">
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_docar" value="${v['drop_con_remark']}" maxlength="200">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Drop off Empty Containe Address *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_deca" value="${v['drop_con_empty_address']}" maxlength="200">
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_decar" value="${v['drop_con_empty_remark']}" maxlength="200">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Type Truck: *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <div class="ds_transport${i}">
                                    ${data_sel_truck}
                                    </div>
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_remark" value="${v['remark']}" maxlength="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Quantity: *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="number" class="form-control form-control-sm inp_quantity" value="${tq}" maxlength="6">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Budget: *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 ">
                                    <input type="number" class="form-control form-control-sm inp_bg" value="${bg}">
                                </div>
                                <div class="col-lg-2 col-md-3 ">
                                    <select class="form-select form-select-sm inp_cur inp_cur${i}">
                                        <option value="THB">THB</option>
                                        <option selected value="USD">USD</option>
                                        <option value="RMB">RMB</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Driver</h5>
                    <div class="data_driver data_driver${i}">
                    ${html_driver_data}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-outline-primary btn-sm col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12" onclick="function_sub_transport.add_new_driver(${i})"> add new driver</button>
                    </div>
                    <div class="form-group text-end float-end">
                        <button class="btn btn-danger btn-sm btn_delete_transport" onclick="function_sub_transport.delete_route(this,'${v['ID']}')"><i class="bi bi-trash"></i> del</button>
                        <button class="btn btn-success btn-sm" onclick="function_sub_transport.save_transport();"><i class="bi bi-save"></i> save</button>
                    </div>
                </div>
                `;

                



                
                $('.transport_booking_detail').append(html_transport_data)
                console.log(html_driver_data)
                if(i==1){
                    $('.btn_delete_transport').remove()
                }
                $(`.ds_supplier${i} > select`).val(v['sup_number'])
                $(`.ds_transport${i}`).val(v['type_truck'])
                $(`.inp_cur${i}`).val(v['cur'])

                $.each(res_data['get_contact'][v['ID']], async function (i1, v1) {                    
                    console.log(i+'_'+i1)
                    let container_id = v1['container_id'] ? v1['container_id'] : '';
                    let id_number = v1['ID'] ? v1['ID'] : '';
                    $(`.inp_select_container_transport${id_number}`).val(container_id)
                    

                    $.each(sub_job_detail.data_container_for_transport,async function(i2,v2){
                        if(v2['ID'] == container_id){
                            $(`.inp_select_container_transport${id_number}`).closest('.driver_detail').find('.inp_seal_transport').val(v2['seal_number'])
                        }
                    })

                })
            })
            

            // $.each(res_data['get_route_data'], function (i, v) {
            //     $.each(res_data['get_contact'][v['ID']], function (i1, v1) {
            //         let container_id = v1['container_id'] ? v1['container_id'] : '';
            //         console.log(container_id)
            //         console.log($(`.driver_detail > .select_transport `).find(`.inp_select_container_transport`))
            //     })
            // })

        } else {
            let html_driver_data = ``;
            // html_driver_data = `
            //         <div class="form-group mt-4 row data_driver_count">
            //             <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Driver: 1</label>
            //             <div class="col-sm-9 col-md-9 col-lg-9">
            //                 <div class="row">
            //                     <div class="col-lg-2 col-md-3 ">
            //                         <input type="text" class="form-control form-control-sm inp_driver_name" placeholder="name">
            //                     </div>
            //                     <div class="col-lg-2 col-md-3 ">
            //                         <input type="text" class="form-control form-control-sm inp_driver_phone" placeholder="phone">
            //                     </div>
            //                 </div>
            //             </div>
            //         </div>
            //             `; 

            let html_transport_data = ``;
            html_transport_data = `
                <div class="card p-4 card_transport " >
                    <h5>Transport Booking Detail (route 1)</h5>
                    <div class="form-group mt-4 row">
                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Supplier:</label>
                        <div class="col-sm-9 col-md-5 col-lg-4">
                            <div class="ds_supplier ds_supplier">
                                ${data_sel_supplier}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Pickup Empty Container Address *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_peca" maxlength="200">
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_pecar" maxlength="200">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Loading Address *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_pca" maxlength="200">
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_pcar" maxlength="200">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center"Delivery Container Address *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_doca" maxlength="200">
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_docar" maxlength="200">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Drop off Empty Containe Address *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_deca" maxlength="200">
                                </div>
                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                <div class="col-lg-5 col-md-5 ">
                                    <input type="text" class="form-control form-control-sm inp_decar" maxlength="200">
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
                                    <input type="text" class="form-control form-control-sm inp_remark" maxlength="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Quantity: *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="number" class="form-control form-control-sm inp_quantity">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Budget: *</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 ">
                                    <input type="number" class="form-control form-control-sm inp_bg">
                                </div>
                                <div class="col-lg-2 col-md-3 ">
                                    <select class="form-select form-select-sm inp_cur inp_cur">
                                        <option value="THB">THB</option>
                                        <option selected value="USD">USD</option>
                                        <option value="RMB">RMB</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-end float-end">
                        <button class="btn btn-danger btn-sm" onclick="function_sub_transport.delete_route(this)"><i class="bi bi-trash"></i> del</button>
                        <button class="btn btn-success btn-sm" onclick="function_sub_transport.save_transport();"><i class="bi bi-save"></i> save</button>
                    </div>
                </div>
                `;

            $('.transport_booking_detail').append(html_transport_data)
            // $(`.ds_supplier${i} > select`).val(v['sup_number'])
            // $(`.truck_select_list${i}`).val(v['type_truck'])
            // $(`.ds_transport${i}`).val(v['type_truck'])
            // $(`.inp_cur${i}`).val(v['cur'])
        }
        //$('.inp_select_container_transport').append(data_container_transport_driver)
        

    },

    ajax_request_first: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_transport.php",
                data: { data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


}