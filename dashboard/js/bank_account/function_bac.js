const function_bac = {
    arr_data_delete : [],
    function_add: async function () {
        let html_data_bac = `
        <tr class="text-center">
            <td></td>
            <td><input type="text" class="form-control form-control inp_country_code" list="country_code_list"></td>
            <td><input type="text" class="form-control form-control inp_country" list="country_list"></td>
            <td><input type="text" class="form-control form-control inp_payment_method" list="payment_method_list"></td>
            <td><input type="text" class="form-control form-control inp_bank_code"></td>
            <td><input type="text" class="form-control form-control inp_company" list="company_list"></td>
            <td><input type="text" class="form-control form-control inp_bank_account"></td>
            <td><input type="text" class="form-control form-control inp_currency" list="currency_list"></td>
            <td><input type="text" class="form-control form-control inp_bank_brunch"></td>
            <td><input type="text" class="form-control form-control inp_bank_address"></td>
            <td><input type="text" class="form-control form-control inp_swift_code"></td>
            <td><input type="text" class="form-control form-control inp_bank_telephone"></td>
            <td><input type="text" class="form-control form-control inp_commercial_number"></td>
            <td><input type="text" class="form-control form-control inp_tax_number"></td>
            <td><input type="text" class="form-control form-control inp_create_by" disabled></td>
            <td><input type="text" class="form-control form-control inp_create_datetime" disabled></td>
            <td><input type="text" class="form-control form-control inp_last_update_by" disabled></td>
            <td><input type="text" class="form-control form-control inp_last_update_datetime" disabled></td>
            <td><button class="btn btn-danger btn-sm" onclick="function_bac.delete_list(this)"><i class="bi bi-trash"></i> Del</button></td>
        </tr>
        `;

        $('.table_data_account tbody').prepend(html_data_bac)

    },

    delete_list : async function(e){
        let id_number = $(e).closest('tr').attr('id_number')


        Swal.fire({
            title: `Are you sure delete list`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                if(id_number != ''){
                    let obj = {
                        id_number : id_number
                    }    
                    this.arr_data_delete.push(obj)
                    let res_data = await this.ajax_sent_delete(this.arr_data_delete)
                    if(res_data['arr_res_del'] == '1'){
                        Swal.fire(
                            'saved!',
                            'Your file has been saved.',
                            'success'
                        )
            
                    } else {
                        Swal.fire(
                            'Error!',
                            'Your file has not been saved.',
                            'error'
            
                        )
                    }
                }
                $(e).closest('tr').remove();
            }
        })



        
    },

    ajax_sent_delete : async function (arr_data_delete) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/bank_account/delete_data_acp.php",
                data: { arr_data_delete: arr_data_delete},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    raw_data_save: async function () {
        let arr_data = []
        $('.table_data_account tbody tr').each(function () {

            let id_number = $(this).attr('id_number')
            let country_code = $('.inp_country_code', this).val()
            let country = $('.inp_country', this).val()
            let payment_method = $('.inp_payment_method', this).val()
            let bank_code = $('.inp_bank_code', this).val()
            let company = $('.inp_company', this).val()
            let bank_account = $('.inp_bank_account', this).val()
            let currency = $('.inp_currency', this).val()
            let bank_brunch = $('.inp_bank_brunch', this).val()
            let bank_address = $('.inp_bank_address', this).val()
            let swift_code = $('.inp_swift_code', this).val()
            let bank_telephone = $('.inp_bank_telephone', this).val()
            let commercial_number = $('.inp_commercial_number', this).val()
            let tax_number = $('.inp_tax_number', this).val()

            country_code = country_code ? country_code : null;
            country = country ? country : null;
            payment_method = payment_method ? payment_method : null;
            bank_code = bank_code ? bank_code : null;
            company = company ? company : null;
            bank_account = bank_account ? bank_account : null;
            currency = currency ? currency : null;
            bank_brunch = bank_brunch ? bank_brunch : null;
            bank_address = bank_address ? bank_address : null;
            swift_code = swift_code ? swift_code : null;
            bank_telephone = bank_telephone ? bank_telephone : null;
            commercial_number = commercial_number ? commercial_number : null;
            tax_number = tax_number ? tax_number : null;

            if (id_number == undefined) {
                let obj = {
                    id_number: id_number,
                    country_code: country_code,
                    country: country,
                    payment_method: payment_method,
                    bank_code: bank_code,
                    company: company,
                    bank_account: bank_account,
                    currency: currency,
                    bank_brunch: bank_brunch,
                    bank_address: bank_address,
                    swift_code: swift_code,
                    bank_telephone: bank_telephone,
                    commercial_number: commercial_number,
                    tax_number: tax_number,
                }
                arr_data.push(obj)
            } else {

                let data_finded = $.grep(setting_first.get_res_data_check, function (obj) {
                    return obj.ID === id_number;
                })


                if (data_finded[0]['location'] == country_code &&
                    data_finded[0]['country'] == country &&
                    data_finded[0]['payment_menthod'] == payment_method &&
                    data_finded[0]['bank_code'] == bank_code &&
                    data_finded[0]['company_name'] == company &&
                    data_finded[0]['bank_account'] == bank_account &&
                    data_finded[0]['currency'] == currency &&
                    data_finded[0]['bank_brunch'] == bank_brunch &&
                    data_finded[0]['bank_address'] == bank_address &&
                    data_finded[0]['swift_code'] == swift_code &&
                    data_finded[0]['bank_telephone'] == bank_telephone &&
                    data_finded[0]['commercial_number'] == commercial_number &&
                    data_finded[0]['tax_number'] == tax_number) {

                } else {
                    let obj = {
                        id_number: id_number,
                        country_code: country_code,
                        country: country,
                        payment_method: payment_method,
                        bank_code: bank_code,
                        company: company,
                        bank_account: bank_account,
                        currency: currency,
                        bank_brunch: bank_brunch,
                        bank_address: bank_address,
                        swift_code: swift_code,
                        bank_telephone: bank_telephone,
                        commercial_number: commercial_number,
                        tax_number: tax_number,
                    }
                    arr_data.push(obj)
                }
            }
        })
        
        let res_data = await this.ajax_sent_save(arr_data)
        if(res_data['arr_res'] == '1'){
            Swal.fire(
                'saved!',
                'Your file has been saved.',
                'success'
            )

        } else {
            Swal.fire(
                'Error!',
                'Your file has not been saved.',
                'error'

            )
        }


        await setting_first.setting_data();
    },

    ajax_sent_save: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/bank_account/save_data_acp.php",
                data: { arr_data: arr_data},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

}