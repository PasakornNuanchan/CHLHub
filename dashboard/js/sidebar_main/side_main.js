const sidebar_main = {
   
    set_data_rows: async function () {
        
        

        let side_menu = await this.ajax_set_side_main()
        
        let url_get_check = $(location).attr('pathname').split("/")[3]
        

        arr_menu = []
        arr_menu_temp = {}
        html_side = '';
        let check_val_data_page = 0;
        $.each(side_menu['menu_list_main'], function (i, v) {   
            let sub_html = '';
          
            $.each(v,function(i1,v1){
            
               
               
                let num_r = 0;
                if(num_r == 0){
                sub_html += `
                <li class="nav-item">
                    <a class="nav-link" href="${v1['link']}">
                        <i class="${v1['menu_icon']}"></i>
                        <span class="item-name"> ${v1['menu_name']}</span>
                    </a>
                </li>
                `;
                num_r++
                }

                arr_menu_temp = {
                    link : v1['link']
                }
                arr_menu.push(arr_menu_temp)

            })

            $('.side_bar_main_add').append(sub_html)
            
        });


        
        $.each(arr_menu,function (i,v){
            if(v['link'] == "CHL-Advance_payment-list.php"){
                arr_menu_temp = {
                    link : 'CHL-Advance_payment.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-Advance-list.php"){
                arr_menu_temp = {
                    link : 'CHL-Advance.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-Billing-list.php"){
                arr_menu_temp = {
                    link : 'CHL-Billing.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-Booking-list.php"){
                arr_menu_temp = {
                    link : 'CHL-booking.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-customs-list.php"){
                arr_menu_temp = {
                    link : 'CHL-Customs.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-customs-list.php"){
                arr_menu_temp = {
                    link : 'CHL-Customs.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-pettyCash_for_payment-list.php"){
                arr_menu_temp = {
                    link : 'CHL-PettyCash_for_payment.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-pettyCash_return-list.php"){
                arr_menu_temp = {
                    link : 'CHL-PettyCash_return.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-pettyCash-list.php"){
                arr_menu_temp = {
                    link : 'CHL-PettyCash.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-Quartation-list.php"){
                arr_menu_temp = {
                    link : 'CHL-Quartation.php'
                }
                arr_menu.push(arr_menu_temp)
                arr_menu_temp = {
                    link : 'CHL-Quartation-markup.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-reportcs-list.php"){
                arr_menu_temp = {
                    link : 'CHL-reportcs.php'
                }
                arr_menu.push(arr_menu_temp)
            }

            if(v['link'] == "CHL-transport-list.php"){
                arr_menu_temp = {
                    link : 'CHL-Transport.php'
                }
                arr_menu.push(arr_menu_temp)
            }
        })
       
        $.each(arr_menu,function (i,v){
            if(url_get_check == v['link']){
                check_val_data_page = 1;
            }
        })

        if(check_val_data_page == '0'){
           window.location = 'CHL-home.php';
        }
       
    }, 



    ajax_set_side_main: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/sidebar_main/get_detail.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },


};

