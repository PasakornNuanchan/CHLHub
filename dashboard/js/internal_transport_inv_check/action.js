const action = {
    save_data_internal: async function () {
        let job_number_add = $('.sel_job_number_add').val()
        let description_add = $('.sel_description_add').val()
        let bill_to_add = $('.sel_bill_to_add').val()
        let qty_add = $('.inp_qty_add').val()
        let unit_price_add = $('.inp_unit_price_add').val()
        let vat_add = $('.inp_vat_add').val()
        let total_add = $('.inp_total_add').val()
        let remark_add = $('.inp_remark_add').val()
        let base_64_file = $('.inp_file_add').prop('files')[0];
        let currency = $('.sel_currency').val()

        let obj_data = {}
        let type_data = '';
        let name_file = '';
        let Base_64_file_base = '';
        if(base_64_file != undefined){
            type_data = base_64_file.type ? base_64_file.type : '';
            name_file = base_64_file.name ? base_64_file.name : '';
            Base_64_file_base = await convert_file(base_64_file);
        }
        
        if(
            job_number_add == '' ||
            description_add == '' ||
            bill_to_add == '' ||
            qty_add == '' ||
            unit_price_add == '' ||
            vat_add == '' ||
            total_add == '' ||
            remark_add == '' ||
            currency == '' ||
            base_64_file == undefined
        ){
            
        }else{
            data = {
                job_number_add : job_number_add,
                description_add : description_add,
                bill_to_add : bill_to_add,
                qty_add : qty_add,
                unit_price_add : unit_price_add,
                vat_add : vat_add,
                total_add : total_add,
                remark_add : remark_add,
                currency : currency,
                type_data : type_data,
                name_file : name_file,
                Base_64_file_base : Base_64_file_base,
            }
        }
        console.log(obj_data)
        let res_data = await this.ajax_save_data(data)
        if(res_data = '1'){
            $('.sel_job_number_add').val('')
            $('.sel_description_add').val('')
            $('.sel_bill_to_add').val('')
            $('.inp_qty_add').val('')
            $('.inp_unit_price_add').val('')
            $('.inp_vat_add').val('')
            $('.inp_total_add').val('')
            $('.inp_remark_add').val('')
            $('.inp_file_add').val('')
            $('.sel_currency').val('')
            $('.inp_sub_total_add').val('')
            $('.inp_vat_ex_add').val('')
            $('.card-preview').html('')

            await setup.setting_first();
        }
    },

    ajax_save_data : async function (obj_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv/save_data_internal_transport.php",
                data: data,
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    save_data_checked : async function(){
        let path = $('.table_expen tbody tr')
        let arr_data_save = []
        $.each(path,function(){
            let data_disabled_check = $(this).find('.input_check_data').attr('disabled') ? '1' : '0';
            if(data_disabled_check){
                let data_checked_check = $(this).find('.input_check_data').prop('checked') ? '1' : '0';
                if(data_checked_check == '1'){
                    let id_number = $(this).attr('id_number')
                    arr_data_save.push(id_number)
                }
            }
        })

        let res_data = await this.ajax_save_data_checked(arr_data_save)
    },

    ajax_save_data_checked : async function (arr_data_save) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv_check/save_data_check.php",
                data: arr_data_save,
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}

async function convert_file(data) {

    const base64String = await toBase64(data);
    return (base64String);
}

function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

