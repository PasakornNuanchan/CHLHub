const suptransport_list_set = {
    suptransport_number_global: '',
    arr_del_list: [],
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
        let get_suptransport_number = getUrlParameter('suptransport_number');

        let suptransport_number = get_suptransport_number == false ? null : get_suptransport_number;

        this.suptransport_number_global = suptransport_number;

        if (get_suptransport_number != 'undefined') {
            await this.set_head_page();
            await this.set_raw_data(suptransport_number);
        } else {
            await this.set_head_page();
        }
    },

    set_head_page: async function () {

        $('.head-of-menu').html('Supplier Transport');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-suptransport_list.php" target="" style="color:white;">Supplier transport main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    },

    set_raw_data: async function (suptransport_number) {
        $('.card_bank_data').html('')
        let rrd = await suptransport_list_set.ajax_request_raw_data(suptransport_number)

        //$('.inp-suptransport_number').val(rrd['sqrc']['suptransport_number'])
        let payment_term = rrd['sqrc']['payment_term'] ? rrd['sqrc']['payment_term'] : '';
        let transport_sup_name = rrd['sqrc']['transport_sup_name'] ? rrd['sqrc']['transport_sup_name'] : '';
        let address = rrd['sqrc']['address'] ? rrd['sqrc']['address'] : '';
        let tax = rrd['sqrc']['tax'] ? rrd['sqrc']['tax'] : '';
        let email = rrd['sqrc']['email'] ? rrd['sqrc']['email'] : '';
        let tel = rrd['sqrc']['tel'] ? rrd['sqrc']['tel'] : '';
        let line = rrd['sqrc']['line'] ? rrd['sqrc']['line'] : '';
        let fax = rrd['sqrc']['fax'] ? rrd['sqrc']['fax'] : '';
        let linkman = rrd['sqrc']['linkman'] ? rrd['sqrc']['linkman'] : '';
        let linkman_tel = rrd['sqrc']['linkman_tel'] ? rrd['sqrc']['linkman_tel'] : '';
        $('.inp-cname').val(transport_sup_name)
        $('.inp-address').val(address)
        $('.inp-tax_id').val(tax)
        $('.inp-email').val(email)
        $('.inp-phone_number').val(tel)
        $('.inp-line').val(line)
        $('.inp-fax').val(fax)
        $('.inp-linkman').val(linkman)
        $('.inp-contact').val(linkman_tel)
        $('.inp_payment_term_day').val(payment_term)

        if (rrd['bank'] != '') {
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
                let tax = v['tax'] ? v['tax'] : '';
                let commercial_number = v['commercial_number'] ? v['commercial_number'] : '';
                let html_data = `
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
                            <button class="btn btn-sm btn-danger" onclick="suptransport_list_set.delete_user_shipper(this)"><i class="bi bi-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>
                `;
                $('.card_bank_data').append(html_data)


                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_abb`).val(bank_abb)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_company_name`).val(company_name)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_company_address`).val(company_address)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_name`).val(bank_number)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_account`).val(bank_account)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_swift_code`).val(bank_swift_code)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_bank_code`).val(bank_code)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_country`).val(country)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_tax_number`).val(tax)
                $(`.card_cmb${id_number} > .card-body > .form-group > .row > .col-9 > .inp_commercial_number`).val(commercial_number)

            })
        } else {
            await suptransport_list_set.add_bank()
        }

    },

    ajax_request_raw_data: async function (suptransport_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/suptransport-management/request_raw_data.php",
                data: { 'suptransport_number': suptransport_number },
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

                let arr_data_save = []
                let cname = $('.inp-cname').val()
                let address = $('.inp-address').val()
                let tax = $('.inp-tax_id').val()
                let email = $('.inp-email').val()
                let phone_number = $('.inp-phone_number').val()
                let line = $('.inp-line').val()
                let fax = $('.inp-fax').val()
                let linkman = $('.inp-linkman').val()
                let linkman_tel = $('.inp-contact').val()
                let payment_term = $('.inp_payment_term_day').val()

                uset_arr_temp = {
                    suptransport_id: this.suptransport_number_global,
                    cname: cname,
                    address: address,
                    tax: tax,
                    email: email,
                    phone_number: phone_number,
                    line: line,
                    fax: fax,
                    linkman: linkman,
                    linkman_tel: linkman_tel,
                    payment_term : payment_term,
                }

                let path = $(`.card_bank_data > .card_cma`)
                $.each(path,function(){
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

                    let obj_number = {
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
                    arr_data_save.push(obj_number)
                })
                // console.log(uset_arr_temp)
                // console.log(arr_data_save)
                // console.log(suptransport_list_set.arr_del_list)

                let res_save_raw_data = await this.ajax_save_raw_data(uset_arr_temp,arr_data_save,suptransport_list_set.arr_del_list)
                // console.log(res_save_raw_data)
                let data_last_id = res_save_raw_data['last_id'];

                if (res_save_raw_data['arr_suc']['st'] == '1') {
                    Swal.fire({
                        title: 'Saved!',
                        text: 'Your file has been saved.',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'CHL-suptransport-management.php' + '?suptransport_number=' + data_last_id
                        }
                    });



                }
            }
        })
    },

    ajax_save_raw_data: async function (uset_arr_temp,arr_data_save,del_list) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/suptransport-management/save_raw_data_user.php",
                data: { 'uset_arr_temp': uset_arr_temp,
                        'arr_data_save' : arr_data_save,
                        'del_list' : del_list },
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
                    <button class="btn btn-sm btn-danger" onclick="suptransport_list_set.delete_user_shipper(this)"><i class="bi bi-trash"></i> Delete</button>
                </div>
            </div>
        </div>
        `;

        $('.card_bank_data').append(html_data_add)
    },

    delete_user_shipper: async function (e) {
        let id_number = $(e).closest('.card_cma').attr('id_number')
        if (id_number != '') {
            suptransport_list_set.arr_del_list.push(id_number)
        }
        $(e).closest('.card_cma').remove()
    }
};


