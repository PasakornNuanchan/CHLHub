const customs ={
    job_number_global :  '' ,
    check_get: function () {
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
        let get_job_number = getUrlParameter('job_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job_number == false ? null : get_job_number;
        let action = get_action == false ? null : get_action;

       customs.job_number_global = job_number;

        console.log(action);
        
        if (action == 'preview') {
            customs_set_data_default.set_data_default();
            customs.head_bcpage(job_number);
            customs_set_sub_booking.set_sub_booking_preview_data(job_number);
            customs_set_sub_customs.set_preview_table_document(job_number);
            customs_set_sub_transport.set_sub_transport_preview_data(job_number);
            customs_set_sub_cash.set_sub_cash_preview_data(job_number);
        } else {

        }
    },
    
    head_bcpage: async function (job_number){
    
        $('.head-of-menu').html('Customs Clearance');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-Customs-list.php" target="" style="color:white;">Customs Clearance List </a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Customs Clearance (Job Number ${job_number})</li>`;
        $('.bcpage').append(html_bdpage);

    },

};


