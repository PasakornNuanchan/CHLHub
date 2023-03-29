const consignee_list_set = {
    consignee_number_global : '',
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
        let get_consignee_number = getUrlParameter('consignee_number');
        
        let consignee_number = get_consignee_number == false ? null : get_consignee_number;
        
        this.consignee_number_global = consignee_number;

        if(get_consignee_number != 'undefined'){
        await this.set_head_page();
        await this.set_raw_data(consignee_number);
        }else{
        await this.set_head_page();
        }
    },

    set_head_page : async function () {
    
        $('.head-of-menu').html('Consignee');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-consignee_list.php" target="" style="color:white;">Consignee main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

    set_raw_data : async function (consignee_number){
        let rrd = await consignee_list_set.ajax_request_raw_data(consignee_number)
       
        //$('.inp-consignee_number').val(rrd['sqrc']['consignee_number'])
        $('.inp-cname').val(rrd['sqrc']['consignee_name']).attr('readonly',true)
        $('.inp-address').val(rrd['sqrc']['address'])
        $('.inp-tax_id').val(rrd['sqrc']['tax'])
        $('.inp-email').val(rrd['sqrc']['email'])
        $('.inp-phone_number').val(rrd['sqrc']['tel'])
        $('.inp-fax').val(rrd['sqrc']['fax'])
        $('.inp-linkman').val(rrd['sqrc']['contact_person_name'])
        $('.inp-contact').val(rrd['sqrc']['contact_person_tel'])
        

    },

    ajax_request_raw_data : async function(consignee_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/consignee-management/request_raw_data.php",
                data: {'consignee_number' : consignee_number},
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
                
                //let consignee_number = $('.inp-consignee_number').val()
                
                let corp_name = $('.inp-cname').val()
                let corp_address = $('.inp-address').val()
                let corp_tax_id = $('.inp-tax_id').val()
                let corp_email = $('.inp-email').val()
                let corp_phone_number = $('.inp-phone_number').val()
                let corp_fax = $('.inp-fax').val()
                let corp_linkman = $('.inp-linkman').val()
                let corp_contact_tel = $('.inp-contact').val()

                let check_val = 0;

                if(corp_name == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Detail data is missing plese check your data !',
                    })
                    check_val = 1;
                }

                if(check_val == 0){
                   uset_arr_temp = {
                    consignee_id : this.consignee_number_global,
                    corp_name : corp_name,
                    corp_address : corp_address,
                    corp_tax_id : corp_tax_id,
                    corp_email : corp_email,
                    corp_phone_number : corp_phone_number,
                    corp_fax : corp_fax,
                    corp_linkman : corp_linkman,
                    corp_contact_tel : corp_contact_tel,
                    
                   }

                    let res_save_raw_data  = await this.ajax_save_raw_data(uset_arr_temp)
                    console.log(res_save_raw_data)
                    if(res_save_raw_data['st'] == '4'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Cannot has save your data because corporate name is duplicate please change corporate name',
                        })
                    }else if(res_save_raw_data['st'] == '1'){
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
                url: "php/consignee-management/save_raw_data_user.php",
                data: {'uset_arr_temp' : uset_arr_temp},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
    
};


