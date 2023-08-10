const setting_data_default = {
    data_billing_des : '',
    setting_data : async function (){

    
        let res_data_default = await setting_data_default.ajax_request_table()

        //job_detail
        console.log(res_data_default['billing_bill_to'])  

        let shipper_data = '';
        let shipment_data = '';
        let consingee_data ='';
        let carrier_data ='';
        let area_data ='';
        let cargo_type_data = '';
        let agent_booking_data = '';
        var container_type_data ='';
        let cs_data_user ='';
        let sale_data_user ='';
        let billing_des = '';
        let bill_to = '';



        if(res_data_default['billing_bill_to'] != "0 results"){
            $.each(res_data_default['billing_bill_to'],function(i,v){
                bill_to +=`<option type="${v['TYPE']}" value="${v['ID']}">${v['NAME']}</option>`;
            })
            $('.inp_billing_to_ap').append(bill_to)
        }


        this.data_billing_des = res_data_default['billing_des'];
        if(res_data_default['billing_des'] != "0 results"){
            $.each(res_data_default['billing_des'],function(i,v){
                billing_des +=`<option value="${v['ID']}">${v['billing_code']}</option>`;
            })
            $('.sel_data_billing_ap').append(billing_des)
        }

        if(res_data_default['cs_data'] != "0 results"){
            $.each(res_data_default['cs_data'],function(i,v){
                cs_data_user +=`<option value="${v['ID']}">${v['first_name']+' '+v['last_name']}</option>`;
            })
            $('.inp_cs_user').append(cs_data_user)
        }
        
        if(res_data_default['sale_data'] != "0 results"){
            $.each(res_data_default['sale_data'],function(i,v){
                sale_data_user +=`<option value="${v['ID']}">${v['first_name']+' '+v['last_name']}</option>`;
            })
            $('.inp_sale_user').append(sale_data_user)
        }
        

        if(res_data_default['shipper_data'] != "0 results"){
            $.each(res_data_default['shipper_data'],function(i,v){
                shipper_data +=`<option value="${v['ID']}">${v['shipper_name']}</option>`;
            })
            $('#shipper_db').append(shipper_data)
        }


        if(res_data_default['shipment_data'] != "0 results"){
            $.each(res_data_default['shipment_data'],function(i,v){
                shipment_data +=`<option value="${v['ID']}">${v['st_name']}</option>`;
            })
            $('#shipment_db').append(shipment_data)
        }

        if(res_data_default['consginee_data'] != "0 results"){
            $.each(res_data_default['consginee_data'],function(i,v){
                consingee_data +=`<option value="${v['ID']}">${v['consignee_name']}</option>`;
            })
            $('#consginee_db').append(consingee_data)
        }

        if(res_data_default['carrier_data'] != "0 results"){
            $.each(res_data_default['carrier_data'],function(i,v){
                carrier_data +=`<option value="${v['ID']}">${v['carrier_name']}</option>`;
            })
            $('#carrier_data').append(carrier_data)
        }

        if(res_data_default['area_data'] != "0 results"){
            $.each(res_data_default['area_data'],function(i,v){
                area_data +=`<option value="${v['ID']}">${v['location_name']+' '+v['provice']}</option>`;
            })
            $('#area_data').append(area_data)
            $('#area_datal').append(area_data)
            $('#area_datat').append(area_data)
            $('#area_datad').append(area_data)
        }
        
        if(res_data_default['cargo_data'] != "0 results"){
            $.each(res_data_default['cargo_data'],function(i,v){
                cargo_type_data +=`<option value="${v['ID']}">${v['cargo_type_name']}</option>`;
            })
            $('#cargo_data').append(cargo_type_data)
        }

        if(res_data_default['agent_data'] != "0 results"){
            $.each(res_data_default['agent_data'],function(i,v){
                agent_booking_data +=`<option value="${v['ID']}">${v['agent_name_corp']}</option>`;
            })
            $('#agent_data').append(agent_booking_data)
        }

        if(res_data_default['container_type_data'] != "0 results"){
            $.each(res_data_default['container_type_data'],function(i,v){
                container_type_data +=`<option value="${v['container_type_name']}">${v['container_type_name']} (${v['container_type_full_name']})</option>`;
            })
            $('#container_type_data').append(container_type_data)
        }

      // transport

        let supplier_data = '';
        let truck_type_data = '';
        let shipping_user = '';
        if (res_data_default['supplier_data'] != "0 results") {
            $.each(res_data_default['supplier_data'], function (i, v) {
                supplier_data += `<option value="${v['ID']}">${v['transport_sup_name']}</option>`;
            })
            $('#sel_supplier').append(supplier_data)
        }

        if (res_data_default['truck_data'] != "0 results") {
            $.each(res_data_default['truck_data'], function (i, v) {
                truck_type_data += `<option value="${v['ID']}">${v['truck_name']}</option>`;
            })
            $('#db_type_truck').append(truck_type_data)
        }
      // report cs
        if (res_data_default['shipping_user'] != "0 results") {
            $.each(res_data_default['shipping_user'], function (i, v) {
                shipping_user += `<option value="${v['ID']}">${v['first_name'] + ' ' + v['last_name']}</option>`;
            })
            $('#sel_ats').append(shipping_user)
            
        }

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