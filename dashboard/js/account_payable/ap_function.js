const ap_function = {
    search_function : async function(){
        let bill_to = $('.inp_data_bill_to').val();
        let data_job_number = $('.inp_data_job_number').val()
        let data_hbl = $('.inp_hbl').val()
        let data_container = $('.inp_container').val()
        let data_billing_code = $('.inp_billing_code').val()
        let data_start_date = $('.inp_start_date').val()
        let data_end_date = $('.inp_end_date').val()
        let data_search = $('.sel_serach').val()
        let data_sale = $('.inp_sale').val()
        let data_cs = $('.inp_cs').val()

        let data_radio_filter = $('input[name="bsradio1"]:checked').attr('id');

        let sale_data_search = $(`#sale_support_list option[value="${data_sale}"]`).attr('id_number')
        let cs_data_search = $(`#cs_support_list option[value="${data_cs}"]`).attr('id_number')
    
        let data_bill_to_serach = $(`#bill_to_list option[value="${bill_to}"]`).attr('data_id')
        let type_bill_to_serach = $(`#bill_to_list option[value="${bill_to}"]`).attr('type_data')
        let job_number_data_serach = $(`#job_number_list option[value="${data_job_number}"]`).attr('id_number')
        let hbl_data_serach = $(`#hbl_list option[value="${data_hbl}"]`).attr('id_number')
        let container_data_serach = $(`#container_list option[value="${data_container}"]`).attr('id_number')        
        let billing_data_serach = $(`#billing_code_list option[value="${data_billing_code}"]`).attr('id_number')
        
        console.log(data_radio_filter)
        console.log(data_bill_to_serach)
        console.log(type_bill_to_serach)
        console.log(job_number_data_serach)
        console.log(hbl_data_serach)
        console.log(container_data_serach)
        console.log(billing_data_serach)
        console.log(data_search)
        console.log(data_start_date)
        console.log(data_end_date)
        console.log(sale_data_search)
        console.log(cs_data_search)
        
    }
}