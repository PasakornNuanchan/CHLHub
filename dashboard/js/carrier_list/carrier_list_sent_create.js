const carrier_sent_create = {
    create_carrier : async function (val_id) {
        window.location = 'CHL-carrier-management.php' + '?carrier_number=' + val_id;
    },

}