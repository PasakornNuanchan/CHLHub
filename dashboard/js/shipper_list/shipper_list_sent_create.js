const shipper_sent_create = {
    create_carrier : async function (val_id) {
        window.location = 'CHL-shipper-management.php' + '?shipper_number=' + val_id;
    },

}