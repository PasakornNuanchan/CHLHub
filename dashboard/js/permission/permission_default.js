const permission_default = {

    set_data_default : async function (){
        ulsd =  await this.ajax_request_data_default()
        
        let sel_data_department = '';
        $.each(ulsd['srd'], function (i, k) {
            sel_data_department += `
            <option value="${k['ID']}">${k['department_name']}</option>
            `;
        });
        $('.sel_department').append(sel_data_department)


        let menu_data = '';
        $.each(ulsd['menu_select'],function(i,v){
            menu_data += `
            <div class="row">
                <div class="col-sm-3 col-lg-3"></div>
                <div class="col-sm-9 col-lg-9">
                <div class="form-group row">
                    <div class="col-sm-1 col-md-1 col-lg-1">
                        <input type="checkbox" class="form-check-input type_page="main" check_clear save_check inp_${v['ID']}" ninp=${v['ID']}>    
                    </div>
                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">${v['menu_name']}</label>
                </div>
                </div>
            </div>
            `;
        })
        $('.add_menu_select').append(menu_data)

        $('.check_clear').attr('disabled',true)

    },
  
    ajax_request_data_default : function (){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/permission/request_data_default.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
    
  
};


