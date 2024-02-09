const start_default = {
    start_default: async function () {
        let res_data_default = await this.ajax_default_data();
        let data_default = '';
        $.each(res_data_default['default'], function (i, v) {
            let name_type = v['name_type'] ? v['name_type'] : '';
            let TYPE = v['TYPE'] ? v['TYPE'] : '';
            let ID = v['ID'] ? v['ID'] : '';
            let NAME = v['NAME'] ? v['NAME'] : '';
            data_default += `
            <div class="form-group">
                <button class="btn btn-sm" data_id="${ID}" data_type="${TYPE}" name_type="${NAME}" onclick="start.mark_active(this)"><i class="bi bi-folder text-warning" style="zoom:135%"></i>${NAME}</button>
            </div>
            `;
        })

        $('.data_sic').append(data_default)


        let html_data_job = '';
        let html_data_des = '';
        console.log(res_data_default['description'])
        console.log(res_data_default['job_number'])
        $.each(res_data_default['job_number'], function (i, v) {
            if(v['job_number'] != ''){
                html_data_job += `<option realdata="${v['job_number']}">${v['job_number']}</option>`;
            }
        })
        $.each(res_data_default['description'], function (i, v) {
            if(v['billing_item_name'] != ''){
                html_data_des += `<option number_des="${v['ID']}" billing_item_name="${v['billing_item_name']}">${v['billing_item_name']}</option>`;
            }
        })

        $('.data_list_job_number').append(html_data_job)
        $('.data_list_billing_list').append(html_data_des)
    },

    

    ajax_default_data: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_review/get_data_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}