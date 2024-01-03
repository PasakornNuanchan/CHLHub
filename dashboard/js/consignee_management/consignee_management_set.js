const consignee_list_set = {
    consignee_number_global : '',
    arr_delete_user_data : [],
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
        let get_consignee_number = getUrlParameter('consignee_number');
        
        let consignee_number = get_consignee_number == false ? null : get_consignee_number;
        
        this.consignee_number_global = consignee_number;

        if (get_consignee_number != 'undefined') {
            await this.set_head_page();
            await this.set_raw_data(consignee_number);
            await this.set_data_user_consignee(consignee_number);
            $('#user_detail_tab').remove();

        } else {
            await this.set_head_page();
            $('#user_detail_tab').remove();
        }
    },

    set_head_page : async function () {
        $('.head-of-menu').html('Consignee');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-consignee_list.php" target="" style="color:white;">Consignee main list</a></li>`;
        $('.bcpage').append(html_bdpage);
    }, 

    set_data_user_consignee : async function(consignee_number){
        let res = await this.ajax_load_user_data(consignee_number)
        console.log(res)
        $('.user_card_tab').html('')
        if(res['user_data_consignee'] != "0 results"){
            $.each(res['user_data_consignee'],function (i,v){
                let uID = v['ID'] ? v['ID'] : '';
                let username = v['sec_username'] ? v['sec_username'] : '';
                let password = v['sec_password'] ? v['sec_password'] : '';
                let forgot_pin = v['forgot_pin'] ? v['forgot_pin'] : '';
                let status_u = v['status_u'] ? v['status_u'] : '';
                let html_user_consignee = '';
    
                html_user_consignee = `
                <div class="consignee_user" user_consignee_id="${uID}">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">username :</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp_username" value="${username}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">password :</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <input type="input" class="form-control form-control-sm inp_pass" value="${password}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">stauts :</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <select class="form-select form-select-sm inp_status inp_status${i}">
                                <option value="1">active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center ">forgot pin (for reset password) :</label>
                        <div class="col-sm-9 col-md-9 col-lg-9">
                        <input type="input" class="form-control form-control-sm inp_forgot" value="${forgot_pin}">
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-danger" onclick="consignee_list_set.delete_user_consingee(this)"><i class="bi bi-trash"></i> Delete</button>
                    </div>
                    <hr>
                </div>
                `;
                
                $('.user_card_tab').append(html_user_consignee)
                $(`.inp_status${i}`).val(status_u)
            })
        }
        
    },

    ajax_load_user_data : async function(consignee_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/consignee-management/get_user_consignee.php",
                data: {'consignee_number' : consignee_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    set_raw_data : async function (consignee_number){
        let rrd = await consignee_list_set.ajax_request_raw_data(consignee_number)
        //$('.inp-consignee_number').val(rrd['sqrc']['consignee_number'])
        let consignee_name = rrd['sqrc']['consignee_name'] ? rrd['sqrc']['consignee_name'] : '';
        let address = rrd['sqrc']['address'] ? rrd['sqrc']['address'] : '';
        let tax = rrd['sqrc']['tax'] ? rrd['sqrc']['tax'] : '';
        let email = rrd['sqrc']['email'] ? rrd['sqrc']['email'] : '';
        let tel = rrd['sqrc']['tel'] ? rrd['sqrc']['tel'] : '';
        let fax = rrd['sqrc']['fax'] ? rrd['sqrc']['fax'] : '';
        let contact_person_name = rrd['sqrc']['contact_person_name'] ? rrd['sqrc']['contact_person_name'] : '';
        let contact_person_tel = rrd['sqrc']['contact_person_tel'] ? rrd['sqrc']['contact_person_tel'] : '';
        let user_sale = rrd['sqrc']['user_sale'] ? rrd['sqrc']['user_sale'] : '';



        await $('.inp-cname').val(consignee_name).attr('disabled',true)
        await $('.inp-address').val(address)
        await $('.inp-tax_id').val(tax)
        await $('.inp-email').val(email)
        await $('.inp-phone_number').val(tel)
        await $('.inp-fax').val(fax)
        await $('.inp-linkman').val(contact_person_name)
        await $('.inp-contact').val(contact_person_tel)
        await $('.sel_sale_support').val(user_sale)
    },

    add_new_user_consignee : async function (){
        let html_new_user = '';
        html_new_user = `
        <div class="consignee_user" user_consignee_id="">
            <div class="form-group row">
                <label class="control-label col-sm-3 align-self-center ">username :</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <input type="input" class="form-control form-control-sm inp_username">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 align-self-center ">password :</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <input type="input" class="form-control form-control-sm inp_pass">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 align-self-center ">stauts :</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <select class="form-select form-select-sm inp_status">
                        <option value="1">active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 align-self-center ">forgot pin (for reset password) :</label>
                <div class="col-sm-9 col-md-9 col-lg-9">
                <input type="input" class="form-control form-control-sm inp_forgot">
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-sm btn-danger" onclick="consignee_list_set.delete_user_consingee(this)"><i class="bi bi-trash"></i> Delete</button>
            </div>
            <hr>
        </div>
        `;
        $('.user_card_tab').append(html_new_user)
    },

    delete_user_consingee : async function (e){
        let data_id = $(e).closest('.consignee_user').attr('user_consignee_id')
        
        obj_delete_user_data = {}
        if(data_id != ""){
            obj_delete_user_data = {
                data_id : data_id
            }
            this.arr_delete_user_data.push(obj_delete_user_data)
        }
        
    },

    save_user_consignee : async function (){
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("consignee_number");
        
        let arr_save = []
        let obj_save = {}
        $('.consignee_user').each(async function (i, v) {
            let user_id = $(this).attr('user_consignee_id')
            let username = $('.inp_username',this).val()
            let password = $('.inp_pass',this).val()
            let statusin = $('.inp_status',this).val()
            let forgot = $('.inp_forgot',this).val()
            
            obj_save = {
                user_id : user_id,
                id_number : id_number,
                username : username,
                password : password,
                statusin : statusin,
                forgot : forgot
            }
            arr_save.push(obj_save)
        })
        
        let res_data = await this.ajax_save_user_data(arr_save)

        if(res_data['arr_save_data'] == '1'){
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
        
    },

    ajax_save_user_data : async function(arr_save){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/consignee-management/save_user_chlth.php",
                data: {'arr_save' : arr_save},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    ajax_request_raw_data : async function(consignee_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/consignee-management/request_raw_data.php",
                data: {'consignee_number' : consignee_number},
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
                
                //let consignee_number = $('.inp-consignee_number').val()
                
                let corp_name = $('.inp-cname').val()
                let corp_address = $('.inp-address').val()
                let corp_tax_id = $('.inp-tax_id').val()
                let corp_email = $('.inp-email').val()
                let corp_phone_number = $('.inp-phone_number').val()
                let corp_fax = $('.inp-fax').val()
                let corp_linkman = $('.inp-linkman').val()
                let corp_contact_tel = $('.inp-contact').val()
                let corp_sale_support = $('.sel_sale_support').val()


                let check_val = 0;

                if(corp_name == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Detail data is missing plese check your data !',
                    })
                    check_val = 1;
                }

                if(check_val == 0){

                this.consignee_number_global = this.consignee_number_global == "undefined" ? '' : this.consignee_number_global;
                   uset_arr_temp = {
                    consignee_id : this.consignee_number_global,
                    corp_name : corp_name,
                    corp_address : corp_address,
                    corp_tax_id : corp_tax_id,
                    corp_email : corp_email,
                    corp_phone_number : corp_phone_number,
                    corp_fax : corp_fax,
                    corp_linkman : corp_linkman,
                    corp_contact_tel : corp_contact_tel,
                    corp_sale_support : corp_sale_support,
                   }
                    let res_save_raw_data  = await this.ajax_save_raw_data(uset_arr_temp)
                    console.log(res_save_raw_data)
                    if(res_save_raw_data['arr_suc']['st'] == '4'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Cannot has save your data because corporate name is duplicate please change corporate name',
                        })
                    }else if(res_save_raw_data['arr_suc']['st'] == '1'){
                        Swal.fire({
                            title: 'Saved!',
                            text: 'Your file has been saved.',
                            icon: 'success',
                          }).then((result) => {
                            if (result.isConfirmed) {
                              window.location.href = 'CHL-consignee-management.php' + '?consignee_number=' + res_save_raw_data['last_id'];;
                            }
                          });
                        
                        // $('.inp-cname').val('')
                        // $('.inp-address').val('')
                        // $('.inp-tax_id').val('')
                        // $('.inp-email').val('')
                        // $('.inp-phone_number').val('')
                        // $('.inp-fax').val('')
                        // $('.inp-linkman').val('')
                        // $('.inp-contact').val('')

                    }else if(res_save_raw_data['arr_suc']['st'] == '0'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Save is false plese contact to support tech team',
                        })
                    }
                }
            }
        })
    },

    ajax_save_raw_data : async function (uset_arr_temp){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/consignee-management/save_raw_data_user.php",
                data: {'uset_arr_temp' : uset_arr_temp},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    corp_check : async function (){
        let name = $('.inp-cname').val()

        if(name != ''){
            let res_data_name = await this.ajax_check_name(name)
        
            if(res_data_name == '0'){
                $('.data_check_name').html(`<i class="bi bi-check-lg" style="zoom:200%; color:green;"></i>`);
                
            }else{
                $('.data_check_name').html(`<i class="bi bi-x-lg" style="zoom:200%; color:red;"></i>`);
            }
        }else{
            $('.data_check_name').html('');
        }

        
    },

    ajax_check_name : async function (name){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/consignee-management/check_data_name.php",
                data: {'name' : name},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    
};


