const shipper_list_set = {
    shipper_number_global: '',
    del_list_data : [],
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
        let get_shipper_number = getUrlParameter('shipper_number');

        let shipper_number = get_shipper_number == false ? null : get_shipper_number;

        this.shipper_number_global = shipper_number;

        if (get_shipper_number != 'undefined') {
            await this.set_head_page();
            await this.set_raw_data(shipper_number);
        } else {
            await this.set_head_page();
        }
    },

    set_head_page: async function () {

        $('.head-of-menu').html('Shipper Management');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-shipper_list.php" target="" style="color:white;">Shipper Management List</a></li>`;
        $('.bcpage').append(html_bdpage);

    },

    set_raw_data: async function (shipper_number) {
        $('.card_bank_data').html('')
        let rrd = await shipper_list_set.ajax_request_raw_data(shipper_number)

        //$('.inp-shipper_number').val(rrd['sqrc']['shipper_number'])
        let shipper_name = rrd['sqrc']['shipper_name'] ? rrd['sqrc']['shipper_name'] : '';
        let address = rrd['sqrc']['address'] ? rrd['sqrc']['address'] : '';
        let tax = rrd['sqrc']['tax'] ? rrd['sqrc']['tax'] : '';
        let email = rrd['sqrc']['email'] ? rrd['sqrc']['email'] : '';
        let tel = rrd['sqrc']['tel'] ? rrd['sqrc']['tel'] : '';
        let fax = rrd['sqrc']['fax'] ? rrd['sqrc']['fax'] : '';
        let linkman = rrd['sqrc']['linkman'] ? rrd['sqrc']['linkman'] : '';
        let linkman_tel = rrd['sqrc']['linkman_tel'] ? rrd['sqrc']['linkman_tel'] : '';
        let payment_term = rrd['sqrc']['payment_term'] ? rrd['sqrc']['payment_term'] : '';
        
        $('.inp-cname').val(shipper_name).attr('readonly', true)
        $('.inp-address').val(address)
        $('.inp-tax_id').val(tax)
        $('.inp-email').val(email)
        $('.inp-phone_number').val(tel)
        $('.inp-fax').val(fax)
        $('.inp-linkman').val(linkman)
        $('.inp-contact').val(linkman_tel)
        $('.inp_payment_term_day').val(payment_term)
 
        if (rrd['bank'] != "0 results") {
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

                let html_data_shipper = `
                <div class="card card_cma card_cmb${id_number} mt-3" id_number="${id_number}">
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
                            <button class="btn btn-danger btn-sm" onclick="shipper_list_set.del_list(this)"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
                `;

                $('.card_bank_data').append(html_data_shipper)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_abb`).val(bank_abb)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_company_name`).val(company_name)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_company_address`).val(company_address)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_name`).val(bank_number)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_account`).val(bank_account)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_swift_code`).val(bank_swift_code)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_code`).val(bank_code)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_country`).val(country)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_tax_number`).val(tax_number)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_commercial_number`).val(commercial_number)

            })
        } else {
            await shipper_list_set.add_bank()
        }
    },

    ajax_request_raw_data: async function (shipper_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/shipper-management/request_raw_data.php",
                data: { 'shipper_number': shipper_number },
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

                //let shipper_number = $('.inp-shipper_number').val()
                let arr_data = []
                let cname = $('.inp-cname').val()
                let address = $('.inp-address').val()
                let tax = $('.inp-tax_id').val()
                let email = $('.inp-email').val()
                let phone_number = $('.inp-phone_number').val()
                let fax = $('.inp-fax').val()
                let linkman = $('.inp-linkman').val()
                let linkman_tel = $('.inp-contact').val()
                let payment_term = $('.inp_payment_term_day').val()

                uset_arr_temp = {
                    shipper_id: this.shipper_number_global,
                    cname: cname,
                    address: address,
                    tax: tax,
                    email: email,
                    phone_number: phone_number,
                    fax: fax,
                    linkman: linkman,
                    linkman_tel: linkman_tel,
                    payment_term: payment_term,
                }

                let path = $('.card_bank_data > .card_cma')
                $.each(path,function(){
                    let id_number = $(this).attr('id_number')
                    let bank_abb = $(this).find('.inp_bank_abb').val();
                    let company_name = $(this).find('.inp_company_name').val();
                    let company_address = $(this).find('.inp_company_address').val();
                    let bank_name = $(this).find('.inp_bank_name').val();
                    let bank_account = $(this).find('.inp_bank_account').val();
                    let bank_swift_code = $(this).find('.inp_bank_swift_code').val();
                    let bank_code = $(this).find('.inp_bank_code').val();
                    let country = $(this).find('.inp_country').val();
                    let tax_number = $(this).find('.inp_tax_number').val();
                    let commercial_number = $(this).find('.inp_commercial_number').val();

                    let obj_data = {
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

                })
                let res_save_raw_data = await this.ajax_save_raw_data(uset_arr_temp,arr_data,shipper_list_set.del_list_data)

                // console.log(uset_arr_temp)
                // console.log(arr_data)
                // console.log(res_save_raw_data)
                if (res_save_raw_data['arr_suc']['st'] == '1') {
                    Swal.fire({
                        title: 'Saved!',
                        text: 'Your file has been saved.',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'CHL-shipper-management.php' + '?shipper_number=' + res_save_raw_data['last_id'];;
                        }
                    });
                }
            }
        })
    },

    ajax_save_raw_data: async function (uset_arr_temp,arr_data,del_list) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/shipper-management/save_raw_data_user.php",
                data: { 'uset_arr_temp': uset_arr_temp,
                        'arr_data':arr_data,
                        'del_list':del_list },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    add_bank: async function () {
        let html_data_add = `
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
                    <button class="btn btn-danger btn-sm" onclick="shipper_list_set.del_list(this)"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>
        `;
        $('.card_bank_data').append(html_data_add)
    },
    
    del_list : async function(e){
        let id_number = $(e).closest('.card_cma').attr('id_number')
        console.log(id_number)
        if(id_number != ''){
            await shipper_list_set.del_list_data.push(id_number)
        }
        $(e).closest('.card_cma').remove()
    }

};


