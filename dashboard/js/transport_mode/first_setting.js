const first_setting = {
    setting_data : async function(){
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("dsfkodsf");
        var driver = url.searchParams.get("fkosdf");
        
        
        let res_data = await this.ajax_get_data(id_number,driver)
        console.log(res_data)
        $.each(res_data['get_data_transport'],function(i,v){

            let pick_con_empty_address = v['pick_con_empty_address'] ? v['pick_con_empty_address'] : '';
            let pick_con_empty_remark = v['pick_con_empty_remark'] ? v['pick_con_empty_remark'] : '';
            let pick_con_address = v['pick_con_address'] ? v['pick_con_address'] : '';
            let pick_con_remark = v['pick_con_remark'] ? v['pick_con_remark'] : '';
            let drop_con_address = v['drop_con_address'] ? v['drop_con_address'] : '';
            let drop_con_remark = v['drop_con_remark'] ? v['drop_con_remark'] : '';
            let drop_con_empty_address = v['drop_con_empty_address'] ? v['drop_con_empty_address'] : '';
            let drop_con_empty_remark = v['drop_con_empty_remark'] ? v['drop_con_empty_remark'] : '';
            let ggpick_con_empty_address = v['ggpick_con_empty_address'] ? v['ggpick_con_empty_address'] : '';
            let ggpick_con_address = v['ggpick_con_address'] ? v['ggpick_con_address'] : '';
            let ggdrop_con_address = v['ggdrop_con_address'] ? v['ggdrop_con_address'] : '';
            let ggdrop_con_empty_address = v['ggdrop_con_empty_address'] ? v['ggdrop_con_empty_address'] : '';
        
            
            $('.inp_pick_emt').append(pick_con_empty_address)
            $('.inp_loading').append(pick_con_address)
            $('.inp_delivery').append(drop_con_address)
            $('.inp_drop_off').append(drop_con_empty_address)

            $('.inp_pick_emt_remark').append(`\n`+pick_con_empty_remark)
            $('.inp_loading_remark').append(`\n`+pick_con_remark)
            $('.inp_delivery_remark').append(`\n`+drop_con_remark)
            $('.inp_drop_off_remark').append(`\n`+drop_con_empty_remark)

            $('.btn_pick_emt').attr(`onclick`,`func_transport_mode.open_url_gg('${ggpick_con_empty_address}')`)
            $('.btn_loading').attr(`onclick`,`func_transport_mode.open_url_gg('${ggpick_con_address}')`)
            $('.btn_delivery').attr(`onclick`,`func_transport_mode.open_url_gg('${ggdrop_con_address}')`)
            $('.btn_drop_off').attr(`onclick`,`func_transport_mode.open_url_gg('${ggdrop_con_empty_address}')`)
        })

        $('.driver_data').html('')
        $.each(res_data['get_driver'],function(i,v){
            let html_data = '';
            let Driver_name = v['Driver_name'] ? v['Driver_name'] : '';
            let container_number = v['container_number'] ? v['container_number'] : '';
            
            html_data = `
            <div class="form-group row">
                <label class="text-center text_driver">Driver</label>
                <input type="text" class="form-control form-control-sm rounded" disabled value="${Driver_name}">
            </div>
            <div class="form-group row">
                <label class="text-center text_container">Container</label>
                <input type="text" class="form-control form-control-sm rounded" disabled value="${container_number}">
            </div>
            `;
            $('.driver_data').append(html_data)
        })
        $('.status_delivery').html('')
        $.each(res_data['get_driver'],function(i,v){
            let container_id_data = v['container_id_data'] ? v['container_id_data'] : '';
            let container_number = v['container_number'] ? v['container_number'] : '';
            // let up_datetime_cntr = v['up_datetime_cntr'] ? v['up_datetime_cntr'] : '';
            let cntr_datetime = v['cntr_datetime'] ? v['cntr_datetime'] : '';
            let cy_datetime_cntr = v['cy_datetime_cntr'] ? v['cy_datetime_cntr'] : '';
            let up_status_cntr = v['up_status_cntr'] ? v['up_status_cntr'] : '';
            let cy_status_cntr = v['cy_status_cntr'] ? v['cy_status_cntr'] : '';
        
            let html_data = '';
            html_data = `
            <div class="card mt-2">
                <div class="card-header">
                    <h4 class="text-center text_delivered">Delivered : </h4><h4 class="text-center">${container_number}</h4>
                </div>
                <div class="card-body p-5">
                    <div class="from-group row">
                        <label class="text-center text_datetime">Date Time</label>
                        <input type="text" class="form-control form-control-sm rounded inp_dt_d${i}" disabled>
                    </div>
                    <div class="form-group row mt-2">
                        <button class="btn btn-success btn_del${i} text_delivered" onclick="func_transport_mode.update_status_data('${container_id_data}','dr');">Delivered</button>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <h4 class="text-center text_return_to_cy">Return to CY : </h4><h4 class="text-center">${container_number}</h4>
                </div>
                <div class="card-body p-5">
                    <div class="from-group row">
                        <label class="text-center text_datetime">Date Time</label>
                        <input type="text" class="form-control form-control-sm rounded inp_dt_rtn_cy${i}" disabled>
                    </div>
                    <div class="form-group row mt-2">
                        <button class="btn btn-success btn_rtn${i} text_return_to_cy" onclick="func_transport_mode.update_status_data('${container_id_data}','rtn');">Return</button>
                    </div>
                </div>
            </div>
            `;
            $('.status_delivery').append(html_data)
            
            // if(up_datetime_cntr != ''){
            //     $(`.inp_dt_ar_de${i}`).val(up_datetime_cntr).addClass("text-center")
            //     $(`.btn_ada${i}`).remove()
            // }

            
            if(cntr_datetime != ''){
                $(`.inp_dt_d${i}`).val(cntr_datetime).addClass("text-center")
                $(`.btn_del${i}`).remove()
            }
            if(cy_datetime_cntr != ''){
                $(`.inp_dt_rtn_cy${i}`).val(cy_datetime_cntr).addClass("text-center")
                $(`.btn_rtn${i}`).remove()
            }
            
        })
    },

    ajax_get_data : function (id_number,driver) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport_mode/get_data_transport.php",
                data : {
                    id_number: id_number,
                    driver: driver},
                dataType: 'json',
                success: function (response) {
                    resolve(response)
                }
            });
        });
    },
}