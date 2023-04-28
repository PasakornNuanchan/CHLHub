const job_support = {
    
    function_add_job : async function(){
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
                let res = await job_support.ajax_job_support()       
                
                Swal.fire(
                    'Create sucess!',
                    'Data has been create.',
                    'success'
                )
            }
        })

        
        
    },

    ajax_job_support : async function (){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_support/job_support.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
    
};


