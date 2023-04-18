const transport_sub_transport = {
    html_sel_supplier: '',
    html_sel_cur: '',
    html_sel_truck: '',
    ajax_set_preview_data: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/set_data_transport.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_set_data_driver: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/set_data_driver.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },



    set_preview_data: async function (job_number) {
        let res_data = await transport_sub_transport.ajax_set_preview_data(job_number);
        let res_data_driver = await transport_sub_transport.ajax_set_data_driver(job_number);
        console.log(res_data)
        console.log(res_data_driver)

        //get transport page
        route = 1;

        let html_tran_sel = '';
        let route_truck = '1';
        if (res_data['tran'] != "0 results") {
            $.each(res_data['tran'], function (i, k) {
                html_tran_sel += `
            <option value="${k['ID']}">Route ${route_truck} ${k['transport_sup_name']} / ${k['truck_quantity']} ${k['truck_name']}</option>
            `;
                route_truck++;
            })
            $('.sel-route-driver').append(html_tran_sel);
        }

        let html_select_supplier = $('.sel-supplier').parent().html();
        let html_select_cur = $('.sel_cur').parent().html();
        let html_select_truck = $('.sel-type_truck').parent().html();


        //console.log(transport.cont_global)
        html_sel_container_driver = '';
        if (transport.cont_global != "0 results") {
            $.each(transport.cont_global, function (i, k) {
                html_sel_container_driver += `
                <option value="${k['ID']}">${k['container_type']} ${k['container_number']}</option>
                `;
            })

        }

        this.sel_cont_driver = html_sel_container_driver

        transport_sub_transport.html_sel_supplier = html_select_supplier
        transport_sub_transport.html_sel_cur = html_select_cur
        transport_sub_transport.html_sel_truck = html_select_truck
        // transport
        $('.add-card-transport').html('');
        let html_transport = '';

        if (res_data['tran'] != "0 results") {
            $.each(res_data['tran'], async function (i, v) {

                let arr_tran_temp = {}
                let arr_tran = []

                let pcea = v['pick_con_empty_address'] || '';
                let pcer = v['pick_con_empty_remark'] || '';
                let pca = v['pick_con_address'] || '';
                let pcr = v['pick_con_remark'] || '';
                let dca = v['drop_con_address'] || '';
                let dcr = v['drop_con_remark'] || '';
                let dcea = v['drop_con_empty_address'] || '';
                let dcer = v['drop_con_empty_remark'] || '';
                let sldt = v['sent_line_datetime'] || '';
                let scf = v['sup_confirm'] || '';
                let bud = v['budget'] || '';
                let type_truck = !!v['type_truck'] ? v['type_truck'] : '';
                let remark = v['remark'] || '';

                let sup_n = !!v['sup_number'] ? v['sup_number'] : '';
                let cur_n = !!v['cur'] ? v['cur'] : '';
                let truck_quantity = !!v['truck_quantity'] ? v['truck_quantity'] : '';

                if (route == 1) {
                    sql_del_hide = `<button class="btn btn-danger rounded-pill btn-sm" onclick="transport.push_del_transport(${v['ID']});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" disabled><i class="bi bi-check-square"></i> Delete </button>`;
                } else {
                    sql_del_hide = `<button class="btn btn-danger rounded-pill btn-sm" onclick="transport.push_del_transport(${v['ID']});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Delete </button>`
                }
                let html_driver = '';
                
                if (res_data_driver['driver'] != null) {


                    $.each(res_data_driver['driver'][v['ID']], async function (i1, v1) {
                        let cont_id = v1['container_id'];
                        html_driver += `
                <div class="driver_transport driver_transport${v['ID']}" driver_transport_no = ${v['ID']} driver_id = ${v1['ID']}>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Driver name:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" class="form-control form-control-sm inp_driver_name" value="${v1['Driver_name']}" >
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center mb-0">Phone number :</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control form-control-sm inp_phone_number " value="${v1['phone_number']}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Container number:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="db_sel_container db_sel_container">
                                    <select class="form-select form-select-sm sel_container_driver${i}${i1} inp_container_number" onchange="transport.driver_seal_number_change(this)">
                                        <option value="">plese select container</option>
                                        ${html_sel_container_driver}
                                    </select>
                                </div>
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center mb-0">Seal number :</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control form-control-sm inp_seal_number" value="${v1['seal_number']}" readonly>
                            </div>
                            <div class="col-lg-2">
                            <button class="btn btn-danger rounded-pill btn-sm" onclick="transport.push_del_driver(${v1['ID']})" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Delete </button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                    `;
                        arr_tran_temp = {
                            main: i,
                            sub_main: i1,
                            data_sel: v1['container_id'],
                            card_tran: v['ID']
                        }
                        arr_tran.push(arr_tran_temp)
                    })
                }


                html_transport = `
        <div class="card-transport card-transport${v['ID']}" card-transport="${v['ID']}" >
            <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Booking Transport Detail (Route ${route})</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Supplier:</label>
                    <div class="col-sm-3">
                        <div class="db-sel-sup db-sel-sup${i}">
                            ${html_select_supplier}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Pickup Empty Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_emp" value="${pcea}" >
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-1 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_emp_remark" value="${pcer}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Pickup Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_con" value="${pca}" >
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-1 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_con_remark" value="${pcr}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Drop off Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_con" value="${dca}" >
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-1 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_con_reamrk" value="${dcr}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Drop off Empty Containe Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_emp" value="${dcea}" >
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-1 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_emp_remark" value="${dcer}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Type Truck:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <div class="db-sel-truck db-sel-truck${i}">
                                    ${html_select_truck}
                                </div>
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-1 align-self-center ">Remark</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-remark_truck" value="${remark}"> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Truck Quantity:</label>
                    <div class="col-sm-3 col-lg-1">
                        <input type="number" class="form-control form-control-sm inp-truck_quantity" style="text-align:right;" value="${truck_quantity}">
                    </div>
                </div>       
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-3">Budget:</label>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="row">
                            <div class="col-lg-2 col-md-3">
                                <input type="number" style="text-align:right;" class="form-control form-control-sm inp-budget" value="${bud}" >
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="db-sel-cur db-sel-cur${i}">
                                    ${html_select_cur} 
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="mb-4">
                <h4 class="mb-4">Driver</h4>
                <div class="add_html_driver add_html_driver${v['ID']} add_html_route${route}">
                ${html_driver}
                </div>
                <button type="button" class="btn btn-soft-secondary col-lg-12" onclick="transport.add_driver_fn(this,'${route}','${v['ID']}')" >Add driver</button>
                
                <hr class="mb-4">
                <h4 class="mb-4">Supplier detail</h4>
                
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Supplier Confirm DateTime :</label>
                    <div class="col-sm-3 col-lg-3">
                        <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${scf}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="row-lg-11">
                        <div style="float: right">
                            ${sql_del_hide}
                            <button class="btn btn-primary rounded-pill btn-sm" onclick="transport.push_action_save_transport(${v['ID']});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>    
                `;
                route++;

                await $('.add-card-transport').append(html_transport);
                $(`.db-sel-sup${i} > select`).val(sup_n);
                $(`.db-sel-cur${i} > select`).val(cur_n);
                $(`.db-sel-truck${i} > select`).val(type_truck);
                $.each(arr_tran, async function (i, v) {
                    let data_sel = (v['data_sel'])
                    await $(`.sel_container_driver${v['main']}${v['sub_main']} `).val(data_sel)
                })


            });

        } else {
            transport.addtransporthtml()

        }


    },


};



