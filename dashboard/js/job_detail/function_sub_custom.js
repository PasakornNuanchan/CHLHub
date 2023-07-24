const function_sub_customs = {
    modal_ship: function (type_st,id) {
        let context_1 = '';
        let textbox_1 = '';
        if (type_st == "cf_up") {
            context_1 = "container upload successful ?";
            textbox_1 = "";
        } else if (type_st == "tb_up" || type_st == "tb_ar" || type_st == "tb_cy" || type_st == "tb_sa" || type_st == "tb_cc" || type_st == "tb_dr") {
            context_1 = "container troubleshoot ? plases enter your problem";
            textbox_1 = `<input type="input" class="form-control text-center inp_get_pro " placeholder="plese put your problem">`;
        } else if (type_st == "cf_ar") {
            context_1 = "container is arrived ?";
            textbox_1 = "";
        } else if (type_st == "cf_cy"){
            context_1 = "container return on area ?";
            textbox_1 = "";
        } else if (type_st == "cf_sa"){
            context_1 = "container arrived on area port ?";
            textbox_1 = "";
        }
        
        Swal.fire({
            title: `Are you sure ${context_1}`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            html: `${textbox_1}`,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let input_data = $('.inp_get_pro').val()
                
                let res_return = await this.ajax_set_status(type_st,input_data,id)
                
                    if (res_return == '1') {
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

                    var currentURL = window.location.href;
                    var url = new URL(currentURL);
                    var id_number = url.searchParams.get("job_number");    
                await sub_customs.first_post_data(id_number)
            }
        })
    },

    ajax_set_status : async function (type_st,input_data,id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/set_customs_status.php",
                data: {
                    type_st : type_st,
                    input_data : input_data,
                    id : id,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    checked_set_data_on_table : function (data_type,id_data){

        Swal.fire({
            title: `Are you sure cheked document ?`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            html: ``,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                //let input_data = $('.inp_get_pro').val()
                
                let res_return = await this.ajax_set_status_on_table(data_type,id_data)
                
                    if (res_return == '1') {
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

                    var currentURL = window.location.href;
                    var url = new URL(currentURL);
                    var id_number = url.searchParams.get("job_number");  

                await sub_customs.first_post_data(id_number)
            }
        })
    },

    ajax_set_status_on_table : async function (type_st,id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/set_customs_status_table.php",
                data: {
                    type_st : type_st,
                    id : id,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}