const function_sub_withdraw = {

    select_type_wd : async function(){
        let inp_type_wd = $('.inp_type_wd').val();
        if(inp_type_wd == "Payble"){
            $('.fg_pic').attr('hidden',false)
        }else if(inp_type_wd == "Advancecash"){
            $('.fg_pic').attr('hidden',false)
        }
        
        
    },

    get_data_save : async function (){

        let petty_cash_amt = $('.inp_petty_cash').val()
        let petty_cash_amt_cur = $('.inp_petty_cash_cur').val()
        let type_data_petty_cash_checl = $('.inp_type_wd').find('option:selected').attr('type_data_pt')
        
        
        let data_amt_wd = $('.inp_amount_wd').val()
        let data_cur_wd = $('.inp_currency_wd').val()
        let data_pca = parseFloat(petty_cash_amt);
        let data_aw = parseFloat(data_amt_wd);

        if(type_data_petty_cash_checl == 'pt'){
            if(data_pca > data_aw && petty_cash_amt_cur === data_cur_wd){
                let data_type_wd = $('.inp_type_wd').val()
                let data_pay_wd = $('.inp_pay_to_wd').val()
                let data_des_wd = $('.inp_description_wd').val()
                let data_rem_wd = $('.inp_remark_wd').val()
                let data_type_pt = 'Pettycash';
                let base_64_file = $('.inp_picfile').prop('files')[0];
                
                let file_con ='';
                if(base_64_file != undefined){
                    file_con = await convert_file(base_64_file);
                }

                if(data_pay_wd != '' && data_des_wd !=''){
                    let data_sent = {}
                    let arr_sent = []

                    var currentURL = window.location.href;
                    var url = new URL(currentURL);
                    var id_number = url.searchParams.get("job_number");

                    data_sent = {
                        data_type_pt : data_type_pt,
                        data_type_wd: data_type_wd,
                        data_pay_wd: data_pay_wd,
                        data_des_wd: data_des_wd,
                        data_amt_wd: data_amt_wd,
                        data_cur_wd: data_cur_wd,
                        data_rem_wd: data_rem_wd,
                        id_number: id_number,
                        picture: file_con,
                    }


                    arr_sent.push(data_sent)
                    let res_data = await this.ajax_save_data(arr_sent)
                    if (res_data == '1') {
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
                    await sub_withdraw.first_post_data(id_number);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data missing plese enter your data ',
                    })
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Petty cash out of balance or currency not match',
                })
                return false;
            }
        }else{
            let data_type_wd = $('.inp_type_wd').val()
            let data_pay_wd = $('.inp_pay_to_wd').val()
            let data_des_wd = $('.inp_description_wd').val()
            let data_rem_wd = $('.inp_remark_wd').val()

            let base_64_file = $('.inp_picfile').prop('files')[0];
            let file_conn = '';

            if(base_64_file != undefined){
                file_conn = await convert_file(base_64_file);
            }

            if(data_pay_wd != '' && data_des_wd !=''){
                let data_sent = {}
                let arr_sent = []

                var currentURL = window.location.href;
                var url = new URL(currentURL);
                var id_number = url.searchParams.get("job_number");

                data_sent = {
                    data_type_wd: data_type_wd,
                    data_pay_wd: data_pay_wd,
                    data_des_wd: data_des_wd,
                    data_amt_wd: data_amt_wd,
                    data_cur_wd: data_cur_wd,
                    data_rem_wd: data_rem_wd,
                    id_number: id_number,
                    picture: file_conn,
                }
                
                arr_sent.push(data_sent)

                let res_data = await this.ajax_save_data(arr_sent)
                if (res_data == '1') {
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
                await sub_withdraw.first_post_data(id_number);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data missing plese enter your data ',
                })
            }
        }
        
    },

    ajax_save_data : async function (arr_sent) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/save_data_withdraw.php",
                data: {arr_sent : arr_sent},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    open_pic : async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/open_pic_withdraw.php",
                data: {data : data},
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

    delete_list_wd : async function (data){
        Swal.fire({
            title: `Are you sure delete list`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                    let res_data_result = await this.ajax_delete_list_wd(data)
                if (res_data_result['arr_res'] == '1') {
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
                await sub_withdraw.first_post_data(id_number);
            }
        })
    },
    ajax_delete_list_wd : async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/delete_list_withdraw.php",
                data: {
                    data: data,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

   
}

async function convert_file(data) {

    const base64String = await toBase64(data);
    return (base64String);
}

function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}