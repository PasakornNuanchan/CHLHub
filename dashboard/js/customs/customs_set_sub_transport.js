const customs_set_sub_transport = {

    ajax_set_preview_data: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/set_sub_transport.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    set_sub_transport_preview_data: async function (job_number) {
        let res_data = await customs_set_sub_transport.ajax_set_preview_data(job_number)
        console.log(res_data)
        // sub Page booking transport 
        html_transport = '';
        var html_select_supplier = $('.sel-supplier').parent().html();
        var html_select_cur = $('.sel-cur').parent().html();
        var html_select_type = $('.inp-type_truck').parent().html();

        route = 1;
        $('.card-transport-add').html('');
        $('.add_driver').html('');
        if (res_data['tran'] != "0 results") {
            $.each(res_data['tran'], async function (i, v) {

                budget = parseFloat(v['budget']);
                let pcea = v['pick_con_empty_address'] || '';
                let pcer = v['pick_con_empty_remark'] || '';
                let pca = v['pick_con_address'] || '';
                let pcr = v['pick_con_remark'] || '';
                let dca = v['drop_con_address'] || '';
                let dcr = v['drop_con_remark'] || '';
                let dcea = v['drop_con_empty_address'] || '';
                let dcer = v['drop_con_empty_remark'] || '';

                let scf = v['sup_confirm'] || '';
                let type_truck = !!v['type_truck'] ? v['type_truck'] : '';
                let remark = v['remark'] || '';

                let sup_n = !!v['sup_number'] ? v['sup_number'] : '';
                let truck_quantity = !!v['truck_quantity'] ? v['truck_quantity'] : '';

                let ID_test = v['ID'];
                html_driver_transport = '';
                let num_tran_driver = '1';

                if (res_data['transport_driver_arr'] != "0 results") {
                    $.each(res_data['transport_driver_arr'][ID_test], async function (i1, v1) {
                        html_driver_transport += `
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Driver ${num_tran_driver}:</label>
                    <div class="col-sm-9 col-lg-10">
                        <div class="row">
                            <div class="col-sm-3 col-lg-2">
                                <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${v1['Driver_name']}" readonly>
                            </div>
                            <div class="col-sm-3 col-lg-2">
                                <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${v1['phone_number']}" readonly>
                            </div>
                            <label class="control-label col-sm-2 col-lg-2 align-self-center mb-0">container_number :</label>
                            <div class="col-sm-3 col-lg-2">
                                <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${v1['container_number']}" readonly>
                            </div>
                            <label class="control-label col-sm-2 col-lg-2 align-self-center mb-0">seal_number :</label>
                            <div class="col-sm-3 col-lg-2">
                            <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${v1['seal_number']}" readonly>
                            </div>
                        </div>
                    </div>
                </div>`;
                        num_tran_driver++;
                    })
                }
                



                html_transport = `
        <div class="card-transport-del">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Booking Transport Detail (Route ${route})</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Supplier:</label>
                    <div class="col-sm-3">
                        <div class="db-sel-sup db_sel_sup${i}">
                            ${html_select_supplier}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Empty Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_emp" value="${pcea}" readonly>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_emp_remark" value="${pcer}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_con" value="${pca}" readonly>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_con_remark" value="${pcr}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_con" value="${dca}" readonly>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_con_reamrk" value="${dcr}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Empty Containe Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-5">
                                <input type="text" class="form-control form-control-sm inp-drop_emp" value="${dcea}" readonly>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_emp_remark" value="${dcer}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0"  >Type Truck:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="db-sel-truck db_sel_truck${i}">
                                    ${html_select_type}
                                </div>
                            </div>
                            <label class="control-label col-sm-2 col-lg-2 align-self-center ">Remark</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-remark_truck" value="${remark}" disabled> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Truck Quantity:</label>
                    <div class="col-sm-3 col-lg-1">
                        <input type="text" class="form-control form-control-sm inp-truck_quantity" style="text-align:right;" value="${truck_quantity}" disabled>
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-4">Driver detail</h4>
                <div class="form-group row">
                    ${html_driver_transport}
                </div>
                <hr class="mb-4">
                <h4 class="mb-4">Supplier detail</h4>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Supplier Confirm DateTime :</label>
                    <div class="col-sm-3 col-lg-3">
                        <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${scf}" readonly>
                    </div>
                </div>
            </div>
        </div>  
    </div>    
                `;
                route++;
                await $('.card-transport-add').append(html_transport);

                $(`.db_sel_sup${i} > select`).val(sup_n).attr('disabled', true);
                $(`.db_sel_truck${i} > select`).val(type_truck).attr('disabled', true);
            });


        }else{
            
            html_transport = `
            <div class="card">
                <div class="card-body">
                    <h4 align="center" style="color: hsl(0, 100%, 50%);">No information transport plese contact to transport team for booking transport</h4>
                </div>
            </div>
            

            `;

            await $('.card-transport-add').append(html_transport);
        }
    },





};
