const consignee_list_set = {
   
    set_data_head : async function () {
    
        $('.head-of-menu').html('Consignee list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-consignee_list.php" target="" style="color:white;">Consignee main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

   
};


