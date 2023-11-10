const create_user = {
    setting_first: async function () {
        $('.head_change').text("Login ")
        $('.fn_old_pass').remove();
        $('.text_new_pass').text("Password")
        $('.fn_cf_new_pass').remove();
        $('.bun_save').html('');

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
        let inp_un = $('.inp-user_name').val()
        let inp_new_password = $('.inp-new_password').val()
        let inp_bk = $('.inp-bank_name').val()
        let inp_bn = $('.inp-bank_number').val()
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

        if (inp_un != '' && inp_new_password != '') {
            let res_data_check_id = await this.ajax_check_id(inp_un)
            if (res_data_check_id == '0') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'System has Username plase change username ',
                })
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
                    inp_new_password: inp_new_password,
                    inp_bk: inp_bk,
                    inp_bn: inp_bn,
                }
                arr_data.push(obj_data)
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your username and password ',
            })
            return
        }

        let res_data_save = await this.ajax_save_data_create(arr_data)
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



    },


}