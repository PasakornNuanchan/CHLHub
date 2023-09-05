const function_account_check = {
    status_change : async function (e){
        let id_row = $(e).closest('tr').attr('data_row')
        let status_data = $(e).attr('status_data')
        let id_find = $(e).attr('id_find');
        // let paid_amt = $(e).closest('tr').val('.inp_paid_amt');
        let paid_amt = $(e).closest('tr').find('.inp_paid_amt').val()
        let currecny = $(e).closest('tr').find('.inp_currency').val()
        let amt_incv = $(e).closest('tr').find('.inp_amt_incv').val()

        let res_total = paid_amt == amt_incv ? "Match" : "Don't Match "


        Swal.fire({
            title: 'Are you sure?',
            text: `Paid Amount : ${paid_amt} ${currecny} ${res_total}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let res_data = this.ajax_save_status_change(id_row,status_data)




                Swal.fire(
                    'Save it!',
                    'data has save it',
                    'success'
                )
            }else{
                $.each(setting_data.data_in_table,function(i,v){                    
                    if(v['ID'] == id_row){
                        let data_stauts = v['status'];
                        $(`#${id_find}_${data_stauts}`).prop('checked',true)
                    }
                })
                
            }
        })
    },

    ajax_save_status_change : async function (id_row,status_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check/setting_data_first.php",
                data: {
                    id_row: id_row,
                    status_data: status_data,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}