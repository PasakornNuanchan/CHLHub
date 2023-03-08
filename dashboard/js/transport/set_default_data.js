const transport_set_default ={
    
    set_data_default: async function (){
        let set_data = await transport_set_default.ajax_set_data();
        

        //transport supplier
        let html_supplier = '';
        $.each(set_data['supplier'], function (i, k) { 
            html_supplier += `
            <option value="${k['transport_sup_number']}">${k['transport_sup_name']}</option>
            `;  
        });
    
        // booking set select
        // shipper 
        let db_sel_shipper='';
        $.each(set_data['shipper'], function (i, k) {
            db_sel_shipper += `
            <option value="${k['shipper_number']}">${k['shipper_name']}</option>
            `;
        });
        

        let db_sel_shipment ='';
        $.each(set_data['shipment'], function (i, k) {
            db_sel_shipment += `
            <option value="${k['st_number']}">${k['st_name']}</option>
            `;
        });
        
        let db_sel_carrier ='';
        $.each(set_data['carrier'], function (i, k) {
            db_sel_carrier += `
            <option value="${k['carrier_number']}">${k['carrier_name']}</option>
            `;
        });

        let db_sel_area ='';
        $.each(set_data['area'], function (i, k) {
            db_sel_area += `
            <option value="${k['area_number']}">${k['location_name']},${k['country']}</option>
            `;
        });
        

        let db_sel_cargo ='';
        $.each(set_data['cargo'], function (i, k) {
            db_sel_cargo += `
            <option value="${k['ID']}">${k['cargo_type_name']}</option>
            `;
        });
       
        
        let db_truck ='';
        $.each(set_data['truck'],function(i , k){
            db_truck +=`
            <option value="${k['ID']}">${k['truck_name']}</option>
            `;
        })

        $('.sel-supplier').append(html_supplier);
        $('.inp-shper').append(db_sel_shipper);
        $('.inp-shptrm').append(db_sel_shipment);
        $('.inp-carrier').append(db_sel_carrier);

        $('.inp-prtrecieve',).append(db_sel_area);
        $('.inp-prtload',).append(db_sel_area);
        $('.inp-ts_port',).append(db_sel_area);
        $('.inp-delivery',).append(db_sel_area);
        $('.inp-cargo_type',).append(db_sel_cargo);
        $('.sel-type_truck',).append(db_truck);
        
    },
    ajax_set_data : function(){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/get_transport.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

}