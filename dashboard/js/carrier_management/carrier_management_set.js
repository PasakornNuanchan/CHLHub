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

        if(get_carrier_number != 'undefined'){
            await this.set_head_page();
            await this.set_raw_data(carrier_number);
            $('.inp-cname').attr('disabled',true)
        }else{
            $('.inp-cname').attr('disabled',false)

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

        let carrier_name = rrd['sqrc']['carrier_name'] ? rrd['sqrc']['carrier_name'] : '';
        let carrier_sub_name = rrd['sqrc']['carrier_sub_name'] ? rrd['sqrc']['carrier_sub_name'] : '';
        let email = rrd['sqrc']['email'] ? rrd['sqrc']['email'] : '';
        let phone_number = rrd['sqrc']['phone_number'] ? rrd['sqrc']['phone_number'] : '';
        let contact_name = rrd['sqrc']['contact_name'] ? rrd['sqrc']['contact_name'] : '';

        $('.inp-cname').val(carrier_name)
        $('.inp-csname').val(carrier_sub_name)
        $('.inp-email').val(email)
        $('.inp-phone_number').val(phone_number)
        $('.inp-contact').val(contact_name)
        

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

                


                let data_number = this.carrier_number_global == "undefined" ? '' : this.carrier_number_global;
                uset_arr_temp = {
                    carrier_id: data_number,
                    corp_name: corp_name,
                    corp_sub_name: corp_sub_name,
                    corp_em: corp_em,
                    phone_number: phone_number,
                    contact: contact,
                }

                let res_save_raw_data = await this.ajax_save_raw_data(uset_arr_temp)
                
                let data_last_id = res_save_raw_data['last_id'];
                if (res_save_raw_data['arr_suc']['st'] == '1') {
                    Swal.fire({
                        title: 'Saved!',
                        text: 'Your file has been saved.',
                        icon: 'success',
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'CHL-carrier-management.php' + '?carrier_number=' + data_last_id
                        }
                      });
                   

                    
                } else if (res_save_raw_data['arr_suc']['st'] == '0') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Save is false plese contact to support tech team',
                    })
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


