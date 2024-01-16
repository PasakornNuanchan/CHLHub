const carrier_list_set = {
    carrier_number_global: '',
    data_del : [],
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
        let get_carrier_number = getUrlParameter('carrier_number');

        let carrier_number = get_carrier_number == false ? null : get_carrier_number;

        this.carrier_number_global = carrier_number;

        if (get_carrier_number != 'undefined') {
            await this.set_head_page();
            await this.set_raw_data(carrier_number);
            $('.inp-cname').attr('disabled', true)
        } else {
            $('.inp-cname').attr('disabled', false)

        }
    },

    set_head_page: async function () {

        $('.head-of-menu').html('Carrier');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-carrier_list.php" target="" style="color:white;">Carrier main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    },

    set_raw_data: async function (carrier_number) {
        let rrd = await carrier_list_set.ajax_request_raw_data(carrier_number)
        // console.log(rrd['bank'])

        let carrier_name = rrd['sqrc']['carrier_name'] ? rrd['sqrc']['carrier_name'] : '';
        let carrier_sub_name = rrd['sqrc']['carrier_sub_name'] ? rrd['sqrc']['carrier_sub_name'] : '';
        let email = rrd['sqrc']['email'] ? rrd['sqrc']['email'] : '';
        let phone_number = rrd['sqrc']['phone_number'] ? rrd['sqrc']['phone_number'] : '';
        let contact_name = rrd['sqrc']['contact_name'] ? rrd['sqrc']['contact_name'] : '';
        let payment_term = rrd['sqrc']['payment_term'] ? rrd['sqrc']['payment_term'] : '';

        $('.inp-cname').val(carrier_name)
        $('.inp-csname').val(carrier_sub_name)
        $('.inp-email').val(email)
        $('.inp-phone_number').val(phone_number)
        $('.inp-contact').val(contact_name)
        $('.inp-contact').val(contact_name)
        $('.inp_payment_term_day').val(payment_term)

        $('.card_bank_data').html('')
        
        if(rrd['bank'] != "0 results"){
            $.each(rrd['bank'], function (i, v) {

                let id_number = v['ID'] ? v['ID'] : '';
                let bank_abb = v['bank_abb'] ? v['bank_abb'] : '';
                let company_name = v['company_name'] ? v['company_name'] : '';
                let company_address = v['company_address'] ? v['company_address'] : '';
                let bank_number = v['bank_number'] ? v['bank_number'] : '';
                let bank_account = v['bank_account'] ? v['bank_account'] : '';
                let bank_swift_code = v['bank_swift_code'] ? v['bank_swift_code'] : '';
                let bank_code = v['bank_code'] ? v['bank_code'] : '';
                let country = v['country'] ? v['country'] : '';
                let tax_number = v['tax_number'] ? v['tax_number'] : '';
                let commercial_number = v['commercial_number'] ? v['commercial_number'] : '';
            
                let html_data = `
                <div class="card card_cma card_cmb_${id_number} mt-3" id_number="${id_number}">
                    <div class="card-body">
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">The bank abbreviation</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_bank_abb" maxlength="60">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Company Name</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_company_name" maxlength="80">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Company address</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_company_address" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Bank name</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_bank_name" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Bank account No</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_bank_account" maxlength="70">
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Bank SWIFT CODE</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_bank_swift_code" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">BANK CODE</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_bank_code" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pl-2 mt-4">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Country</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_country" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">TAX number</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_tax_number" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="form-group pl-2">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Commercial number</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm inp_commercial_number" maxlength="70">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-sm btn-danger" onclick="carrier_list_set.del_list(this)"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
                `;
    
                $('.card_bank_data').append(html_data)
    
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_abb`).val(bank_abb)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_company_name`).val(company_name)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_company_address`).val(company_address)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_name`).val(bank_number)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_account`).val(bank_account)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_swift_code`).val(bank_swift_code)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_code`).val(bank_code)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_country`).val(country)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_tax_number`).val(tax_number)
                $(`.card_cmb_${id_number} > .card-body > .form-group > .row > .col-9 > .inp_commercial_number`).val(commercial_number)
            })
        }else{
            await this.add_bank();
        }
        
    },
    
    del_list : async function(e){
        let data_id_number = $(e).closest('.card_cma').attr('id_number')
        carrier_list_set.data_del.push(data_id_number)
        $(e).closest('.card_cma').remove()
    },


    ajax_request_raw_data: async function (carrier_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/carrier-management/request_raw_data.php",
                data: { 'carrier_number': carrier_number },
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

                //let carrier_number = $('.inp-carrier_number').val()
                let corp_name = $('.inp-cname').val()
                let corp_sub_name = $('.inp-csname').val()
                let corp_em = $('.inp-email').val()
                let phone_number = $('.inp-phone_number').val()
                let contact = $('.inp-contact').val()
                let payment_term = $('.inp_payment_term_day').val()

                let arr_data = [];

                let data_number = this.carrier_number_global == "undefined" ? '' : this.carrier_number_global;
                uset_arr_temp = {
                    carrier_id: data_number,
                    corp_name: corp_name,
                    corp_sub_name: corp_sub_name,
                    corp_em: corp_em,
                    phone_number: phone_number,
                    contact: contact,
                    payment_term : payment_term,
                }
                let path_data = $('.card_bank_data > .card_cma')

                $.each(path_data, function () {
                    let obj_data = {}
                    
                    let id_number = $(this).attr('id_number')
                    let bank_abb = $(this).find('.inp_bank_abb').val()
                    let company_name = $(this).find('.inp_company_name').val()
                    let company_address = $(this).find('.inp_company_address').val()
                    let bank_name = $(this).find('.inp_bank_name').val()
                    let bank_account = $(this).find('.inp_bank_account').val()
                    let bank_swift_code = $(this).find('.inp_bank_swift_code').val()
                    let bank_code = $(this).find('.inp_bank_code').val()
                    let country = $(this).find('.inp_country').val()
                    let tax_number = $(this).find('.inp_tax_number').val()
                    let commercial_number = $(this).find('.inp_commercial_number').val()

                    if(
                        bank_abb != '' ||
                        company_name != '' ||
                        company_address != '' ||
                        bank_name != '' ||
                        bank_account != '' ||
                        bank_swift_code != '' ||
                        bank_code != '' ||
                        country != '' ||
                        commercial_number != '' ||
                        tax_number != ''
                    ){
                        obj_data = {
                            id_number : id_number,
                            bank_abb : bank_abb,
                            company_name : company_name,
                            company_address : company_address,
                            bank_name : bank_name,
                            bank_account : bank_account,
                            bank_swift_code : bank_swift_code,
                            bank_code : bank_code,
                            country : country,
                            tax_number : tax_number,
                            commercial_number : commercial_number,
                        }
                        arr_data.push(obj_data)
                    }
                })
                console.log(arr_data)
                // console.log(uset_arr_temp)
                let res_save_raw_data = await this.ajax_save_raw_data(uset_arr_temp, arr_data,carrier_list_set.data_del)
                // console.log(res_save_raw_data)
                let data_last_id = res_save_raw_data['last_id'];
                if (res_save_raw_data['arr_suc']['st'] == '1') {
                    Swal.fire({
                        title: 'Saved!',
                        text: 'Your file has been saved.',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'CHL-carrier-management.php' + '?carrier_number=' + data_last_id
                        }
                    });



                } else if (res_save_raw_data['arr_suc']['st'] == '0') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Save is false plese contact to support tech team',
                    })
                }

            }
        })
    },

    ajax_save_raw_data: async function (uset_arr_temp, arr_data,data_del) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/carrier-management/save_raw_data_user.php",
                data: {
                    'uset_arr_temp': uset_arr_temp,
                    'arr_data': arr_data,
                    'data_del' : data_del,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    add_bank: async function () {
        let html_data = `
        <div class="card card_cma mt-3">
            <div class="card-body">
                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">The bank abbreviation</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_bank_abb" maxlength="60">
                        </div>
                    </div>
                </div>
                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Company Name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_company_name" maxlength="80">
                        </div>
                    </div>
                </div>
                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Company address</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_company_address" maxlength="200">
                        </div>
                    </div>
                </div>
                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Bank name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_bank_name" maxlength="40">
                        </div>
                    </div>
                </div>
                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Bank account No</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_bank_account" maxlength="70">
                        </div>
                    </div>
                </div>

                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Bank SWIFT CODE</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_bank_swift_code" maxlength="40">
                        </div>
                    </div>
                </div>
                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">BANK CODE</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_bank_code" maxlength="40">
                        </div>
                    </div>
                </div>
                <div class="form-group pl-2 mt-4">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Country</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_country" maxlength="40">
                        </div>
                    </div>
                </div>
                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">TAX number</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_tax_number" maxlength="40">
                        </div>
                    </div>
                </div>
                <div class="form-group pl-2">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Commercial number</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm inp_commercial_number" maxlength="70">
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-sm btn-danger" onclick="carrier_list_set.del_list(this)"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>
        `;

        $('.card_bank_data').append(html_data)
    },


};


