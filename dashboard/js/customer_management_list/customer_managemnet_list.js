const customer_management_list = {
    set_data_head : async function () {
    
        $('.head-of-menu').html('Customer Management List');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-customer_management_list.php" target="" style="color:white;">Customer Management List</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

    add_customer : async function(){
        window.location = 'CHL-customer-management.php' + '?user_number=';
    },
    
    edit_customer : async function(val_id){
        window.location = 'CHL-customer-management.php' + '?user_number=' + val_id;

    }
}