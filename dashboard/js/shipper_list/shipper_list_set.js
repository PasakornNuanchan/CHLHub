const shipper_list_set = {
   
    set_data_head : async function () {
    
        $('.head-of-menu').html('Shipper list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-shipper_list.php" target="" style="color:white;">Shipper main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 
  
};


