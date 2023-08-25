const sub_bl = {
    data_as_consignee : [],
    first_post_data: async function (data) {
        let res_data = await this.ajax_get_data_setting(data)


        console.log(res_data)
        let data_as_consignee_obj = {
            name_data : res_data['job_title']['consignee_name'],
            address_data : res_data['job_title']['address']
        }
        this.data_as_consignee.push(data_as_consignee_obj)


        let shipper_number = res_data['job_title']['shipper_number'] ? res_data['job_title']['shipper_number'] : '';
        let consignee_number = res_data['job_title']['consignee_number'] ? res_data['job_title']['consignee_number'] : '';

        let port_of_receipt_number = res_data['job_title']['port_of_receipt_number'] ? res_data['job_title']['port_of_receipt_number'] : '';
        let port_of_loading_number = res_data['job_title']['port_of_loading_number'] ? res_data['job_title']['port_of_loading_number'] : '';
        let ts_port_number = res_data['job_title']['ts_port_number'] ? res_data['job_title']['ts_port_number'] : '';
        let port_of_delivery_number = res_data['job_title']['port_of_delivery_number'] ? res_data['job_title']['port_of_delivery_number'] : '';
        let vessel = res_data['job_title']['mother_vessel'] ? res_data['job_title']['mother_vessel'] : '';




        $('.inp_bl_por').val(port_of_receipt_number)
        $('.inp_bl_pol').val(port_of_loading_number)
        $('.inp_bl_pod').val(ts_port_number)
        $('.inp_bl_pode').val(port_of_delivery_number)
        $('.inp_mother_vessel').val(vessel)

        let bill_header = res_data['bl_title']['bill_header'] ? res_data['bl_title']['bill_header'] : '';
        let delivery_agent = res_data['bl_title']['delivery_agent'] ? res_data['bl_title']['delivery_agent'] : '';
        let notify_party = res_data['bl_title']['notify_party'] ? res_data['bl_title']['notify_party'] : '';
        let pre_carriage = res_data['bl_title']['pre_carriage'] ? res_data['bl_title']['pre_carriage'] : '';
        let shipper_on_board = res_data['bl_title']['shipper_on_board'] ? res_data['bl_title']['shipper_on_board'] : '';
        let bl_number = res_data['bl_title']['bl_number'] ? res_data['bl_title']['bl_number'] : '';
        let shipper_bl = res_data['bl_title']['shipper_bl'] ? res_data['bl_title']['shipper_bl'] : '';
        let consignee_bl = res_data['bl_title']['consignee_bl'] ? res_data['bl_title']['consignee_bl'] : '';
        let description_of_good = res_data['bl_title']['description_of_good'] ? res_data['bl_title']['description_of_good'] : '';

        $('.inp_bl_shipping').val(shipper_bl)
        $('.inp_bl_consingee').val(consignee_bl)


        $('.inp_notify_bl').val(notify_party)
        $('.inp_pre_carriage').val(pre_carriage)
        $('.inp_bill_header_bl').val(bill_header)
        $('.inp_delivery_agent_bl').val(delivery_agent)
        $('.inp_shipper_on_board').val(shipper_on_board)
        $('.inp_bl_number').val(bl_number)
        $('.inp_description_of_good').val(description_of_good)

        $('.table_detail_bl tbody').html('');
        if (res_data['bl_list'] != "0 results") {
            $.each(res_data['bl_list'], function (i, v) {

                let id_number = v['ID'] ? v['ID'] : '';
                let container_no = v['container_no'] ? v['container_no'] : '';
                let package = v['package'] ? v['package'] : '';
                let kind_of_package = v['kind_of_package'] ? v['kind_of_package'] : '';
                let gross_weight = v['gross_weight'] ? v['gross_weight'] : '';
                let measurement = v['measurement'] ? v['measurement'] : '';

                let html_data_list = `
                <tr id_number = "${id_number}">
                    <td><textarea class="form-control inp_container_no_and_seal inp_container_no_and_seal${i}" id="exampleFormControlTextarea1" rows="4"></textarea></td>
                    <td><input type="text" class="form-control form-control-sm inp_container_or_package" value="${package}"></td>
                    <td><textarea class="form-control inp_kind_of_package inp_kind_of_package${i}" id="exampleFormControlTextarea1" rows="4" ></textarea></td>
                    <td><input type="text" class="form-control form-control-sm inp_gross_Weight" value="${gross_weight}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_mesurement" value="${measurement}"></td>
                </tr>
                `;


                $('.table_detail_bl tbody').append(html_data_list)
                $(`.inp_container_no_and_seal${i}`).append(container_no)
                $(`.inp_kind_of_package${i}`).append(kind_of_package)
            })
        } else {
            function_sub_bl.add_detail_bl()
        }


        let data_container = $('.bl_container_type').parent().html();
        let data_unit_bl = $('.inp_unit_bl').parent().html();
        $('.table_container_bl > tbody').html('')
        let data_gw_all = '';
        if (res_data['container'] != "0 results") {
            $.each(res_data['container'], function (i, v) {
                let id_nubmer = v['ID'] ? v['ID'] : '';
                let container_number = v['container_number'] ? v['container_number'] : '';
                let seal_number = v['seal_number'] ? v['seal_number'] :'';
                let container_type = v['container_type'] ? v['container_type'] : '';
                let quantity = v['quantity'] ? v['quantity'] : '';
                let unit = v['unit'] ? v['unit']: '';
                let cbm = v['cbm'] ? v['cbm'] :'';
                let gw = v['gw'] ? v['gw'] : '';
                //let slw = v['single_cnt'] ? v['single_cnt'] : '';
                //let weight = 0;
                // gw = parseFloat(gw)
                // slw = parseFloat(slw)

                //weight = gw - slw;
                
                

                let html_data_container = `
                <tr class="containertr_row${i} containertr_row" container_id="${id_nubmer}">
                    <td><input type="text" class="form-control form-control-sm" value="${container_number}" disabled></td>
                    <td>${data_container}</td>
                    <td><input type="text" class="form-control form-control-sm" value="${seal_number}">
                    <td><input type="number" class="form-control form-control-sm inp_quantity_bl" onchange="function_sub_bl.cal_container_package()" value="${quantity}"></td>
                    <td>${data_unit_bl}</td>
                    <td><input type="text" class="form-control form-control-sm text-end inp_weight_bl" onchange="function_sub_bl.cal_container_weight()" value="${gw}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_cbm_bl" value="${cbm}"></td>
                </tr>
                `;

                $('.table_container_bl > tbody').append(html_data_container)
                $(`.containertr_row${i} > td > .inp_bl_contianer_type`).val(container_type).attr('disabled', true)
                $(`.containertr_row${i} > td > .inp_unit_bl`).val(unit).attr('onchange','function_sub_bl.cal_container_package()')
                data_gw_all = parseFloat(data_gw_all + parseFloat(gw))
            })
            $('.inp_gross_Weight').val(data_gw_all)
        }

    },



    ajax_get_data_setting: async function (pipe_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                data: { pipe_data: pipe_data },
                url: "php/job_detail/get_data_bl.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}