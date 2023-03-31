const permission_set = {
    
    
    run : async function(){
        await this.set_head_page();
        await permission_default.set_data_default();
    },

    set_head_page : async function () {
    
        $('.head-of-menu').html('Permission');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-Permission.php" target="" style="color:white;">Permission main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

    

    change_department : async function(i,v){

        await this.clear_check();


        let data_department = $('.sel_department').val()
        //console.log(data_department)
        arr_inp = []
        arr_inp_temp = {}
       let request_data = await this.ajax_change_data(data_department)
        console.log(request_data)
        $('.check_clear').attr('disabled',false)
        $.each(request_data['srrdl'],function(i,v){
            if(v == '20'){
                $(`.inp_${v}`).prop('checked',true).attr('disabled',true)
            }else{
                $(`.inp_${v}`).prop('checked',true)
            }
        })

    },

    clear_check : async function(){
        
        $('.add_menu_select').find('.check_clear').prop('checked',false)
    },

    ajax_change_data : async function (data_department){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
            url: "php/permission/change_department.php",
            data: {'data_department' : data_department},
            dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    save_per : async function(){
        save_check = $(`.save_check`)
        let arr_save_temp = {}
        let arr_save = []

       
        
        let department = $('.sel_department').val()
        if(department == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'plese select department',
            })
        }else{
            $.each(save_check,function (i,v){
                let ninp = $(this).attr('ninp')
                let save_check = $(`.inp_${ninp}`).is(":checked") ? 1 : 0
                arr_save_temp = {
                    id_menu : ninp,
                    save_check : save_check
                }
                arr_save.push(arr_save_temp)
            })
        }

        let res_save = await this.ajax_save_raw_data_permis(arr_save,department)
        if(res_save['st'] == '1'){
            Swal.fire(
                'saved!',
                'Your file has been saved.',
                'success'
            )
        }else if(res_save['st'] == '0'){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Save is false plese contact to support tech team',
            })
        }
    },

    ajax_save_raw_data_permis : async function (arr_save,department){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
            url: "php/permission/save_raw_data_permis.php",
            data: {'arr_save' : arr_save,
            'department' : department},
            dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    
    
};


