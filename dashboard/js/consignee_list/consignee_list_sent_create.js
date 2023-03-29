const consignee_sent_create = {
    create_carrier : async function (val_id) {
        window.location = 'CHL-consignee-management.php' + '?consignee_number=' + val_id;
    },

}