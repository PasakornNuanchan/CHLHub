const setup = {
    slsdpsaad : '',
    ajax_setup_my_user: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/my_user/get_user.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    ajax_setup_default: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/my_user/get_default.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    setup_default : async function (){
        let res_data = await this.ajax_setup_default()
        console.log(res_data)
        let html_data_department = ''
        $.each(res_data['department'],function(i,v){
            html_data_department += `<option value="${v['ID']}">${v['department_name']}</option>`
        })

        $('.sel_department').append(html_data_department)
    },

    setup_data : async function (){


        $('.bcpage > .breadcrumb-item > a').html('My User')

        await this.setup_default();
        let res_data = await this.ajax_setup_my_user()
        
        $.each(res_data['get_user'],function(i,v){

            let id_number = v['ID'] ? v['ID'] : '';
            let user_number = v['user_number'] ? v['user_number'] : '';
            let first_name = v['first_name'] ? v['first_name'] : '';
            let last_name = v['last_name'] ? v['last_name'] : '';
            let address = v['address'] ? v['address'] : '';
            let mobile_number = v['mobile_number'] ? v['mobile_number'] : '';
            let email = v['email'] ? v['email'] : '';
            let country_number = v['country_number'] ? v['country_number'] : '';
            let city_number = v['city_number'] ? v['city_number'] : '';
            let sec_user_id = v['sec_user_id'] ? v['sec_user_id'] : '';
            let sec_user_pass = v['sec_user_pass'] ? v['sec_user_pass'] : '';
            let pincode_forgot = v['pincode_forgot'] ? v['pincode_forgot'] : '';
            let pictrue = v['pictrue'] ? v['pictrue'] : '';
            let status_user = v['status_user'] ? v['status_user'] : '';
            let department_number = v['department_number'] ? v['department_number'] : '';
            let bank_number = v['bank_number'] ? v['bank_number'] : '';
            let bank_name = v['bank_name'] ? v['bank_name'] : '';
            let brunch = v['brunch'] ? v['brunch'] : '';
            setup.slsdpsaad = sec_user_pass;
            
            $('.inp-fname').val(first_name)
            $('.inp-lname').val(last_name)
            $('.inp-mphone').val(mobile_number)
            $('.inp-email').val(email)
            $('.inp-address').val(address)
            $('.sel_department').val(department_number)
            $('.sel_st').val(status_user)
            $('.inp-bank_name').val(bank_name)
            $('.inp-bank_number').val(bank_number)


        })
    }
}