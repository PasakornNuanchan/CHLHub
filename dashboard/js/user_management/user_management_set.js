const user_list_set = {
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

        if(get_user_number != undefined){
        await this.set_head_page();
        await user_list_set_default.set_data_default();
        await this.set_raw_data(user_number);
        }else{

        }
    },

    set_head_page : async function () {
    
        $('.head-of-menu').html('User');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-PettyCash-list.php" target="" style="color:white;">User main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

    set_raw_data : async function (user_number){
        let rrd = await user_list_set.ajax_request_raw_data(user_number)
        console.log(rrd)

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

    },

    ajax_request_raw_data : async function(user_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/request_raw_data.php",
                data: {'user_number' : user_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    fn_save_raw : async function (){
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
                
                let un = $('.inp-un').val()
                let inp_fn = $('.inp-fname').val()
                let inp_ln = $('.inp-lname').val()
                let inp_mp = $('.inp-mphone').val()
                let inp_em = $('.inp-email').val()
                let inp_ad = $('.inp-address').val()
                let sel_de = $('.sel_department').val()
                let sel_st = $('.sel_st').val()

                let inp_un = $('.inp-user_name').val()
                let inp_pw = $('.inp-pass_word').val()
                let inp_pwf = $('.inp-password_f').val()
                
                let inp_bk = $('.inp-bank_name').val()
                let inp_bn = $('.inp-bank_number').val()

                let check_val = 0;
                if(un == "" || inp_fn == "" || inp_ln == "" || inp_mp == "" || inp_em == "" || inp_ad == "" || sel_de == "" || sel_st == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Detail data is missing plese check your data !',
                    })
                    check_val = 1;
                }else if(inp_un == "" || inp_pw == "" || inp_pwf == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Login data is missing plese check your data !',
                    })
                    check_val = 1;
                }else if(inp_bk == "" || inp_bn == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Cash Detail data is missing plese check your data !',
                    })
                    check_val = 1;
                }

                if(check_val == 0){
                   uset_arr_temp = {
                    un : un,
                    inp_fn : inp_fn,
                    inp_ln : inp_ln,
                    inp_mp : inp_mp,
                    inp_em : inp_em,
                    inp_ad : inp_ad,
                    sel_de : sel_de,
                    sel_st : sel_st,
                    inp_un : inp_un,
                    inp_pw : inp_pw,
                    inp_pwf : inp_pwf,
                    inp_bk : inp_bk,
                    inp_bn : inp_bn
                   }

                    let res_save_raw_data  = await this.ajax_save_raw_data(uset_arr_temp)
                }
                
            
            }
        })
    },

    ajax_save_raw_data : async function (uset_arr_temp){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/save_raw_data_user.php",
                data: {'uset_arr_temp' : uset_arr_temp},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
    
};


