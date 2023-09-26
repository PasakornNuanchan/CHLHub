const setting_default = {
    setting_default : async function(){
        
        let res_data = await this.ajax_setting_default();
        console.log(res_data)

        let bill_to_data_option = '';
        let job_number_data_option = '';        
        let hbl_data_option = '';
        let container_data_option = '';
        let billing_code_data_option = '';
        let user_data_option = '';

        
        $.each(res_data['bill_to_ap'],function(i,v){
            bill_to_data_option += `<option type_data="${v['TYPE']}"data_id="${v['ID']}" value="${v['NAME']}">${v['NAME']}</option>`;
        })

        $.each(res_data['job_number'],function(i,v){
            job_number_data_option += `<option id_number="${v['ID']}" value="${v['job_number']}">${v['job_number']}</option>`;
        })

        $.each(res_data['hbl'],function(i,v){
            hbl_data_option += `<option id_number="${v['ID']}" value="${v['hbl']}">${v['hbl']}</option>`;
        })

        $.each(res_data['container'],function(i,v){
            container_data_option += `<option id_number="${v['ID']}" value="${v['container_number']}">${v['container_number']}</option>`;
        })

        $.each(res_data['billing_code'],function(i,v){
            billing_code_data_option += `<option id_number="${v['ID']}" value="${v['billing_item_name']}">${v['billing_item_name']}</option>`;
        })

        $.each(res_data['user'],function(i,v){
            user_data_option += `<option id_number="${v['ID']}" value="${v['first_name']} ${v['last_name']}">${v['first_name']} ${v['last_name']}</option>`;
        })

        
        
        $('.bill_to_list_option').append(bill_to_data_option)
        $('.job_number_list_option').append(job_number_data_option)
        $('.hbl_list_option').append(hbl_data_option)
        $('.container_list_option').append(container_data_option)
        $('.billing_code_option').append(billing_code_data_option)

        $('.sale_support_data_option').append(user_data_option)
        $('.cs_support_data_option').append(user_data_option)
    },

    ajax_setting_default : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payable/get_data_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

}
