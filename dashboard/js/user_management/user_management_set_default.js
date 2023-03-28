const user_list_set_default = {

    set_data_default : async function (){
        let ulsd =  await user_list_set_default.ajax_request_data_default()
        
        let sel_data_department = '';
        $.each(ulsd['srd'], function (i, k) {
            sel_data_department += `
            <option value="${k['ID']}">${k['department_name']}</option>
            `;
        });
        $('.sel_department').append(sel_data_department)
    },
  
    ajax_request_data_default : function (){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/user-management/request_data_default.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
    
  
};


