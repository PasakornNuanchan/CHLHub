const job_detail = {


    set_header_page: async function () {
        $('.head-of-menu').html('Job Detail');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Job Detail</a></li>
        `;
        $('.bcpage').append(html_bdpage);

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };

        let get_action = getUrlParameter('action');
        console.log(get_action)
    
        if(get_action == "preview"){
            await setting_data_default.setting_data();
            await sub_job_detail.first_post_data(id_number);
            await sub_transport.first_post_data(id_number);
            await sub_reportcs.first_post_data(id_number);
            await sub_customs.first_post_data(id_number);
            await sub_billing.first_post_data_ar(id_number);
            await sub_billing.first_post_data_ap(id_number);
            await sub_withdraw.first_post_data(id_number);
        }else if (get_action == "create"){
            await setting_data_default.setting_data();
            await create_job.setting_create_job();
        }
        
    
    },

   
};
