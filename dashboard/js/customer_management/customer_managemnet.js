const customer_management = {
    cm_id_global : '',
    
    set_data_head: async function () {

        $('.head-of-menu').html('Customer Management');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-customer_management_list.php" target="" style="color:white;">Customer Management List</a></li>`;
        $('.bcpage').append(html_bdpage);

    },

    check_get: async function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        let check_number = getUrlParameter('user_number');
        let number_cus = check_number == false ? null : check_number;
        this.cm_id_global = number_cus;
        
        if (number_cus == null) {
            await this.set_data_preview();
            // $('.passandforgotgen').html('');
        } else {
            await this.set_data_preview();
            await this.set_raw_data(number_cus);
        }
    },

    set_data_preview: async function () {
        let res_data = await this.ajax_set_data_preview()
        console.log(res_data)

        let context_corp = '';
        $.each(res_data['consignee'], function (i, v) {
            context_corp += `<option value="${v['ID']}">${v['consignee_name']}</option><br>`;
        })
        $('.sel_corp').append(context_corp)
    },

    ajax_set_data_preview: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customer_management/get_customer_management.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },



    get_data_save: async function () {
        let corp = $('.sel_corp').val()
        let name = $('.inp_name').val()
        let lname = $('.inp-lname').val()
        let email = $('.inp-email').val()
        let phone = $('.inp-mphone').val()
        let status_a = $('.sel_st').val()

        let username = $('.inp-user_name').val()
        let password = $('.inp-pass_word').val()
        let pin = $('.inp-password_f').val()

        if(corp == '' || username == '' || password == '' || pin == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Plese enter your data coperate username password and pin forgot password',
            })
        }else{
            let res_data_check = await this.ajax_check_data_user(username)
            let res = '';

            if(this.cm_id_global != ''){
                res = 0;
            }else{
                res = res_data_check['data_check'];
            }
            
            if(res != 1){
            
                let data = {
                    ID : this.cm_id_global,
                    corp: corp,
                    name: name,
                    lname: lname,
                    email: email,
                    phone: phone,
                    status_a: status_a,
                    username: username,
                    password: password,
                    pin: pin
                }
                let res_data_save = await this.ajax_get_data_save(data)
                
                if(res_data_save['st'] == '1'){
                    Swal.fire(
                        'saved!',
                        'Your data has been saved.',
                        'success'
                    )
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'System has problem plese contact to thailand tech team ',
                    })
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username duplicate in system plese change your username',
                })
            }
        }
        
    },

    ajax_check_data_user : async function (username) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customer_management/check_data_username.php",
                data: { username: username },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_get_data_save: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customer_management/save_customer_management.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    set_raw_data: async function (number_cus) {
        let res_data = await this.ajax_set_raw_data(number_cus);
        console.log(res_data)


        let corp = res_data['data_raw']['corp_id'] ? res_data['data_raw']['corp_id'] : '';
        let name = res_data['data_raw']['name'] ? res_data['data_raw']['name'] : '';
        let lname = res_data['data_raw']['sur_name'] ? res_data['data_raw']['sur_name'] : '';
        let email = res_data['data_raw']['email'] ? res_data['data_raw']['email'] : '';
        let phone = res_data['data_raw']['phone_number'] ? res_data['data_raw']['phone_number'] : '';
        let status_a = res_data['data_raw']['status_u'] ? res_data['data_raw']['status_u'] : '';
        let username = res_data['data_raw']['sec_username'] ? res_data['data_raw']['sec_username'] : '';
        let password = res_data['data_raw']['sec_password'] ? res_data['data_raw']['sec_password'] : '';
        let pin = res_data['data_raw']['forgot_pin'] ? res_data['data_raw']['forgot_pin'] : '';

        $('.sel_corp').val(corp)
        $('.inp_name').val(name)
        $('.inp-lname').val(lname)
        $('.inp-email').val(email)
        $('.inp-mphone').val(phone)
        $('.sel_st').val(status_a)
        $('.inp-user_name').val(username).attr('disabled',true)
        $('.inp-pass_word').val(password)
        $('.inp-password_f').val(pin)

        $('.passandforgot').html('');
    },

    ajax_set_raw_data: async function (number_cus) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customer_management/get_raw_data.php",
                data: { data: number_cus },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    generate: async function (val) {

        var characters = "0123456789@#$%!&*ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        var long = "6";
        let password = '';
        for (var i = 0; i < long; i++) {
            gen = characters.charAt(Math.floor(Math.random() * characters.length));
            password += gen;
        }

        let context_title = '';
        if(val == "gp"){
            context_title = "reset password"
        }else{
            context_title = "reset pin passcode"
        }

        
        Swal.fire({
            title: `Are you sure ${context_title}?`,
            text: `New password : ${password}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then(async (result) => {
            if (result.isConfirmed) {
                
                let res_data = await this.ajax_generate(password,val)
                
                if(res_data['st'] == '1'){
                    Swal.fire(
                        'saved!',
                        `Change ${context_title}`,
                        'success'
                    )
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Plese contact to techteam!',
                    })
                }
            }
        })
    },

    ajax_generate: async function (password,val) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customer_management/reset_password.php",
                data: 
                    { password: password,
                    val : val,},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }

}