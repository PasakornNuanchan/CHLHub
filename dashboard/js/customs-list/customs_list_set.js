const customs_list_set = {
   
    set_data_rows: async function (job_doc_pt) {
        $('.head-of-menu').html('Customs Clearance List');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-Customs-list.php" target="" style="color:white;">Customs Clearance Main List</a></li>`;
        $('.bcpage').append(html_bdpage);
    },

};

