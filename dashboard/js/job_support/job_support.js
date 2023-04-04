const job_support = {
    
    function_add_job : async function(){
        console.log(1)
        let res = await job_support.ajax_job_support()
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


