const petty_cash_set_sel_job = {
    
    
    set_job : async function (data) { 
        let res = await petty_cash_set_sel_job.ajax_set_job();
        console.log(res)
        let html = '';
        $.each(res, function (i, k) { 
            html += `
            <option value="${k['ID']}">${k['job_number']} / ${k['consignee_name']} </option>
            `;  
        });
        $('.sel-description').append(html);
        
    },


    ajax_set_job : function () { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash/get_pettycash.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    




  
};
