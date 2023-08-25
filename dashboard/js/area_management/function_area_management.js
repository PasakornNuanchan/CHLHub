const area_management ={
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