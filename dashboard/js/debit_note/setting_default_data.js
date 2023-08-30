const setting_default_data = {
    setting_default_data : async function(){
        
        let res_data_default_setting = await this.ajax_request_data_default();
        
        let html_bill_to = '';
        $.each(res_data_default_setting['data_bill_to'],function(i,v){
            html_bill_to += `
            <option data_type="${v['type_data']}" value="${v['data_id']}">${v['name_data']}</option>
            `;
        })
        $('.inp_bill_to_ap_job').append(html_bill_to)
        $('.inp_bill_to_ap_corp').append(html_bill_to)


        let html_user_cs = '';
        $.each(res_data_default_setting['data_user_cs'],function(i,v){
            html_user_cs += `
            <option value="${v['ID']}">${v['first_name']} ${v['last_name']}</option>
            `;
        })
        $('.inp_cs_support_ap_job').append(html_user_cs)
        $('.inp_cs_support_ap_corp').append(html_user_cs)


    },

    ajax_request_data_default : async function () {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/debit_note/get_reuqest_data_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}