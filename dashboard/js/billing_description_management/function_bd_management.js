const function_bd_management ={

    set_data_head : async function () {
    
        $('.head-of-menu').html('Billing Description Management');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing_description_list.php" target="" style="color:white;">Billing Description main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    },

    get_data_management : async function (){
        let code_name = $('.inp_code_name').val()
        let item_name = $('.inp_item_name').val()


        let res_data = await this.ajax_area_management(code_name,item_name)
        if(res_data == '1'){
            await Swal.fire(
                'Save it!',
                'Your file has been deleted.',
                'success'
              )
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System error plese contact to tech team',
              })
        }
    },

    ajax_area_management : async function (code_name,item_name){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing_description_management/save_data.php",
                data: {
                    code_name : code_name,
                    item_name : item_name} ,
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
}