const user_list_set = {
    user_number_global: '',
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
        let get_user_number = getUrlParameter('user_number');

        let user_number = get_user_number == false ? null : get_user_number;
        this.user_number_global = user_number;

        console.log(get_user_number)
        if (get_user_number != 'undefined') {
            await this.set_head_page();
            await user_list_set_default.set_data_default();
            await this.set_raw_data(user_number);
            await $('.card_first_login').remove()
        } else {
            await this.set_head_page();
            await user_list_set_default.set_data_default();
            await create_user.setting_first();



        }
    },

    set_head_page: async function () {

        $('.head-of-menu').html('User');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-user_list.php" target="" style="color:white;">User main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    },



    set_raw_data: async function (user_number) {
        let rrd = await user_list_set.ajax_request_raw_data(user_number)

        $('.inp-un').val(rrd['sqru']['user_number'])
        $('.inp-fname').val(rrd['sqru']['first_name'])
        $('.inp-lname').val(rrd['sqru']['last_name'])
        $('.inp-mphone').val(rrd['sqru']['mobile_number'])
        $('.inp-email').val(rrd['sqru']['email'])
        $('.inp-address').val(rrd['sqru']['address'])
        $('.sel_department').val(rrd['sqru']['department_number'])
        $('.sel_st').val(rrd['sqru']['status_user'])

        $('.inp-user_name').val(rrd['sqru']['sec_user_id'])
        $('.inp-pass_word').val(rrd['sqru']['sec_user_pass'])
        $('.inp-password_f').val(rrd['sqru']['pincode_forgot'])


        $('.inp-bank_name').val(rrd['sqru']['bank_name'])
        $('.inp-bank_number').val(rrd['sqru']['bank_number'])
        $('.inp-user_name').attr('disabled', true)

    },

    ajax_request_raw_data: async function (user_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/request_raw_data.php",
                data: { 'user_number': user_number },
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
        // ps
        // pfp
        let context_title = '';
        if (val == "ps") {
            context_title = "reset password"
        } else {
            context_title = "reset pin passcode"
        }

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var lang_id = url.searchParams.get("user_number");

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
                let res_data = await this.ajax_generate(password, val, lang_id)

                if (res_data['st'] == '1') {
                    Swal.fire(
                        'saved!',
                        `Change ${context_title}`,
                        'success'
                    )
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Plese contact to techteam!',
                    })
                }
            }
        })
    },

    ajax_generate: async function (password, val, lang_id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/reset_password.php",
                data: {
                    password: password,
                    val: val,
                    lang_id: lang_id,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    fn_save_raw: async function () {
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

                // let un = $('.inp-un').val()
                let inp_fn = $('.inp-fname').val()
                let inp_ln = $('.inp-lname').val()
                let inp_mp = $('.inp-mphone').val()
                let inp_em = $('.inp-email').val()
                let inp_ad = $('.inp-address').val()
                let sel_de = $('.sel_department').val()
                let sel_st = $('.sel_st').val()
                // let inp_old_password = $('.inp-old_pass_word').val()
                // let inp_new_password = $('.inp-new_password').val()
                // let inp_cf_new_password  = $('.inp-cf_newpassword').val()

                let inp_bk = $('.inp-bank_name').val()
                let inp_bn = $('.inp-bank_number').val()

                let check_val = 0;
                let res_save_raw_data = 0;



                var currentURL = window.location.href;
                var url = new URL(currentURL);
                var id_number = url.searchParams.get("user_number");

                let arr_data = []
                let obj_data = {}

                obj_data = {
                    inp_fn: inp_fn,
                    inp_ln: inp_ln,
                    inp_mp: inp_mp,
                    inp_em: inp_em,
                    inp_ad: inp_ad,
                    sel_de: sel_de,
                    sel_st: sel_st,
                    inp_bk: inp_bk,
                    inp_bn: inp_bn,
                    id_number: id_number,
                }
                arr_data.push(obj_data)



                let res_data_save = await this.ajax_save_raw_data(arr_data)
                if (res_data_save == '1') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Oops...',
                        text: 'Saved ',
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data error Please contact to tech team ',
                    })
                }
            }
        })
    },

    ajax_check_password: async function (id_number, inp_old_password) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/checkPass_word.php",
                data: {
                    'id_number': id_number,
                    'inp_old_password': inp_old_password
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_raw_data: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/save_raw_data_user.php",
                data: { 'arr_data': arr_data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    close_eye: async function (e) {

        let data_type = $(e).closest('.row').find('input').attr('type')
        if (data_type == 'password') {
            $(e).closest('.row').find('input').attr('type', 'text')
        } else {
            $(e).closest('.row').find('input').attr('type', 'password')
        }

    }

};


