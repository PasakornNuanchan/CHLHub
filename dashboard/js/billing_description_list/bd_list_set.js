const bd_list_set = {
   
    set_data_head : async function () {
    
        $('.head-of-menu').html('Billing description list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing_description_list.php" target="" style="color:white;">Billing description main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 
  
};


