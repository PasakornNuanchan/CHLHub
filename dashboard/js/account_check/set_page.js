const set_page = {
    set_head_page : async function () {
    
        $('.head-of-menu').html('Accounting Part');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="account_check.php" target="" style="color:white;">Account check</a></li>`;
        $('.bcpage').append(html_bdpage);
        await setting_data.setting_data_first();
        await setting_data.setting_first_title()
        
        
    }, 
}