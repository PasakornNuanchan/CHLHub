const sub_job_detail = {
    data_select_container: '',
    data_container_for_transport : '',
    select_packing_global : '',
    first_post_data: async function (data) {
        //data = 1;
        let res_data = await this.ajax_request_first(data);
        // console.log(res_data)
        this.data_container_for_transport = res_data['container'];
        //job_detail

        let job_number_data = res_data['job_title']['job_number'] ? res_data['job_title']['job_number'] : '';
        if(job_number_data != ''){
            $('.generate_job_func').remove();
        }

        // let notify_type =  v['notify_type'] ? v['notify_type'] : '';
        // let notify_number =  v['notify_number'] ? v['notify_number'] : '';
        // let client_type =  v['client_type'] ? v['client_type'] : '';
        // let client_number =  v['client_number'] ? v['client_number'] : '';

        let notify_type = res_data['job_title']['notify_type'] ? res_data['job_title']['notify_type'] : '';
        let notify_number = res_data['job_title']['notify_number'] ? res_data['job_title']['notify_number'] : '';
        let client_type = res_data['job_title']['client_type'] ? res_data['job_title']['client_type'] : '';
        let client_number = res_data['job_title']['client_number'] ? res_data['job_title']['client_number'] : '';

        //$(`.select_bill_to_ar option[type="${bill_to_type}"][value="${bill_to}"]`).prop('selected', true);

        $(`.inp_client option[type_data="${client_type}"][value="${client_number}"]`).prop('selected',true)
        $(`.inp_notify_job_detail option[type_data="${notify_type}"][value="${notify_number}"]`).prop('selected',true)

        $('.inp_create_date').val(res_data['job_title']['create_date'])
        $('.inp_jobnumber').val(res_data['job_title']['job_number'])
        $('.inp_bookingnumber').val(res_data['job_title']['booking_number'])
        $('.inp_consignee').val(res_data['job_title']['consignee_number'])
        $('.inp_shipper').val(res_data['job_title']['shipper_number'])
        $('.inp_shipment').val(res_data['job_title']['st_number'])
        $('.inp_remark').val(res_data['job_title']['remark'])
        $('.inp_carrier').val(res_data['job_title']['carrier_number'])
        $('.inp_port_of_receipt').val(res_data['job_title']['port_of_receipt_number'])
        $('.inp_port_of_loading').val(res_data['job_title']['port_of_loading_number'])
        $('.inp_ts_port').val(res_data['job_title']['ts_port_number'])
        $('.inp_port_of_discharge').val(res_data['job_title']['port_of_discharge'])
        $('.inp_port_of_delivery').val(res_data['job_title']['port_of_delivery_number'])
        $('.inp_mother_vessel').val(res_data['job_title']['mother_vessel'])
        $('.inp_feeder_vessel').val(res_data['job_title']['feeder_vessel'])
        $('.inp_etd').val(res_data['job_title']['etd'])
        $('.inp_eta').val(res_data['job_title']['eta'])
        $('.inp_inv').val(res_data['job_title']['inv'])
        $('.inp_mbl').val(res_data['job_title']['mbl'])
        $('.inp_finaldestination').val(res_data['job_title']['final_destination'])

        //$('.inp_hbl').val(res_data['job_title']['hbl'])

        if(res_data['hbl_data'] != "0 results"){
            $('.hbl_added').html('')
            $.each(res_data['hbl_data'],function(i,v){
                let hbl_data = v['hbl'] ? v['hbl'] : '';
                let id_hbl = v['ID'] ? v['ID'] : '';
                
                let html_data = `
                <div class="form-group row" id_hbl="${id_hbl}">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center " maxlength="100">H B/L:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <div class="row">
                            <div class="col-sm-11 col-md-10 col-lg-11">
                                <input type="text" class="form-control form-control-sm inp_hbl hbl_sel_data" value="${hbl_data}">
                            </div>
                            <div class="col-sm-1 col-md-2 col-lg-1">
                                <button class="btn btn-outline-danger btn_delete_hbl btn-sm" onclick="function_sub_job_detail.delete_data_hbl(this)"><i class="bi bi-trash" ></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                $('.hbl_added').append(html_data)
            })
        }
        





        $('.inp_commodity').val(res_data['job_title']['commodity'])
        $('.inp_delivery_place').val(res_data['job_title']['delivery_place'])
        // container information 
        $('.inp_cargo_des').val(res_data['container_information']['cargo'])
        $('.inp_cargo_type').val(res_data['container_information']['cargo_type'])
        $('.inp_quantity').val(res_data['container_information']['quantity'])
        $('.inp_gw').val(res_data['container_information']['gw'])
        $('.inp_vol').val(res_data['container_information']['volume'])
        $('.inp_remark_container').val(res_data['container_information']['mark'])
        //booking_agent
        $('.inp_booking_agent').val(res_data['job_title']['booking_agent'])

        $('.inp_cs_user').val(res_data['job_title']['cs_support'])
        $('.inp_sale_user').val(res_data['job_title']['sale_support'])
        //container 
        let select_packing = $('.inp_select_packing').parent().html();
        this.select_packing_global = select_packing;
        html_container_type = $('#container_type_data').parent().html();
        
        this.data_select_container = $('.inp_container_type').parent().html()
        $('.table_data_container > tbody').html('')
        $('.table_container_module tbody').html('')
        $('.table_container_v2 tbody').html('')
        
        let notify = res_data['job_title']['notify'] ? res_data['job_title']['notify'] : '';
        $('.inp_notify').val(notify)

        if (res_data['data_container'] != "0 results") {
            let html_data_container_group = '';
            $.each(res_data['data_container'], async function (i, v) {
                i++;
                let count_data_row = v['count_data_row'] ? v['count_data_row'] : '';
                let container_type = v['container_type'] ? v['container_type'] : '';
                html_data_container_group = `
                <tr container_have_data = "1">
                    <td class="text-center"><div class="q_container"></div></td>
                    <td class="container_type_data_selector${i}" >${sub_job_detail.data_select_container}</td>
                    <td><input type="number" class="form-control form-control-sm text-center inp_num_q" value="${count_data_row}" disabled></td>
                    <td class="text-center"><button class="btn btn-danger btn_delete_container btn-sm" onclick="function_sub_job_detail.delete_container_main(this,${i})"><i class="bi bi-trash"></i></button></td>
                </tr>
                `;

                $('.table_container_v2 tbody').append(html_data_container_group)
                $(`.table_container_v2 > tbody > tr > .container_type_data_selector${i} > .inp_container_type`).val(container_type).attr('disabled', true)
                
                if (res_data['container'] != "0 results") {
                    $.each(res_data['container'], function (i1, v1) {
                        if (v1['container_type'] == v['container_type']) {
                            let id_container = v1['ID'] ? v1['ID'] : '';
                            let data_container_v1 = v1['container_type'];
                            let container_number = v1['container_number'] ? v1['container_number'] : '';
                            let cargo_description = v1['cargo_description'] ? v1['cargo_description'] : '';
                            let single_cnt = v1['single_cnt'] ? v1['single_cnt'] : '';
                            let package = v1['package'] ? v1['package'] : '';
                            let gw = v1['gw'] ? v1['gw'] : '';
                            let volume = v1['volume'] ? v1['volume'] : '';
                            let seal_number = v1['seal_number'] ? v1['seal_number'] : '';
                            let cy = v1['cy'] ? v1['cy'] : '';
                            let rtn = v1['rtn'] ? v1['rtn'] : '';
                            let remark = v1['remark'] ? v1['remark'] : '';
                            let unit = v1['unit'] ? v1['unit'] : '';
                            
                            let data_vgm = parseFloat(single_cnt) + parseFloat(gw);

                            let html_container_module = `
                                <tr class="container_data_q${i1}" id_container_module = "${id_container}">
                                    <td class="text-center"><div class="q_container_module"></div></td>
                                    <td>${sub_job_detail.data_select_container}</td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_container_number" maxlength="30" value="${container_number}"></td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_seal_number" maxlength="30" value="${seal_number}"></td>
                                    <td><input type="number" class="form-control form-control-sm text-center inp_single_weight" value="${single_cnt}" onchange="function_sub_job_detail.cal_vgm(this)"></td>
                                    <td><input type="number" class="form-control form-control-sm text-center inp_package" maxlength="40" value="${package}"></td>
                                    <td>${select_packing}</td>
                                    <td><input type="number" class="form-control form-control-sm text-center inp_gw" value="${gw}" onchange="function_sub_job_detail.cal_vgm(this)"></td>
                                    <td><input type="number" class="form-control form-control-sm text-center inp_volume" value="${volume}"></td>
                                    <td><input type="number" class="form-control form-control-sm text-center inp_vgm" value="${data_vgm}"></td>
                                    <td><input type="date" class="form-control form-control-sm text-center inp_cy" value="${cy}"></td>
                                    <td><input type="date" class="form-control form-control-sm text-center inp_rtn" value="${rtn}"></td>
                                    <td><input type="text" class="form-control form-control-sm text-center inp_remark" maxlength="200" value="${remark}"></td>
                                </tr>
                                `;
                            $('.table_container_module tbody').append(html_container_module)
                            $(`.table_container_module > tbody > .container_data_q${i1} > td > .inp_container_type`).val(data_container_v1).attr('disabled',true)
                            $(`.table_container_module > tbody > .container_data_q${i1} > td > .inp_select_packing`).val(unit)
                        }

                    })
                }
            })
        } else {
            let html_data_container_group = '';
            html_data_container_group = `
            <tr>
                <td class="text-center"><div class="q_container"></div></td>
                <td ">${sub_job_detail.data_select_container}</td>
                <td><input type="number" class="form-control form-control-sm text-center inp_num_q" ></td>
                <td class="text-center"><button class="btn btn-success btn-sm" onclick="function_sub_job_detail.add_container_module(this,1)"><i class="bi bi-plus-circle"></i></button><button class="btn btn-danger btn-sm" onclick="function_sub_job_detail.delete_container_main(this,1)"><i class="bi bi-trash"></i></button></td>
            </tr>
            `;

            $('.table_container_v2 tbody').append(html_data_container_group)

        }


        

        // if (res_data['container'] == "0 results") {

        //     html_container = `
        //         <tr class="text-center header_container_data">
        //             <td>${html_container_type}</td>
        //             <td><input type="text" class="form-control form-control-sm inp_container_number"></td>
        //             <td><input type="number" class="form-control form-control-sm inp_cntr" "></td>
        //             <td><input type="checkbox" class="form-check-input inp_soc"></td>
        //             <td><input type="checkbox" class="form-check-input inp_ow"></td>
        //             <td><input type="date" class="form-control form-control-sm inp_cy"></td>
        //             <td><input type="date" class="form-control form-control-sm inp_rtn" ></td>
        //             <td><button class="btn btn-sm btn-danger" onclick="function_sub_job_detail.delete_row_table_container(this)"><i class="bi bi-trash text-white"></i></button></td>
        //         </tr>
        //         `;
        //     $('.table_data_container > tbody').append(html_container) 

        // }else{
        //     $.each(res_data['container'], function (i, v) {
        //         let html_container = ``;

        //         let cy = v['cy'] ? v['cy'] : '';
        //         let rtn = v['rtn'] ? v['rtn'] : '';
        //         let container_number = v['container_number'] ? v['container_number'] : '';
        //         let single_cnt = v['single_cnt'] ? v['single_cnt'] : '';

        //         html_container = `
        //         <tr class="text-center header_container_data" container_id="${v['ID']}">
        //             <td>${html_container_type}</td>
        //             <td><input type="text" class="form-control form-control-sm inp_container_number" value="${container_number}"></td>
        //             <td><input type="number" class="form-control form-control-sm inp_cntr" value="${single_cnt}"></td>
        //             <td><input type="checkbox" class="form-check-input inp_soc"></td>
        //             <td><input type="checkbox" class="form-check-input inp_ow"></td>
        //             <td><input type="date" class="form-control form-control-sm inp_cy" value="${cy}"></td>
        //             <td><input type="date" class="form-control form-control-sm inp_rtn" value="${rtn}"></td>
        //             <td><button class="btn btn-sm btn-danger" onclick="function_sub_job_detail.delete_row_table_container(this)"><i class="bi bi-trash text-white"></i></button></td>
        //         </tr>
        //         `;

        //         $('.table_data_container > tbody').append(html_container)
        //         $('.table_data_container > tbody > tr:last').find($('.inp_container_type')).val(v['container_type'])
        //         if (v['soc'] == 1) {
        //             $('.table_data_container > tbody > tr:last').find($('.inp_soc')).attr('checked', 'true')
        //         }

        //         if (v['ow'] == 1) {
        //             $('.table_data_container > tbody > tr:last').find($('.inp_ow')).attr('checked', 'true')

        //         }
        //     })
        // }

        
        await function_sub_job_detail.cal_number_container_rows()
        await function_sub_job_detail.cal_number_container_module_rows()
        await function_sub_job_detail.cal_cargo_information()
        
    },

    ajax_request_first: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_first_set.php",
                data: { data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


}