const carrier_list_set = {
   
    set_data_head : async function () {
    
        $('.head-of-menu').html('Carrier list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-carrier_list.php" target="" style="color:white;">User main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 
  
};


