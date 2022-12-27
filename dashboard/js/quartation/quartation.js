

const quartation = {
    addhtmlbase_server: function (e = null) {
        let sl_carrier = $(".db-select-carrier").html();
        let sl_pol = $(".db-select-pol").html();
        let sl_pod = $(".db-select-pod").html();
        html = `
                <div class="base-add">
                <H4>Base Service</H4>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Carrier :</label>
                            <div class="col-lg-5 col-md-5">
                                ${sl_carrier}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Container size :</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4">
                                            <select class="form-select form-select-sm inp-ts_port">
                                                <option value="" selected>Select size</option>
                                                <option value="">40HQ</option>
                                                <option value="">20DC</option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-4 col-lg-2 align-self-center mb-0" for="pwd2">Container Quantity</label>
                                        <div class="col-lg-2 col-md-2">
                                            <input type="text" class="form-control form-control-sm">
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Port of loading</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            ${sl_pol}
                                        </div>
                                        <label class="control-label col-sm-2 col-md-3 col-lg-2 align-self-center mb-0" for="pwd2">Port of Delivery</label>
                                        <div class="col-lg-4">
                                            ${sl_pod}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Budget :</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4">
                                            <input type="text" class="form-control form-control-sm" readonly>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <select name="" class="form-select form-select-sm" id="" disabled>
                                                <option value="" selected>THB</option>
                                                <option value="">USD</option>
                                                <option value="">RMB</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <button type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" onclick="quartation.addhtmlbase_server();" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Route</button>
                                            <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_base(); style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-dash-lg"></i> Delete Route</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        $(".base-row").append(html);
    },
    addhtmlsub_tbl: function () {
        html = `
            <tr class="sub_des">
                <td class=""><select name="" class="form-select form-select-sm" id="">
                    <option value="" selected>Plese Select service</option>
                    <option value="">DF/DO Fee</option>
                    <option value="">THC</option>
                    <option value="">Seal Fee</option>
                    <option value="">Handling Charge</option>
                    <option value="">Import Duty With Vat</option>
                    <option value="">Customs Clearance Charge</option>
                    <option value="">Customs fee</option>
                    <option value="">Customs Inspection Charge</option>
                    <option value="">Gate Charge</option>
                    <option value="">Pick-up Empty Container Fee</option>
                    <option value="">Return Laden Container Fee</option>
                    <option value="">Container Cleaning Charge</option>
                    <option value="">Equipment Maintenance Fee</option>
                    <option value="">Demurrage & Detention</option>
                    <option value="">Over time Charge for truck</option>
                    <option value="">Storage Charge</option>
                    <option value="">Over time charge for customer </option>
                    <option value="">insurance</option>
                    <option value="">Surrender BL Fee</option>
                    <option value="">AMS (amtomated manifest system)</option>
                    <option value="">Carrier Security Charge</option>
                    <option value="">Port Security Charge (PU)</option>
                </select></td>
                <td><select name="" id="" class="form-select form-select-sm">
                    <option value="">Import</option>
                    <option value="">Export</option>
                    <option value="" selected>Other service</option>
                </select></td>
                <td><input type="input" class="form-control form-control-sm " id="" placeholder=""></td>
                <td><select name="" class="form-select form-select-sm" id="">
                    <option value="">THB</option>
                </select></td>
                <td><input type="input" class="form-control form-control-sm " id="" placeholder=""></td>
                <td  onclick="quartation.del_sup_row(this);"><svg class="del-tr"  width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="red"></path>
                        <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="red"></path>
                    </svg>
                </td>
            </tr>
            `;
        $('[name="sub-tbl"]>tbody').append(html);
    },
    del_sup_row: function (e = null) {
        $(e).closest("tr").remove();
    },
    check_get: function () {
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
        let get_quo = getUrlParameter('quartation_number');
        let get_action = getUrlParameter('action');

        let quartation_number = get_quo == false ? null : get_quo;
        let action = get_action == false ? null : get_action;

        if (action == 'preview') {
            quartation.set_preview_data(quartation_number);
        } else {

        }
    },
    set_preview_data: async function (quartation_number = null) {
        let res_data = await quartation.ajax_set_preview_data(quartation_number);
        console.log(res_data);
        title = res_data['title']

        // Quartation Detail
        $('.inp-quo_no').val(title['quartation_number']);
        $('.inp-sign_st').val((title['status'] == '1' ? 'Signed' : 'Not Sign'));
        $('.sel_consignee').val(title['consignee_number']);
        $('.inp-commodity').val(title['commodity']);
        $('.sel-type-title').val(title['type']);
        // ขาด type

        // END Quartation Detail

        // Base service


        var carrier_type = $('.inp-carrier-type').parent().html();
        var select_pod = $('.inp-port_load').parent().html();
        var select_del = $('.inp-port_del').parent().html();
        var select_currency = $('.select-currency').parent().html();

        $('.base-row').html('')
        let base_data = [];
        let truck_import = [];
        let truck_export = [];
        let other = [];

        $.each(res_data['detail'], function (i, v) {
            if (v['type'] === 'base_service') {
                base_data.push(v);
            }
        });
        let html = '';
        let num = 1;
        let html_select_carrier = await quartation.html_select_carrier();
        $('.base-row').html('');
        $.each(base_data, function (i, v) {
            html = `
                    <div class="base-add">
                        <H4>Base Service ${num}</H4>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center sel-carrier" for="pwd2">Carrier :</label>
                            <div class="col-lg-5 col-md-5">
                                <div class="db-select-carrier db-select-carrier${i}">
                                       
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Container size :</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-lg-5 col-md-4 db-select-carrier_type db-select-carrier_type${i}">
                                        ${carrier_type}
                                    </div>
                                    <label class="control-label col-sm-2 col-md-4 col-lg-2 align-self-center mb-0" for="pwd2">Container Quantity</label>
                                    <div class="col-lg-2 col-md-2 ">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Port of loading</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="db-select-pol db-select-pol${i}">
                                            ${select_pod}
                                        </div>
                                    </div>
                                    <label class="control-label col-sm-2 col-md-3 col-lg-2 align-self-center mb-0" for="pwd2">Port of Delivery</label>
                                    <div class="col-lg-4">
                                        <div class="db-select-pod db-select-pod${i}">
                                            ${select_del}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Budget :</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4">
                                        <input type="text" class="form-control form-control-sm inp-budget" value="${v['price']}" readonly>
                                    </div>
                                    <div class="col-lg-3 col-md-3 db-select-currency db-select-currency${i}">
                                        ${select_currency}
                                    </div>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <button type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" onclick="quartation.addhtmlbase_server(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Route</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                 `;
                 num++;
                $('.base-row').append(html);
                $(`.db-select-carrier${i}`).append(html_select_carrier);

                $(`.select-carrier${i} > select`).val(v['carrier_number']); 

                $(`.db-select-carrier_type${i} > select`).val(v['container_type']);                                
                $(`.db-select-pol${i} > select`).val(v['pol']);                                
                $(`.db-select-pod${i} > select`).val(v['pod']);                                
                $(`.db-select-currency${i} > select`).val(v['currency']).attr('disabled','disabled') ;                                

        });
        // END Base service


        // trucking fee (import)
        $('.truck_fee_import_row').html('');
        $.each(res_data['truck_fee']['import'], function (i, v) { 
            html = `
                <div class="truck_fee_import_row">                    
                    <h5>Trucking Fee (Import) ${i+1}</h5>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " on>Pickup :</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-5">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_pickup " value="${v['pickup']}">
                                </div>
                                <label class="control-label col-sm-2 col-md-2 col-lg-1 align-self-center mb-0">Dropoff :</label>
                                <div class="col-lg-3 col-md-5">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_drop" value="${v['dropoff']}">
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center inp-tr_fee_budget">Budget :</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_budget" value="${v['price']}">
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <select name="" class="form-select form-select-sm sel-tr_fee_currency" id="" value="${v['currency']}">
                                        <option value="THB" selected>THB</option>
                                        <option value="USD">USD</option>
                                        <option value="RMB">RMB</option>
                                    </select>
                                </div>
                                <div class="col-sm-9 col-md-5 col-lg-4">
                                    <button onclick="quartation.add_truck_fee_import(this);" type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Route</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <hr>
            `
            $('.truck_fee_import').append(html);
        });


        // trucking fee (export)
        $('.truck_fee_export_row').html('');

        $.each(res_data['truck_fee']['export'], function (i, v) { 
            html = `
                <div class="truck_fee_export_row">                    
                    <h5>Trucking Fee (Export) ${i+1}</h5>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " on>Pickup :</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-5">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_pickup " value="${v['pickup']}">
                                </div>
                                <label class="control-label col-sm-2 col-md-2 col-lg-1 align-self-center mb-0">Dropoff :</label>
                                <div class="col-lg-3 col-md-5">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_drop" value="${v['dropoff']}">
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center inp-tr_fee_budget">Budget :</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_budget" value="${v['price']}">
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <select name="" class="form-select form-select-sm sel-tr_fee_currency" id="" value="${v['currency']}">
                                        <option value="THB" selected>THB</option>
                                        <option value="USD">USD</option>
                                        <option value="RMB">RMB</option>
                                    </select>
                                </div>
                                <div class="col-sm-9 col-md-5 col-lg-4">
                                    <button onclick="quartation.add_truck_fee_import(this);" type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Route</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <hr>
            `;
            $('.truck_fee_export').append(html);
        });


        // Sup service
            let sel_sup_service = $('.sel-sup_service').parent().html();

            $('[name = "sub-tbl"] tbody').html('');
            $.each(res_data['sup_service'], function (i, v) { 
                html = `
                    <tr class="sub_des sub_des${i}">
                        <td class="select_des_sup">
                            ${sel_sup_service}</td>
                        <td><select name="" id="" class="form-select form-select-sm sel_type_sup_service">
                                <option value="Import">Import</option>
                                <option value="Export">Export</option>
                                <option value="Other">Other service</option>
                            </select></td>
                        <td><input type="input" class="form-control form-control-sm inp_price_sup_service" id="" placeholder="" value="${v['price']}"></td>
                        <td><select name="" class="form-select form-select-sm sel_currency_sup_service" id="" >
                                <option value="THB">THB</option>
                                <option value="USD">USD</option>
                                <option value="RMB">RMB</option>
                            </select></td>
                        <td><input type="input" class="form-control form-control-sm " id="" placeholder="" value="${v['remark']}"></td>
                        <td onclick="">
                            <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.7688 8.71387H16.2312C18.5886 8.71387 20.5 10.5831 20.5 12.8885V17.8254C20.5 20.1308 18.5886 22 16.2312 22H7.7688C5.41136 22 3.5 20.1308 3.5 17.8254V12.8885C3.5 10.5831 5.41136 8.71387 7.7688 8.71387ZM11.9949 17.3295C12.4928 17.3295 12.8891 16.9419 12.8891 16.455V14.2489C12.8891 13.772 12.4928 13.3844 11.9949 13.3844C11.5072 13.3844 11.1109 13.772 11.1109 14.2489V16.455C11.1109 16.9419 11.5072 17.3295 11.9949 17.3295Z" fill="currentColor"></path>
                                <path opacity="0.4" d="M17.523 7.39595V8.86667C17.1673 8.7673 16.7913 8.71761 16.4052 8.71761H15.7447V7.39595C15.7447 5.37868 14.0681 3.73903 12.0053 3.73903C9.94257 3.73903 8.26594 5.36874 8.25578 7.37608V8.71761H7.60545C7.20916 8.71761 6.83319 8.7673 6.47754 8.87661V7.39595C6.4877 4.41476 8.95692 2 11.985 2C15.0537 2 17.523 4.41476 17.523 7.39595Z" fill="currentColor"></path>
                            </svg>
                        </td>
                    </tr>
                `;
                $('[name = "sub-tbl"] tbody').append(html);
                $(`.sub_des${i} .sel_type_sup_service`).val(v['type']);
                $(`.sub_des${i} .sel_currency_sup_service`).val(v['currency']);

            });


    },
    ajax_set_preview_data: function (quartation_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation/get_preview_data.php",
                data: { 'quartation_number': quartation_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    get_consignee_sel: async function () {
        let res_consignee = await quartation.ajax_get_consingee();
        return res_consignee;

    },
    ajax_get_consingee: function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation/get_consignee.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    html_consignee: async function (data) {
        let res = await quartation.get_consignee_sel();
        let html = '';
        $.each(res, function (i, k) {
            html += `
            <option value="${k['ID']}">${k['consignee_name']}</option>
            `;
        });

        $('.sel_consignee').append(html);
    },

    html_base_service: function () {

    },
    get_base_service: async function () {

    },
    ajax_get_base_service: function () {

    },
    html_select_carrier:async function () {
        let carrier = await quartation.get_carrier();
        html = '';
        let html_option = '';
        $.each(carrier, function (i, v) { 
            html_option += `
                <option value="${v['carrier_number']}">
                    ${v['carrier_name']}
                </option>
            `;
        });
        
        html = `
            <select class="form-select form-select-sm">
                ${html_option}
            </select>
        `;
        return html;
    },
    get_carrier: async function () {
        let carrier = await quartation.ajax_get_carrier();
        return carrier;
    },
    ajax_get_carrier: function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation/get_carrier_all.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                }
            });
        });
    },
    add_truck_fee_import : function (e = null) {  
        $num = $('.truck_fee_import_row').length;
        let html = `
        <div class="truck_fee_import_row">                    
            <h5>Trucking Fee (Import) ${$num+1}</h5>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " on>Pickup :</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-lg-3 col-md-5">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                        <label class="control-label col-sm-2 col-md-2 col-lg-1 align-self-center mb-0">Dropoff :</label>
                        <div class="col-lg-3 col-md-5">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center inp-tr_fee_budget">Budget :</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <input type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <select name="" class="form-select form-select-sm sel-tr_fee_currency" id="">
                                <option value="THB" selected>THB</option>
                                <option value="USD">USD</option>
                                <option value="RMB">RMB</option>
                            </select>
                        </div>
                        <div class="col-sm-9 col-md-5 col-lg-4">
                            <button onclick="quartation.add_truck_fee_import(this);" type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Route</button>
                            <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_truck_fee_import(this);; style=" box-shadow:="" 0px="" 4px="" rgba(0,="" 0,="" 0.25);"=""><i class="bi bi-dash-lg"></i> Delete Route</button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        `;

        $('.truck_fee_import').append(html);
    },
};


$(function () {
    quartation.html_consignee();
    quartation.check_get();
    
});
