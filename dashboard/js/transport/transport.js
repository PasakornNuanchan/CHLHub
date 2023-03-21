const transport = {
    job_number_global: '',
    check_get: async function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        let get_job_number = getUrlParameter('job_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job_number == false ? null : get_job_number;
        let action = get_action == false ? null : get_action;
        transport.job_number_global = job_number;
        console.log(action);

        if (action == 'preview') {
            await transport_set_default.set_data_default();
            transport.set_preview_data(job_number);

        } else {

        }
    },
    ajax_set_preview_data: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/get_preview_data.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },



    set_preview_data: async function (job_number) {



        let res_data = await transport.ajax_set_preview_data(job_number);


        //head menu and breadcrumb
        $('.head-of-menu').html(`Transport`);
        $('.bcpage').html('');
        html_bdpage = `
    <li class="breadcrumb-item"><a href="CHL-transport-list.php" target="" style="color:white;">Transport List</a></li>
    <li class="breadcrumb-item active page-item" aria-current="page">Transport (Job number ${res_data['booking']['job_number']})</li>`;
        $('.bcpage').append(html_bdpage);
        $('[name = "data_table_list"] tbody').html('');



        console.log(res_data);

        job_global = res_data['booking']['job_number'];
        // container&driver

        rows_c = 1;
        $('[name = container-tbl] tbody').html('');

        $.each(res_data['cont'], function (i, v) {

            if ((container_type_check = v['container_type']) == null) {
                $('[name = container-tbl] tbody').html('');
            } else {
                sub_container = container_type_check.substring(2);
                if (sub_container == "GP" || sub_container == "U9") {
                    container_type_name = "General Purpose";
                } if (sub_container == "HC") {
                    container_type_name = "High Cube";
                } if (sub_container == "RH") {
                    container_type_name = "Refrigerated High Cube";
                } if (sub_container == "OT") {
                    container_type_name = "Open Top";
                } if (sub_container == "FR") {
                    container_type_name = "Flat Rack ";
                } if (sub_container == "RF") {
                    container_type_name = "Refrigerated Container";
                } if (sub_container == "TK") {
                    container_type_name = "ISO Tank";
                }

                if ((soc = v['soc']) == 1) {
                    soc = "checked";
                } else {
                    soc = "";
                } if ((ow = v['ow']) == 1) {
                    ow = "checked";
                } else {
                    ow = "";
                }
                let gw = parseFloat(v['gross_weight']);
                let cb = parseFloat(v['cbm']);
                gross_weight = gw ? gw.toFixed(2) : '';
                cbm = cb ? cb.toFixed(2) : '';
                

                let container_number = v['container_number']  ? v['container_number'] : '';
                let seal_number = v['seal_number']  ? v['seal_number'] : '';

                html_container = `
                <tr container_data_id=${v['ID']}>
                    <td>${rows_c}</td>
                    <td>${container_type_name} (${v['container_type']})</td>
                    <td><input type="text" class="form-control form-control-sm inp-container_number" value="${container_number}"></td>
                    <td><input type="text" class="form-control form-control-sm inp-seal_number" value="${seal_number}"></td>
                    <td><input type="number" class="form-control form-control-sm inp-gw" style="text-align:right;" value="${gross_weight}"></td>
                    <td><input type="number" class="form-control form-control-sm inp-cbm" style="text-align:right;" value="${cbm}"></td>
                    <td><input type="checkbox" class="form-check-input" ${soc} disabled></td>
                    <td><input type="checkbox" class="form-check-input" ${ow} disabled></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${v['cy']}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled  value="${v['rtn']}"></td>
                </tr>
                `;
                rows_c++;
                $('[name = container-tbl] tbody').append(html_container);



            }
        });

        this.cont_global = res_data['cont'];

        await transport_sub_transport.set_preview_data(job_number);

        // booking set (booking detail)
        $('.inp-shper').val(res_data['booking']['shipper_number']).attr('disabled', true);
        $('.inp-shptrm').val(res_data['booking']['st_number']).attr('disabled', true);

        $('.inp-carrier').val(res_data['booking']['carrier_number']).attr('disabled', true);
        $('.inp-prtrecieve').val(res_data['booking']['port_of_receipt_number']).attr('disabled', true);
        $('.inp-prtload').val(res_data['booking']['port_of_loading_number']).attr('disabled', true);
        $('.inp-ts_port').val(res_data['booking']['ts_port_number']).attr('disabled', true);
        $('.inp-delivery').val(res_data['booking']['port_of_delivery_number']).attr('disabled', true);



        $('.inp-jobno').val(res_data['booking']['job_number']).attr('readonly', true);
        $('.inp-bkno').val(res_data['booking']['booking_number']).attr('readonly', true);

        $('.inp-rmk').val(res_data['booking']['remark']).attr('readonly', true);

        $('.inp-M_vessel').val(res_data['booking']['mother_vessel']).attr('readonly', true);
        $('.inp-mother-voy-no').val(res_data['booking']['voy_no_mother']).attr('readonly', true);
        $('.inp-feeder_vessel').val(res_data['booking']['feeder_vessel']).attr('readonly', true);
        $('.inp-feeder_voy_no').val(res_data['booking']['voy_no_feeder']).attr('readonly', true);
        $('.inp-etd').val(res_data['booking']['etd']).attr('readonly', true);
        $('.inp-eta').val(res_data['booking']['eta']).attr('readonly', true);

        $('.inp-cargodes').val(res_data['cninform']['cargo']).attr('readonly', true);





        if (res_data['cninform']['hs_code'] == undefined) {
            let hscode_parse = "";
            $('.inp-hscode').val(hscode_parse).attr('disabled', true);

        } else {
            $('.inp-hscode').val(res_data['cninform']['hs_code'] + ' ' + res_data['cninform']['hs_decription']).attr('disabled', true);
        }

        $('.inp-cargo_type').val(res_data['cninform']['cargo_type']).attr('disabled', true);
        $('.inp-cargo_qty').val(res_data['cninform']['quantity']).attr('readonly', true);
        $('.inp-cargo_gw').val(res_data['cninform']['gw']).attr('readonly', true);
        $('.inp-cargo_vol').val(res_data['cninform']['volume']).attr('readonly', true);
        $('.inp-cargo_marks').val(res_data['cninform']['mark']).attr('readonly', true);


        // driver set route

        //let route_driver = $('.sel-route-driver').parent().html();

        // driver

       
        //let container_for_driver = $('.sel-container-for-driver').parent().html();

        // let db_sel_container_for_driver = '';
        // $.each(res_data['cont'], function (i, k) {
        //     db_sel_container_for_driver += `
        //     <option value="${k['ID']}">${k['container_type']} ${k['container_number']}</option>
        //     `;
        // });
        // $('.sel_container_driver').append(db_sel_container_for_driver);

    },

    push_del_driver: async function (del_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await transport.ajax_del_driver(del_id)
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                // transport.set_sub_cash_preview_data(customs.job_number_global);
            }
        })
    },
    ajax_del_driver: async function (del_id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/del_driver_list.php",
                data: { 'del_id': del_id },
                dataType: "json",
                success: function (res) {
                    resolve(res);

                },
            });
        });
    },

    driver_seal_number_change: async function (e) {
        let val_id_seal = $(e).val();
        let parent = $(e).closest('.driver_transport');
        
        let test = this.cont_global.filter(x => x.ID === val_id_seal);
        let seal_number = '';
        $.each(test,function(i,v){
            seal_number = (v['seal_number'])
        })
        $('.inp_seal_number',parent).val(seal_number)
       
    },

    addtransporthtml: function (e = null) {
        html_select_supplier = transport_sub_transport.html_sel_supplier
        console.log(html_select_supplier)
        html_select_cur = transport_sub_transport.html_sel_cur
        html_select_type = transport_sub_transport.html_sel_truck

        html_add_transport = `
        <div class="card-transport">
        <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Booking Transport Detail (Route ${route} )</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Supplier:</label>
                <div class="col-sm-3">
                        ${html_select_supplier}
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Empty Container Address:</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control form-control-sm inp-pick_emp">
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm inp-pick_emp_remark" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Container Address:</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control inp-pick_con" >
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                        <div class="col">
                            <input type="text" class="form-control inp-pick_con_remark" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Container Address:</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control inp-drop_con"  >
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                        <div class="col">
                            <input type="text" class="form-control inp-drop_con_reamrk"  >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Empty Containe Address:</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control inp-drop_emp" " >
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                        <div class="col">
                            <input type="text" class="form-control inp-drop_emp_remark"" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
            <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Type Truck:</label>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col">
                        <div class="db-sel-truck db-sel-truck">
                            ${html_select_type}
                        </div>
                    </div>
                    <label class="control-label col-sm-2 col-lg-1 align-self-center ">Remark</label>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm inp-remark_truck"> 
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Truck Quantity:</label>
            <div class="col-sm-3 col-lg-1">
                <input type="text" class="form-control form-control-sm inp-truck_quantity" style="text-align:right;">
            </div>
        </div>     
            <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-3">Budget:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="input" style="text-align:right;" class="form-control form-control-sm inp-budget">
                            </div>
                            <div class="col-lg-2">
                                <div class="db-sel-cur">
                                    ${html_select_cur}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="form-group row">
                    <div class="row-lg-11">
                        <div style="float: right">
                            <button class="btn btn-danger rounded-pill btn-sm" onclick="transport.push_del_transport();" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Delete </button>
                            <button class="btn btn-primary rounded-pill btn-sm" onclick="transport.push_action_save_transport();" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save </button>
                            <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-line"></i> Sent to line group</button>
                        </div>
                    </div>
                </div>
            <hr class="mb-4">
            <h4 class="mb-4">Supplier detail</h4>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0"  >Sent Request Line :</label>
                <div class="col-sm-3 col-lg-3">
                    <input type="input" class="form-control form-control-sm" " readonly>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Supplier Confirm DateTime :</label>
                <div class="col-sm-3 col-lg-3">
                    <input type="input" class="form-control form-control-sm inp-supplier_firm" readonly>
                </div>
            </div>
        </div>
        </div>
        `;
        route++;
        $('.add-card-transport').append(html_add_transport);

    }, del_transport: function () {


    },

    push_action_save_container: async function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                check_val_container = 0;
                $('[name = container-tbl] tbody > tr').each(async function (i, e) {
                    let container_number = $('.inp-container_number', this).val()
                    let seal_number = $('.inp-seal_number', this).val()
                    let gw = $('.inp-gw', this).val();
                    let cbm = $('.inp-cbm', this).val();

                    if( container_number == '' ||  seal_number == '' ||  gw == '' ||  cbm == ''){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Necessary information is missing. Please input',
                        })
                        check_val_container = 0;
                        return false; 
                    }else{
                        check_val_container = 1;
                    }
                })

                if (check_val_container == 1) {
                    await transport.save_container();
                    Swal.fire(
                        'saved!',
                        'Your file has been saved.',
                        'success'
                    )
                }

            }
        })
    },
    save_container: async function (i, e) {
        let container_arr = [];
        let container_arr_tmp = {};

        $('[name = container-tbl] tbody > tr').each(function (i, e) {

            let ID = $(this).attr('container_data_id');
            let container_nubmer = $('.inp-container_number', this).val();
            let seal_number = $('.inp-seal_number', this).val();
            let gw = $('.inp-gw', this).val();
            let cbm = $('.inp-cbm', this).val();

            container_arr_tmp = {
                ID: ID,
                container_nubmer: container_nubmer,
                seal_number: seal_number,
                gw: gw,
                cbm: cbm,
            }

            container_arr.push(container_arr_tmp)
        });
        
       
        let res = await transport.ajax_save_container(container_arr);
       
    },
    ajax_save_container: function (container_arr) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/save_container.php",
                data: { 'container_arr': container_arr },
                dataType: "json",
                success: function (res) {

                    resolve(res);

                },
            });
        });
    },
    push_action_save_driver: async function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await transport.save_driver()
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )

            }
        })
    },

    save_driver: async function (i, e) {
        let driver_arr = [];
        let driver_arr_tmp = {};

        $('.driver-part-del').each(function (i, e) {

            let ID = $(this).attr('driver-part-del');
            let route_number = $('.sel-route-driver', this).val();
            let name_val = $('.inp-driver_name_val', this).val();
            let phone_val = $('.inp-driver_phone_val', this).val();
            let container_val = $('.sel-container-for-driver', this).val();

            driver_arr_tmp = {
                ID: ID,
                job_global: job_global,
                route_number: route_number,
                name_val: name_val,
                phone_val: phone_val,
                container_val: container_val
            }

            driver_arr.push(driver_arr_tmp)
        })
        await transport.ajax_save_driver(driver_arr)
    },
    ajax_save_driver: function (driver_arr) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/save_driver.php",
                data: { 'driver_arr': driver_arr },
                dataType: "json",
                success: function (res) {

                    resolve(res);

                },
            });
        });
    },

    push_action_save_transport: async function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let val_check = 0;
                $('.card-transport').each(async function (i, e) {

                    
                    let sel_supplier = $('.sel-supplier', this).val();
                    let inp_peca = $('.inp-pick_emp', this).val();
                    let inp_pca = $('.inp-pick_con', this).val();
                    let inp_doca = $('.inp-drop_con', this).val();
                    let inp_doeca = $('.inp-drop_emp', this).val();
                    let truck_type = $('.sel-type_truck', this).val();
                    let truck_quantity = $('.inp-truck_quantity', this).val();
                    let inp_bg = $('.inp-budget', this).val();
                    let sel_cur = $('.sel_cur', this).val();
                    
                    if (sel_supplier == '' || inp_peca == '' || inp_pca == '' || inp_doca == '' || inp_doeca == '' || truck_type == '' || truck_quantity == '' || inp_bg == '' || sel_cur == '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Necessary information is missing. Please input',
                        })
                        val_check = 0
                        return false;
                    }else{
                        val_check = 1
                    }
                })
                
                if (val_check == 1) {
                    await transport.save_transport();
                    Swal.fire(
                        'saved!',
                        'Your file has been saved.',
                        'success'
                    )
                }
            }
        })
    },

    save_transport: async function () {
        let transport_arr = [];
        let transport_arr_tmp = {};

        let driver_arr = [];
        let driver_arr_temp = {};
        $('.card-transport').each(function (i, e) {

            let ID = $(this).attr('card-transport');
            let sel_supplier = $('.sel-supplier', this).val();
            let inp_peca = $('.inp-pick_emp', this).val();
            let inp_peca_remark = $('.inp-pick_emp_remark', this).val();
            let inp_pca = $('.inp-pick_con', this).val();
            let inp_pca_remark = $('.inp-pick_con_remark', this).val();
            let inp_doca = $('.inp-drop_con', this).val();
            let inp_doca_remark = $('.inp-drop_con_reamrk', this).val();
            let inp_doeca = $('.inp-drop_emp', this).val();
            let inp_doecaremark = $('.inp-drop_emp_remark', this).val();
            let truck_type = $('.sel-type_truck', this).val();
            let truck_remark = $('.inp-remark_truck', this).val();
            let truck_quantity = $('.inp-truck_quantity', this).val();
            let inp_bg = $('.inp-budget', this).val();
            let sel_cur = $('.sel_cur', this).val();

            transport_arr_tmp = {
                ID: ID,
                sel_supplier: sel_supplier,
                inp_peca: inp_peca,
                inp_peca_remark: inp_peca_remark,
                inp_pca: inp_pca,
                inp_pca_remark: inp_pca_remark,
                inp_doca: inp_doca,
                inp_doca_remark: inp_doca_remark,
                inp_doeca: inp_doeca,
                inp_doecaremark: inp_doecaremark,
                truck_type: truck_type,
                truck_remark: truck_remark,
                truck_quantity: truck_quantity,
                inp_bg: inp_bg,
                sel_cur: sel_cur,
                job_number: transport.job_number_global
            }

            transport_arr.push(transport_arr_tmp)
        })

        $(`.driver_transport`).each(function (i1,v1){
            //let number_route_id = ($('.driver_transport').find('#driver_transport_no').val())
            let number_route_id = $(this).attr('driver_transport_no')
            let driver_id = $(this).attr('driver_id')
            let inp_driver_name = $('.inp_driver_name', this).val();
            let inp_phone_number = $('.inp_phone_number', this).val();
            let inp_container_number = $('.inp_container_number', this).val();
            driver_arr_temp = {
                job_number : transport.job_number_global,
                number_route_id: number_route_id,
                driver_id : driver_id,
                inp_driver_name : inp_driver_name,
                inp_phone_number : inp_phone_number,
                inp_container_number : inp_container_number
            }
            driver_arr.push(driver_arr_temp)
        })
        console.log(driver_arr)
        await transport.ajax_save_transport(transport_arr,driver_arr)
    },
    ajax_save_transport: function (transport_arr,driver_arr) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/save_transport.php",
                data: { 'transport_arr': transport_arr,
                        'driver_arr' : driver_arr},
                dataType: "json",
                success: function (res) {
                    resolve(res);

                },
            });
        });
    }, push_del_transport: async function (del_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await transport.ajax_del_transport(del_id)
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                // transport.set_sub_cash_preview_data(customs.job_number_global);
                await transport_sub_transport.set_preview_data(transport.job_number_global);
            }
        })
    },
    ajax_del_transport: async function (del_id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/del_transport.php",
                data: { 'del_id': del_id },
                dataType: "json",
                success: function (res) {
                    resolve(res);

                },
            });
        });
    },

    add_driver_fn : function (e=null,val){
        
        let html_select_cont = transport_sub_transport.sel_cont_driver
        console.log(val)
        html_add_driver = `
        <div class="driver_transport" driver_transport_no = ${val}>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Driver name:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" class="form-control form-control-sm inp_driver_name"  >
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center mb-0">Phone number :</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control form-control-sm inp_phone_number " >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Container number:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="db_sel_container">
                                    <select class="form-select form-select-sm sel_container_driver inp_container_number" onchange="transport.driver_seal_number_change(this)">
                                        <option value="">Plese select container number</option>
                                        ${html_select_cont}
                                    </select>
                                </div>
                            </div>
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center mb-0">Seal number :</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control form-control-sm inp_seal_number " readonly>
                            </div>
                            <div class="col-lg-2">
                            <button class="btn btn-danger rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Delete </button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        `;
        $(`.add_html_driver${val}`).append(html_add_driver)
    },



};


function number_format(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


