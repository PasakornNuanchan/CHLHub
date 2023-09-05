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

    change_department_job_detail : async function (){
        

        let data_department = $('.inp_select_department_job').val();

        $.each(ulsd['rjd'],function (i,v){
            if(v['department'] == data_department){
                $('.inp_job_detail').val(v['job_detail'])
                $('.inp_transport').val(v['transport'])
                $('.inp_report').val(v['reportcs'])
                $('.inp_customs').val(v['customs'])
                $('.inp_billing').val(v['billing'])
                $('.inp_withdraw').val(v['withdraw'])
            }
        })
    },

    save_permission_job : async function (){
        let department = $('.inp_select_department_job').val()
        let job_detail = $('.inp_job_detail').val();
        let transport = $('.inp_transport').val()
        let reportcs = $('.inp_report').val()
        let customs = $('.inp_customs').val() 
        let billing = $('.inp_billing').val()
        let withdraw = $('.inp_withdraw').val()
        
        let obj_save = {}
        let arr_save = []
        obj_save = {
            department : department,
            job_detail : job_detail,
            transport : transport,
            reportcs : reportcs,
            customs : customs,
            billing : billing,
            withdraw : withdraw
        }
        arr_save.push(obj_save)

        let res_data = await this.ajax_save_permission_job(arr_save)
        
        if(res_data == '1' ){
            Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })
        }


    },

    ajax_save_permission_job : async function (arr_save){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
            url: "php/permission/save_permission_job.php",
            data: {'arr_save' : arr_save},
            dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    change_department_cash : async function (){
        let data_department = $('.inp_select_department_cash').val();
        $.each(ulsd['rc'],function (i,v){
            if(v['department'] == data_department){
                $('.inp_payble').val(v['payble'])
                $('.inp_advance').val(v['advance'])
                $('.inp_petty_cash_request').val(v['pettycash'])
                $('.inp_reutn_petty_cash').val(v['returnpettycash'])
            }
        })
    },

    save_permission_cash : async function (){
        let inp_select_department_cash = $('.inp_select_department_cash').val()
        let inp_payble = $('.inp_payble').val()
        let inp_advance = $('.inp_advance').val();
        let inp_petty_cash_request = $('.inp_petty_cash_request').val()
        let inp_reutn_petty_cash = $('.inp_reutn_petty_cash').val()

        let obj_save = {}
        let arr_save = []
        obj_save = {
            inp_select_department_cash: inp_select_department_cash,
            inp_payble : inp_payble,
            inp_advance : inp_advance,
            inp_petty_cash_request : inp_petty_cash_request,
            inp_reutn_petty_cash : inp_reutn_petty_cash,
        }
        arr_save.push(obj_save)

        let res_data = await this.ajax_save_permission_cash(arr_save)
        
        if(res_data == '1' ){
            Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })
        }
    },

    ajax_save_permission_cash : async function (arr_save){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
            url: "php/permission/save_permission_cash.php",
            data: {'arr_save' : arr_save},
            dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    change_department : async function(i,v){

        await this.clear_check();


        let data_department = $('.sel_department').val()
        
        arr_inp = []
        arr_inp_temp = {}
       let request_data = await this.ajax_change_data(data_department)
        //console.log(request_data['srrdl'])
        $('.check_clear').attr('disabled',false)

        $.each(request_data['srrdl'],function(i,v){
            console.log(v)
            // if(v == '20'){
            //     $(`.inp_${v}`).prop('checked',true).attr('disabled',true)
            // }else{
                console.log($(`.inp_${v}`).prop('checked',true))
            // }
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


