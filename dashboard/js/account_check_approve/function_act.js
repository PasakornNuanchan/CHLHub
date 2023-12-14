const function_act = {

    save_function : async function(){
        let data_radio_process = $('input[name="radio_process"]:checked').val();
        let data_radio_select_act = $('input[name="radio_select_act"]:checked').val();
        console.log(data_radio_select_act)
        let e_path = $('.table > tbody > tr')
        let arr_data = []
        $.each(e_path,function(){
            let data_check = '';

            if(data_radio_select_act == "check"){
                if(data_radio_process == "process"){
                    data_check = $(this).find('.data_check').prop("checked") ? '1' : '0';
                }else{
                    data_check = $(this).find('.data_check').prop("checked") ? '0' : '1';
                }
            }else{
                if(data_radio_process == "process"){
                    data_check = $(this).find('.data_check_apply').prop("checked") ? '1' : '0';
                }else{
                    data_check = $(this).find('.data_check_apply').prop("checked") ? '0' : '1';
                }
            }
            


            if(data_check == '1'){

                let data_id = $(this).closest('tr').attr('id_number')
                let obj_data = {
                    data_id : data_id
                }
                arr_data.push(obj_data)
            }
        })
        
        // console.log(data_radio_process)
        // console.log(data_radio_select_act)
        // console.log(arr_data)
        let res_data = await this.ajax_save_data(data_radio_process,arr_data,data_radio_select_act)

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
    },

    ajax_save_data : async function (data_radio_process,arr_data,data_radio_select_act) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_approve/save_data.php",
                data : {
                    data_radio_process : data_radio_process,
                    data_radio_select_act : data_radio_select_act,
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