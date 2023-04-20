const quartation = {
  get_quono: '',

  check_get: async function () {
    var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i
      for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=')

        if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined
            ? true
            : decodeURIComponent(sParameterName[1])
        }
      }
      return false
    }
    let get_quo = getUrlParameter('quartation_number')
    quartation.get_quono = getUrlParameter('quartation_number')
    let get_action = getUrlParameter('action')

    let quartation_number = get_quo == false ? null : get_quo
    let action = get_action == false ? null : get_action

    if (action == 'preview') {
      await this.set_started()
      await quartation.set_preview_data(quartation_number)

    } else if (action == 'create') {

      await this.set_started()
      //await this.addhtmlbase_server()
    }
  },


  set_started: async function () {
    title_d = '';

    sl_carrier = $('.db-select-carrier').parent().html()
    sl_pol = $('.db-select-pol').parent().html()
    sl_pod = $('.db-select-pod').parent().html()
    sl_carrier_type = $('.db-select-container-size').parent().html()

    ss_description = $('.sel-sup_des_service').parent().html()
    ss_type = $('.sel_type_sup_service').parent().html()
    ss_cur = $('.sel_currency_sup_service').parent().html()
  },


  set_preview_data: async function (quartation_number = null) {
    let res_data = await quartation.ajax_set_preview_data(quartation_number)
    console.log(res_data)
    title = res_data['title']
    title_d = res_data['title']['ID']


    // Quartation Detail
    $('.inp-quo_no').val(title['quartation_number'])
    $('.inp-sign_st').val(title['status'] == '1' ? 'Signed' : 'Not Sign')
    $('.sel_consignee').val(title['consignee_number'])
    $('.sel_term').val(title['term'])

    $('.inp-commodity').val(title['commodity'])
    $('.sel-type-title').val(title['type'])
    // ขาด type

    // END Quartation Detail

    // Base service

    var carrier_type = $('.inp-carrier-type').parent().html()
    var select_pod = $('.inp-port_load').parent().html()
    var select_del = $('.inp-port_del').parent().html()
    var select_currency = $('.select-currency').parent().html()
    var html_select_carrier = $('.inp-carrier').parent().html()

    var inp_qty = $('.inp_qty').parent().html()


    $('.base-row').html('')
    let base_data = []

    if (res_data['detail'] != "0 results") {
      let html = ''
      num_base_service = 1
      $.each(res_data['detail'], function (i, v) {
        html = `
                      <div class="base-add" data_base_id="${v['base_id']}">
                          <H5 class="mb-3">Route ${num_base_service}</H5>
                          <div class="form-group row">
                              <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center sel-carrier" >Carrier :</label>
                              <div class="col-lg-5 col-md-5">
                                  <div class="db-select-carrier db-select-carrier${i}">
                                         ${html_select_carrier}
                                  </div>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " >Container size :</label>
                              <div class="col-sm-9">
                                  <div class="row">
                                      <div class="col-lg-5 col-md-4 db-select-carrier_type db-select-carrier_type${i}">
                                          ${carrier_type}
                                      </div>
                                      <label class="control-label col-sm-2 col-md-4 col-lg-2 align-self-center mb-0" >Container Quantity</label>
                                      <div class="col-lg-2 col-md-2 ">
                                          <input type="number" class="form-control form-control-sm inp_qty "value='${v['qty']}' onchange="quartation.fillter_route(this);">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " >Port of loading</label>
                              <div class="col-sm-9">
                                  <div class="row">
                                      <div class="col-md-4 col-lg-4">
                                          <div class="db-select-pol db-select-pol${i}">
                                              ${select_pod}
                                          </div>
                                      </div>
                                      <label class="control-label col-sm-2 col-md-3 col-lg-2 align-self-center mb-0" >Port of Delivery</label>
                                      <div class=" col-md-4  col-lg-4">
                                          <div class="db-select-pod db-select-pod${i}">
                                              ${select_del}
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " >Budget :</label>
                              <div class="col-sm-9">
                                  <div class="row">
                                      <div class="col-lg-3 col-md-4">
                                          <input type="number" class="form-control form-control-sm inp_budget" value="${v['price'] * v['qty']}" readonly>
                                      </div>
                                      <div class="col-lg-3 col-md-3 db-select-currency db-select-currency${i}">
                                          ${select_currency}
                                      </div>
                                      <div class="col-sm-9 col-md-5 col-lg-4">
                                          <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_base(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-dash-lg"></i> Delete Route</button>
  
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <hr>
                      </div>
                   `
        num_base_service++
        $('.base-row').append(html)

        $(`.db-select-carrier${i} > select`).val(v['carrier_number'])
        $(`.db-select-carrier_type${i} > select`).val(v['container_type'])
        $(`.db-select-pol${i} > select`).val(v['pol'])
        $(`.db-select-pod${i} > select`).val(v['pod'])
        $(`.db-select-currency${i} > select`)
          .val(v['currency'])
          .attr('disabled', 'disabled')
      })
    } else {
      console.log(2)
    }
    // END Base service

    // trucking fee (import)
    $('.truck_fee_import_row').parent().html('')

    if (res_data['truck_fee']['import'] != "0 results") {
      $.each(res_data['truck_fee']['import'], async function (i, v) {
        html = `
                <div class="truck_fee_import_row" data_truck_import_id = '${v['ID']}'>                    
                    <h5> Import ${i + 1}</h5>
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
                                    <input type="number" class="form-control form-control-sm inp-truck_fee_budget" value="${v['price']}">
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <select  class="form-select form-select-sm sel-tr_fee_import_currency tr_fee_import_currency${i}"  value="${v['currency']}">
                                        <option value="THB">THB</option>
                                        <option value="USD">USD</option>
                                        <option value="RMB">RMB</option>
                                    </select>
                                </div>
                                <div class="col-sm-9 col-md-5 col-lg-4">
                                  <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_truck_fee_import(this);" style=""><i class="bi bi-dash-lg"></i> Delete Import</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <hr>

                </div>
            `
        await $('.truck_fee_import').append(html)
        $(`.sel-tr_fee_export_currency${i}`).val(v['currency'])
      })
    }

    // trucking fee (export)
    $('.truck_fee_export_row').parent().html('')
    if (res_data['truck_fee']['export'] != "0 results") {
      $.each(res_data['truck_fee']['export'], async function (i, v) {
        html = `
                <div class="truck_fee_export_row" data_truck_export_id = '${v['ID']}'>                    
                    <h5>Export ${i + 1}</h5>
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
                                    <input type="number" class="form-control form-control-sm inp-truck_fee_budget" value="${v['price']}">
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <select  class="form-select form-select-sm sel-tr_fee_export_currency sel-tr_fee_export_currency${i}"  value="${v['currency']}">
                                        <option value="THB">THB</option>
                                        <option value="USD">USD</option>
                                        <option value="RMB">RMB</option>
                                    </select>
                                </div>
                                <div class="col-sm-9 col-md-5 col-lg-4">
                                    <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_truck_fee_export(this);"><i class="bi bi-dash-lg"></i> Delete Export</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <hr>
                </div>
               
            `
        await $('.truck_fee_export').append(html)
        $(`.sel-tr_fee_export_currency${i}`).val(v['currency'])
      })
    }

    // Sup service
    let sel_sup_service = $('.sel-sup_des_service').parent().html()
    $('[name = "sub-tbl"] tbody').html('')
    if (res_data['sup_service'] != "0 results") {
      $.each(res_data['sup_service'], function (i, v) {
        html = `
                    <tr class="sub_des sub_des${i}" data_sup_id="${v['ID']}">
                        <td class="select_des_sup">
                            ${ss_description}</td>
                        <td>${ss_type}</td>
                        <td><input type="input" class="form-control form-control-sm inp_price_sup_service"  placeholder="" value="${v['price']}"></td>
                        <td>${ss_cur}</td>
                        <td><input type="input" class="form-control form-control-sm inp_sup_remark"  placeholder="" value="${v['remark']}"></td>
                        <td  onclick="quartation.del_sup_row(this);"><svg class="del-tr"  width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="red"></path>
                                <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="red"></path>
                            </svg>
                        </td>
                    </tr>
                `
        $('[name = "sub-tbl"] tbody').append(html)
        $(`.sub_des${i} .sel_type_sup_service`).val(v['type'])
        $(`.sub_des${i} .sel-sup_des_service`).val(v['description'])
        $(`.sub_des${i} .sel_currency_sup_service`).val(v['currency'])
      })
    }
  },


  addhtmlbase_server: function (e = null) {
    // let sl_carrier = $('.db-select-carrier').html()
    // let sl_pol = $('.db-select-pol').html()
    // let sl_pod = $('.db-select-pod').html()
    // let sl_carrier_type = $('.db-select-container-size').html()
    //let num = $('.base-add').length + 1

    html_base_service = `
                <div class="base-add">
                <H5>Route </H5>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center"  >Carrier :</label>
                            <div class="col-lg-5 col-md-5">
                                ${sl_carrier}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " >Container size :</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4">
                                            ${sl_carrier_type}
                                        </div>
                                        <label class="control-label col-sm-2 col-md-4 col-lg-2 align-self-center mb-0" >Container Quantity</label>
                                        <div class="col-lg-2 col-md-2">
                                            <input type="text" class="form-control form-control-sm inp_qty" onchange="quartation.fillter_route(this);">
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " >Port of loading</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            ${sl_pol}
                                        </div>
                                        <label class="control-label col-sm-2 col-md-3 col-lg-2 align-self-center mb-0" >Port of Delivery</label>
                                        <div class="col-lg-4">
                                            ${sl_pod}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " >Budget :</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4">
                                            <input type="number" class="form-control form-control-sm inp_budget" readonly>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <select  class="form-select form-select-sm select-currency"  disabled >
                                                <option value="THB">THB</option>
                                                <option value="USD">USD</option>
                                                <option value="RMB">RMB</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_base(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-dash-lg"></i> Delete Route</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            `
    $('.base-row').append(html_base_service)
  },
  addhtmlsub_tbl: function () {

    html = `
            <tr class="sub_des">
                <td class="">
                ${ss_description}</td>
                <td>
                    ${ss_type}
                </td>
                <td><input type="number" class="form-control form-control-sm inp_price_sup_service"  placeholder=""></td>
                <td>${ss_cur}</td>
                <td><input type="input" class="form-control form-control-sm inp_sup_remark"  placeholder=""></td>
                <td  onclick="quartation.del_sup_row(this);"><svg class="del-tr"  width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="red"></path>
                        <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="red"></path>
                    </svg>
                </td>
            </tr>
            `
    $('[name="sub-tbl"]>tbody').append(html)
  },
  del_sup_row: function (e = null) {
    let num = $('.sub_des').length
    console.log(num)
    if (num == 1) {
      alert('You can not remove this one')
      return
    } else {
      $(e).closest('tr').remove()
    }
  },


  ajax_set_preview_data: function (quartation_number) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        type: 'post',
        url: 'php/quotation/get_preview_data.php',
        data: { quartation_number: quartation_number },
        dataType: 'json',
        success: function (response) {
          resolve(response)
        },
      })
    })
  },
  get_consignee_sel: async function () {
    let res_consignee = await quartation.ajax_get_consingee()
    return res_consignee
  },
  ajax_get_consingee: function () {
    return new Promise(function (resolve, reject) {
      $.ajax({
        type: 'post',
        url: 'php/Ajax_select/get_consignee.php',
        data: {},
        dataType: 'json',
        success: function (res) {
          resolve(res)
        },
      })
    })
  },
  ajax_get_shipment: function () {
    return new Promise(function (resolve, reject) {
      $.ajax({
        type: 'post',
        url: 'php/Ajax_select/get_shipment.php',
        data: {},
        dataType: 'json',
        success: function (res) {
          resolve(res)
        },
      })
    })
  },
  html_consignee: async function (data) {
    let res = await quartation.get_consignee_sel()
    let html = ''
    $.each(res, function (i, k) {
      html += `
            <option value="${k['ID']}">${k['consignee_name']}</option>
            `
    })

    $('.sel_consignee').append(html)
  },
  html_shipment: async function () {
    let res_data = await this.ajax_get_shipment();
    console.log(res_data)
    let html = ''
    $.each(res_data, function (i, k) {
      html += `
            <option value="${k['ID']}">${k['st_name']}</option>
            `
    })

    $('.sel_term').append(html)
  },
  del_base: function (e = null) {
    if ($('.base-add').length <= 1) {
      alert('should be atleast 1');
    } else {
      $(e).closest('.base-add').remove();
    }
  },
  add_truck_fee_import: function (e = null) {
    num = $('.truck_fee_import_row').length
    let html = `
                <div class="truck_fee_import_row">                    
                    <h5> Import ${num + 1}</h5>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " on>Pickup :</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-5">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_pickup " >
                                </div>
                                <label class="control-label col-sm-2 col-md-2 col-lg-1 align-self-center mb-0">Dropoff :</label>
                                <div class="col-lg-3 col-md-5">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_drop" >
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center inp-tr_fee_budget">Budget :</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <input type="number" class="form-control form-control-sm inp-truck_fee_budget" >
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <select  class="form-select form-select-sm sel-tr_fee_import_currency"  >
                                        <option value="THB">THB</option>
                                        <option value="USD">USD</option>
                                        <option value="RMB">RMB</option>
                                    </select>
                                </div>
                                <div class="col-sm-9 col-md-5 col-lg-4">
                                    <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_truck_fee_import(this);" style=""><i class="bi bi-dash-lg"></i> Delete Route</button>
                                    </div>
                            </div>
                        </div>
                    </div> 
                    <hr> 
                </div>    
            `

    $('.truck_fee_import').append(html)
  },
  add_truck_fee_export: function (e = null) {
    num = $('.truck_fee_export_row').length
    let html = `
                <div class="truck_fee_export_row">                    
                    <h5> Export ${num + 1}</h5>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " >Pickup :</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-5">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_pickup " >
                                </div>
                                <label class="control-label col-sm-2 col-md-2 col-lg-1 align-self-center mb-0">Dropoff :</label>
                                <div class="col-lg-3 col-md-5">
                                    <input type="text" class="form-control form-control-sm inp-truck_fee_drop" >
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center inp-tr_fee_budget">Budget :</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <input type="number" class="form-control form-control-sm inp-truck_fee_budget" >
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <select  class="form-select form-select-sm sel-tr_fee_export_currency"  >
                                        <option value="THB">THB</option>
                                        <option value="USD">USD</option>
                                        <option value="RMB">RMB</option>
                                    </select>
                                </div>
                                <div class="col-sm-9 col-md-5 col-lg-4">
                                    <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_truck_fee_export(this);" style=" box-shadow:="" 0px="" 4px="" rgba(0,="" 0,="" 0.25);"=""><i class="bi bi-dash-lg"></i> Delete Route</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <hr>     

                </div>
            `
    $('.truck_fee_export').append(html)
  },
  html_modal_add_consignee: function () {
    if ($('#add_consignee_moda').length >= 1) {
      $('#add_consignee_moda').remove()
    }
    html = `
        <div class="modal fade" id="add_consignee_moda">
            <div class="modal-dialog">
                <div class="modal-content">
            
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Add Consignee</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
            
                    <!-- Modal body -->
                    <div class="modal-body ps-5">
                        <div class="form-group">
                        <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">Corporate name</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp-cname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">Address</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp-address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">Tax ID</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp-tax_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">Email</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp-email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">Phone number</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp-phone_number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">Fax</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp-fax">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">Contact</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp-linkman">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">Contact Tel</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp-contact">
                        </div>
                    </div>
                        </div>
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="quartation.fn_save_raw()"><i class="bi bi-check-square"></i> Save</button>
                      <button type="button" class="btn btn-danger  rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>`

    $('body').append(html)
    $('#add_consignee_moda').modal('show')
  },
  quotation_save: async function (param) {
    data = {}
    let title_id = title_d ? title_d : '';
    let quo_no = $('.inp-quo_no').val()
    let sign_st = $('.inp-sign_st').val()
    let consignee = $('.sel_consignee').val()
    let term = $('.sel_term').val()
    let commod = $('.inp-commodity').val()
    let type_title = $('.sel-type-title').val()
    let detail = {
      quo_no: quo_no,
      sign_st: sign_st,
      consignee: consignee,
      term: term,
      commod: commod,
      type_title: type_title,
    }

    let base_arr = []
    $('.base-add').each(function (i, e) {
      // element == this
      let base_arr_tmp = {}
      let base_id = $(this).attr('data_base_id') == '' ? base_id = $('.inp_route_id_save', this).val() : $(this).attr('data_base_id')

      let carrier = $('.inp-carrier', this).val()
      let carrier_type = $('.inp-carrier-type', this).val()
      let pol = $('.inp-port_load', this).val()
      let pod = $('.inp-port_del', this).val()
      let qty = $('.inp_qty', this).val()

      base_arr_tmp = {
        base_id: base_id,
        carrier: carrier,
        carrier_type: carrier_type,
        pol: pol,
        pod: pod,
        qty: qty,
      }
      base_arr.push(base_arr_tmp)
    })

    let truck_fee_import = []
    $('.truck_fee_import_row').each(function (i, e) {
      let truck_fee_import_tmp = {}
      let truck_import_id = $(this).attr('data_truck_import_id')
      let truck_pickup = $('.inp-truck_fee_pickup', this).val()
      let truck_drop = $('.inp-truck_fee_drop', this).val()
      let budget = $('.inp-truck_fee_budget', this).val()
      let currency = $('.sel-tr_fee_import_currency', this).val()
      truck_fee_import_tmp = {
        ID: truck_import_id,
        truck_pickup: truck_pickup,
        truck_drop: truck_drop,
        Budget * budget,
        currency: currency,
      }
      truck_fee_import.push(truck_fee_import_tmp)
    })

    let truck_fee_export = []
    $('.truck_fee_export_row').each(function (i, e) {
      let truck_fee_export_tmp = {}
      let truck_export_id = $(this).attr('data_truck_export_id')
      let truck_pickup = $('.inp-truck_fee_pickup', this).val()
      let truck_drop = $('.inp-truck_fee_drop', this).val()
      let budget = $('.inp-truck_fee_budget', this).val()
      let currency = $('.sel-tr_fee_export_currency', this).val()
      truck_fee_export_tmp = {
        ID: truck_export_id,
        truck_pickup: truck_pickup,
        truck_drop: truck_drop,
        Budget * budget,
        currency: currency,
      }
      truck_fee_export.push(truck_fee_export_tmp)
    })

    let sup_service = []
    $('.sub_des').each(function (i, e) {
      // element == this
      let sup_service_tmp = {}
      let ID = $(this).attr('data_sup_id');
      let service = $('.sel-sup_des_service', this).val()
      let type = $('.sel_type_sup_service', this).val()
      let unit_price = $('.inp_price_sup_service', this).val()
      let currency = $('.sel_currency_sup_service', this).val()
      let remark = $('.inp_sup_remark', this).val()

      sup_service_tmp = {
        ID: ID,
        service: service,
        type: type,
        unit_price: unit_price,
        currency: currency,
        remark: remark,
      }
      sup_service.push(sup_service_tmp)
    })


    let save_data = {
      quo_no: quo_no,
      title_id: title_id,
      detail: detail,
      base: base_arr,
      truck_import: truck_fee_import,
      truck_export: truck_fee_export,
      sup_service: sup_service,
    }
    console.log(save_data)

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
        let res = await quartation.ajax_save_quotation(save_data)
        console.log(res);
        Swal.fire(
          'saved!',
          'Your file has been saved.',
          'success'
        )
      }
    })
  },
  ajax_save_quotation: function (data) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        type: 'post',
        url: 'php/quotation/save_quotation.php',
        data: data,
        dataType: 'json',
        success: function (response) {
          resolve(response)
        },
      })
    })
  },
  // fillter_route_carrier: async function (e) {

  //   let parent = $(e).closest('.base-add')
  //   console.log(parent)
  //   let val = $(e).val()
  //   console.log(val)
  //   $('.inp-carrier-type', parent).val('')
  //   $(
  //     'select.inp-port_load, select.inp-port_del ,input.inp_budget, select.select-currency',
  //     parent,
  //   ).val('')

  //   let res = await quartation.ajax_get_containner_by_route({
  //     carrier_no: val,
  //   })

  //   $('.inp-carrier-type>option', parent).hide()
  //   $('.inp-port_load>option', parent).hide()
  //   $('.inp-port_del>option', parent).hide()

  //   $.each(res, function (i, v) {
  //     container_type = v['container_type']
  //     pol = v['pol']
  //     pod = v['pod']

  //     $(
  //       '.inp-carrier-type>option[value="' + container_type + '"]',
  //       parent,
  //     ).show()
  //     $('.inp-port_load>option[value="' + pol + '"]', parent).show()
  //     $('.inp-port_del>option[value="' + pod + '"]', parent).show()
  //   })
  // },

  fillter_route: async function (e) {
    let parent = $(e).closest('.base-add')
    let carrier = $('.inp-carrier', parent).val()
    let carrier_type = $('.inp-carrier-type', parent).val()
    let carrier_pl = $('.inp-port_load', parent).val()
    let carrier_pd = $('.inp-port_del', parent).val()
    let carrier_qty =  $('.inp_qty',parent).val();
    

    let res_data = await quartation.ajax_get_route()

    let carrier_rs = res_data['route_set'].filter(res_data => res_data.carrier_number == carrier)
    let container_size_rs = '';

    if (carrier_type != '') {
      container_size_rs = carrier_rs.filter(res_data => res_data.container_type == carrier_type)
    } else {
      container_size_rs = carrier_rs.filter(res_data => res_data.container_type != '')
    }
    if (carrier_pl != '') {
      pol_rs = container_size_rs.filter(res_data => res_data.pol == carrier_pl)
    } else {
      pol_rs = container_size_rs.filter(res_data => res_data.pol != '')
    }
    if (carrier_pd != '') {
      pod_rs = pol_rs.filter(res_data => res_data.pod == carrier_pd)
    } else {
      pod_rs = pol_rs.filter(res_data => res_data.pod != '')
    }

    if(pod_rs.length == 1){
      $('.inp_budget',parent).val(pod_rs[0]['price']*carrier_qty)
      $('.select-currency'.parent).val(pod_rs[0]['currency'])
      $('.inp_route_id_save',parent).val(pod_rs[0]['ID'])
    }else{
      $('.inp_budget',parent).val('')

    }

  },


  ajax_get_route: async function (data_get) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        type: 'post',
        url: 'php/quotation/get_route.php',
        data: data_get,
        dataType: 'json',
        success: function (response) {
          resolve(response)
        },
      })
    })
  },

  ajax_get_containner_by_route: function (data) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        type: 'post',
        url: 'php/quotation/get_container_by_route.php',
        data: data,
        dataType: 'json',
        success: function (response) {
          resolve(response)
        },
      })
    })
  },
  check_base_input: async function () {
    $(document).on('change', '.base-add select, .base-add input', async function (e) {
      var parent = $(this).closest('.base-add')
      let data_st = null
      var d_carrier = '';
      var d_carrier_type = '';
      var d_pol = '';
      var d_pod = '';
      var d_qty = '';
      data = []
      $(
        $('select:not(.select-currency), input:not(.inp_budget)', parent),
      ).each(async function (i, e) {
        // console.log(e);
        if (!!$(this).val() && $('input.inp_qty', parent).val() >= 1) {
          console.log('1');
          data_st = 1
          d_carrier = $('.inp-carrier', parent).val();
          d_carrier_type = $('.inp-carrier-type', parent).val();
          d_pol = $('.inp-port_load', parent).val();
          d_pod = $('.inp-port_del', parent).val();
          d_qty = $('.inp_qty', parent).val();
        } else {
          data_st = 0
          // console.log('0');
        }
      })
      if (data_st === 1) {
        var data = {
          'carrier': d_carrier,
          'carrier_type': d_carrier_type,
          'pol': d_pol,
          'pod': d_pod,
          'total': d_qty,
        }
        let res = await quartation.check_base_route(data)
        let total_budget = (d_qty * res[0]['price']);
        let curr = res[0]['currency']
        $('.inp_budget', parent).val(total_budget);
        $('.select-currency', parent).val(curr);

      }

      // console.log(4)
    },
    )
  },
  check_base_route: function (data) {
    return new Promise(function (resolve, reject) {
      $.ajax({
        type: 'post',
        url: 'php/quotation/check_route_input.php',
        data: data,
        dataType: 'json',
        success: function (response) {
          resolve(response)
        },
      })
    })
  },
  del_truck_fee_export: function (e = null) {
    $(e).closest('.truck_fee_export_row').remove()
  },
  del_truck_fee_import: function (e = null) {
    $(e).closest('.truck_fee_import_row').remove()
  },
  quick_markup: function (e = null) {
    let url_get = '?quartation_number=' + quartation.get_quono;
    let url_get_action = '&action=' + 'preview';

    window.location.href = "CHL-Quartation-markup.php" + url_get + url_get_action;
  },

  fn_save_raw : async function (){
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
            
            let corp_name = $('.inp-cname').val()
            let corp_address = $('.inp-address').val()
            let corp_tax_id = $('.inp-tax_id').val()
            let corp_email = $('.inp-email').val()
            let corp_phone_number = $('.inp-phone_number').val()
            let corp_fax = $('.inp-fax').val()
            let corp_linkman = $('.inp-linkman').val()
            let corp_contact_tel = $('.inp-contact').val()

            let check_val = 0;

            if(corp_name == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Detail data is missing plese check your data !',
                })
                check_val = 1;
            }

            if(check_val == 0){
               uset_arr_temp = {
                consignee_id : '',
                corp_name : corp_name,
                corp_address : corp_address,
                corp_tax_id : corp_tax_id,
                corp_email : corp_email,
                corp_phone_number : corp_phone_number,
                corp_fax : corp_fax,
                corp_linkman : corp_linkman,
                corp_contact_tel : corp_contact_tel,
               }
               console.log(uset_arr_temp)

                let res_save_raw_data  = await this.ajax_save_raw_data_consignee(uset_arr_temp)
                console.log(res_save_raw_data)
                if(res_save_raw_data['st'] == '4'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Cannot has save your data because corporate name is duplicate please change corporate name',
                    })
                }else if(res_save_raw_data['st'] == '1'){
                    await Swal.fire(
                        'saved!',
                        'Your file has been saved.',
                        'success'
                    )
                    $('#add_consignee_moda').modal('hide');
                }else if(res_save_raw_data['st'] == '0'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Save is false plese contact to support tech team',
                    })
                }
            }
        }
    })
},

ajax_save_raw_data_consignee : async function (uset_arr_temp){
    return new Promise(function (resolve, reject) {
        $.ajax({
            type: "post",
            url: "php/consignee-management/save_raw_data_user.php",
            data: {'uset_arr_temp' : uset_arr_temp},
            dataType: "json",
            success: function (res) {
                resolve(res);
            },
        });
    });
}


}






$(async function () {

  await quartation.html_consignee()
  await quartation.html_shipment()
  await quartation.check_get()
  await quartation.check_base_input()
})

$(document).ready(function () {
  quartation.check_base_input();

});
