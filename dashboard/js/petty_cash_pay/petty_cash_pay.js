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

        var data = data_petty_cash['data_petty_cash']
        await this.setting_data_table_t(data)

    },

    setting_data_table_t: async function (data) {
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                order: [[0, 'desc']]
            });
            data.forEach(function (item) {
                var status_pay_btn = item.paid_by == null ? 
                `<button type="button" onclick="petty_cash_pay.modal_preview('${item.ID}')"  class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-save"></i> Paid</button>
                <button type="button" onclick="job_list.set_to_page_up(' + item.ID + ')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`  
                : `<button type="button" onclick="job_list.set_to_page_up(' + item.ID + ')"  class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button>`;
                var pictrue = item.img_payble == null || item.img_payble == '' ? '' : `<i class="bi bi-files" onclick="petty_cash_pay.open_pic('${item.ID}')"></i>`;
                var data_create_by = item.ufn+' '+item.uln;
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

    open_pic : async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/open_pic_withdraw.php",
                data: {data : data},
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

    modal_preview: function (val_get) {
        if ($('#add_moda').length >= 1) {
            $('#add_moda').remove()
        }
        
        console.log(val_get)

        let type_cash = '';
        
        $.each(data_petty_cash['data_petty_cash'],function(i,v){
            if(v['ID'] == val_get){
                val_id = v['ID'];
                type_cash = v['type_payble'];
                job_number = v['job_number'] ? v['job_number'] :'';
                request_by = v['ufn']+' '+v['uln'];
                datetime_request = v['create_datetime'];
                payto_payble = v['payto_payble'];
                amount_payble = v['amount_payble']+' '+v['currency_payble']


            }
        })

        
        
        html = `
        <div class="modal fade" id="add_moda"">
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
                                <select class="form-select form-select-sm">
                                    <option value="cash">Cash</option>
                                    <option value="tranfer">Tranfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">upload file: </label>
                            <div class="col-sm-9 col-md-5 col-lg-9">
                                <input type="file" class="form-control form-control-sm inp_picfile" id="imgInp">
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
                    <button type="button" class="btn btn-success" onclick="function_sub_reportcs.save_doc_image(this,'${val_get}')">Save Docs</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            
                </div>
            </div>
        </div>`

    $('body').append(html)
    $('#add_moda').modal('show')
        
    },
};
