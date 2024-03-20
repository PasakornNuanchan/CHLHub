const create_user = {
    setting_first: async function () {
        $('.head_change').text("Login ")
        $('.fn_old_pass').remove();
        $('.text_new_pass').text("Password")
        $('.fn_cf_new_pass').remove();
        $('.bun_save').html('');
        $('.card_change_pass').remove()
        $('.bun_save').append(`
        <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="create_user.save_user_data()"><i class="bi bi-check-square"></i> Save</button>
        `);

    },
    ajax_check_id: async function (inp_un) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/check_id_mas.php",
                data: { inp_un },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_data_create: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/save_data_create.php",
                data: { 'arr_data': arr_data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    save_user_data: async function () {

        let inp_fn = $('.inp-fname').val()
        let inp_ln = $('.inp-lname').val()
        let inp_mp = $('.inp-mphone').val()
        let inp_em = $('.inp-email').val()
        let inp_ad = $('.inp-address').val()
        let sel_de = $('.sel_department').val()
        let sel_st = $('.sel_st').val()
        let inp_un = $('.inp-user_name-newpass').val()
        let inp_pw = $('.inp_pass_word_as').val()
        let inp_pwc = $('.inp_pass_word_as_cf').val()
        let inp_fgp = $('.inp_forgot_as_pass').val()
        let inp_bn = $('.inp-bank_name').val()
        let inp_bnum = $('.inp-bank_number').val()
        let obj_data = {}
        let arr_data = []


        if (inp_fn == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your firstname',
            })
            return
        }

        if (inp_un == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your username',
            })
            return
        }

        if (inp_pw == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your password',
            })
            return
        }

        if (inp_pwc == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your confirm password',
            })
            return
        }
        if (inp_fgp == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your forgot pin password',
            })
            return
        }

        if (inp_pw != inp_pwc) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter password and password confirm is same',
            })
            return
        }

        if (inp_fn != '' && inp_un != '' && inp_pw != '' && inp_pwc != '' && inp_pw == inp_pwc) {
            let res_data_check_id = await this.ajax_check_id(inp_un)
            if (res_data_check_id == '0') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'System has Username plase change username ',
                })
                return;
            } else {
                obj_data = {
                    inp_fn: inp_fn,
                    inp_ln: inp_ln,
                    inp_mp: inp_mp,
                    inp_em: inp_em,
                    inp_ad: inp_ad,
                    sel_de: sel_de,
                    sel_st: sel_st,
                    inp_un: inp_un,
                    inp_pw: inp_pw,
                    inp_pwc: inp_pwc,
                    inp_fgp: inp_fgp,
                    inp_bn : inp_bn,
                    inp_bnum : inp_bnum,
                }
                arr_data.push(obj_data)

                let res_data_save = await this.ajax_save_data_create(arr_data)
                console.log(res_data_save)
                let data_arr_suc = res_data_save['arr_suc'] ? res_data_save['arr_suc'] : '';
                let data_last_id = res_data_save['last_id'] ? res_data_save['last_id'] : '';
                if (data_arr_suc == '1') {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Oops...',
                        text: 'Saved ',
                    })
                    window.open(`CHL-user-management.php?user_number=${data_last_id}`)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data error Please contact to tech team ',
                    })
                }
            }
        }
    },
}


