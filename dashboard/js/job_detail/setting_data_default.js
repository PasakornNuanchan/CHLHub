const setting_data_default = {
    
    setting_data : async function (){
        let res_data_default = await setting_data_default.ajax_request_table()


        //job_detail
        //console.log(res_data_default)  

        let shipper_data = '';
        let shipment_data = '';
        let consingee_data ='';
        let carrier_data ='';
        let area_data ='';
        let cargo_type_data = '';
        let agent_booking_data = '';
        let container_type_data ='';

        $.each(res_data_default['shipper_data'],function(i,v){
            shipper_data +=`<option value="${v['ID']}">${v['shipper_name']}</option>`;
        })
        $('#shipper_db').append(shipper_data)

        $.each(res_data_default['shipment_data'],function(i,v){
            shipment_data +=`<option value="${v['ID']}">${v['st_name']}</option>`;
        })
        $('#shipment_db').append(shipment_data)

        $.each(res_data_default['consginee_data'],function(i,v){
            consingee_data +=`<option value="${v['ID']}">${v['consignee_name']}</option>`;
        })
        $('#consginee_db').append(consingee_data)

        $.each(res_data_default['carrier_data'],function(i,v){
            carrier_data +=`<option value="${v['ID']}">${v['carrier_name']}</option>`;
        })
        $('#carrier_data').append(carrier_data)

        $.each(res_data_default['area_data'],function(i,v){
            area_data +=`<option value="${v['ID']}">${v['location_name']+' '+v['provice']}</option>`;
        })
        $('#area_data').append(area_data)
        $('#area_datal').append(area_data)
        $('#area_datat').append(area_data)
        $('#area_datad').append(area_data)

        $.each(res_data_default['cargo_data'],function(i,v){
            cargo_type_data +=`<option value="${v['ID']}">${v['cargo_type_name']}</option>`;
        })
        $('#cargo_data').append(cargo_type_data)

        $.each(res_data_default['agent_data'],function(i,v){
            agent_booking_data +=`<option value="${v['ID']}">${v['agent_name_corp']}</option>`;
        })
        $('#agent_data').append(agent_booking_data)

        $.each(res_data_default['container_type_data'],function(i,v){
            container_type_data +=`<option value="${v['container_type_name']}">${v['container_type_name']} (${v['container_type_full_name']})</option>`;
        })
        $('#container_type_data').append(container_type_data)

      // transport

        let supplier_data = '';
        $.each(res_data_default['supplier_data'],function (i,v){
            supplier_data +=`<option value="${v['ID']}">${v['transport_sup_name']}</option>`;
        })
        $('#sel_supplier').append(supplier_data)

        let truck_type_data = '';
        $.each(res_data_default['truck_data'],function(i,v){
            truck_type_data +=`<option value="${v['ID']}">${v['truck_name']}</option>`;
        })
        $('#db_type_truck').append(truck_type_data)
      // report cs
        let shipping_user = '';
        $.each(res_data_default['shipping_user'],function(i,v){
            shipping_user +=`<option value="${v['ID']}">${v['first_name']+' '+v['last_name']}</option>`;
        })
        $('#sel_ats').append(shipping_user)
      // customs

      // billing

      // withdraw

    },

    ajax_request_table: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_defalt.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}