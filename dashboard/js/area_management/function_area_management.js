const area_management ={

    set_data_head : async function () {
    
        $('.head-of-menu').html('Area list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-area_list.php" target="" style="color:white;">Area main list</a></li>`;
        $('.bcpage').append(html_bdpage);

    },

    get_area_management : async function (){
        let data_port = $('.inp_port_name').val()
        let data_provice = $('.inp_provice').val()


        let res_data = await this.ajax_area_management(data_port,data_provice)
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

    ajax_area_management : async function (data_port,data_provice){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/area_management/save_data.php",
                data: {
                    data_port : data_port,
                    data_provice : data_provice} ,
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
}