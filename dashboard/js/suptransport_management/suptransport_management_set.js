const suptransport_list_set = {
    suptransport_number_global : '',
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
        let get_suptransport_number = getUrlParameter('suptransport_number');
        
        let suptransport_number = get_suptransport_number == false ? null : get_suptransport_number;
        
        this.suptransport_number_global = suptransport_number;

        if(get_suptransport_number != 'undefined'){
        await this.set_head_page();
        await this.set_raw_data(suptransport_number);
        }else{
        await this.set_head_page();
        }
    },

    set_head_page : async function () {
    
        $('.head-of-menu').html('Supplier Transport');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-suptransport_list.php" target="" style="color:white;">Supplier transport main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

    set_raw_data : async function (suptransport_number){
        let rrd = await suptransport_list_set.ajax_request_raw_data(suptransport_number)
       
        //$('.inp-suptransport_number').val(rrd['sqrc']['suptransport_number'])
        $('.inp-cname').val(rrd['sqrc']['transport_sup_name']).attr('readonly',true)
        $('.inp-address').val(rrd['sqrc']['address'])
        $('.inp-tax_id').val(rrd['sqrc']['tax'])
        $('.inp-email').val(rrd['sqrc']['email'])
        $('.inp-phone_number').val(rrd['sqrc']['tel'])
        $('.inp-line').val(rrd['sqrc']['line'])
        $('.inp-fax').val(rrd['sqrc']['fax'])
        $('.inp-linkman').val(rrd['sqrc']['linkman'])
        $('.inp-contact').val(rrd['sqrc']['linkman_tel'])
        

    },

    ajax_request_raw_data : async function(suptransport_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/suptransport-management/request_raw_data.php",
                data: {'suptransport_number' : suptransport_number},
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
                
                //let suptransport_number = $('.inp-suptransport_number').val()
                
                let cname = $('.inp-cname').val()
                let address = $('.inp-address').val()
                let tax = $('.inp-tax_id').val()
                let email = $('.inp-email').val()
                let phone_number = $('.inp-phone_number').val()
                let line = $('.inp-line').val()
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
                    suptransport_id : this.suptransport_number_global,
                    cname : cname,
                    address : address,
                    tax : tax,
                    email : email,
                    phone_number : phone_number,
                    line : line,
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
                url: "php/suptransport-management/save_raw_data_user.php",
                data: {'uset_arr_temp' : uset_arr_temp},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
    
};


