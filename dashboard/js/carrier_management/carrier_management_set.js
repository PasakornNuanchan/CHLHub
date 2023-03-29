const carrier_list_set = {
    carrier_number_global : '',
    check_get: async function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        let get_carrier_number = getUrlParameter('carrier_number');

        let carrier_number = get_carrier_number == false ? null : get_carrier_number;

        this.carrier_number_global = carrier_number;

        if(get_carrier_number != undefined){
        await this.set_head_page();
        await this.set_raw_data(carrier_number);
        }else{

        }
    },

    set_head_page : async function () {
    
        $('.head-of-menu').html('Carrier');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-carrier_list.php" target="" style="color:white;">Carrier main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

    set_raw_data : async function (carrier_number){
        let rrd = await carrier_list_set.ajax_request_raw_data(carrier_number)

        //$('.inp-carrier_number').val(rrd['sqrc']['carrier_number'])
        $('.inp-cname').val(rrd['sqrc']['carrier_name'])
        $('.inp-csname').val(rrd['sqrc']['carrier_sub_name'])
        $('.inp-email').val(rrd['sqrc']['email'])
        $('.inp-phone_number').val(rrd['sqrc']['phone_number'])
        $('.inp-contact').val(rrd['sqrc']['contact_name'])
        

    },

    ajax_request_raw_data : async function(carrier_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/carrier-management/request_raw_data.php",
                data: {'carrier_number' : carrier_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    fn_save_raw : async function (){
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
                
                //let carrier_number = $('.inp-carrier_number').val()
                let corp_name = $('.inp-cname').val()
                let corp_sub_name = $('.inp-csname').val()
                let corp_em = $('.inp-email').val()
                let phone_number = $('.inp-phone_number').val()
                let contact = $('.inp-contact').val()

                let check_val = 0;

                if(corp_name == "" || corp_sub_name == "" || corp_em == "" || phone_number == "" || contact == "" ){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Detail data is missing plese check your data !',
                    })
                    check_val = 1;
                }

                if(check_val == 0){
                   uset_arr_temp = {
                    carrier_id : this.carrier_number_global,
                    corp_name : corp_name,
                    corp_sub_name : corp_sub_name,
                    corp_em : corp_em,
                    phone_number : phone_number,
                    contact : contact,
                    
                   }

                    let res_save_raw_data  = await this.ajax_save_raw_data(uset_arr_temp)
                    console.log(res_save_raw_data)
                    if(res_save_raw_data['st'] == '1'){
                        Swal.fire(
                            'saved!',
                            'Your file has been saved.',
                            'success'
                        )
                    }else if(res_save_raw_data['st'] == '0'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Save is false plese contact to support tech team',
                        })
                    }
                }
            }
        })
    },

    ajax_save_raw_data : async function (uset_arr_temp){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/carrier-management/save_raw_data_user.php",
                data: {'uset_arr_temp' : uset_arr_temp},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
    
};


