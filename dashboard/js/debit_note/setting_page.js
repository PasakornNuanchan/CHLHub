const setting_page = {
    set_header_page: async function (job_number) {
        $('.head-of-menu').html('Check Debit Note');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Debit note list</a></li>
        `;
        $('.bcpage').append(html_bdpage);


        // let data_table_booking = await job_list.ajax_request_table();
        // console.log(data_table_booking)
        // var data = data_table_booking['booking_list']
        // await job_list.setting_data_table_t(data);
        // await $('.pnv').remove()

        // $('#myTable > tbody').html('')
        await setting_default_data.setting_default_data();
        await this.set_ap_by_job();
        await this.set_ar_by_job();

    },


    set_ar_by_job : async function(){
        let job_number = $('.inp_job_number_ar_job').val()
        let date_start = $('.inp_date_start_ar_job').val()
        let date_stop = $('.inp_date_stop_ar_job').val()
        let bill_to = $('.inp_bill_to_ar_job').val()
        let bill_to_type = $('.inp_bill_to_ar_job :selected').attr('data_type')
        let cs_support = $('.inp_cs_support_ar_job').val()

        let res_data = await this.ajax_set_ar_by_job(job_number, date_start, date_stop, bill_to, cs_support, bill_to_type);
        
        let data_round = 1;
        let last_i = 0;

        if (res_data['data_setdefault_ar_by_job'] != "0 results") {
            $.each(res_data['data_setdefault_ar_by_job'], function (i, v) {
                $.each(v, function (i1, v1) {
                    let create_date = v1['create_date'] ? v1['create_date'] : '';
                    let bill_to_c = v1['bill_to_c'] ? v1['bill_to_c'] : '';
                    let job_number = v1['job_number'] ? v1['job_number'] : '';
                    let mbl = v1['mbl'] ? v1['mbl'] : '';
                    let container = v1['container'] ? v1['container'] : '';
                    let container_quantity = v1['container_quantity'] ? v1['container_quantity'] : '';
                    let billing_item_data = v1['billing_item_data'] ? v1['billing_item_data'] : '';
                    let cal_data = v1['cal_data'] ? v1['cal_data'] : '';
                    let currency = v1['currency'] ? v1['currency'] : '';

                    let text_container = container.split(',');
                    let text_container_join = text_container.join('<br>');


                    let usd_cal = '';
                    let thb_cal = '';
                    let rmb_cal = '';
                    let yen_cal = '';
                    if (currency == "USD") {
                        usd_cal = cal_data;
                    } else if (currency == "THB") {
                        thb_cal = cal_data;
                    } else if (currency == "RMB") {
                        rmb_cal = cal_data;
                    } else if (currency == "YEN") {
                        yen_cal = cal_data;
                    }

                    if (i == last_i) {
                        data_round++;
                    } else {
                        data_round = 1;
                    }
                    last_i = i;

                    usd_cal = usd_cal ? parseFloat(usd_cal).toFixed(2) : '';
                    thb_cal = thb_cal ? parseFloat(thb_cal).toFixed(2) : '';
                    rmb_cal = rmb_cal ? parseFloat(rmb_cal).toFixed(2) : '';
                    yen_cal = yen_cal ? parseFloat(yen_cal).toFixed(2) : '';


                    let html_data_table = '';
                    if (i1 == 0) {
                        html_data_table = `
                    <tr class="table_ar_${i}_${i1} table_ar_${i}">
                        <td class="td_m text-center">${create_date}</td>
                        <td >${bill_to_c}</td>
                        <td class="td_m text-center">${job_number}</td>
                        <td class="td_m text-center">${mbl}</td>
                        <td class="td_m text-center">${text_container_join}</td>
                        <td class="td_m text-center">${container_quantity}</td>
                        <td>${billing_item_data}</td>
                        <td class="text-end data_cal_usd">${usd_cal}</td>
                        <td class="text-end data_cal_thb">${thb_cal}</td>
                        <td class="text-end data_cal_rmb">${rmb_cal}</td>
                        <td class="text-end data_cal_yen">${yen_cal}</td>
                    </tr>
                    `;
                    } else {
                        html_data_table = `
                    <tr class="table_ar_${i}_${i1} table_ar_${i}">
                        <td>${bill_to_c}</td>
                        <td>${billing_item_data}</td>
                        <td class="text-end data_cal_usd">${usd_cal}</td>
                        <td class="text-end data_cal_thb">${thb_cal}</td>
                        <td class="text-end data_cal_rmb">${rmb_cal}</td>
                        <td class="text-end data_cal_yen">${yen_cal}</td>
                    </tr>
                    `;
                    }


                    $('.table_data_ar_by_job tbody').append(html_data_table)
                })


                let data_plus_cal_usd = 0;
                let data_plus_cal_thb = 0;
                let data_plus_cal_rmb = 0;
                let data_plus_cal_yen = 0;



                $(`.table_ar_${i}`).each(function (i, v) {
                    let data_cal_usd = $('.data_cal_usd', this).html();
                    let data_cal_thb = $('.data_cal_thb', this).html();
                    let data_cal_rmb = $('.data_cal_rmb', this).html();
                    let data_cal_yen = $('.data_cal_yen', this).html();

                    data_cal_usd = parseFloat(data_cal_usd);
                    data_cal_thb = parseFloat(data_cal_thb);
                    data_cal_rmb = parseFloat(data_cal_rmb);
                    data_cal_yen = parseFloat(data_cal_yen);


                    data_plus_cal_usd = data_plus_cal_usd + data_cal_usd;
                    data_plus_cal_thb = data_plus_cal_thb + data_cal_thb;
                    data_plus_cal_rmb = data_plus_cal_rmb + data_cal_rmb;
                    data_plus_cal_yen = data_plus_cal_yen + data_cal_yen;

                })

                data_plus_cal_usd = data_plus_cal_usd.toFixed(2);
                data_plus_cal_thb = data_plus_cal_thb.toFixed(2);
                data_plus_cal_rmb = data_plus_cal_rmb.toFixed(2);
                data_plus_cal_yen = data_plus_cal_yen.toFixed(2);


                data_plus_cal_usd = isNaN(data_plus_cal_usd) ? '' : data_plus_cal_usd;
                data_plus_cal_thb = isNaN(data_plus_cal_thb) ? '' : data_plus_cal_thb;
                data_plus_cal_rmb = isNaN(data_plus_cal_rmb) ? '' : data_plus_cal_rmb;
                data_plus_cal_yen = isNaN(data_plus_cal_yen) ? '' : data_plus_cal_yen;




                let html_data_table_res = `
                <tr style="background-color:LightGray;">
                    <td colspan="7"></td>
                    <td class="text-end">${data_plus_cal_usd}</td>
                    <td class="text-end">${data_plus_cal_thb}</td>
                    <td class="text-end">${data_plus_cal_rmb}</td>
                    <td class="text-end">${data_plus_cal_yen}</td>
                </tr>
            `;
                $('.table_data_ar_by_job tbody').append(html_data_table_res)


                $(`.table_ar_${i}_0 > .td_m`).attr({ 'rowspan': `${data_round}` })
            })
        } else {
            let html_data_table_res = `
            <tr>
                <td colspan="11" class="text-center"> Undefind data please select again</td>
            </tr>
            `;
            $('.table_data_ar_by_job tbody').append(html_data_table_res)
        }


    },

    ajax_set_ar_by_job: async function (job_number, date_start, date_stop, bill_to, cs_support, bill_to_type) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/debit_note/setting_ar_default_job.php",
                data: {
                    job_number: job_number,
                    date_start: date_start,
                    date_stop: date_stop,
                    bill_to: bill_to,
                    bill_to_type: bill_to_type,
                    cs_support: cs_support
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    
    set_ap_by_job: async function () {

        $('.table_data_ap_by_job tbody').html('');

        let job_number = $('.inp_job_number_ap_job').val()
        let date_start = $('.inp_date_start_ap_job').val()
        let date_stop = $('.inp_date_stop_ap_job').val()
        let bill_to = $('.inp_bill_to_ap_job').val()
        let bill_to_type = $('.inp_bill_to_ap_job :selected').attr('data_type')
        let cs_support = $('.inp_cs_support_ap_job').val()

        let res_data = await this.ajax_set_ap_by_job(job_number, date_start, date_stop, bill_to, cs_support, bill_to_type);
        
        let data_round = 0;
        let last_i = 0;



        if (res_data['data_setdefault_ap_by_job'] != "0 results") {
            $.each(res_data['data_setdefault_ap_by_job'], function (i, v) {

                $.each(v, function (i1, v1) {
                    let create_date = v1['create_date'] ? v1['create_date'] : '';
                    let bill_to_c = v1['bill_to_c'] ? v1['bill_to_c'] : '';
                    let job_number = v1['job_number'] ? v1['job_number'] : '';
                    let mbl = v1['mbl'] ? v1['mbl'] : '';
                    let container = v1['container'] ? v1['container'] : '';
                    let container_quantity = v1['container_quantity'] ? v1['container_quantity'] : '';
                    let billing_item_data = v1['billing_item_data'] ? v1['billing_item_data'] : '';
                    let cal_data = v1['cal_data'] ? v1['cal_data'] : '';
                    let currency = v1['currency'] ? v1['currency'] : '';

                    let text_container = container.split(',');
                    let text_container_join = text_container.join('<br>');


                    let usd_cal = '';
                    let thb_cal = '';
                    let rmb_cal = '';
                    let yen_cal = '';
                    if (currency == "USD") {
                        usd_cal = cal_data;
                    } else if (currency == "THB") {
                        thb_cal = cal_data;
                    } else if (currency == "RMB") {
                        rmb_cal = cal_data;
                    } else if (currency == "YEN") {
                        yen_cal = cal_data;
                    }

                    if (i == last_i) {
                        data_round++;
                    } else {
                        data_round = 1;
                    }
                    last_i = i;

                    

                    usd_cal = usd_cal ? parseFloat(usd_cal).toFixed(2) : '';
                    thb_cal = thb_cal ? parseFloat(thb_cal).toFixed(2) : '';
                    rmb_cal = rmb_cal ? parseFloat(rmb_cal).toFixed(2) : '';
                    yen_cal = yen_cal ? parseFloat(yen_cal).toFixed(2) : '';


                    let html_data_table = '';
                    if (i1 == 0) {
                        html_data_table = `
                    <tr class="table_ap_${i}_${i1} table_ap_${i}">
                        <td class="td_m text-center">${create_date}</td>
                        <td >${bill_to_c}</td>
                        <td class="td_m text-center">${job_number}</td>
                        <td class="td_m text-center">${mbl}</td>
                        <td class="td_m text-center">${text_container_join}</td>
                        <td class="td_m text-center">${container_quantity}</td>
                        <td>${billing_item_data}</td>
                        <td class="text-end data_cal_usd">${usd_cal}</td>
                        <td class="text-end data_cal_thb">${thb_cal}</td>
                        <td class="text-end data_cal_rmb">${rmb_cal}</td>
                        <td class="text-end data_cal_yen">${yen_cal}</td>
                    </tr>
                    `;
                    } else {
                        html_data_table = `
                    <tr class="table_ap_${i}_${i1} table_ap_${i}">
                        <td>${bill_to_c}</td>
                        <td>${billing_item_data}</td>
                        <td class="text-end data_cal_usd">${usd_cal}</td>
                        <td class="text-end data_cal_thb">${thb_cal}</td>
                        <td class="text-end data_cal_rmb">${rmb_cal}</td>
                        <td class="text-end data_cal_yen">${yen_cal}</td>
                    </tr>
                    `;
                    }


                    $('.table_data_ap_by_job tbody').append(html_data_table)

                    
                })
                
                $(`.table_ap_${i}_0 > .td_m`).attr({ 'rowspan': `${data_round}` })
            
                let data_plus_cal_usd = 0;
                let data_plus_cal_thb = 0;
                let data_plus_cal_rmb = 0;
                let data_plus_cal_yen = 0;




                $(`.table_ap_${i}`).each(function (i, v) {
                    let data_cal_usd = $('.data_cal_usd', this).html();
                    let data_cal_thb = $('.data_cal_thb', this).html();
                    let data_cal_rmb = $('.data_cal_rmb', this).html();
                    let data_cal_yen = $('.data_cal_yen', this).html();

                    data_cal_usd = parseFloat(data_cal_usd);
                    data_cal_thb = parseFloat(data_cal_thb);
                    data_cal_rmb = parseFloat(data_cal_rmb);
                    data_cal_yen = parseFloat(data_cal_yen);


                    data_plus_cal_usd = data_plus_cal_usd + data_cal_usd;
                    data_plus_cal_thb = data_plus_cal_thb + data_cal_thb;
                    data_plus_cal_rmb = data_plus_cal_rmb + data_cal_rmb;
                    data_plus_cal_yen = data_plus_cal_yen + data_cal_yen;

                })

                data_plus_cal_usd = data_plus_cal_usd.toFixed(2);
                data_plus_cal_thb = data_plus_cal_thb.toFixed(2);
                data_plus_cal_rmb = data_plus_cal_rmb.toFixed(2);
                data_plus_cal_yen = data_plus_cal_yen.toFixed(2);


                data_plus_cal_usd = isNaN(data_plus_cal_usd) ? '' : data_plus_cal_usd;
                data_plus_cal_thb = isNaN(data_plus_cal_thb) ? '' : data_plus_cal_thb;
                data_plus_cal_rmb = isNaN(data_plus_cal_rmb) ? '' : data_plus_cal_rmb;
                data_plus_cal_yen = isNaN(data_plus_cal_yen) ? '' : data_plus_cal_yen;




                let html_data_table_res = `
                <tr style="background-color:LightGray;">
                    <td colspan="7"></td>
                    <td class="text-end">${data_plus_cal_usd}</td>
                    <td class="text-end">${data_plus_cal_thb}</td>
                    <td class="text-end">${data_plus_cal_rmb}</td>
                    <td class="text-end">${data_plus_cal_yen}</td>
                </tr>
                `;
                $('.table_data_ap_by_job tbody').append(html_data_table_res)


                
            })
        } else {
            let html_data_table_res = `
            <tr>
                <td colspan="11" class="text-center"> Undefind data please select again</td>
            </tr>
            `;
            $('.table_data_ap_by_job tbody').append(html_data_table_res)
        }
    },



    ajax_set_ap_by_job: async function (job_number, date_start, date_stop, bill_to, cs_support, bill_to_type) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/debit_note/setting_ap_default_job.php",
                data: {
                    job_number: job_number,
                    date_start: date_start,
                    date_stop: date_stop,
                    bill_to: bill_to,
                    bill_to_type: bill_to_type,
                    cs_support: cs_support
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_request_data_ap : async function (job_number,date_start,date_stop,bill_to,cs_support,bill_to_type){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/debit_note/file_gen_ap_debit_note.php",
                data: {
                    job_number: job_number,
                    date_start: date_start,
                    date_stop: date_stop,
                    bill_to: bill_to,
                    bill_to_type: bill_to_type,
                    cs_support: cs_support
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    excel_generate_ap : async function () {
        let job_number = $('.inp_job_number_ap_job').val()        
        let date_start = $('.inp_date_start_ap_job').val()
        let date_stop = $('.inp_date_stop_ap_job').val()
        let bill_to_type = $('.inp_bill_to_ap_job :selected').attr('data_type')
        let bill_to = $('.inp_bill_to_ap_job').val()        
        let cs_support = $('.inp_cs_support_ap_job').val()

        let res_data = await this.ajax_request_data_ap(job_number,date_start,date_stop,bill_to,cs_support,bill_to_type)
        
        var createXLSLFormatObj = [];
        /* XLS Head Columns */
        var xlsHeader = ["Create date", "Bill to","inv no.","mbl on.","Container No.","Quantity Container","description","USD","THB","RMB","YEN"];
        createXLSLFormatObj.push(xlsHeader);
         /* XLS Rows Data */
    
        var xlsRows = res_data['data_setting_default_ap_by_job'];

        $.each(xlsRows, function(i, v) {
            var innerRowData = [];
            var val = {};
            let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
            let billing_item_data = v['billing_item_data'] ? v['billing_item_data'] : '';
            let container = v['container'] ? v['container'] : '';
            let container_quantity = v['container_quantity'] ? v['container_quantity'] : '';
            let create_date = v['create_date'] ? v['create_date'] : '';
            let currency = v['currency'] ? v['currency'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let main = v['main'] ? v['main'] : '';
            let mbl = v['mbl'] ? v['mbl'] : '';

            let thb_cur = 0;
            let usd_cur = 0;
            let rmb_cur = 0;
            let yen_cur = 0;

            if(currency == "THB"){
                thb_cur = thb_cur + main;
            }else if(currency == "USD"){
                usd_cur = thb_cur + main;
            }else if(currency == "RMB"){
                rmb_cur = thb_cur + main;
            }else if(currency == "YEN"){
                yen_cur = thb_cur + main;
            }

            thb_cur = parseFloat(thb_cur).toFixed(2);
            usd_cur = parseFloat(usd_cur).toFixed(2);
            rmb_cur = parseFloat(rmb_cur).toFixed(2);
            yen_cur = parseFloat(yen_cur).toFixed(2);
            
            innerRowData = [
                create_date,
                bill_to_c,
                job_number,
                mbl,
                container,
                container_quantity,
                billing_item_data ,
                usd_cur,
                thb_cur,
                rmb_cur,
                yen_cur
            ]

            createXLSLFormatObj.push(innerRowData);
        });
        

        /* File Name */
        var filename = "Statement.xlsx";

        /* Sheet Name */
        var ws_name = "Statement";

        if (typeof console !== 'undefined') console.log(new Date());
        var wb = XLSX.utils.book_new(),
            ws = XLSX.utils.aoa_to_sheet(createXLSLFormatObj);

        /* Add worksheet to workbook */
        XLSX.utils.book_append_sheet(wb, ws, ws_name);

        /* Write workbook and Download */
        if (typeof console !== 'undefined') console.log(new Date());
        XLSX.writeFile(wb, filename);
        if (typeof console !== 'undefined') console.log(new Date());
    },

    ajax_request_data_ar : async function (job_number,date_start,date_stop,bill_to,cs_support,bill_to_type){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/debit_note/file_gen_ar_debit_note.php",
                data: {
                    job_number: job_number,
                    date_start: date_start,
                    date_stop: date_stop,
                    bill_to: bill_to,
                    bill_to_type: bill_to_type,
                    cs_support: cs_support
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    excel_generate_ar : async function () {
        let job_number = $('.inp_job_number_ar_job').val()        
        let date_start = $('.inp_date_start_ar_job').val()
        let date_stop = $('.inp_date_stop_ar_job').val()
        let bill_to_type = $('.inp_bill_to_ar_job :selected').attr('data_type')
        let bill_to = $('.inp_bill_to_ar_job').val()        
        let cs_support = $('.inp_cs_support_ar_job').val()

        let res_data = await this.ajax_request_data_ar(job_number,date_start,date_stop,bill_to,cs_support,bill_to_type)
        
        var createXLSLFormatObj = [];
        /* XLS Head Columns */
        var xlsHeader = ["Create date", "Bill to","inv no.","mbl on.","Container No.","Quantity Container","description","USD","THB","RMB","YEN"];
        createXLSLFormatObj.push(xlsHeader);
         /* XLS Rows Data */
    
        var xlsRows = res_data['data_setting_default_ap_by_job'];

        $.each(xlsRows, function(i, v) {
            var innerRowData = [];
            var val = {};
            let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
            let billing_item_data = v['billing_item_data'] ? v['billing_item_data'] : '';
            let container = v['container'] ? v['container'] : '';
            let container_quantity = v['container_quantity'] ? v['container_quantity'] : '';
            let create_date = v['create_date'] ? v['create_date'] : '';
            let currency = v['currency'] ? v['currency'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let main = v['main'] ? v['main'] : '';
            let mbl = v['mbl'] ? v['mbl'] : '';

            let thb_cur = 0;
            let usd_cur = 0;
            let rmb_cur = 0;
            let yen_cur = 0;

            if(currency == "THB"){
                thb_cur = thb_cur + main;
            }else if(currency == "USD"){
                usd_cur = thb_cur + main;
            }else if(currency == "RMB"){
                rmb_cur = thb_cur + main;
            }else if(currency == "YEN"){
                yen_cur = thb_cur + main;
            }

            thb_cur = parseFloat(thb_cur).toFixed(2);
            usd_cur = parseFloat(usd_cur).toFixed(2);
            rmb_cur = parseFloat(rmb_cur).toFixed(2);
            yen_cur = parseFloat(yen_cur).toFixed(2);
            
            innerRowData = [
                create_date,
                bill_to_c,
                job_number,
                mbl,
                container,
                container_quantity,
                billing_item_data ,
                usd_cur,
                thb_cur,
                rmb_cur,
                yen_cur
            ]

            createXLSLFormatObj.push(innerRowData);
        });
        

        /* File Name */
        var filename = "Statement.xlsx";

        /* Sheet Name */
        var ws_name = "Statement";

        if (typeof console !== 'undefined') console.log(new Date());
        var wb = XLSX.utils.book_new(),
            ws = XLSX.utils.aoa_to_sheet(createXLSLFormatObj);

        /* Add worksheet to workbook */
        XLSX.utils.book_append_sheet(wb, ws, ws_name);

        /* Write workbook and Download */
        if (typeof console !== 'undefined') console.log(new Date());
        XLSX.writeFile(wb, filename);
        if (typeof console !== 'undefined') console.log(new Date());
    },

    

    


}