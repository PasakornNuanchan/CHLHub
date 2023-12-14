const function_acp = {




    filter_select: async function () {
        let oobj_data = {}
        let arr_data = []
        let data_bill_to = $('.inp_data_bill_to').val()
        let data_job_number = $('.inp_data_job_number').val()
        let data_currency = $('.sel_currency').val()
        let data_paid_action = $('.sel_paid_action').val()

        let data_type = $(`#bill_to_list option[value="${data_bill_to}"]`).attr('data_type')
        let data_id = $(`#bill_to_list option[value="${data_bill_to}"]`).attr('data_id')

        let data_job = $(`#job_number_list [value="${data_job_number}"]`).attr('real_data')

        oobj_data = {
            data_type: data_type,
            data_id: data_id,
            data_job: data_job,
            data_currency: data_currency,
            data_paid_action: data_paid_action,
        }
        arr_data.push(oobj_data)

        let res_data = await this.ajax_request_filter(arr_data)
        await first_setting.setting_data_table(res_data);
    },

    select_all: async function (e) {
        let obj_data = {}
        let arr_data = []
        $(`.table_data_account tbody tr`).each(function () {
            let check_disabled = $(this).find(`td > .cbx_sel`).prop('disabled') == false ? '1' : '0';
            // console.log(check_disabled)

            if (check_disabled == '1') {
                if (e == '1') {
                    $(this).find(`td > .cbx_sel`).prop('checked', true)
                    let id_number = $(this).attr('id_number')
                    let ref_job_id = $(this).attr('ref_job_id')

                    obj_data = {
                        id_number: id_number,
                        ref_job_id: ref_job_id,
                    }
                    arr_data.push(obj_data)

                } else {
                    $(this).find(`td > .cbx_sel`).prop('checked', false)

                }
            }
        })

        console.log(arr_data)

        if (e != '2') {


            Swal.fire({
                title: "Are you sure?",
                html: `You won't be able to revert this!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Confirm!"
            }).then(async (result) => {
                if (result.isConfirmed) {

                    // arr_data.push(obj_data)
                    console.log(arr_data)
                    let res_data = await this.ajax_data_request_paid(arr_data)
                    // let res_data = '1';
                    if (res_data == '1') {

                        $.each(arr_data, function (i, v) {
                            let id_number = v['id_number'] ? v['id_number'] : '';
                            $(`.table_data_account > tbody > .row_master_${id_number} > td > .cbx_sel`).attr({ 'disabled': true, 'checked': true })
                        })
                        Swal.fire({
                            title: "Save it!",
                            text: "Your has been saved.",
                            icon: "success"
                        });
                    } else {
                        $.each(arr_data, function (i, v) {
                            let id_number = v['id_number'] ? v['id_number'] : '';

                            $(`.table_data_account > tbody > .row_master_${id_number} > td > .cbx_sel`).attr({ 'disabled': false, 'checked': false })
                        })
                        Swal.fire({
                            title: "error!",
                            text: "Please contact to tech team ",
                            icon: "error"
                        });
                    }
                }
            });
        }

    },

    // check_paid_data: async function (e) {
    //     let id_number = $(e).closest('tr').attr('id_number')
    //     let ref_job_id = $(e).closest('tr').attr('ref_job_id')
    //     let job_number = $(e).closest('tr').find('.inp_job_no').val()
    //     let bill_to = $(e).closest('tr').find('.inp_bill_to').val()
    //     let code = $(e).closest('tr').find('.inp_code').val()
    //     let currency_can = $(e).closest('tr').find('.inp_currency_can').val()
    //     let amt_inc_can = $(e).closest('tr').find('.inp_amt_incv_can').val()

        

    //     Swal.fire({
    //         title: "Are you sure?",
    //         html: `You won't be able to revert this! <br>
    //         job number : ${job_number} <br>
    //         bill to : ${bill_to} <br>
    //         CODE : ${code} <br>
    //         amount : ${amt_inc_can} ${currency_can}
    //         `,
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3085d6",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Yes, Confirm!"
    //     }).then(async (result) => {
    //         if (result.isConfirmed) {

    //             let obj_data = {}
    //             let arr_data = []

    //             obj_data = {
    //                 id_number: id_number,
    //                 ref_job_id: ref_job_id,
    //             }
    //             arr_data.push(obj_data)
    //             let res_data = await this.ajax_data_request_paid(arr_data)
    //             if (res_data == '1') {
    //                 $(e).closest('tr').find('.cbx_sel').attr({ 'checked': true, 'disabled': true })
    //                 Swal.fire({
    //                     title: "Save it!",
    //                     text: "Your has been saved.",
    //                     icon: "success"
    //                 });
    //             } else {
    //                 // console.log(1)
    //                 $(e).closest('tr').find('.cbx_sel').attr('checked', false)
    //                 Swal.fire({
    //                     title: "error!",
    //                     text: "Please contact to tech team ",
    //                     icon: "error"
    //                 });
    //             }
    //         }else{
    //             $(e).prop('checked',false)
                
    //         }
    //     });

    // },

    // ajax_data_request_paid: async function (arr_data) {
    //     return new Promise(function (resolve, reject) {
    //         $.ajax({
    //             type: "post",
    //             url: "php/account_check_payable/payment_update.php",
    //             dataType: "json",
    //             data: {
    //                 arr_data : arr_data
    //             },
    //             success: function (res) {
    //                 resolve(res);
    //             },
    //         });
    //     });
    // },

    ajax_request_filter: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_payable/get_data_table.php",
                dataType: "json",
                data: { arr_data: arr_data },
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },



    get_data_show_expen : async function(){
        let a = $('.table_data_account > tbody > tr')
        let arr_data = []
        $.each(a,function(){
            let checked_data = $(this).closest('tr').find('.cbx_sel').prop('checked') ? '1' : '0';
            if(checked_data == '1'){
                let id_number = $(this).attr('id_number')
                let job_number = $(this).closest('tr').find('.inp_job_no').val()
                let bill_to = $(this).closest('tr').find('.inp_bill_to').val()
                let code = $(this).closest('tr').find('.inp_code').val()
                let currency = $(this).closest('tr').find('.inp_currency').val()
                
                let obj_data = {
                    id_number : id_number,
                    job_number : job_number,
                    bill_to : bill_to,
                    code : code,
                    currency : currency,
                }
                arr_data.push(obj_data)
            }
        })
        await this.modal_check_data(arr_data)

        // if(arr_data != ''){
        // }else{
        //     Swal.fire({
        //         title: "error!",
        //         text: "Please select expenses ",
        //         icon: "error"
        //     });
        // }
    },


    modal_check_data : async function(arr_data){

        if ($('#pcad_modal').length >= 1) {
            $('#pcad_modal').remove()
        }

        let html_data_detail_list = ``;
        $.each(arr_data,function(i,v){
            let id_number = v['id_number'] ? v['id_number'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let bill_to = v['bill_to'] ? v['bill_to'] : '';
            let code = v['code'] ? v['code'] : '';
            let currency = v['currency'] ? v['currency'] : '';

            html_data_detail_list += `
            <tr id_number="${id_number}">
                <td><input class="form-control form-control-sm" value="${job_number}" disabled></td>
                <td><input class="form-control form-control-sm" value="${bill_to}" disabled></td>
                <td><input class="form-control form-control-sm" value="${code}" disabled></td>
                <td><input class="form-control form-control-sm" value="${currency}" disabled></td>

            </tr>
            `;
            
        })


        html = `
        <div class="modal fade" id="pcad_modal" >
            <div class="modal-dialog modal-lg" >
                <div class="modal-content" style="width:100%; height:100%;">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Expense Processing</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="m-1 p-2 c_modal_button">
                        <button class="btn btn-sm btn-outline-primary">Confirm</button>
                        <button class="btn btn-sm btn-outline-primary" disabled>Print</button>
                        <button class="btn btn-sm btn-outline-primary" disabled>Print format setting</button>
                    </div>
                    <div class="m1 p-2 c_modal_data_detail">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>Cashing</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>Bank Chg.</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>Offset</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>Cust Code</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>Cust inv no.</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>Amount</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>Offset AMT</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>???</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-6 col-md-6 text-center"><label>prepare</label></div>
                                    <div class="col-lg-6 col-md-6 text-center"><input type="text" class="form-control form-control-sm"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="table-responsive ">
                        <table id="basic-table" class="table table-hover " name="billing-ap-tbl" role="grid" style="border-radius: 12px;">
                            <thead>
                                <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                    <th>No</th>
                                    <th>OK</th>
                                    <th>Job number</th>
                                    <th>Fee</th>
                                    <th>Settlement</th>
                                    <th>Curr.</th>
                                    <th>AP/AR Total</th>
                                    <th>Outstanding</th>
                                    <th>Settlement</th>
                                    <th>Actual ex.rate</th>
                                    <th>Actual currency</th>
                                    <th>Curr.</th>
                                    <th>Annotated</th>
                                    <th>Vat%</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                        </div>
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="billing_ap.import_save_data()">import</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>`

        $('body').append(html)
        $('#pcad_modal').modal('show')
    },
}

