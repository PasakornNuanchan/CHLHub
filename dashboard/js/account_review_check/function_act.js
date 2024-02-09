const function_act = {

    save_function : async function(){
        let e_path = $('.table > tbody > tr')
        let arr_data = []
        let data_check_save = '';
        $.each(e_path,function(){
            let data_dis = $(this).find('.data_check').attr('disabled') ? '1' : '0';
            if(data_dis == '0'){
                let data_check = $(this).find('.data_check').prop("checked") ? '1' : '0';
                if(data_check == '1'){
                    let data_id = $(this).closest('tr').attr('id_number') ? $(this).closest('tr').attr('id_number') : '';
                    let bank_number = $(this).closest('tr').find('.sel_bank_number').val()
                    let payment = $(this).closest('tr').find('.inp_payment_term').val()
                    

                    if( payment == ''){
                        data_check_save = '1'
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'information payment term is unvaliable please re-check your data',
                        })
                    }else{
                        if(bank_number != '' || payment != ''){
                            if(data_id != ''){
                                let obj_data = {
                                    data_id : data_id,
                                    bank_number : bank_number,
                                    payment : payment,
                                }
                                arr_data.push(obj_data)
                            }
                        }
                    }
                }
            }  
        })
        // console.log(arr_data)

        if(data_check_save != '1'){
            let res_data = await this.ajax_save_data(arr_data)
            if(res_data == '1'){
                Swal.fire(
                    'Save it!',
                    'Your file has been save.',
                    'success'
                )
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data is problem pls. contact to tech team',
                })
            }
            
            await start.select_filter();
        }
        
    },

    ajax_save_data : async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_approve/save_data.php",
                data : {
                    arr_data : arr_data,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}