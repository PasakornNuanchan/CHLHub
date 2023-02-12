const reportcs_set_default ={
    
    set_data_default: async function (job_number){
        
        let set_data = await reportcs_set_default.ajax_set_data(job_number);
        console.log(set_data);
        // booking set select
        // shipper 
        let db_sel_shipper='';
        $.each(set_data['shipper'], function (i, k) {
            db_sel_shipper += `
            <option value="${k['shipper_number']}">${k['shipper_name']}</option>
            `;
        });
        $('.inp-shper').append(db_sel_shipper);

        let db_sel_shipment ='';
        $.each(set_data['shipment'], function (i, k) {
            db_sel_shipment += `
            <option value="${k['st_number']}">${k['st_name']}</option>
            `;
        });

        $('.inp-shptrm').append(db_sel_shipment);
        let db_sel_carrier ='';
        $.each(set_data['carrier'], function (i, k) {
            db_sel_carrier += `
            <option value="${k['carrier_number']}">${k['carrier_name']}</option>
            `;
        });
        $('.inp-carrier-sel').append(db_sel_carrier);
        let db_sel_area ='';
        $.each(set_data['area'], function (i, k) {
            db_sel_area += `
            <option value="${k['area_number']}">${k['location_name']},${k['country']}</option>
            `;
        });
        $('.inp-prtrecieve',).append(db_sel_area);
        $('.inp-prtload',).append(db_sel_area);
        $('.inp-ts_port',).append(db_sel_area);
        $('.inp-delivery-sel-booking',).append(db_sel_area);

        let db_sel_cargo ='';
        $.each(set_data['cargo'], function (i, k) {
            db_sel_cargo += `
            <option value="${k['ID']}">${k['cargo_type_name']}</option>
            `;
        });
        $('.inp-cargo_type',).append(db_sel_cargo);

        let db_sel_truck ='';
        $.each(set_data['truck'], function (i, k) {
            db_sel_truck += `
            <option value="${k['ID']}">${k['truck_name']}</option>
            `;
        });
        $('.inp-type_truck',).append(db_sel_truck);
        


        let db_sel_dem ='';
        $.each(set_data['container'], function (i, k) {
            db_sel_dem += `
            <option value="${k['ID']}">${k['container_number']} ${k['container_type']}</option>
            `;
        });
        $('.sel-dem-container',).append(db_sel_dem);
        
       
    },
    ajax_set_data : function(job_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/reportcs/get_reportcs.php",
                data: {'job_number': job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

}