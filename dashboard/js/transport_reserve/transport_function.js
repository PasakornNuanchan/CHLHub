const transport_function = {
    get_to_copy: async function (e) {
        
        let id_number = $(e).closest('.card').attr('rjid')
        console.log(id_number)
        let clear_date = $(e).closest('.card').find('.inp_clearance_date').val()
        let delivery_date = $(e).closest('.card').find('.inp_delivery_plan').val()
        let clear_date_d = clear_date.substring(0,10)
        let delivery_date_d = delivery_date.substring(0,10)
        let delivery_date_t = delivery_date.substring(11,16)
        

        let arr_count_type = [];
        let arr_container_number = [];
        $(e).closest('.card').find('.table > tbody > tr').each(function(i,v){
            
            let count_type = $(this).find('.inp_container_type').attr('type_sub_name')
            let conatiner_name = $(this).find('.inp_container_name').val()
            arr_count_type.push(count_type)
            arr_container_number.push(`"`+conatiner_name+`"`)
        })
        
        let compress_type = compressArray(arr_count_type);
        let container_type_data = compress_type.join(',');
        let container_number_data = arr_container_number.join(',')

        let get_hbl = await this.ajax_get_hbl(id_number);
        let hbl_arr = [];
        let hbl_data = '';
        
        if(get_hbl['hbl'] != "0 results"){
            
            $.each(get_hbl['hbl'],function(i,v){
                let hbl = v['hbl'] ? v['hbl'] : '';
                // console.log(hbl)
                hbl_arr.push(hbl)
                
            })
            hbl_data = hbl_arr.join(',');
        }
        
        
        let dataToCopy = `
        clearance on ${clear_date_d} 
        delivery on ${delivery_date_d} @ ${delivery_date_t}
        ข้อมูล
        B/L : ${hbl_data}
        จำนวน : ${container_type_data}
        เลขตู้ : ${container_number_data}  
        ราคา  :
        ที่จัดส่ง ; 
        ""CONTACT : 伟泰0879562324
        KNL RECYCLETECHNOLOGY & TO SERVICE CO.,LTD.""
        https://www.google.com/maps?q=13.749329,101.671371
            
        *ออกใบเสร็จ
        ""M.P.F. CONSULTANT CO.,LTD.
        88/22 MOO.9 , TAMBON THUNGSUKLA, AMPHUR SRIRACHA, CHONBURI,THAILAND 20230
        收货人税务登记号TAX ID: 0205565030623"""
        
        `;

        // let dataToCopy = "http://www.uat-chlop.com/chlhub/dashboard/transport_mode.php";
        var copyTextArea = $("<textarea/>");// สร้าง element textarea สำหรับใช้คัดลอกข้อมูล
        copyTextArea.text(dataToCopy);// กำหนดข้อมูลให้กับ textarea
        $('.area_text').append(copyTextArea);// นำ textarea ไปแทรกใน DOM (เปิด textarea ในหน้าจอ)
        copyTextArea.select();// เลือกข้อความใน textarea
        document.execCommand("copy");// คัดลอกข้อมูล
        copyTextArea.remove();// นำ textarea ออกจาก DOM (ปิด textarea ในหน้าจอ)
    },

    ajax_get_hbl : async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport_reserve/get_hbl.php",
                data : {id_number:id_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}



function compressArray(array) {
    let result = [];
    let current = null;
    let count = 0;

    for (let i = 0; i < array.length; i++) {
        if (array[i] !== current) {
            if (count > 0) {
                result.push(`${count}*${current}`);
            }
            current = array[i];
            count = 1;
        } else {
            count++;
        }
    }

    if (count > 0) {
        result.push(`${count}*${current}`);
    }

    return result;
}