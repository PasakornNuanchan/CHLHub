const preview_management = {
    set_header_page: async function () {

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        id_number = url.searchParams.get("job_number");


        let res = await this.get_job_number(id_number)
        
        $('.head-of-menu').html('Job Detail');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="job_management_list.php" target="" style="color:white;">Job Management list</a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Job (Job Number ${res})</li>
        `;
        $('.bcpage').append(html_bdpage);



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

        let get_action = getUrlParameter('action');

        await this.patse_data_detail(id_number)
    },
    patse_data_detail : async function (id_number) {
        let res_data_detail = await this.get_detail(id_number);
        console.log(res_data_detail)
        
        $('.inp_job_number').append(res_data_detail['job_detail']['job_number'])
        $('.inp_booking_number').append(res_data_detail['job_detail']['booking_number'])
        $('.inp_consignee').append(res_data_detail['job_detail']['consignee_name'])
        $('.inp_shipper').append(res_data_detail['job_detail']['shipper_name'])
        $('.inp_shipment').append(res_data_detail['job_detail']['st_name'])
        $('.inp_remark').append(res_data_detail['job_detail']['remark'])
        $('.inp_carrier').append(res_data_detail['job_detail']['carrier_name'])
        $('.inp_por').append(res_data_detail['job_detail']['a1l']+','+res_data_detail['job_detail']['a1p'])
        $('.inp_pol').append(res_data_detail['job_detail']['a2l']+','+res_data_detail['job_detail']['a2p'])
        $('.inp_ts').append(res_data_detail['job_detail']['a3l']+','+res_data_detail['job_detail']['a3p'])
        $('.inp_pod').append(res_data_detail['job_detail']['a4l']+','+res_data_detail['job_detail']['a4p'])
        $('.inp_mother').append(res_data_detail['job_detail']['mother_vessel'])
        $('.inp_feeder').append(res_data_detail['job_detail']['feeder_vessel'])
        $('.inp_etd').append(res_data_detail['job_detail']['etd'])
        $('.inp_eta').append(res_data_detail['job_detail']['eta'])

        $('.inp_inv').append(res_data_detail['job_detail']['inv'])
        $('.inp_hbl').append(res_data_detail['job_detail']['hbl'])
        $('.inp_mbl').append(res_data_detail['job_detail']['mbl'])

        $('.inp_pick_up_do').append(res_data_detail['job_detail']['pickup_DO_date'])
        $('.inp_checkdoc').append(res_data_detail['job_detail']['check_document'])
        $('.inp_enter').append(res_data_detail['job_detail']['enter_date'])
        $('.inp_clearance_date').append(res_data_detail['job_detail']['clearlance_date'])
        $('.inp_clearance_by').append(res_data_detail['job_detail_status']['first_name']+' ')
        $('.inp_clearance_by').append(res_data_detail['job_detail_status']['last_name'])

        if(res_data_detail['job_detail_status']['ship_arrived_status'] == '1'){
            $('.inp_ship_arrived').append(`<span class='badge rounded-pill bg-success'>Success</span>`)    
        }else if(res_data_detail['job_detail_status']['ship_arrived_status'] == '2'){
            $('.inp_ship_arrived').append(`<span class='badge rounded-pill bg-danger'>Troubleshoot</span>`)    
        }else{
            $('.inp_ship_arrived').append(`<span class='badge rounded-pill bg-warning'>Waiting shiping arrived</span>`)   
        }

        if(res_data_detail['job_detail_status']['drop_status'] == '1'){
            $('.inp_container_dropff').append(`<span class='badge rounded-pill bg-success'>Success</span>`)    
        }else if(res_data_detail['job_detail_status']['drop_status'] == '2'){
            $('.inp_container_dropff').append(`<span class='badge rounded-pill bg-danger'>Troubleshoot</span>`)    
        }else{
            $('.inp_container_dropff').append(`<span class='badge rounded-pill bg-warning'>Waiting drop off</span>`)   
        }

        if(res_data_detail['job_detail_status']['Cus_status'] == '1'){
            $('.inp_cus_clerance').append(`<span class='badge rounded-pill bg-success'>Success</span>`)
        }else if(res_data_detail['job_detail_status']['Cus_status'] == '2'){
            $('.inp_cus_clerance').append(`<span class='badge rounded-pill bg-danger'>Troubleshoot</span>`)
        }else{
            $('.inp_cus_clerance').append(`<span class='badge rounded-pill bg-warning'>Waiting Clearance</span>`)   
        }
        
        
        let data_count_all = res_data_detail['data_container']['total_count'];
        let data_up = res_data_detail['data_container']['count_up'];
        let data_ar = res_data_detail['data_container']['count_ar'];

        if(data_count_all == data_up){
            $('.inp_container_upload').append(`<span class='badge rounded-pill bg-success'>Success</span>`)
        }else{
            $('.inp_container_upload').append(`<span class='badge rounded-pill bg-danger'>Unsuccessful</span>`)
        }

        if(data_count_all == data_ar){
            $('.inp_container_arrived').append(`<span class='badge rounded-pill bg-success'>Success</span>`)
        }else{
            $('.inp_container_arrived').append(`<span class='badge rounded-pill bg-danger'>Unsuccessful</span>`)
        }
    },

    get_to_copy : async function(e){
        let get_atr_fn = $(e).attr('fntype')
        let dataToCopy = $(`.${get_atr_fn}`).html()
        var copyTextArea = $("<textarea/>");// สร้าง element textarea สำหรับใช้คัดลอกข้อมูล
        copyTextArea.text(dataToCopy);// กำหนดข้อมูลให้กับ textarea
        $("body").append(copyTextArea);// นำ textarea ไปแทรกใน DOM (เปิด textarea ในหน้าจอ)
        copyTextArea.select();// เลือกข้อความใน textarea
        document.execCommand("copy");// คัดลอกข้อมูล
        copyTextArea.remove();// นำ textarea ออกจาก DOM (ปิด textarea ในหน้าจอ)
    },

    get_show_photo : async function(data_type){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/preview_management/get_lunch_photo.php",
                data: {
                    id_number: id_number,
                    data_type: data_type,
                },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

    get_detail : async function (data){
        return new Promise(function (resolve, reject) {
            $.ajax({
            type: "post",
            url: "php/preview_management/get_detail.php",
            data : {data :data},
            dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    
    get_job_number : async function (id_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
            type: "post",
            url: "php/job_detail/get_job_number.php",
            data : {id_number :id_number},
            dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}