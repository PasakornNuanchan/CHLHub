const transport_sub_driver_container = {
    route_driver : '' ,
    container_for_driver : '',
    ajax_set_preview_data: function (job_number) {
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



        let res_data = await transport_sub_driver_container.ajax_set_preview_data(job_number);
        console.log(res_data)

        let route_driver = $('.sel-route-driver').parent().html();
        let container_for_driver = $('.sel-container-for-driver').parent().html();

        transport_sub_driver_container.route_driver = route_driver
        transport_sub_driver_container.container_for_driver = container_for_driver
        

        html_driver = '';
        num_driver = 1;
        $('.driver-part-add').html('');
        let num = '1';
        if (res_data['driver'] != "0 result") {
            $.each(res_data['driver'], async function (i, v) {


                if (driver_n = v['Driver_name'] != undefined) {
                    driver_name_val = v['Driver_name'];
                } else {
                    driver_name_val = "";
                }

                if (phone_n = v['phone_number'] != undefined) {
                    phone_number_val = v['phone_number'];
                } else {
                    phone_number_val = "";
                }
                if (container_n = v['container_number'] != "") {
                    container_number_val = v['container_number']
                } else {
                    container_number_val = "";
                }
                if (seal_n = v['seal_number'] != "") {
                    seal_number_val = v['seal_number'];
                } else {
                    seal_number_val = "";
                }

                if (num == 1) {
                    del_driver_dis = `<button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="transport.push_del_driver(${v['ID']});" disabled><i class="bi bi-dash-lg"></i> Delete Driver</button>`;
                } else {
                    del_driver_dis = `<button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="transport.push_del_driver(${v['ID']});" ><i class="bi bi-dash-lg"></i> Delete Driver</button>`;
                }

                html_driver = `
            <div class="driver-part-del driver-part-del${v['ID']}" driver-part-del=${v['ID']}>
                <div class="card-body" >
                    <h5>Driver (person ${num_driver})</h5>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center ">Route number:</label>
                        <div class="col-md-8 col-lg-4">
                            <div class="db-sel-route db-sel-route${i}">
                           ${route_driver}
                           </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2">Driver name:</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control inp-driver_name_val" value="${driver_name_val}" >
                                </div>
                                <label class="control-label col-sm-2 col-md-4 col-lg-2   ">Phone Number :</label>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" class="form-control inp-driver_phone_val" value="${phone_number_val}" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2   ">Container number:</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="db-sel-route db-sel-con_drive${i}">
                            ${container_for_driver}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2   ">Seal number:</label>
                        <div class="col-sm-9 col-lg-9">   
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <input type="input" class="form-control form-control-sm inp-seal_number_driver" value="${seal_number_val}" readonly>    
                                </div>
                                <div class="col-sm-2 col-md-4 col-lg-2">
                                    ${del_driver_dis}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            `;

                num++;
                num_driver++;
                await $('.driver-part-add').append(html_driver);
                $(`.db-sel-route${i} > select`).val(v['route_id']);
                $(`.db-sel-con_drive${i} > select`).val(v['container_id']);
            });
        }else{
            await transport.adddriverhtml();
        }
    },
};

