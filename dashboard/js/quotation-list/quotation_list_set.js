const quotation_list_set = {
   
    set_data_rows: async function () {
        
        $('.head-of-menu').html('Quotation List');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-Quartation-list.php" target="" style="color:white;">Quotation Main List</a></li>`;
        $('.bcpage').append(html_bdpage);
        
    }, 

};

