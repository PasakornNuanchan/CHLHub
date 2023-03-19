const home = {

    set_preview_data: async function (job_number) {
        $('.head-of-menu').html('Home');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Home</a></li>
        `;
        $('.bcpage').append(html_bdpage);
        
    },
   
};
