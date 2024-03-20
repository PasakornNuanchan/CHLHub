const action = {
    save_data : async function (){
        let fname = $('.inp-fname').val()
        let lname = $('.inp-lname').val()
        let mphone = $('.inp-mphone').val()
        let email = $('.inp-email').val()
        let address = $('.inp-address').val()
        let bank_name = $('.inp-bank_name').val()
        let bank_number = $('.inp-bank_number').val()
        let old_pass_word = $('.inp-old_pass_word').val()
        let new_password = $('.inp-new_password').val()
        let cf_newpassword = $('.inp-cf_newpassword').val()


        let arr_data_save = []
        
        if(old_pass_word != '' && new_password != '' && cf_newpassword != '' ){
            let res_old_pass_word = await this.ajax_requrest_password(old_pass_word);
            if(res_old_pass_word == setup.slsdpsaad){
                if(new_password == cf_newpassword){
                    let obj = {
                        fname : fname,
                        lname : lname,
                        mphone : mphone,
                        email : email,
                        address : address,
                        bank_name : bank_name,
                        bank_number : bank_number,
                        old_pass_word : old_pass_word,
                        new_password : new_password,
                        cf_newpassword : cf_newpassword,
                    }
                    arr_data_save.push(obj)
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'New password and confirm new password is not same',
                    })
                    return;
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Old password is not same in system please try agian',
                })
                return;
            }
            
        }else{
            let obj = {
                fname : fname,
                lname : lname,
                mphone : mphone,
                email : email,
                address : address,
                bank_name : bank_name,
                bank_number : bank_number,
            }
            arr_data_save.push(obj)
        }
        // console.log(arr_data_save)
        let res_data_save = await this.ajax_save_data(arr_data_save)

        if(res_data_save == '1'){
            Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })

        }
    },

    ajax_requrest_password : async function (old_pass_word) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/my_user/generatepass.php",
                data: {old_pass_word:old_pass_word},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    ajax_save_data : async function (arr_data_save) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/my_user/save_data_user.php",
                data: {arr_data_save:arr_data_save},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
}