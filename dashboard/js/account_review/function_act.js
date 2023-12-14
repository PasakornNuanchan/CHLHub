const function_act = {
    save_data : async function (){
        // console.log(start.res_data_table_main)
        let path_loop = $('.table > tbody > tr')
        let arr_data = []
        $.each(path_loop,function(i,v){
            let data_id_number = $(this).closest('tr').attr('id_number')
            let data_radio_select_type = $(`input[name="radio_act${data_id_number}"]:checked`).val();
            let obj_data ={}
            $.each(start.res_data_table_main['table'],function(i1,v1){
                if(v1['ID'] == data_id_number){
                    if(v1['status'] != data_radio_select_type){
                        obj_data = {
                            data_id_number :data_id_number,
                            data_radio_select_type : data_radio_select_type,
                            data_start : v1['status'],
                        }
                        arr_data.push(obj_data)
                    }
                }
            })
        })
        // console.log(arr_data)
        let res_data = await this.ajax_data_save(arr_data)

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

    ajax_data_save : async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_review/save_data.php",
                dataType: "json",
                data : {
                    arr_data : arr_data,
                },
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}