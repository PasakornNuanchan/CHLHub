const sub_job_detail = {
    first_post_data: async function (data) {
        //data = 1;
        let res_data = await this.ajax_request_first(data);
        
        //job_detail
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
        $('.inp_port_of_delivery').val(res_data['job_title']['port_of_delivery_number'])
        $('.inp_mother_vessel').val(res_data['job_title']['mother_vessel'])
        $('.inp_feeder_vessel').val(res_data['job_title']['feeder_vessel'])
        $('.inp_etd').val(res_data['job_title']['etd'])
        $('.inp_eta').val(res_data['job_title']['eta'])
        $('.inp_inv').val(res_data['job_title']['inv'])
        $('.inp_mbl').val(res_data['job_title']['mbl'])
        $('.inp_hbl').val(res_data['job_title']['hbl'])
        // container information 
        $('.inp_cargo_des').val(res_data['container_information']['cargo'])
        $('.inp_cargo_type').val(res_data['container_information']['cargo_type'])
        $('.inp_quantity').val(res_data['container_information']['quantity'])
        $('.inp_gw').val(res_data['container_information']['gw'])
        $('.inp_vol').val(res_data['container_information']['volume'])
        $('.inp_remark_container').val(res_data['container_information']['mark'])
        //booking_agent
        $('.inp_booking_agent').val(res_data['job_title']['booking_agent'])
        //container 
        html_container_type = $('#container_type_data').parent().html();

        $('.table_data_container > tbody').html('')
        
        if (res_data['container'] == "0 results") {

            html_container = `
                <tr class="text-center header_container_data">
                    <td>${html_container_type}</td>
                    <td><input type="text" class="form-control form-control-sm inp_container_number"></td>
                    <td><input type="number" class="form-control form-control-sm inp_cntr" "></td>
                    <td><input type="checkbox" class="form-check-input inp_soc"></td>
                    <td><input type="checkbox" class="form-check-input inp_ow"></td>
                    <td><input type="date" class="form-control form-control-sm inp_cy"></td>
                    <td><input type="date" class="form-control form-control-sm inp_rtn" ></td>
                    <td><button class="btn btn-sm btn-danger" onclick="function_sub_job_detail.delete_row_table_container(this)"><i class="bi bi-trash text-white"></i></button></td>
                </tr>
                `;
            $('.table_data_container > tbody').append(html_container) 
            
        }else{
            $.each(res_data['container'], function (i, v) {
                let html_container = ``;

                let cy = v['cy'] ? v['cy'] : '';
                let rtn = v['rtn'] ? v['rtn'] : '';
                let container_number = v['container_number'] ? v['container_number'] : '';
                let single_cnt = v['single_cnt'] ? v['single_cnt'] : '';

                html_container = `
                <tr class="text-center header_container_data" container_id="${v['ID']}">
                    <td>${html_container_type}</td>
                    <td><input type="text" class="form-control form-control-sm inp_container_number" value="${container_number}"></td>
                    <td><input type="number" class="form-control form-control-sm inp_cntr" value="${single_cnt}"></td>
                    <td><input type="checkbox" class="form-check-input inp_soc"></td>
                    <td><input type="checkbox" class="form-check-input inp_ow"></td>
                    <td><input type="date" class="form-control form-control-sm inp_cy" value="${cy}"></td>
                    <td><input type="date" class="form-control form-control-sm inp_rtn" value="${rtn}"></td>
                    <td><button class="btn btn-sm btn-danger" onclick="function_sub_job_detail.delete_row_table_container(this)"><i class="bi bi-trash text-white"></i></button></td>
                </tr>
                `;

                $('.table_data_container > tbody').append(html_container)
                $('.table_data_container > tbody > tr:last').find($('.inp_container_type')).val(v['container_type'])
                if (v['soc'] == 1) {
                    $('.table_data_container > tbody > tr:last').find($('.inp_soc')).attr('checked', 'true')
                }

                if (v['ow'] == 1) {
                    $('.table_data_container > tbody > tr:last').find($('.inp_ow')).attr('checked', 'true')

                }
            })
        }

    },

    ajax_request_first : async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_first_set.php",
                data: {data},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


}