const setting_default = {
    ajax_get_user_sale : async function(){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/consignee-management/get_user_sale.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    setting_sale_support : async function (){
        let res_data = await this.ajax_get_user_sale()
        
        let html_sel_sale = ''

        $.each(res_data['user_sale'],function(i,v){
            let id_number = v['ID'] ? v['ID'] : '';
            let first_name = v['first_name'] ? v['first_name'] : '';
            html_sel_sale += `<option value="${id_number}">${first_name}</option>`;
        })

        $('.sel_sale_support').append(html_sel_sale)
    }
}