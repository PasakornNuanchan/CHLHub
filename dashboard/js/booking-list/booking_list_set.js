const booking_list_set = {

    set_data_rows: async function (job_doc_pt) {
        $('.head-of-menu').html('Booking List');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-booking-list.php" target="" style="color:white;">Booking main list</a></li>`;
        $('.bcpage').append(html_bdpage);


        let data_table_booking = await booking_list_set.ajax_request_table();
        var data = data_table_booking['booking_list']
        await booking_list_set.setting_data_table_t(data);
        await $('.pnv').remove()

        $('#myTable > tbody').html('')
    },

    setting_data_table_t: async function (data) {
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                order: [[0, 'desc']]
            });
            data.forEach(function (item) {
                var last_button = '<button type="button" onclick="booking_list.preview(' + item.ID + ')" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>'
                table.row.add([item.create_date,
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


    function_add_job: async function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await job_support.ajax_job_support()

                await Swal.fire(
                    'Create sucess!',
                    'Data has been create.',
                    'success'
                )
                    
                let data_table_booking = await booking_list_set.ajax_request_table();
                var data = data_table_booking['booking_list']
                await booking_list_set.setting_data_table_t(data);
            }
        })

    },

    ajax_job_support: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_support/job_support.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }

};

