const sidebar_main = {
   
    set_data_rows: async function () {
        
        let side_menu = await this.ajax_set_side_main()
        
        html_side = '';
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
                }else{

                }

           
                
            })

            $('.side_bar_main_add').append(sub_html)

          

            
            

            
        });
        
      
      
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

