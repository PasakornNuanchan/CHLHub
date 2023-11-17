const function_arp = {
    select_all: async function (e) {
        e == 'select' ? $('.table_data_account tbody > tr > td > .cbx_select').prop('checked', true) : $('.table_data_account tbody > tr > td > .cbx_select').prop('checked', false);
    },

    // open_excel : async function(){
    //     window.location.href = '../dashboard/php/account_res_payable/gen_excel_file.php';
    // },

    function_gen_excel_transport: async function (e) {
        let res_data_request = await this.ajax_request_generat_report()
        console.log(res_data_request['table'])



        let data_test = []
        let arr_data = []
        arr_data = [
            `JOB NO`,
            `BILL TO`,
            `CODE`,
            `amount`,
            `currency`,
            `USD`,
            `THB`,
            `CNY`,
            `HKD`,
            `amount currency`,
            `exchage rate`,
            `S/O`,
            `BL`,
            `Sailing date`,
            `vessel`,
            `ETD`,
            `ETA`,
            `Requester`,
            `customer address`,
            `Customer phone`,
        ]

        data_test.push(arr_data)
        $.each(res_data_request['table'], function (i, v) {

            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let consginee_tel = v['consginee_tel'] ? v['consginee_tel'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let sale_support = v['sale_support'] ? v['sale_support'] : '';
            let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
            let billing_des_name = v['billing_des_name'] ? v['billing_des_name'] : '';
            let create_by = v['create_by'] ? v['create_by'] : '';
            let mbl = v['mbl'] ? v['mbl'] : '';
            let vessel = v['vessel'] ? v['vessel'] : '';
            let etd = v['ETD'] ? v['ETD'] : '';
            let eta = v['ETA'] ? v['ETA'] : '';
            let currency = v['currency'] ? v['currency'] : '';
            let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
            let id_number = v['ID'] ? v['ID'] : '';
            let qty = v['qty'] ? v['qty'] : '';
            let unit_price = v['unit_price'] ? v['unit_price'] : '';
            let vat = v['vat'] ? v['vat'] : '';
            let remark = v['remark'] ? v['remark'] : '';
            let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
            let sys_rate_currency = v['sys_rate_currency'] ? v['sys_rate_currency'] : '';
            let data_total = qty * unit_price
            let data_incv = (data_total * (vat / 100)) + data_total
            let data_currency = data_incv * sys_rate


            arr_data = [
                job_number,
                bill_to_c,
                billing_des_name,
                data_incv,
                currency,
                data_currency,
                sys_rate,
                mbl,
                mbl,
                etd,
                vessel,
                etd,
                eta,
                create_by,
                consignee_name,
                consginee_tel,

            ]

            data_test.push(arr_data)

        })

        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(data_test), "Sheet1");

        // Save the workbook as an Excel file
        XLSX.writeFile(wb, "output.xlsx");
    },

    ajax_request_generat_report: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_res_payable/get_data_table_generate_report.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    request_data_search_filter : async function(){
        let data_bill_to =  $('.inp_data_bill_to').val()

        let data_get_type = $(`.bill_to_list_option option[value="${data_bill_to}"]`).attr('data_type')
        let data_get_row = $(`.bill_to_list_option option[value="${data_bill_to}"]`).attr('data_row')

        
        
        let data_job_number =  $('.inp_data_job_number').val()
        let currency =  $('.sel_currency').val()
        let type_date =  $('.sel_type_date').val()
        let start_date =  $('.inp_start_date').val()
        let end_date =  $('.inp_end_date').val()


        let arr_data_request = []
        let obj_data_request = {
            data_get_type : data_get_type,
            data_get_row : data_get_row,
            data_job_number : data_job_number,
            currency : currency,
            type_date : type_date,
            start_date : start_date,
            end_date : end_date,
        }
        arr_data_request.push(obj_data_request)

        // let res_data = await this.ajax_request_data_filter(arr_data_request)

    },

    ajax_request_data_filter : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_res_payable/get_data_table.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}