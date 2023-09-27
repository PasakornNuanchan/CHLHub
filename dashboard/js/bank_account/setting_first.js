const setting_first = {
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
        let res_data = await this.ajax_first_set();
        
        
        if(res_data['get_bank_account'] != "0 results"){
            $('.table_data_account tbody').html('')
            let html_data = '';
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
                <tr class="text-center">
                    <td>${i}</td>
                    <td><input type="text" class="form-control form-control" value="${location}"></td>
                    <td><input type="text" class="form-control form-control" value="${country}"></td>
                    <td><input type="text" class="form-control form-control" value="${payment_menthod}"></td>
                    <td><input type="text" class="form-control form-control" value="${bank_code}"></td>
                    <td><input type="text" class="form-control form-control" value="${company_name}"></td>
                    <td><input type="text" class="form-control form-control" value="${bank_account}"></td>
                    <td><input type="text" class="form-control form-control" value="${currency}"></td>
                    <td><input type="text" class="form-control form-control" value="${bank_brunch}"></td>
                    <td><input type="text" class="form-control form-control" value="${bank_address}"></td>
                    <td><input type="text" class="form-control form-control" value="${swift_code}"></td>
                    <td><input type="text" class="form-control form-control" value="${bank_telephone}"></td>
                    <td><input type="text" class="form-control form-control" value="${commercial_number}"></td>
                    <td><input type="text" class="form-control form-control" value="${tax_number}"></td>
                    <td><input type="text" class="form-control form-control" value="${create_fn} ${create_ln}" disabled></td>
                    <td><input type="text" class="form-control form-control" value="${create_datetime}" disabled></td>
                    <td><input type="text" class="form-control form-control" value="${last_fn} ${last_ln}" disabled></td>
                    <td><input type="text" class="form-control form-control" value="${last_modify_datetime}" disabled></td>
                </tr>
                `;
                $('.table_data_account tbody').append(html_data)
            })
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