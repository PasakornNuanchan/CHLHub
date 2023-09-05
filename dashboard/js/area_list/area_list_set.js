const carrier_list_set = {
   
    set_data_head : async function () {
    
        $('.head-of-menu').html('Area list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-area_list.php" target="" style="color:white;">Area main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 
  
};


