const job_list_management = {

    set_header_page: async function (job_number) {
        $('.head-of-menu').html('Preview management list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Preview management list</a></li>
        `;
        $('.bcpage').append(html_bdpage);


        let data_table_booking = await job_list_management.ajax_request_table();
        
        var data = data_table_booking['booking_list']
        await job_list_management.setting_data_table_t(data);
        await $('.pnv').remove()

        $('#myTable > tbody').html('')
        
        let res = await this.ajax_get_permission();
        
        if(res['permis'] == '2' || res['permis'] == '3'){
            $('.btn_create_job').remove();
        }
        
    },

    ajax_get_permission : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_management_list/get_permission.php",
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
                var last_button = '<button type="button" onclick="job_list_management.set_to_page_up(' + item.ID + ')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>'
                table.row.add([
                item.create_date,
                item.job_number,
                item.mbl,
                item.carrier_name,
                item.consignee_name,
                item.location_name,
                item.eta,
                last_button
                ]).draw();
            });
        });
    },

    set_to_page_up : async function(data){
        
        window.location = "preview_management.php" + "?job_number=" + data+"&action=preview";
        
    },

    set_to_page_create : async function(data){
        
        window.location = "job_detail.php" + "?job_number=" + data+"&action=create";
        
    },
    
    ajax_request_table: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/booking-list/get_detail.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
};
