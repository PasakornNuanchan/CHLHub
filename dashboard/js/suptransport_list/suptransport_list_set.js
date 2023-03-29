const suptransport_list_set = {
   
    set_data_head : async function () {
    
        $('.head-of-menu').html('Supplier Transport list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-suptransport_list.php" target="" style="color:white;">Supplier Transport main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 
  
};


