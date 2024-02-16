const job_list = {

    set_header_page: async function (job_number) {
        $('.head-of-menu').html('Job');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Job list</a></li>
        `;
        $('.bcpage').append(html_bdpage);


        let data_table_booking = await job_list.ajax_request_table();
        console.log(data_table_booking)
        var data = data_table_booking['booking_list']
        await job_list.setting_data_table_t(data);
        await $('.pnv').remove()

        $('#myTable > tbody').html('')
        
        let res = await this.ajax_get_permission();
        console.log(res['permis'])
        if(res['permis'] == '2' || res['permis'] == '3'){
            $('.btn_create_job').remove();
        }
        // if(res['premis']['job_detail']=='2' ||res['premis']['job_detail']=='3' ){
        //     $('.btn_create_job').remove()
        // }
    },

    ajax_get_permission : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_list/get_permission.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    setting_data_table_t: async function (data) {
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                order: [[0, 'desc']]
            });
            data.forEach(function (item) {
                var last_button = '<a target="_blank" href="job_detail.php?job_number='+item.ID+'&action=preview"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</a>'
                table.row.add([
                last_button,
                item.job_number,
                item.sale_support,
                item.client_name,
                item.booking_number,
                item.POL,
                item.POD,
                item.etd,
                item.eta,
                ]).draw();
            });
        });


    },

    set_to_page_up : async function(data){
        
        window.location = "job_detail.php" + "?job_number=" + data+"&action=preview";
        
    },

    set_to_page_create : async function(data){
        
        window.location = "job_detail.php" + "?job_number=" + data+"&action=create";
        
    },
    
    ajax_request_table: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_list/get_detail.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
};
