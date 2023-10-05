const setting_first = {

    get_res_data_check : [],

    first_set : async function(){
        $('.head-of-menu').html('Bank Account');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="bank_account.php" target="" style="color:white;">Bank account</a></li>
        `;
        $('.bcpage').append(html_bdpage);
        await this.setting_data();
    },


    setting_data : async function(){
        $('.table_data_account tbody').html('')

        let res_data = await this.ajax_first_set();
        this.get_res_data_check = res_data['get_bank_account']
        if(res_data['get_bank_account'] != "0 results"){
            $('.table_data_account tbody').html('')
            let html_data = '';
            let arr_country_code = []
            let arr_country = []
            let arr_currency = []
            let arr_payment = []
            let arr_company = []
            $.each(res_data['get_bank_account'],function(i,v){
                i++;   
                let id_number = v['ID'] ? v['ID'] : '';
                let location = v['location'] ? v['location'] : '';
                let country = v['country'] ? v['country'] : '';
                let payment_menthod = v['payment_menthod'] ? v['payment_menthod'] : '';
                let bank_code = v['bank_code'] ? v['bank_code'] : '';
                let company_name = v['company_name'] ? v['company_name'] : '';
                let bank_account = v['bank_account'] ? v['bank_account'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let bank_brunch = v['bank_brunch'] ? v['bank_brunch'] : '';
                let bank_address = v['bank_address'] ? v['bank_address'] : '';
                let swift_code = v['swift_code'] ? v['swift_code'] : '';
                let bank_telephone = v['bank_telephone'] ? v['bank_telephone'] : '';
                let commercial_number = v['commercial_number'] ? v['commercial_number'] : '';
                let tax_number = v['tax_number'] ? v['tax_number'] : '';
                let create_by = v['create_by'] ? v['create_by'] : '';
                let create_datetime = v['create_datetime'] ? v['create_datetime'] : '';
                let last_modify_by = v['last_modify_by'] ? v['last_modify_by'] : '';
                let last_modify_datetime = v['last_modify_datetime'] ? v['last_modify_datetime'] : '';

                let create_fn = v['create_fn'] ? v['create_fn'] : '';
                let create_ln = v['create_ln'] ? v['create_ln'] : '';
                let last_fn = v['last_fn'] ? v['last_fn'] : '';
                let last_ln = v['last_ln'] ? v['last_ln'] : '';


                html_data = `
                <tr class="text-center" id_number="${id_number}">
                    <td>${i}</td>
                    <td><input type="text" class="form-control form-control-sm inp_country_code" list="country_code_list" value="${location}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_country" list="country_list" value="${country}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_payment_method" list="payment_method_list" value="${payment_menthod}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_bank_code" value="${bank_code}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_company" list="company_list" value="${company_name}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_bank_account" value="${bank_account}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_currency" list="currency_list" value="${currency}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_bank_brunch" value="${bank_brunch}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_bank_address" value="${bank_address}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_swift_code" value="${swift_code}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_bank_telephone" value="${bank_telephone}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_commercial_number" value="${commercial_number}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_tax_number" value="${tax_number}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_create_by" value="${create_fn} ${create_ln}" disabled></td>
                    <td><input type="text" class="form-control form-control-sm inp_create_datetime" value="${create_datetime}" disabled></td>
                    <td><input type="text" class="form-control form-control-sm inp_last_update_by" value="${last_fn} ${last_ln}" disabled></td>
                    <td><input type="text" class="form-control form-control-sm inp_last_update_datetime" value="${last_modify_datetime}" disabled></td>
                    <td><button class="btn btn-danger btn-sm" onclick="function_bac.delete_list(this)"><i class="bi bi-trash"></i> Del</button></td>
                </tr>
                `;
                $('.table_data_account tbody').append(html_data)

                payment_method_list

                arr_country_code.push(location)
                arr_country.push(country)
                arr_currency.push(currency)
                arr_payment.push(payment_menthod)
                arr_company.push(company_name)
            })
            //console.log(arr_country_code)
            var c_arr_country_code_code = removeDuplicates(arr_country_code);
            var c_arr_country_code = removeDuplicates(arr_country);
            var c_arr_currency_code = removeDuplicates(arr_currency);
            var c_arr_payment_code = removeDuplicates(arr_payment);
            var c_arr_company_code = removeDuplicates(arr_company)

            let html_data_country_code_code = '';
            let html_data_country_code = '';
            let html_data_currency_code = '';
            let html_data_payment_code = '';
            let html_data_company_code = '';

            $.each(c_arr_country_code_code,function(i,v){
                html_data_country_code_code += `<option>${v}</option>`;
            })
            $.each(c_arr_country_code,function(i,v){
                html_data_country_code += `<option>${v}</option>`;
            })
            $.each(c_arr_currency_code,function(i,v){
                html_data_currency_code += `<option>${v}</option>`;
            })
            $.each(c_arr_payment_code,function(i,v){
                html_data_payment_code += `<option>${v}</option>`;
            })
            $.each(c_arr_company_code,function(i,v){
                html_data_company_code += `<option>${v}</option>`;
            })

            //console.log(html_data_country_code_code)
            $('.country_code_list_option').append(html_data_country_code_code)
            $('.country_list_option').append(html_data_country_code)
            $('.currency_list_option').append(html_data_currency_code)
            $('.payment_method_list_option').append(html_data_payment_code)
            $('.company_list_option').append(html_data_company_code)
            

        }

        
        
    },



    ajax_first_set: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/bank_account/get_bank_account.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}

function removeDuplicates(array) {
    return $.grep(array, function(el, index) {
      return index === $.inArray(el, array);
    });
  }