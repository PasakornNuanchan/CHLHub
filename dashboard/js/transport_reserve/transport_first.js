const transport_first = {
    setting_default : async function(){
        let res_data = await this.ajax_setting_default()
        console.log(res_data)
        html_data_supplier = '';
        if(res_data['supplier'] != "0 results"){
            $.each(res_data['supplier'],function(i,v){
                html_data_supplier += `<option value="${v['ID']}">${v['transport_sup_name']}</option>`
            })
        }
        
    },

    ajax_setting_default : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport_reserve/get_data_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    setting_first : async function(){
        let res_data = await this.ajax_setting_data_first()
        console.log(res_data)
        if(res_data['task'] != "0 results"){
            $('.data_transport').html('')
            $.each(res_data['task'],function(i,v){
                let id_number = v['ID'] ? v['ID'] : '';
                let job_number = v['job_number'] ? v['job_number'] : '';
                let sup_number = v['sup_number'] ? v['sup_number'] : '';
                let truck_quantity = v['truck_quantity'] ? v['truck_quantity'] : '';
                let pick_con_empty_address = v['pick_con_empty_address'] ? v['pick_con_empty_address'] : '';
                let pick_con_empty_remark = v['pick_con_empty_remark'] ? v['pick_con_empty_remark'] : '';
                let pick_con_address = v['pick_con_address'] ? v['pick_con_address'] : '';
                let pick_con_remark = v['pick_con_remark'] ? v['pick_con_remark'] : '';
                let drop_con_address = v['drop_con_address'] ? v['drop_con_address'] : '';
                let drop_con_remark = v['drop_con_remark'] ? v['drop_con_remark'] : '';
                let drop_con_empty_address = v['drop_con_empty_address'] ? v['drop_con_empty_address'] : '';
                let drop_con_empty_remark = v['drop_con_empty_remark'] ? v['drop_con_empty_remark'] : '';
                let budget = v['budget'] ? v['budget'] : '';
                let cur = v['cur'] ? v['cur'] : '';
                let sent_line_datetime = v['sent_line_datetime'] ? v['sent_line_datetime'] : '';
                let sup_confirm = v['sup_confirm'] ? v['sup_confirm'] : '';
                let type_truck = v['type_truck'] ? v['type_truck'] : '';
                let remark = v['remark'] ? v['remark'] : '';
                let status = v['status'] ? v['status'] : '';
                let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                let ggpick_con_empty_address = v['ggpick_con_empty_address'] ? v['ggpick_con_empty_address'] : '';
                let ggpick_con_address = v['ggpick_con_address'] ? v['ggpick_con_address'] : '';
                let ggdrop_con_address = v['ggdrop_con_address'] ? v['ggdrop_con_address'] : '';
                let ggdrop_con_empty_address = v['ggdrop_con_empty_address'] ? v['ggdrop_con_empty_address'] : '';
                let count_container = v['count_container'] ? v['count_container'] : '';
                let delivery_date = v['delivery_date'] ? v['delivery_date'] : '';
                let clearance_date = v['clearance_date'] ? v['clearance_date'] : '';
    
                let html_container = '';
                $.each(res_data['container'][ref_job_id],function(i1,v1){
                let container_type = v1['container_type'] ? v1['container_type'] : '';
                let container_number = v1['container_number'] ? v1['container_number'] : '';
                let gw = v1['gw'] ? v1['gw'] : '';
                let container_type_name = v1['container_type_name'] ? v1['container_type_name'] : '';

                html_container += `<tr>
                    <td class="text-center">1</td>
                    <td><input type="text" class="form-control form-control-sm text-center inp_container_type"  readonly type_sub_name="${container_type}" value="${container_type_name}"></td>
                    <td><input type="text" class="form-control form-control-sm text-center inp_container_name"  readonly value="${container_number}"></td>
                    <td><input type="text" class="form-control form-control-sm text-center inp_container_gw"  readonly value="${gw}"></td>
                </tr>`
                })
                


                let html_card_transport = `
                <div class="card" id_number="${id_number}" rjid="${ref_job_id}">
                    <div class="card-body">
                        <div class="mx-auto">
                            <div class="form-group row text-center">
                                <div class="col-lg-1 col-xl-1"><label for="">From</label></div>
                                <div class="col-lg-2 col-xl-2"><input type="text" class="form-control form-control-sm" value="${pick_con_address}" readonly></div>
                                <div class="col-lg-1 col-xl-1"><label for="">To</label></div>
                                <div class="col-lg-2 col-xl-2"><input type="text" class="form-control form-control-sm" value="${drop_con_address}" readonly></div>
                                <div class="col-lg-1 col-xl-1"><label for="">Container quantity</label></div>
                                <div class="col-lg-1 col-xl-1"><input type="text" class="form-control form-control-sm" value="${count_container}" readonly></div>
                                <div class="col-lg-1 col-xl-1"><label for="">Supplier</label></div>
                                <div class="col-lg-2 col-xl-2"><select class="form-select form-select-sm" name="" id="">
                                    <option value="">Please select supplier</option>
                                       ${html_data_supplier}
                                    </select></div>
                            </div>
                            <div class="form-group row text-center">
                                <div class="col-lg-1 col-xl-1"><label for="">Job number</label></div>
                                <div class="col-lg-2 col-xl-2"><input type="text" class="form-control form-control-sm inp_job_number" value="${job_number}" readonly></div>
                                <div class="col-lg-1 col-xl-1"><label for="">Clearlance date</label></div>
                                <div class="col-lg-2 col-xl-2"><input type="datetime-local" class="form-control form-control-sm inp_clearance_date" value="${clearance_date}" readonly></div>
                                <div class="col-lg-1 col-xl-1"><label for="">Delivery date plan</label></div>
                                <div class="col-lg-2 col-xl-2"><input type="datetime-local" class="form-control form-control-sm inp_delivery_plan" value="${delivery_date}" readonly></div>
                                <!-- <div class="col-lg-1 col-xl-1"><label for="">Container Plan</label></div>
                                <div class="col-lg-1 col-xl-1"><input type="text" class="form-control form-control-sm " value="${count_container}"></div> -->
                            </div>
                            <div class="text-end">
                                <button class="btn btn-outline-primary btn-sm">save</button>
                                <button class="btn btn-outline-primary btn-sm" onclick="transport_function.get_to_copy(this)">copy context</button>
                            </div>
                            <div class="text-center">
                                <span class="badge rounded-pill bg-secondary text-light" data-bs-toggle="collapse" href="#collatog${i}">see more</span>
                            </div>
                        </div>
                        <div id="collatog${i}" class="collapse p-4">
                            <div class="form-group row text-center">
                                <div class="col-lg-2 col-xl-2"><label for="">Pickup Empty Container Address</label></div>
                                <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="${pick_con_empty_address}" readonly></div>
                                <div class="col-lg-2 col-xl-2"><label for="">remark</label></div>
                                <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="${pick_con_empty_remark}" readonly></div>
                            </div>
                            <div class="form-group row text-center">
                                <div class="col-lg-2 col-xl-2"><label for="">Loading Address</label></div>
                                <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="${pick_con_address}" readonly></div>
                                <div class="col-lg-2 col-xl-2"><label for="">remark</label></div>
                                <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="${pick_con_remark}" readonly></div>
                            </div>
                            <div class="form-group row text-center">
                                <div class="col-lg-2 col-xl-2"><label for="">Delivery Container Address</label></div>
                                <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="${drop_con_address}" readonly></div>
                                <div class="col-lg-2 col-xl-2"><label for="">remark</label></div>
                                <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="${drop_con_remark}" readonly></div>
                            </div>
                            <div class="form-group row text-center">
                                <div class="col-lg-2 col-xl-2"><label for="">Drop off Empty Containe Address</label></div>
                                <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="${drop_con_empty_address}" readonly></div>
                                <div class="col-lg-2 col-xl-2"><label for="">remark</label></div>
                                <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="${drop_con_empty_remark}" readonly></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Container Type</th>
                                            <th>Container Number</th>
                                            <th>GW</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${html_container}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                $('.data_transport').append(html_card_transport)
            })
        }
        
        
    },

    ajax_setting_data_first : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport_reserve/get_data_transport.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

}