const billing_all = {
    push_check: async function (action_id,val) {
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
                let res = await billing_all.ajax_push_check_action(action_id);
                console.log(res);
                
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                if(val == 'tp'){
                    billing_ap.set_preview_data_ap(billing.job_number_global);
                }else if(val == 'tr'){
                    billing.set_preview_data_ar(billing.job_number_global);
                }
                
            }
        })
    },
    ajax_push_check_action : function (action_id) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/push_check_action.php",
                data: {'action_id' : action_id},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}