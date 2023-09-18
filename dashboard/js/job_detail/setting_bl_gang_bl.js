const sub_gang_bl = {
    setting_first_bl_gang: async function () {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let res_data = await this.get_bl_data(id_number)
        console.log(res_data)
        let html_data_header = '';
        if (res_data['bl_title'] != "0 results") {
        $.each(res_data['bl_title'], async function (i, v) {
            html_data_header += `
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded" id="bl_tab${v['ID']}" data-bs-toggle="pill" data-bs-target="#bl_tab_target${v['ID']}" type="button" role="tab" aria-controls="pills-profile${v['ID']}" aria-selected="false">Bill of Lading</button>
            </li>
            `;
        })
        }
        $('#pills-tab').append(html_data_header)

        let html_data_pill = '';
        if (res_data['bl_title'] != "0 results") {
            $.each(res_data['bl_title'], async function (i, v) {

                let hbl = v['hbl'] ? v['hbl'] : '';
                let id_data = v['ID'] ? v['ID'] : '';

                html_data_pill = `
            <div class="tab-pane fade bl_tab_target" id="bl_tab_target${v['ID']}" bl_number="${id_data}" role="tabpanel" aria-labelledby="bl_tab${v['ID']}">
                <div class="row">
                <div class=" col-xl-7 col-lg-7">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Bill of Landing</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">HBL : </label>
                                    <div class="col">
                                        <input class="form-control form-control-sm inp_hbl" value="${hbl}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Shipper : </label>
                                    <div class="col">
                                        <textarea class="form-control inp_bl_shipping inp_bl_shipping${i}" id="exampleFormControlTextarea1" rows="5" maxlength="400" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Consignee : </label>
                                    <div class="col">
                                        <textarea class="form-control inp_bl_consingee inp_bl_consingee${i}" id="exampleFormControlTextarea1" rows="5" maxlength="400" ></textarea>
                                        <button class="btn btn-sm btn-outline-primary" onclick="function_sub_bl.address_consignee(this)">Save as consignee</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Notify Party : </label>
                                    <div class="col">
                                        <textarea class="form-control inp_notify_bl inp_notify_bl${i}" id="exampleFormControlTextarea1" rows="5" maxlength="400"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Pre-Carriage By : </label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_pre_carriage inp_pre_carriage${i}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Place of Receipt : </label>
                                    <div class="col">
                                        <select class="form-select form-select-sm bl_por inp_bl_por${i} inp_bl_por" >
                                            <option value="select place of receipt"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Port of loading : </label>
                                    <div class="col">
                                        <select class="form-select form-select-sm bl_pol inp_bl_pol${i} inp_bl_pol " disabled>
                                            <option value="select port of lading"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Port of Discharge : </label>
                                    <div class="col">
                                        <select class="form-select form-select-sm bl_pod inp_bl_pod${i} inp_bl_pod " disabled>
                                            <option value="select port of discharge"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Place of delivery : </label>
                                    <div class="col">
                                        <select class="form-select form-select-sm bl_pode inp_bl_pode${i} inp_bl_pode " disabled>
                                            <option value="select place of delivery"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Vessel : </label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_mother_vessel inp_mother_vessel${i}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="card p-4 ">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="form-group mt-4">
                                <div class="row">
                                    <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">Bill header : </label>
                                    <div class="col">
                                        <select class="form-select form-select-sm inp_bill_header_bl inp_bill_header_bl${i}">
                                            <option value="">Select bill header</option>
                                            <option value="CHL">CHINA HIGHWIN LIMITED</option>
                                            <option value="THS">TH SHIPPING CONTAINER LINE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">Delivery Agent : </label>
                                    <div class="col">
                                        <textarea class="form-control inp_delivery_agent_bl inp_delivery_agent_bl${i}" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">ship on board date: </label>
                                    <div class="col">
                                        <input type="date" class="form-control form-control-sm inp_shipper_on_board inp_shipper_on_board${i}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">surrender date: </label>
                                    <div class="col">
                                        <input type="date" class="form-control form-control-sm inp_on_board_date inp_on_board_date${i}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3"> Final destination</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_final_destination inp_final_destination${i}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">No. of Original B(s)/L : </label>
                                    <div class="col">
                                        <input type="number" class="form-control form-control-sm inp_bl_number inp_bl_number${i}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">Place of issue : </label>
                                    <div class="col">
                                        <input class="form-control form-control-sm inp_place inp_place${i}" list="place_list" maxlength="60">
                                        <datalist id="place_list">
                                            <option value="Bangkok">
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">payble at: </label>
                                    <div class="col">
                                        <input class="form-control form-control-sm inp_payble inp_payble${i}" list="place_list" maxlength="60">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-4">
                    <div class="card-header">
                        <h4>Bill of lading detail</h4>
                        <div class="bd-example table-responsive">
                            <table class="table table-hover table_detail_bl table_detail_bl${id_data}" id_list="${id_data}">
                                <thead class="text-center">
                                    <tr>
                                        <th row="2">Container No. & Seal No. Marks and Number</th>
                                        <th>No.of Container or package</th>
                                        <th>unit</th>
                                        <th>Kind of package; Description of goods</th>
                                        <th>Gross Weight</th>
                                        <th>unit</th>
                                        <th>Measurement</th>
                                        <th>unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><textarea class="form-control inp_container_no_and_seal" id="exampleFormControlTextarea1" rows="4"></textarea></td>
                                        <td><input type="text" class="form-control form-control-sm inp_container_or_package"></td>
                                        <td><select class="form-select form-select-sm inp_unit_package">
                                                <option value="">-- select unit --</option>
                                                ${setting_data_default.data_unit}
                                            </select></td>
                                        <td><textarea class="form-control inp_kind_of_package" id="exampleFormControlTextarea1" rows="4"></textarea></td>
                                        <td><input type="text" class="form-control form-control-sm inp_gross_Weight"></td>
                                        <td><input type="text" class="form-control form-control-sm inp_gross_weight_unit" value="KGS" disabled></td>
                                        <td><input type="text" class="form-control form-control-sm inp_mesurement"></td>
                                        <td><input type="text" class="form-control form-control-sm inp_mesurement_unit" value="CBM" disabled></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- <button class="btn btn-outline-primary btn-sm col-xl-12 col-lg-12 col-md-12 col-sx-12" onclick="function_sub_bl.add_detail_bl()">Add detail</button> -->
                    </div>
                </div>
                
                <div class="card p-4">
                    <div class="card-header">
                        <h4>Container</h4>
                    </div>
                    <div class="card-body">
                        <div class="bd-example table-responsive">
                            <table class="table table-hover table_container_bl">
                                <thead>
                                    <tr class="text-center">
                                        <th>Contianer type</th>
                                        <th>Container number</th>
                                        <th>Seal number</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Weight</th>
                                        <th>CBM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><select class="form-select form-select-sm bl_container_type inp_bl_contianer_type">
                                                <option value="">select container type</option>
                                            </select></td>
                                        <td><input type="text" class="form-control form-control-sm"></td>

                                        <td><input type="text" class="form-control form-control-sm inp_quantity_bl"></td>
                                        <td>
                                            <select class="form-select form-select-sm inp_unit_bl">
                                                <option value="BAGS">BAGS</option>
                                                <option value="BALES">BALES</option>
                                                <option value="BOXES">BOXES</option>
                                                <option value="BUNDLES">BUNDLES</option>
                                                <option value="CANS">CANS</option>
                                                <option value="CATRONS">CATRONS</option>
                                                <option value="CASES">CASES</option>
                                                <option value="CRATES">CRATES</option>
                                                <option value="CARTON">CARTON</option>
                                                <option value="CTNS">CTNS</option>
                                                <option value="DOZENS">DOZENS</option>
                                                <option value="DRUMS">DRUMS</option>
                                                <option value="LOTS">LOTS</option>
                                                <option value="PACKAGES">PACKAGES</option>
                                                <option value="PAIRS">PAIRS</option>
                                                <option value="PALLET(S)">PALLET(S)</option>
                                                <option value="PAPER PLTS">PAPER PLTS</option>
                                                <option value="PCS">PCS</option>
                                                <option value="PIECES">PIECES</option>
                                                <option value="PKGS">PKGS</option>
                                                <option value="PLASTIC PLTS">PLASTIC PLTS</option>
                                                <option value="PLTS">PLTS</option>
                                                <option value="PLYWOOD CASE(S)">PLYWOOD CASE(S)</option>
                                                <option value="RACKS">RACKS</option>
                                                <option value="REELS">REELS</option>
                                                <option value="ROLLS">ROLLS</option>
                                                <option value="SACKS">SACKS</option>
                                                <option value="SETS">SETS</option>
                                                <option value="SHEET">SHEET</option>
                                                <option value="STEEL CASES">STEEL CASES</option>
                                                <option value="TANKS">TANKS</option>
                                                <option value="TINS">TINS</option>
                                                <option value="TRAYS">TRAYS</option>
                                                <option value="UNIT">UNIT</option>
                                                <option value="CREATE">W/CREATE</option>
                                                <option value="WOODEN CASES">WOODEN CASES</option>
                                            </select>
                                            <!-- <input type="text" class="form-control form-control-sm inp_unit_bl"> -->
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm"></td>
                                        <td><input type="text" class="form-control form-control-sm inp_cbm_bl" "></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <div class="form-group">
                                <div class="row text-center">
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <label>Total : Quantity </label>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <input type="text" class="form-control form-control-sm inp_package_total text-end" disabled>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <label class="col-xl-3">Weight </label>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <input type="text" class="form-control form-control-sm inp_weight_total text-end" disabled>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <label class="col-xl-3">CBM </label>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <input type="text" class="form-control form-control-sm col-xl-2 inp_cbm_total text-end" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-4">
                    <div class="card-header"><h4>Frieight charges on</h4></div>
                    <div class="card-body">
                        <div class="bd-exsample table-responsive">
                            <table class="table table-hover table_fright table_fright${i}   table_select_fright${v['ID']}" ref_id_row="${v['ID']}" id_number="${id_number}">
                                <thead>
                                    <tr>                                        
                                        <th>Frieight charges on</th>
                                        <th>Prepaid</th>
                                        <th>Collect</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control form-control-sm inp_charge"></td>
                                        <td><input type="text" class="form-control form-control-sm inp_prepaid"></td>
                                        <td><input type="text" class="form-control form-control-sm inp_collect"></td>
                                        <td><button class="btn btn-sm btn-danger" onclick="function_sub_bl.delete_fright(this)"><i class="bi bi-trash"></i> Del</button></td>
                                    </tr>
                                </tody>
                            </table>
                        </div>
                        <div><button class="btn btn-sm btn-primary col-xl-12 col-lg-12 col-md-12" onclick="function_sub_bl.add_fright(this)">add rows fright charge on</button></div>
                        
                    </div>
                    <div class="text-end">
                        <button class="btn btn-success btn-sm rounded" onclick="function_sub_bl.get_save_data(this)"><i class="bi bi-save"></i> save</button>
                        <button class="btn btn-outline-primary btn-sm" onclick="function_sub_bl.generate_telex_line(this)">Telex release BL</button>
                        <button class="btn btn-outline-primary btn-sm" onclick="function_sub_bl.generate_bl(this)">Generate BL</button>
                        <button class="btn btn-outline-primary btn-sm" onclick="function_sub_bl.generate_bl_line(this)">Generate BL With line</button>
                    </div>
                </div>
                </div>
            </div>
            `;

                let shipper_bl = v['shipper_bl'] ? v['shipper_bl'] : '';
                let consignee_bl = v['consignee_bl'] ? v['consignee_bl'] : '';
                let notify_bl = v['notify_party'] ? v['notify_party'] : '';
                let feeder = v['feeder_vessel'] ? v['feeder_vessel'] : '';
                let mother = v['mother_vessel'] ? v['mother_vessel'] : '';
                let port_of_receipt_number = v['port_of_receipt_number'] ? v['port_of_receipt_number'] : '';
                let port_of_loading_number = v['port_of_loading_number'] ? v['port_of_loading_number'] : '';
                let port_of_discharge = v['port_of_discharge'] ? v['port_of_discharge'] : '';
                let port_of_delivery_number = v['port_of_delivery_number'] ? v['port_of_delivery_number'] : '';

                let bill_header = v['bill_header'] ? v['bill_header'] : '';
                let delivery_agent = v['delivery_agent'] ? v['delivery_agent'] : '';
                let shipper_on_board = v['shipper_on_board'] ? v['shipper_on_board'] : '';
                let on_board_date = v['on_board_date'] ? v['on_board_date'] : '';
                let final_destination = v['final_destination'] ? v['final_destination'] : '';
                let place = v['place'] ? v['place'] : '';
                let original_number = v['bl_number'] ? v['bl_number'] : '';
                let payble_at = v['payble_at'] ? v['payble_at'] : '';

                $('.tab-content').append(html_data_pill)
                $(`.inp_bl_shipping${i}`).val(shipper_bl)
                $(`.inp_bl_consingee${i}`).val(consignee_bl)
                $(`.inp_notify_bl${i}`).val(notify_bl)
                $(`.inp_pre_carriage`).val(feeder)

                $('.sel_bill_ap' + i + ' > select option[value="' + v['bill_to'] + '"][bill_to_type="' + v['bill_to_type'] + '"]').prop('selected', true);

                $(`.inp_bl_por${i}`).append(setting_data_default.data_area)
                $(`.inp_bl_pol${i}`).append(setting_data_default.data_area)
                $(`.inp_bl_pod${i}`).append(setting_data_default.data_area)
                $(`.inp_bl_pode${i}`).append(setting_data_default.data_area)

                $(`.inp_bl_por${i}`).val(port_of_receipt_number).attr('disabled', true)
                $(`.inp_bl_pol${i}`).val(port_of_loading_number).attr('disabled', true)
                $(`.inp_bl_pod${i}`).val(port_of_discharge).attr('disabled', true)
                $(`.inp_bl_pode${i}`).val(port_of_delivery_number).attr('disabled', true)

                $(`.inp_mother_vessel`).val(mother)
                $(`.inp_bill_header_bl${i}`).val(bill_header)
                $(`.inp_delivery_agent_bl${i}`).val(delivery_agent)
                $(`.inp_shipper_on_board${i}`).val(shipper_on_board)
                $(`.inp_on_board_date${i}`).val(on_board_date)
                $(`.inp_final_destination${i}`).val(final_destination)
                $(`.inp_bl_number${i}`).val(original_number)
                $(`.inp_place${i}`).val(place)
                $(`.inp_payble${i}`).val(payble_at)

                

                
            })
        }

        $('.table_fright tbody').html('');
        if(res_data['fright'] != "0 results"){
                    
            $.each(res_data['fright'],function(i1,v1){
                let id_fright = v1['ID'] ? v1['ID'] : '';
                let collect = v1['collect'] ? v1['collect'] : '';
                let fright = v1['fright'] ? v1['fright'] : '';
                let prepaid = v1['prepaid'] ? v1['prepaid'] : '';
                let ref_job_id = v1['ref_job_id'] ? v1['ref_job_id'] : '';
                let ref_row = v1['ref_row'] ? v1['ref_row'] : '';
                
                
                    let html_data_fright = `
                    <tr id_list= "${id_fright}">
                        <td><input type="text" class="form-control form-control-sm inp_charge" value="${fright}"></td>
                        <td><input type="text" class="form-control form-control-sm inp_prepaid" value="${prepaid}"></td>
                        <td><input type="text" class="form-control form-control-sm inp_collect" value="${collect}"></td>
                        <td><button class="btn btn-sm btn-danger" onclick="function_sub_bl.delete_fright(this)"><i class="bi bi-trash"></i> Del</button></td>
                    </tr>
                    `;
    
    
                    $(`.table_select_fright${ref_row} > tbody`).append(html_data_fright)
                
                
            })
        }

        if(res_data['bl_list'] != "0 results"){
            $.each(res_data['bl_list'],function (i,v){
                
                let id_list = v['bl_title_id'] ? v['bl_title_id'] : '';
                let id_row = v['ID'] ? v['ID'] : '';
                $(`.table_detail_bl${id_list} tbody`).html('')

                let container_no = v['container_no'] ? v['container_no'] : '';
                let package = v['package'] ? v['package'] : '';
                let package_unit = v['package_unit'] ? v['package_unit'] : '';
                let kind_of_package = v['kind_of_package'] ? v['kind_of_package'] : '';
                let gross_weight = v['gross_weight'] ? v['gross_weight'] : '';
                let gross_weight_unit = v['gross_weight_unit'] ? v['gross_weight_unit'] : '';
                let measurement = v['measurement'] ? v['measurement'] : '';
                let cbm_unit = v['cbm_unit'] ? v['cbm_unit'] : '';


                let html_bl_list = ` 
                <tr id_list ="${id_list}" id_row = "${id_row}">
                    <td><textarea class="form-control inp_container_no_and_seal inp_container_no_and_seal${i}" id="exampleFormControlTextarea1" rows="4"></textarea></td>
                    <td><input type="text" class="form-control form-control-sm inp_container_or_package inp_container_or_package${i}"></td>
                    <td><select class="form-select form-select-sm inp_unit_package inp_unit_package${i}">
                            <option value="">-- select unit --</option>
                            ${setting_data_default.data_unit}
                        </select></td>
                    <td><textarea class="form-control inp_kind_of_package inp_kind_of_package${i}" id="exampleFormControlTextarea1" rows="4"></textarea></td>
                    <td><input type="text" class="form-control form-control-sm inp_gross_Weight inp_gross_Weight${i}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_gross_weight_unit inp_gross_weight_unit${i}" value="KGS" disabled></td>
                    <td><input type="text" class="form-control form-control-sm inp_mesurement inp_mesurement${i}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_mesurement_unit inp_mesurement_unit${i}" value="CBM" disabled></td>
                </tr>
                `;
                $(`.table_detail_bl${id_list} tbody`).append(html_bl_list)
                $(`.table_detail_bl${id_list} tbody > tr > td > .inp_container_no_and_seal${i}`).val(container_no)
                $(`.table_detail_bl${id_list} tbody > tr > td > .inp_container_or_package${i}`).val(package)
                $(`.table_detail_bl${id_list} tbody > tr > td > .inp_unit_package${i}`).val(package_unit)
                $(`.table_detail_bl${id_list} tbody > tr > td > .inp_kind_of_package${i}`).val(kind_of_package)
                $(`.table_detail_bl${id_list} tbody > tr > td > .inp_gross_Weight${i}`).val(gross_weight)
                $(`.table_detail_bl${id_list} tbody > tr > td > .inp_gross_weight_unit${i}`).val(gross_weight_unit)
                $(`.table_detail_bl${id_list} tbody > tr > td > .inp_mesurement${i}`).val(measurement)
                $(`.table_detail_bl${id_list} tbody > tr > td > .inp_mesurement_unit${i}`).val(cbm_unit)
            })
        }

        
        let cal_quantity_end = 0;
        let cal_weight_end = 0;
        let cal_cbm = 0;
        if (res_data['container'] != "0 results") {

            $('.table_container_bl tbody').html('')
            $.each(res_data['container'], function (i, v) {
                

                let container_id = v['ID'] ? v['ID'] : '';
                let container_type = v['container_type'] ? v['container_type'] : '';
                let container_number = v['container_number'] ? v['container_number'] : '';
                let seal_number = v['seal_number'] ? v['seal_number'] : '';
                let package = v['package'] ? v['package'] : '';
                let unit = v['unit'] ? v['unit'] : '';
                let gw = v['gw'] ? v['gw'] : '';
                let volume = v['volume'] ? v['volume'] : '';

                let data_html = `
                <tr container_id = "${container_id}">
                    <td><select class="form-select form-select-sm bl_container_type inp_bl_contianer_type inp_bl_contianer_type${i}">
                            <option value="">select container type</option>
                            ${setting_data_default.data_container_type}
                        </select></td>
                    <td><input type="text" class="form-control form-control-sm inp_container_number_bl inp_container_number_bl${i}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_seal_number_bl inp_seal_number_bl${i}"></td>
                    <td><input type="text" class="form-control form-control-sm text-end inp_quantity_bl inp_quantity_bl${i}"></td>
                    <td><select class="form-select form-select-sm inp_bl_unit_data inp_bl_unit_data${i}">
                            <option value="">-- select data --</option>
                            ${setting_data_default.data_unit}
                        </select>
                    </td>
                    <td><input type="text" class="form-control form-control-sm text-end inp_weight_bl inp_weight_bl${i}" onchange="function_sub_bl.cal_container_weight(this)"></td>
                    <td><input type="text" class="form-control form-control-sm text-end inp_cbm_bl inp_cbm_bl${i}" onchange="function_sub_bl.cal_container_cbm(this)"></td>
                </tr>
                `;

                $('.table_container_bl tbody').append(data_html)
                $(`.inp_bl_contianer_type${i}`).val(container_type).attr('disabled', true)
                $(`.inp_container_number_bl${i}`).val(container_number)
                $(`.inp_seal_number_bl${i}`).val(seal_number)
                $(`.inp_quantity_bl${i}`).val(package)
                $(`.inp_bl_unit_data${i}`).val(unit)
                $(`.inp_weight_bl${i}`).val(gw)
                $(`.inp_cbm_bl${i}`).val(volume)

                cal_quantity_end   = parseFloat(cal_quantity_end) + parseFloat(package)
                cal_weight_end = parseFloat(cal_weight_end) + parseFloat(gw)
                cal_cbm = parseFloat(cal_cbm) + parseFloat(volume)

                
            })
        }
        $('.inp_package_total').val(cal_quantity_end)
        $('.inp_weight_total').val(cal_weight_end)
        $('.inp_cbm_total').val(cal_cbm)

        

        
        

    },

    get_bl_data: function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_bl_gang_data.php",
                data: {
                    id_number: id_number
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}