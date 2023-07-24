const customs_set_data_default = {

    ajax_set_data: function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/get_customs.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    set_data_default: async function () {
        let set_data = await customs_set_data_default.ajax_set_data();
        console.log(set_data)
        //transport supplier
        let html_supplier = '';
        $.each(set_data['supplier'], function (i, k) {
            html_supplier += `
            <option value="${k['transport_sup_number']}">${k['transport_sup_name']}</option>
            `;
        });
        $('.sel-supplier').append(html_supplier);

        // booking set select
        // shipper 
        let db_sel_shipper = '';
        $.each(set_data['shipper'], function (i, k) {
            db_sel_shipper += `
            <option value="${k['ID']}">${k['shipper_name']}</option>
            `;
        });
        $('.inp-shper').append(db_sel_shipper);

        let db_sel_shipment = '';
        $.each(set_data['shipment'], function (i, k) {
            db_sel_shipment += `
            <option value="${k['st_number']}">${k['st_name']}</option>
            `;
        });

        $('.inp-shptrm').append(db_sel_shipment);
        let db_sel_carrier = '';
        $.each(set_data['carrier'], function (i, k) {
            db_sel_carrier += `
            <option value="${k['carrier_number']}">${k['carrier_name']}</option>
            `;
        });
        $('.inp-carrier').append(db_sel_carrier);
        let db_sel_area = '';
        $.each(set_data['area'], function (i, k) {
            db_sel_area += `
            <option value="${k['area_number']}">${k['location_name']},${k['country']}</option>
            `;
        });
        $('.inp-prtrecieve',).append(db_sel_area);
        $('.inp-prtload',).append(db_sel_area);
        $('.inp-ts_port',).append(db_sel_area);
        $('.inp-delivery',).append(db_sel_area);

        let db_sel_cargo = '';
        $.each(set_data['cargo'], function (i, k) {
            db_sel_cargo += `
            <option value="${k['ID']}">${k['cargo_type_name']}</option>
            `;
        });
        $('.inp-cargo_type',).append(db_sel_cargo);

        let db_sel_type_truck = '';
        $.each(set_data['type_truck'], function (i, k) {
            db_sel_type_truck += `
            <option value="${k['ID']}">${k['truck_name']}</option>
            `;
        });
        $('.inp-type_truck',).append(db_sel_type_truck);

        let db_sel_des_cash = '';
        $.each(set_data['des_cash'], function (i, k) {
            db_sel_des_cash += `
            <option value="${k['ID']}">${k['billing_item_name']}</option>
            `;
        });
        $('.sel-des-cash',).append(db_sel_des_cash);

        let db_gover = '';
        $.each(set_data['gover'], function (i, k) {
            db_gover += `
            <option value="${k['ID']}">${k['name']}</option>
            `;
        });

        $('.inp-pcn-pay',).append(db_gover);



    },
}