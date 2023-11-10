const transport_function = {
    get_to_copy: async function (e) {
        let id_number = $(e).closest('.card').attr('rjid')
        // console.log(id_number)
        let clear_date = $(e).closest('.card').find('.inp_clearance_date').val()
        let delivery_date = $(e).closest('.card').find('.inp_delivery_plan').val()
        let clear_date_d = clear_date.substring(0, 10)
        let delivery_date_d = delivery_date.substring(0, 10)
        let delivery_date_t = delivery_date.substring(11, 16)


        let arr_count_type = [];
        let arr_container_number = [];
        $(e).closest('.card').find('.table > tbody > tr').each(function (i, v) {

            let count_type = $(this).find('.inp_container_type').attr('type_sub_name')
            let conatiner_name = $(this).find('.inp_container_name').val()
            arr_count_type.push(count_type)
            arr_container_number.push(`"` + conatiner_name + `"`)
        })

        let compress_type = compressArray(arr_count_type);
        let container_type_data = compress_type.join(',');
        let container_number_data = arr_container_number.join(',')

        let get_hbl = await this.ajax_get_hbl(id_number);
        let hbl_arr = [];
        let hbl_data = '';

        let value_remark = $(e).closest('.card').find('.inp_delivery_remark').val()
        let value_delivery = $(e).closest('.card').find('.inp_delivery_container').val()
        let value_ggmap = $(e).closest('.card').find('.ggdrop_con').attr('href')
        if (get_hbl['hbl'] != "0 results") {

            $.each(get_hbl['hbl'], function (i, v) {
                let hbl = v['hbl'] ? v['hbl'] : '';
                // console.log(hbl)
                hbl_arr.push(hbl)

            })
            hbl_data = hbl_arr.join(',');
        }

       
        let consignee_name = ""
        let consginee_address = ""
        let tax = ""
        let type_select_text = '';

        await Swal.fire({
            title: "Receip By",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Consignee",
            confirmButtonColor : "green",
            denyButtonText : "CHL",
            denyButtonColor : "blue",
            cancelButtonText : "Cancel",
            cancelButtonColor : "red",
        }).then(async(result) => {
            
            if (result.isConfirmed) {
                let res_data_consignee = await this.ajax_get_consginee_detail(id_number)
                consignee_name = res_data_consignee['consingee'][0]['consignee_name']
                consginee_address = res_data_consignee['consingee'][0]['address']
                tax = res_data_consignee['consingee'][0]['tax']
                // consignee_name = res_data_consignee['consingee'][0]['consignee_name']
                // consginee_address = res_data_consignee['consingee'][0]['address']
                // tax = res_data_consignee['consingee'][0]['tax']
        
        
            } else if (result.isDenied) {
                consignee_name = "CHINA HIGHWIN (THAILAND) LIMITED (HEAD OFFICE)";
                consginee_address = "223/85, 92 Country Complex Building A, 17th Floor Sanphawut Rd, Bangna-Tai Bangna Bangkok 10260 Thailand";
                tax = "0745560004379";
            }
        });
        
        
        console.log(consignee_name)
        console.log(consginee_address)
        console.log(tax)

      
        let dataToCopy = `
        clearance on ${clear_date_d} 
        delivery on ${delivery_date_d} @ ${delivery_date_t}
        ข้อมูล
        B/L : ${hbl_data}
        จำนวน : ${container_type_data}
        เลขตู้ : ${container_number_data}  
        ราคา  :
        ที่จัดส่ง ; 
        Remark : ${value_remark}
        ${value_delivery}
        ${value_ggmap}
            
        *ออกใบเสร็จ
        ${consignee_name}
        ${consginee_address}
        收货人税务登记号TAX ID: ${tax}
        
        `;

        // let dataToCopy = "http://www.uat-chlop.com/chlhub/dashboard/transport_mode.php";
        var copyTextArea = $("<textarea/>");// สร้าง element textarea สำหรับใช้คัดลอกข้อมูล
        copyTextArea.text(dataToCopy);// กำหนดข้อมูลให้กับ textarea
        $('.area_text').append(copyTextArea);// นำ textarea ไปแทรกใน DOM (เปิด textarea ในหน้าจอ)
        copyTextArea.select();// เลือกข้อความใน textarea
        document.execCommand("copy");// คัดลอกข้อมูล
        copyTextArea.remove();// นำ textarea ออกจาก DOM (ปิด textarea ในหน้าจอ)
    },

    ajax_get_consginee_detail : async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport_reserve/get_detail_consignee.php",
                data: {
                    id_number: id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_get_hbl: async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport_reserve/get_hbl.php",
                data: { id_number: id_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    get_data_save: async function (e) {
        let data_id_number = $(e).closest('.card').attr('id_number')
        let data_supplier_name = $(e).closest('.card').find(`.inp_data_supplier${data_id_number}`).val()

        let res_data = await this.ajax_sent_data_save(data_id_number, data_supplier_name);
        if (res_data == '1') {
            Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })
        }

    },

    ajax_sent_data_save: async function (data_id_number, data_supplier_name) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport_reserve/save_data_transport.php",
                data: {
                    data_id_number: data_id_number,
                    data_supplier_name: data_supplier_name
                },
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