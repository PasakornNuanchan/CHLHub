const setting_data_default = {
    data_billing_des : '',
    data_billing_des_ar : '',
    data_area : '',
    data_container_type : '',
    data_unit : '',
    address_pick_container : '',
    address_load_container : '',
    address_delivery_container : '',
    address_return_container : '',
    html_data_address_pick_container : '',
    html_data_address_load_container : '',
    html_data_address_delivery_container : '',
    html_data_address_return_container : '',
    transport_container_html : '',
    transport_hbl_html : '',

    setting_data : async function (id_number){

    
        let res_data_default = await setting_data_default.ajax_request_table(id_number)

        //job_detail
        // console.log(res_data_default)  

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
        let billing_des_ar = '';
        let bill_to_ar = '';
        let unit_data = '';
        let shipper_consignee = '';

        let html_address_pick_container = '';
        let html_address_load_container = '';
        let html_address_delivery_container = '';
        let html_address_return_container = '';

        
        

        if(res_data_default['address_pick_container'] != "0 results"){
            $.each(res_data_default['address_pick_container'],function(i,v){
                html_address_pick_container += `<option value="${v['pick_con_empty_address']}">${v['pick_con_empty_address']}</option>`;
            })
        }

        if(res_data_default['address_load_container'] != "0 results"){
            $.each(res_data_default['address_load_container'],function(i,v){
                html_address_load_container += `<option value="${v['pick_con_address']}">${v['pick_con_address']}</option>`;
            })
        }

        if(res_data_default['address_delivery_container'] != "0 results"){
            $.each(res_data_default['address_delivery_container'],function(i,v){
                html_address_delivery_container += `<option value="${v['drop_con_address']}">${v['drop_con_address']}</option>`;
            })
        }

        if(res_data_default['address_return_container'] != "0 results"){
            $.each(res_data_default['address_return_container'],function(i,v){
                html_address_return_container += `<option value="${v['drop_con_empty_address']}">${v['drop_con_empty_address']}</option>`;
            })
        }

        this.address_pick_container = res_data_default['address_pick_container'];
        this.address_load_container = res_data_default['address_load_container'];
        this.address_delivery_container = res_data_default['address_delivery_container'];
        this.address_return_container = res_data_default['address_return_container'];

        this.html_data_address_pick_container = html_address_pick_container;
        this.html_data_address_load_container = html_address_load_container;
        this.html_data_address_delivery_container = html_address_delivery_container;
        this.html_data_address_return_container = html_address_return_container;

        if(res_data_default['unit'] != "0 results"){
            $.each(res_data_default['unit'],function(i,v){
                unit_data += `<option value="${v['ID']}">${v['name']}</option>`;
            })
            
            $('.inp_select_packing').append(unit_data)
            $('.inp_unit_package').append(unit_data)
        }

        this.data_unit = unit_data
    

        if(res_data_default['bill_to_ar'] != "0 results"){
            $.each(res_data_default['bill_to_ar'],function(i,v){
                bill_to_ar +=`<option type="${v['TYPE']}" value="${v['ID']}">${v['NAME']}</option>`;
            })
            $('.select_bill_to_ar').append(bill_to_ar)
        }

        this.data_billing_des_ar = res_data_default['billing_des_ar'];
        if(res_data_default['billing_des_ar'] != "0 results"){
            $.each(res_data_default['billing_des_ar'],function(i,v){
                billing_des_ar +=`<option value="${v['ID']}">${v['billing_code']}</option>`;
            })
            $('.select_code_billing_ar').append(billing_des_ar)
        }
        
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
                carrier_data +=`<option value="${v['ID']}" web_checl="${v['web_check']}">${v['carrier_name']}</option>`;
            })
            $('#carrier_data').append(carrier_data)
        }

        if(res_data_default['area_data'] != "0 results"){
            $.each(res_data_default['area_data'],function(i,v){
                area_data +=`<option value="${v['ID']}">${v['location_name']}</option>`;
            })
            $('#area_data').append(area_data)
            $('#area_datal').append(area_data)
            $('#area_datat').append(area_data)
            $('#area_datad').append(area_data)
            $('#area_datadl').append(area_data)

            $('.bl_por').append(area_data)
            $('.bl_pol').append(area_data)
            $('.bl_pod').append(area_data)
            $('.bl_pode').append(area_data)
            this.data_area = area_data

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
            //$('.bl_container_type').append(container_type_data)

            this.data_container_type = container_type_data
        }


        if(res_data_default['shipper_consignee'] != "0 results"){
            $.each(res_data_default['shipper_consignee'],function(i,v){
                shipper_consignee += `<option type_data="${v['type_data']}" value="${v['id_data']}" >${v['name_data']}</option>`
            })

            $('#client_db').append(shipper_consignee)
            $('#notify_db').append(shipper_consignee)
        }

      // transport

        let supplier_data = '';
        let truck_type_data = '';
        let shipping_user = '';

        let html_data_container_transport = '';
        let html_data_hbl_transport = '';

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

        if (res_data_default['container_select_transport'] != "0 results") {
            $.each(res_data_default['container_select_transport'], function (i, v) {
                html_data_container_transport += `<option value="${v['ID']}">${v['container_number']+' '+v['data_container']}</option>`;
            })
            // $('#sel_supplier').append(supplier_data)
            // console.log(html_data_container_transport)
        }

        if (res_data_default['hbl_select_transport'] != "0 results") {
            $.each(res_data_default['hbl_select_transport'], function (i, v) {
                html_data_hbl_transport += `<option value="${v['ID']}">${v['hbl']}</option>`;
            })
            // $('#db_type_truck').append(truck_type_data)
            // console.log(html_data_hbl_transport)
        }

        this.transport_container_html = html_data_container_transport
        this.transport_hbl_html = html_data_hbl_transport

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

    ajax_request_table: async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_defalt.php",
                data : {id_number : id_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}