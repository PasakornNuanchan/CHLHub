const shipper_list_set = {
    shipper_number_global : '',
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
        let get_shipper_number = getUrlParameter('shipper_number');
        
        let shipper_number = get_shipper_number == false ? null : get_shipper_number;
        
        this.shipper_number_global = shipper_number;

        if(get_shipper_number != 'undefined'){
        await this.set_head_page();
        await this.set_raw_data(shipper_number);
        }else{
        await this.set_head_page();
        }
    },

    set_head_page : async function () {
    
        $('.head-of-menu').html('Shipper Management');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-shipper_list.php" target="" style="color:white;">Shipper Management List</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

    set_raw_data : async function (shipper_number){
        let rrd = await shipper_list_set.ajax_request_raw_data(shipper_number)
       
        //$('.inp-shipper_number').val(rrd['sqrc']['shipper_number'])
        $('.inp-cname').val(rrd['sqrc']['shipper_name']).attr('readonly',true)
        $('.inp-address').val(rrd['sqrc']['address'])
        $('.inp-tax_id').val(rrd['sqrc']['tax'])
        $('.inp-email').val(rrd['sqrc']['email'])
        $('.inp-phone_number').val(rrd['sqrc']['tel'])
        $('.inp-fax').val(rrd['sqrc']['fax'])
        $('.inp-linkman').val(rrd['sqrc']['linkman'])
        $('.inp-contact').val(rrd['sqrc']['linkman_tel'])
        

    },

    ajax_request_raw_data : async function(shipper_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/shipper-management/request_raw_data.php",
                data: {'shipper_number' : shipper_number},
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
                
                //let shipper_number = $('.inp-shipper_number').val()
                
                let cname = $('.inp-cname').val()
                let address = $('.inp-address').val()
                let tax = $('.inp-tax_id').val()
                let email = $('.inp-email').val()
                let phone_number = $('.inp-phone_number').val()
                let fax = $('.inp-fax').val()
                let linkman = $('.inp-linkman').val()
                let linkman_tel = $('.inp-contact').val()

                let check_val = 0;

                if(cname == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Detail data is missing plese check your data !',
                    })
                    check_val = 1;
                }

                if(check_val == 0){
                   uset_arr_temp = {
                    shipper_id : this.shipper_number_global,
                    cname : cname,
                    address : address,
                    tax : tax,
                    email : email,
                    phone_number : phone_number,
                    fax : fax,
                    linkman : linkman,
                    linkman_tel : linkman_tel,
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
                        
                    $('.inp-cname').val('')
                    $('.inp-address').val('')
                    $('.inp-tax_id').val('')
                    $('.inp-email').val('')
                    $('.inp-phone_number').val('')
                    $('.inp-fax').val('')
                    $('.inp-linkman').val('')
                    $('.inp-contact').val('')
                        
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
                url: "php/shipper-management/save_raw_data_user.php",
                data: {'uset_arr_temp' : uset_arr_temp},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
    
};


