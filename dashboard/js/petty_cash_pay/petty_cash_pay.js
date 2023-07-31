const petty_cash_pay = {

    set_header_page: async function (job_number) {
        $('.head-of-menu').html('Petty Cash Pay');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="petty_cash_pay.php" target="" style="color:white;">Petty Cash Pay list</a></li>
        `;
        $('.bcpage').append(html_bdpage);


        data_petty_cash = await this.ajax_request_table();
        console.log(data_petty_cash)

        var data_pay = data_petty_cash['data_pay'];
        var data_pettycash = data_petty_cash['data_petty_cash'];
        var data_advancecash = data_petty_cash['data_advance_cash'];

        await this.setting_data_table_pay(data_pay)
        await this.setting_data_table_pettycash(data_pettycash)
        await this.setting_data_table_advancecash(data_advancecash)
        await this.setting_data_table_return_petty_cash(data_pettycash)

        let res_data = await this.ajax_get_permission();
        console.log(res_data)

        if(res_data['data_permission']['payble'] == "2"){

        }else if(res_data['data_permission']['payble'] == "3"){
            $('#payble').remove()
            $('#payble_tab_target').remove()
        } 

        if(res_data['data_permission']['advance'] == "2"){
            
        }else if(res_data['data_permission']['advance'] == "3"){
            $('#advancecash').remove()
            $('#advancecash_tab_target').remove()
        }

        if(res_data['data_permission']['pettycash'] == "2"){
            
        }else if(res_data['data_permission']['pettycash'] == "3"){
            $('#pettycash').remove()
            $('#pettycash_tab_target').remove()
        }

        if(res_data['data_permission']['returnpettycash'] == "2"){
            
        }else if(res_data['data_permission']['returnpettycash'] == "3"){
            $('#returnpettycash').remove()
            $('#returnpettycash_tab_target').remove()
        }

        $('.head_menu').eq(0).addClass('active')
        $('.menu_tab').eq(0).addClass('show')
        $('.menu_tab').eq(0).addClass('active')
    },


    ajax_get_permission: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty_cash_pay/get_permission_cash.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    setting_data_table_pay: async function (data) {
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                order: [[0, 'desc']]
            });
            data.forEach(function (item) {
                var status_pay_btn = item.paid_by == null ?
                    `<button type="button" onclick="petty_cash_pay.modal_pay_paid('${item.ID}','pay')"  class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-save"></i> Paid</button>
                <button type="button" onclick="petty_cash_pay.modal_pay_preview('${item.ID}','pay')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`
                    : `<button type="button" onclick="petty_cash_pay.modal_pay_preview('${item.ID}','pay')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`;
                var pictrue = item.img_payble == null || item.img_payble == '' ? '' : `<i class="bi bi-files" onclick="petty_cash_pay.open_pic('${item.ID}')"></i>`;
                var data_create_by = item.ufn + ' ' + item.uln;
                var status_pay = item.paid_by == null ? '<span class="badge rounded-pill bg-danger" >Unpiad</span>' : '<span class="badge rounded-pill bg-success">Paid</span>';
                var data_amount = item.amount_payble

                table.row.add([
                    item.create_datetime,
                    item.job_number,
                    item.type_payble,
                    item.payto_payble,
                    item.description_payble,
                    data_amount,
                    item.currency_payble,
                    pictrue,
                    data_create_by,
                    status_pay,
                    status_pay_btn
                ]).draw();
            });
        });
    },

    setting_data_table_pettycash: async function (data) {
        $(document).ready(function () {
            var table = $('#myTablept').DataTable({
                order: [[0, 'desc']]
            });
            data.forEach(function (item) {
                var status_pay_btn = item.tranfer_by == null ?
                    `<button type="button" onclick="petty_cash_pay.modal_petty_cash_paid('${item.ID}')"  class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-save"></i> Paid</button>
                <button type="button" onclick="petty_cash_pay.modal_petty_cash_preview('${item.ID}')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`
                    : `<button type="button" onclick="petty_cash_pay.modal_petty_cash_preview('${item.ID}')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`;
                // var pictrue = item.img_payble == null || item.img_payble == '' ? '' : `<i class="bi bi-files" onclick="petty_cash_pay.open_pic('${item.ID}')"></i>`;
                // var data_create_by = item.ufn + ' ' + item.uln;
                var status_pay = item.tranfer_by == null ? '<span class="badge rounded-pill bg-danger" >Unpiad</span>' : '<span class="badge rounded-pill bg-success">Paid</span>';
                // var data_amount = item.amount_payble

                var user_rrequest = item.first_name == null ? '' : item.first_name + ' ' + item.last_name;
                table.row.add([
                    item.datetime_request,
                    item.petty_cash_number,
                    user_rrequest,
                    status_pay,
                    status_pay_btn
                ]).draw();
            });
        });
    },

    setting_data_table_return_petty_cash: async function (data) {
        $(document).ready(function () {
            var table = $('#myTablere').DataTable({
                order: [[0, 'desc']]
            });
            data.forEach(function (item) {
                var status_pay_btn = item.return_payment_by == null ?
                    `<button type="button" onclick="petty_cash_pay.modal_return_paid('${item.ID}')"  class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-save"></i> Paid</button>
                <button type="button" onclick="petty_cash_pay.modal_return_petty_cash_preview('${item.ID}')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`
                    : `<button type="button" onclick="petty_cash_pay.modal_return_petty_cash_preview('${item.ID}')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`;
                // var pictrue = item.img_payble == null || item.img_payble == '' ? '' : `<i class="bi bi-files" onclick="petty_cash_pay.open_pic('${item.ID}')"></i>`;
                // var data_create_by = item.ufn + ' ' + item.uln;
                var status_pay = item.return_payment_by == null ? '<span class="badge rounded-pill bg-danger" >Unpiad</span>' : '<span class="badge rounded-pill bg-success">Paid</span>';
                // var data_amount = item.amount_payble

                var user_rrequest = item.first_name == null ? '' : item.first_name + ' ' + item.last_name;
                table.row.add([
                    item.datetime_request,
                    item.petty_cash_number,
                    user_rrequest,
                    status_pay,
                    status_pay_btn
                ]).draw();
            });
        });
    },

    setting_data_table_advancecash: async function (data) {
        $(document).ready(function () {
            var table = $('#myTablead').DataTable({
                order: [[0, 'desc']]
            });

            data.forEach(function (item) {
                var status_pay_btn = item.paid_by == null ?
                    `<button type="button" onclick="petty_cash_pay.modal_pay_paid('${item.ID}','ad')"  class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-save"></i> Paid</button>
                <button type="button" onclick="petty_cash_pay.modal_pay_preview('${item.ID}','ad')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`
                    : `<button type="button" onclick="petty_cash_pay.modal_pay_preview('${item.ID}','ad')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`;
                var pictrue = item.img_payble == null || item.img_payble == '' ? '' : `<i class="bi bi-files" onclick="petty_cash_pay.open_pic('${item.ID}')"></i>`;
                var data_create_by = item.ufn + ' ' + item.uln;
                var status_pay = item.paid_by == null ? '<span class="badge rounded-pill bg-danger" >Unpiad</span>' : '<span class="badge rounded-pill bg-success">Paid</span>';
                var data_amount = item.amount_payble

                table.row.add([
                    item.create_datetime,
                    item.job_number,
                    item.type_payble,
                    item.payto_payble,
                    item.description_payble,
                    data_amount,
                    item.currency_payble,
                    pictrue,
                    data_create_by,
                    status_pay,
                    status_pay_btn
                ]).draw();
            });
        });
    },


    get_data_save_petty_cash: async function (e) {
        let data_pay = $('.inp_pay_data').val()
        let data_id = $(e).closest('#add_moda').attr('data_id')

        let base_64_file = $('.inp_picfile').prop('files')[0];
        let file_con = '';
        if (base_64_file != undefined) {
            file_con = await convert_file(base_64_file);
        }

        let arr_data = []
        let data_obj = {
            data_id: data_id,
            data_pay: data_pay,
            data_file: file_con
        }
        arr_data.push(data_obj)

        let res_data_save = await this.ajax_save_data_petty_cash(arr_data);

        if (res_data_save == '1') {
            await Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        } else {
            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })
        }

        location.reload();
    },

    ajax_save_data_petty_cash: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty_cash_pay/save_cash_pettycash.php",
                data: { arr_data: arr_data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    get_data_for_save: async function (e) {
        let data_pay = $('.inp_pay_data').val()
        let data_id = $(e).closest('#add_moda').attr('data_id')

        let base_64_file = $('.inp_picfile').prop('files')[0];
        let file_con = '';
        if (base_64_file != undefined) {
            file_con = await convert_file(base_64_file);
        }

        let arr_data = []
        let data_obj = {
            data_id: data_id,
            data_pay: data_pay,
            data_file: file_con
        }

        arr_data.push(data_obj)

        let res_data_save = await this.ajax_save_data(arr_data);

        if (res_data_save == '1') {
            await Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        } else {
            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })
        }

        location.reload();
        // var currentURL = window.location.href;
        // var url = new URL(currentURL);
        // var id_number = url.searchParams.get("job_number");
        // await petty_cash_pay.set_header_page(id_number)
    },

    ajax_save_data: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty_cash_pay/save_cash_pay.php",
                data: { arr_data: arr_data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_request_table: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty_cash_pay/petty_cash_pay_get_detail.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    open_paid_petty_cash: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty_cash_pay/open_pic_petty_cash.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

    open_pic: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/open_pic_withdraw.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },
    open_pay: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty_cash_pay/open_pic_withdraw_paid.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

    open_paid_return_petty_cash : async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty_cash_pay/open_pic_return_petty_cash.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

    modal_pay_paid: function (val_get, type_s) {
        if ($('#add_moda').length >= 1) {
            $('#add_moda').remove()
        }

        let val_id_i = '';
        let type_cash = '';
        let job_number = '';
        let request_by = '';
        let datetime_request = '';
        let payto_payble = '';
        let amount_payble = '';


        if (type_s == 'pay') {
            $.each(data_petty_cash['data_pay'], function (i, v) {
                if (v['ID'] == val_get) {
                    val_id_i = v['ID'];
                    type_cash = v['type_payble'];
                    job_number = v['job_number'] ? v['job_number'] : '';
                    request_by = v['ufn'] + ' ' + v['uln'];
                    datetime_request = v['create_datetime'];
                    payto_payble = v['payto_payble'];
                    amount_payble = v['amount_payble'] + ' ' + v['currency_payble'];

                }
            })
        } else if (type_s == 'ad') {
            $.each(data_petty_cash['data_advance_cash'], function (i, v) {
                if (v['ID'] == val_get) {
                    val_id_i = v['ID'];
                    type_cash = v['type_payble'];
                    job_number = v['job_number'] ? v['job_number'] : '';
                    request_by = v['ufn'] + ' ' + v['uln'];
                    datetime_request = v['create_datetime'];
                    payto_payble = v['payto_payble'];
                    amount_payble = v['amount_payble'] + ' ' + v['currency_payble'];

                }
            })
        }


        html = `
        <div class="modal fade" id="add_moda" data_id=${val_id_i}>
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">${type_cash}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body ">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Job number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${job_number}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request By: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${request_by}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request Datetime: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${datetime_request}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">photo document: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <button class="btn btn-outline-secondary" onclick="petty_cash_pay.open_pic('${val_id_i}')"><i class="bi bi-files"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay to: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${payto_payble}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank name: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Amount: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${amount_payble}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay : </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <select class="form-select form-select-sm inp_pay_data">
                                    <option value="cash">Cash</option>
                                    <option value="tranfer">Tranfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">upload file: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="file" id="imgInp" class="form-control form-control-sm inp_picfile" >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 text-center mx-auto">
                            <div class="bd-example">
                                <img id="blah" style="width:300px;height:300px;border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" class="bg-secondary" />
                            </div>
                        </div>
                        
                        
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="petty_cash_pay.get_data_for_save(this)">Save Docs</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            
                </div>
            </div>
        </div>

        <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result).css({
                        "width": "300px",
                        "height": "400px"
                    });
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            console.log('33333')
            readURL(this);
        });
    </script>
`;
        $('body').append(html)
        $('#add_moda').modal('show')

    },

    modal_petty_cash_paid: function (val_get) {
        if ($('#add_moda').length >= 1) {
            $('#add_moda').remove()
        }
        let petty_cash_number = '';
        let request_by = '';
        let datetime_request = '';
        let tranfer_bank_number = '';
        let tranfer_bank_name = '';
        let tranfer_method = '';
        let html_detail = '';
        let amount_all = 0;
        let data_currency = '';

        $.each(data_petty_cash['data_petty_cash'], function (i, v) {
            if (v['ID'] == val_get) {
                petty_cash_number = v['petty_cash_number'] ? v['petty_cash_number'] : '';
                request_by = v['first_name'] ? v['first_name'] + ' ' + v['last_name'] : '';
                datetime_request = v['datetime_request'] ? v['datetime_request'] : '';
                tranfer_bank_number = v['tranfer_bank_number'] ? v['tranfer_bank_number'] : '';
                tranfer_bank_name = v['tranfer_bank_name'] ? v['tranfer_bank_name'] : '';
                tranfer_method = v['tranfer_method'] ? v['tranfer_method'] : '';

                $.each(data_petty_cash['arr_get_detail_petty_cash'][v['petty_cash_number']], function (i1, v1) {
                    i1++;
                    let data_amount = v1['amount'] ? v1['amount'] : '';
                    data_currency = v1['currency'] ? v1['currency'] : '';
                    let job_number_main = v1['job_number_main'] ? v1['job_number_main'] : '';
                    amount_all = parseFloat(amount_all) + parseFloat(data_amount)
                    html_detail += `
                
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">Job No.${i1}:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <input type="text" class="form-control form-control-sm" value="${job_number_main}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">amount : </label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <input type="text" class="form-control form-control-sm" value="${data_amount + ' ' + data_currency}" disabled>
                    </div>
                </div>
                `;
                })

            }
        })



        html = `
        <div class="modal fade" id="add_moda" data_id=${val_get}>
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Petty Cash</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body ">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Petty cash number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${petty_cash_number}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request By: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${request_by}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request Datetime: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${datetime_request}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_bank_number}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank name: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_bank_name}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Amount: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${amount_all + ' ' + data_currency}" disabled>
                            </div>
                        </div>
                        <hr>
                        ${html_detail}
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay : </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <select class="form-select form-select-sm inp_pay_data">
                                    <option value="cash">Cash</option>
                                    <option value="tranfer">Tranfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">upload file: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="file" id="imgInp" class="form-control form-control-sm inp_picfile" >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 text-center mx-auto">
                            <div class="bd-example">
                                <img id="blah" style="width:300px;height:300px;border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" class="bg-secondary" />
                            </div>
                        </div>
                        
                        
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="petty_cash_pay.get_data_save_petty_cash(this)">Save Docs</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            
                </div>
            </div>
        </div>

        <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result).css({
                        "width": "300px",
                        "height": "400px"
                    });
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            console.log('33333')
            readURL(this);
        });
    </script>
`;
        $('body').append(html)
        $('#add_moda').modal('show')

    },

    modal_petty_cash_preview: function (val_get) {
        if ($('#add_moda').length >= 1) {
            $('#add_moda').remove()
        }
        let petty_cash_number = '';
        let request_by = '';
        let datetime_request = '';
        let tranfer_bank_number = '';
        let tranfer_bank_name = '';
        let tranfer_method = '';
        let html_detail = '';
        let amount_all = 0;
        let data_currency = '';

        $.each(data_petty_cash['data_petty_cash'], function (i, v) {
            if (v['ID'] == val_get) {
                petty_cash_number = v['petty_cash_number'] ? v['petty_cash_number'] : '';
                request_by = v['first_name'] ? v['first_name'] + ' ' + v['last_name'] : '';
                datetime_request = v['datetime_request'] ? v['datetime_request'] : '';
                tranfer_bank_number = v['tranfer_bank_number'] ? v['tranfer_bank_number'] : '';
                tranfer_bank_name = v['tranfer_bank_name'] ? v['tranfer_bank_name'] : '';
                tranfer_method = v['tranfer_method'] ? v['tranfer_method'] : '';

                $.each(data_petty_cash['arr_get_detail_petty_cash'][v['petty_cash_number']], function (i1, v1) {
                    i1++;
                    let data_amount = v1['amount'] ? v1['amount'] : '';
                    data_currency = v1['currency'] ? v1['currency'] : '';
                    let job_number_main = v1['job_number_main'] ? v1['job_number_main'] : '';
                    amount_all = parseFloat(amount_all) + parseFloat(data_amount)
                    html_detail += `
                
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">Job No.${i1}:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <input type="text" class="form-control form-control-sm" value="${job_number_main}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">amount : </label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <input type="text" class="form-control form-control-sm" value="${data_amount + ' ' + data_currency}" disabled>
                    </div>
                </div>
                `;
                })

            }
        })



        html = `
        <div class="modal fade" id="add_moda" data_id=${val_get}>
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Petty Cash</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body ">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Petty cash number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${petty_cash_number}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request By: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${request_by}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request Datetime: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${datetime_request}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_bank_number}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank name: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_bank_name}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Amount: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${amount_all + ' ' + data_currency}" disabled>
                            </div>
                        </div>
                        <hr>
                        ${html_detail}
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay : </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_method}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">picture file: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <button class="btn btn-outline-secondary" onclick="petty_cash_pay.open_paid_petty_cash('${val_get}')"><i class="bi bi-files"></i></button>
                            </div>
                        </div>
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            
                </div>
            </div>
        </div>
`;
        $('body').append(html)
        $('#add_moda').modal('show')

    },

    modal_pay_preview: function (val_get, type_s) {
        if ($('#add_moda').length >= 1) {
            $('#add_moda').remove()
        }
        let val_id = '';
        let type_cash = '';
        let job_number = '';
        let request_by = '';
        let datetime_request = '';
        let payto_payble = '';
        let amount_payble = '';
        let paid_by = '';
        let datetime_paid = '';
        let type_pay = '';
        let bnb = '';
        let bbn = '';

        if (type_s == "pay") {
            $.each(data_petty_cash['data_pay'], function (i, v) {
                if (v['ID'] == val_get) {
                    val_id = v['ID'];
                    type_cash = v['type_payble'];
                    job_number = v['job_number'] ? v['job_number'] : '';
                    request_by = v['ufn'] + ' ' + v['uln'];
                    datetime_request = v['create_datetime'];
                    payto_payble = v['payto_payble'];
                    amount_payble = v['amount_payble'] + ' ' + v['currency_payble']
                    paid_by = v['u1fn'] ? v['u1fn'] + ' ' + v['u1ln'] : '';
                    datetime_paid = v['datetime_paid'] ? v['datetime_paid'] : '';
                    type_pay = v['type_pay'] ? v['type_pay'] : '';
                }
            })
        } else if (type_s == "pt") {
            $.each(data_petty_cash['data_petty_cash'], function (i, v) {
                if (v['ID'] == val_get) {
                    val_id = v['ID'];
                    type_cash = v['type_payble'];
                    job_number = v['job_number'] ? v['job_number'] : '';
                    request_by = v['ufn'] + ' ' + v['uln'];
                    datetime_request = v['create_datetime'];
                    payto_payble = v['payto_payble'];
                    amount_payble = v['amount_payble'] + ' ' + v['currency_payble']
                    paid_by = v['u1fn'] ? v['u1fn'] + ' ' + v['u1ln'] : '';
                    datetime_paid = v['datetime_paid'] ? v['datetime_paid'] : '';
                    type_pay = v['type_pay'] ? v['type_pay'] : '';

                }
            })
        } else if (type_s == "ad") {
            $.each(data_petty_cash['data_advance_cash'], function (i, v) {
                if (v['ID'] == val_get) {
                    val_id = v['ID'];
                    type_cash = v['type_payble'];
                    job_number = v['job_number'] ? v['job_number'] : '';
                    request_by = v['ufn'] + ' ' + v['uln'];
                    datetime_request = v['create_datetime'];
                    payto_payble = v['payto_payble'];
                    amount_payble = v['amount_payble'] + ' ' + v['currency_payble']
                    paid_by = v['u1fn'] ? v['u1fn'] + ' ' + v['u1ln'] : '';
                    datetime_paid = v['datetime_paid'] ? v['datetime_paid'] : '';
                    type_pay = v['type_pay'] ? v['type_pay'] : '';
                    bbn = v['bbn'] ? v['bbn'] : '';
                    bnb = v['bnb'] ? v['bnb'] : '';
                }
            })
        }


        html = `
        <div class="modal fade" id="add_moda" data_id=${val_id}>
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">${type_cash}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body ">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Job number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${job_number}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request By: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${request_by}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request Datetime: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${datetime_request}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">photo document: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <button class="btn btn-outline-secondary" onclick="petty_cash_pay.open_pic('${val_id}')"><i class="bi bi-files"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay to: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${payto_payble}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${bnb}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank name: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${bbn}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Amount: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${amount_payble}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay : </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input class="form-control form-control-sm" value="${type_pay}" disabled>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">upload file: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                            <button class="btn btn-outline-secondary" onclick="petty_cash_pay.open_pay('${val_id}')"><i class="bi bi-files"></i></button>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Paid by: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="input" class="form-control form-control-sm " value="${paid_by}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Paid Datetime: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="input" class="form-control form-control-sm " value="${datetime_paid}" disabled>
                            </div>
                        </div>
                        
                        
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            
                </div>
            </div>
        </div>
`;

        $('body').append(html)
        $('#add_moda').modal('show')

    },

    modal_return_paid: function (val_get) {
        if ($('#add_moda').length >= 1) {
            $('#add_moda').remove()
        }
        let petty_cash_number = '';
        let request_by = '';
        let datetime_request = '';
        let tranfer_bank_number = '';
        let tranfer_bank_name = '';
        let tranfer_method = '';
        let html_detail = '';
        let amount_all = 0;
        let data_currency = '';

        let cash_all = 0;
        let cash_use = 0;
        $.each(data_petty_cash['data_petty_cash'], function (i, v) {
            if (v['ID'] == val_get) {
                petty_cash_number = v['petty_cash_number'] ? v['petty_cash_number'] : '';
                request_by = v['first_name'] ? v['first_name'] + ' ' + v['last_name'] : '';
                datetime_request = v['datetime_request'] ? v['datetime_request'] : '';
                // tranfer_bank_number = v['tranfer_bank_number'] ? v['tranfer_bank_number'] : '';
                // tranfer_bank_name = v['tranfer_bank_name'] ? v['tranfer_bank_name'] : '';
                tranfer_method = v['tranfer_method'] ? v['tranfer_method'] : '';

                $.each(data_petty_cash['arr_get_detail_petty_cash'][v['petty_cash_number']], function (i1, v1) {
                    let html_detail_useage = '';
                    $.each(data_petty_cash['arr_get_detail_petty_cash_usage'][v1['ID']], function (i2, v2) {
                        i2++;
                        let payto_payble = v2['payto_payble'] ? v2['payto_payble'] : '';
                        let description_payble = v2['description_payble'] ? v2['description_payble'] : '';
                        let amount_payble = v2['amount_payble'] ? v2['amount_payble'] : '';
                        cash_use = parseFloat(cash_use) + parseFloat(amount_payble)
                        let currency_payble = v2['currency_payble'] ? v2['currency_payble'] : '';
                        html_detail_useage += `
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay to No. ${i2}:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${payto_payble}" disabled>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${description_payble}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">Amount No ${i2}:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${amount_payble}" disabled>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${currency_payble}" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                    `;
                    })

                    i1++;
                    let data_amount = v1['amount'] ? v1['amount'] : '';
                    cash_all = parseFloat(cash_all) + parseFloat(data_amount)
                    data_currency = v1['currency'] ? v1['currency'] : '';
                    let job_number_main = v1['job_number_main'] ? v1['job_number_main'] : '';
                    amount_all = parseFloat(amount_all) + parseFloat(data_amount)
                    html_detail += `
                
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request No.${i1}:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${job_number_main}" disabled>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${data_amount + ' ' + data_currency}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                ${html_detail_useage}
                `;
                })

            }
        })

        cash_all = cash_all - cash_use

        html = `
        <div class="modal fade" id="add_moda" data_id=${val_get}>
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Return Petty Cash</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body ">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Petty cash number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${petty_cash_number}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request By: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${request_by}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request Datetime: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${datetime_request}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_bank_number}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank name: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_bank_name}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Cash return: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" value="${cash_all}" disabled>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" value="${data_currency}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay : </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <select class="form-select form-select-sm inp_pay_data">
                                    <option value="cash">Cash</option>
                                    <option value="tranfer">Tranfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">upload file: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="file" id="imgInp" class="form-control form-control-sm inp_picfile" >
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 text-center mx-auto">
                            <div class="bd-example">
                                <img id="blah" style="width:300px;height:300px;border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" class="bg-secondary" />
                            </div>
                        </div>
                        <hr>
                        <h5 class="mt-4 mb-3">Petty cash request</h5>
                        ${html_detail}
                        <hr>
                        
                        
                        
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="petty_cash_pay.get_data_save_return(this)">Save Docs</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            
                </div>
            </div>
        </div>

        <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result).css({
                        "width": "300px",
                        "height": "400px"
                    });
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            console.log('33333')
            readURL(this);
        });
    </script>
`;
        $('body').append(html)
        $('#add_moda').modal('show')

    },

    modal_return_petty_cash_preview: function (val_get) {


        if ($('#add_moda').length >= 1) {
            $('#add_moda').remove()
        }
        let petty_cash_number = '';
        let request_by = '';
        let datetime_request = '';
        let tranfer_bank_number = '';
        let tranfer_bank_name = '';
        let tranfer_method = '';
        let html_detail = '';
        let amount_all = 0;
        let data_currency = '';

        let cash_all = 0;
        let cash_use = 0;
        $.each(data_petty_cash['data_petty_cash'], function (i, v) {
            if (v['ID'] == val_get) {
                petty_cash_number = v['petty_cash_number'] ? v['petty_cash_number'] : '';
                request_by = v['first_name'] ? v['first_name'] + ' ' + v['last_name'] : '';
                datetime_request = v['datetime_request'] ? v['datetime_request'] : '';
                // tranfer_bank_number = v['tranfer_bank_number'] ? v['tranfer_bank_number'] : '';
                // tranfer_bank_name = v['tranfer_bank_name'] ? v['tranfer_bank_name'] : '';
                tranfer_method = v['return_payment_method'] ? v['return_payment_method'] : '';

                $.each(data_petty_cash['arr_get_detail_petty_cash'][v['petty_cash_number']], function (i1, v1) {
                    let html_detail_useage = '';
                    $.each(data_petty_cash['arr_get_detail_petty_cash_usage'][v1['ID']], function (i2, v2) {
                        i2++;
                        let payto_payble = v2['payto_payble'] ? v2['payto_payble'] : '';
                        let description_payble = v2['description_payble'] ? v2['description_payble'] : '';
                        let amount_payble = v2['amount_payble'] ? v2['amount_payble'] : '';
                        cash_use = parseFloat(cash_use) + parseFloat(amount_payble)
                        let currency_payble = v2['currency_payble'] ? v2['currency_payble'] : '';
                        html_detail_useage += `
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay to No. ${i2}:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${payto_payble}" disabled>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${description_payble}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">Amount No ${i2}:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${amount_payble}" disabled>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${currency_payble}" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                    `;
                    })

                    i1++;
                    let data_amount = v1['amount'] ? v1['amount'] : '';
                    cash_all = parseFloat(cash_all) + parseFloat(data_amount)
                    data_currency = v1['currency'] ? v1['currency'] : '';
                    let job_number_main = v1['job_number_main'] ? v1['job_number_main'] : '';
                    amount_all = parseFloat(amount_all) + parseFloat(data_amount)
                    html_detail += `
                
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request No.${i1}:</label>
                    <div class="col-sm-9 col-md-5 col-lg-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${job_number_main}" disabled>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" value="${data_amount + ' ' + data_currency}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                ${html_detail_useage}
                `;
                })

            }
        })

        cash_all = cash_all - cash_use

        html = `
        <div class="modal fade" id="add_moda" data_id=${val_get}>
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Return Petty Cash</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body ">
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Petty cash number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${petty_cash_number}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request By: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${request_by}"disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Request Datetime: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${datetime_request}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank number: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_bank_number}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Bank name: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_bank_name}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Cash return: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" value="${cash_all}" disabled>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" value="${data_currency}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Pay method: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="text" class="form-control form-control-sm" value="${tranfer_method}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">upload file: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <button class="btn btn-outline-secondary" onclick="petty_cash_pay.open_paid_return_petty_cash('${val_get}')"><i class="bi bi-files"></i></button>
                            </div>
                        </div>
                        <hr>
                        <h5 class="mt-4 mb-3">Petty cash request</h5>
                        ${html_detail}
                        <hr>
                        
                        
                        
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            
                </div>
            </div>
        </div>
`;
        $('body').append(html)
        $('#add_moda').modal('show')

    },

    get_data_save_return: async function (e) {
        let data_pay = $('.inp_pay_data').val()
        let data_id = $(e).closest('#add_moda').attr('data_id')

        let base_64_file = $('.inp_picfile').prop('files')[0];
        let file_con = '';
        if (base_64_file != undefined) {
            file_con = await convert_file(base_64_file);
        }

        let arr_data = []
        let data_obj = {
            data_id: data_id,
            data_pay: data_pay,
            data_file: file_con
        }

        arr_data.push(data_obj)

        let res_data_save = await this.ajax_save_data(arr_data);

        if (res_data_save == '1') {
            await Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        } else {
            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System has problem plese contact to thailand tech team ',
            })
        }

        location.reload();

    },

    ajax_save_return_petty_cash: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty_cash_pay/save_cash_return_petty_cash.php",
                data: { arr_data: arr_data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

};





async function convert_file(data) {

    const base64String = await toBase64(data);
    return (base64String);
}

function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}