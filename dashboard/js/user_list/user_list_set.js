const user_list_set = {
   
    set_data_head : async function () {
    
        $('.head-of-menu').html('User list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-PettyCash-list.php" target="" style="color:white;">User main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 
  
};


