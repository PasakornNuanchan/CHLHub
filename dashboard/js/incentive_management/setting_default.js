const setting_data_default = {
    start_default : async function(){
        

        $('.sel_sale').html('')
        $('.sel_client').html('')
        $('#job_number_list').html('')

        let res_data = await this.ajax_request_default_data();
        console.log(res_data)

        let html_data_sale_user = `<option value="">All</option>`;
        $.each(res_data['sale'],function(i,v){
            html_data_sale_user += `<option value="${v['ID']}">${v['first_name']} ${v['last_name']}</option>`;
        })

        $('.sel_sale').append(html_data_sale_user)


        let html_data_client_user = '<option value="">All</option>';
        $.each(res_data['client'],function(i,v){
            html_data_client_user += `<option value="${v['ID']}">${v['consignee_name']}</option>`;
        })
        $('.sel_client').append(html_data_client_user)


        let html_data_job_number = '';
        let e_path = $('.table_process tbody tr')
        $.each(e_path,function(){
            let job_number = $(this).find('.inp_job_number').val()
            html_data_job_number += `<option value="${job_number}">${job_number}</option>`
        })
        $('#job_number_list').append(html_data_job_number)


    },

    ajax_request_default_data : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/incentive_management/get_data_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}