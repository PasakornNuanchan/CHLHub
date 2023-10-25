const func_transport_mode = {
    select_language : async function(e){
        let data_type = $('.sel_langague').val()
        if(data_type == "TH"){
            $('.text_languages').html('ภาษา')
            $('.text_address').html('ที่อยู่')
            $('.text_pickup_emp_container').html('สถานที่รับตู้คอนเทนเนอร์เปล่า')
            $('.text_loading_address').html('สถานที่รับสินค้า')
            $('.text_delivery_container').html('สถานที่จัดส่งสินค้า')
            $('.text_drop_off_emp_container').html('สถานที่คืนตู้คอนเทนเนอร์')
            $('.text_detail').html('รายละเอียด')
            $('.text_driver').html('ชื่อผู้ขับรถ')
            $('.text_container').html('หมายเลขคอนเทนเนอร์')
            $('.text_arrived_deivery').html('ถึงสถานที่จัดส่ง')
            $('.text_datetime').html('วันและเวลา')
            $('.text_delivered').html('จัดส่งสินค้า')
            $('.text_return_to_cy').html('ส่งตู้คืนสถานที่คืนตู้คอนเทนเนอร์')
        }else if(data_type == "EN"){
            $('.text_languages').html('Languages')
            $('.text_address').html('Address')
            $('.text_pickup_emp_container').html('Pickup Empty Container Address')
            $('.text_loading_address').html('Loading Address')
            $('.text_delivery_container').html('Delivery Container Address')
            $('.text_drop_off_emp_container').html('Drop off Empty Containe Address')
            $('.text_detail').html('Detail')
            $('.text_driver').html('Driver')
            $('.text_container').html('Container number')
            $('.text_arrived_deivery').html('Arrive delivery place')
            $('.text_datetime').html('Datetime')
            $('.text_delivered').html('Delivered')
            $('.text_return_to_cy').html('Return to cy')
        }
    },

    update_status_data : async function(container_id,type_data){
        let languages = $('.sel_langague').val()
    

        let title_data = languages == "TH" ? "ยืนยันการบันทึกข้อมูล" : "Are you sure save list";
        let text_data = languages == "TH" ? "ถ้าคุณตรวจสอบแล้วกรุณากดปุ่มบันทึก" : "you sure click on Yes, save it!";
        let btn_cf_data = languages == "TH" ? "บันทึก" : "Yes, save it!";
        let btn_cc_data = languages == "TH" ? "ยกเลิก" : "Cancel";

        let text_save_1 = languages == "TH" ? "บันทึก" : "saved!";
        let text_save_2 = languages == "TH" ? "ข้อมูลของคุณถูกบันทึกแล้ว" : "Your data has been saved.";

        let text_can_1 = languages == "TH" ? "ไม่สามารถบันทึกข้อมูลได้กรุณาติดต่อ ชิปปิ้งเพื่อติดต่อบริษัท" : "System has problem plese contact to thailand tech team ";
        Swal.fire({
            title: `${title_data}`,
            html: `${text_data}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `${btn_cf_data}`,
            cancelButtonText: `${btn_cc_data}`
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res_data = await this.ajax_setting_status(container_id,type_data)
                
                if(res_data == '1'){
                    Swal.fire(
                        `${text_save_1}`,
                        `${text_save_2}`,
                        'success'
                    )
                    location.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        text: `${text_can_1}`,
                    })
                }
            }
        })
        
    },

    ajax_setting_status : function (container_id,type_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport_mode/set_status_transport.php",
                data : {container_id: container_id,
                        type_data : type_data},
                dataType: 'json',
                success: function (response) {
                    resolve(response)
                }
            });
        });
    },

    open_url_gg : async function (e){
        window.open(e)
    }
}