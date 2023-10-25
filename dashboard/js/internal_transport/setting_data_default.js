const setting_data_default = {

    data_job_number : '',
    data_description : '',
    data_plate : '',
    data_pay_to : '',
    setting_data_first : async function (){
        
        let res_data = await this.ajax_setting_data_first();
        console.log(res_data)

        let html_data_jobnumber = '';
        $.each(res_data['job_number'],function(i,v){
            html_data_jobnumber += `<option value="${v['ID']}">${v['job_number']} / ${v['consignee_name']}</option>`;
        })
        $('.sel_jobnumber').append(html_data_jobnumber)

        let html_data_description = '';
        $.each(res_data['description'],function(i,v){
            html_data_description += `<option value="${v['ID']}">${v['description_name']}</option>`;
        })
        $('.sel_description').append(html_data_description)

        let html_data_payto = '';
        $.each(res_data['pay_to'],function(i,v){
            html_data_payto += `<option value="${v['ID']}">${v['corp_name']}</option>`;
        })
        $('.sel_payto').append(html_data_payto)
        $('.sel_payto_detail').append(html_data_payto)
        $('.sel_payto_statement').append(html_data_payto)

        let html_data_plate = '';
        $.each(res_data['plate'],function(i,v){
            html_data_plate += `<option value="${v['ID']}">${v['plate']}</option>`;
        })
        $('.sel_plate').append(html_data_plate)

        let data_jobnumber = $('.sel_jobnumber').parent().html();
        let data_description = $('.sel_description').parent().html();
        let data_plate = $('.sel_plate').parent().html();
        let data_payto = $('.sel_payto').parent().html();

        this.data_pay_to = await data_payto;
        this.data_job_number = await data_jobnumber;
        this.data_description = await data_description;
        this.data_plate = await data_plate;
        
    },

    ajax_setting_data_first : async function (){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport/get_detail_default.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}