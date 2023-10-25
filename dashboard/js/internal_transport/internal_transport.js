const internal_transport = {

    set_header_page: async function () {
        //$('.table_data_internal tbody').html('')
        //$('.inp_let_start').attr('checked',true)
    },


    add_rows_req: async function () {


        $('.table_data_internal > tbody > tr').lenght;

        let html_data_page = "";
        html_data_page = `
        <tr>
            <td>${setting_data_default.data_job_number}</td>
            <td>${setting_data_default.data_description}</td>
            <td>${setting_data_default.data_pay_to}</td>
            <td><input type="number" class="form-control form-control-sm rounded inp_qty text-center" onchange="internal_transport.cal_in_row(this)"></td>
            <td><input type="number" class="form-control form-control-sm rounded inp_price text-end" onchange="internal_transport.cal_in_row(this)"></td>
            <td><input type="number" class="form-control form-control-sm rounded inp_vat text-center" onchange="internal_transport.cal_in_row(this)"></td>
            <td><input type="text" class="form-control form-control-sm rounded inp_total_row text-end " disabled></td>
            <td><select class="form-select form-select-sm rounded inp_currency" onchange="internal_transport.cal_in_row(this)">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                </select></td>
            <td><input type="file" class="form-control form-control-sm rounded inp_data_file_internal" onchange="internal_transport.function_show_preview_pic(this)" id="fileInput"></td>
            <td><input type="text" class="form-control form-control-sm rounded inp_remark"></td>
            <td><input type="date" class="form-control form-control-sm rounded inp_operation_date"></td>
            <td>${setting_data_default.data_plate}</td>
            <td><button class="btn btn-outline-success btn-sm" onclick="internal_transport.save_data_function(this)"><i class="bi bi-save"></i> Save</button>
            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Del</button></td>
        </tr>`;
        $('.table_data_internal tbody').prepend(html_data_page)
    },

    cal_in_row: async function (e) {

        //in rows
        $('.table_data_internal > tbody > tr').each(function (i, v) {

            let data_qty = parseFloat($('.inp_qty', this).val())
            let data_price = parseFloat($('.inp_price', this).val())
            let data_vat = parseFloat($('.inp_vat', this).val())

            data_qty = isNaN(data_qty) ? 0 : data_qty;
            data_price = isNaN(data_price) ? 0 : data_price;
            data_vat = isNaN(data_vat) ? 0 : data_vat;

            let data_total_row = 0;
            data_total_row = parseFloat(data_qty * data_price) + ((data_qty * data_price) * (data_vat / 100));
            data_total_row_fix = data_total_row.toFixed(2)
            $('.inp_total_row', this).val(data_total_row_fix)
        })
        await this.cal_result();
    },

    cal_result: async function (e) {

        let thb_data = 0;
        let usd_data = 0;
        let rmb_data = 0;

        let data_currency_select = $(e).attr('data_c')
        data_currency_select = data_currency_select === undefined ? 'THB' : data_currency_select;

        $('.table_data_internal > tbody > tr').each(function (i, v) {
            let data_total = parseFloat($('.inp_total_row', this).val())
            let data_currency = $('.inp_currency', this).val()
            data_total = isNaN(data_total) ? 0 : data_total;

            if (data_currency == "THB") {
                thb_data = thb_data + data_total;
            } else if (data_currency == "USD") {
                usd_data = usd_data + data_total;
            } else if (data_currency == "RMB") {
                rmb_data = rmb_data + data_total;
            }
        })

        let thb_data_total = 0;
        let usd_data_total = 0;
        let rmb_data_total = 0;


        $('.table_data_internal > tbody > tr').each(function (i, v) {
            let data_qty = parseFloat($('.inp_qty', this).val())
            let data_price = parseFloat($('.inp_price', this).val())
            let data_currency = $('.inp_currency', this).val()
            let data_res = data_qty * data_price;
            data_res = isNaN(data_res) ? 0 : data_res;


            if (data_currency == "THB") {
                thb_data_total = thb_data + data_res;
            } else if (data_currency == "USD") {
                usd_data_total = usd_data + data_res;
            } else if (data_currency == "RMB") {
                rmb_data_total = rmb_data + data_res;
            }
        })
        // console.log(thb_data)
        // console.log(usd_data)
        // console.log(rmb_data)

        let val_usd = 0;
        let val_thb = 0;
        let val_rmb = 0;

        if (data_currency_select == "THB") {
            val_usd = 34.55;
            val_thb = 1;
            val_rmb = 4.84;
        } else if (data_currency_select == "USD") {
            val_usd = 1;
            val_thb = 0.029;
            val_rmb = 0.14;
        } else if (data_currency_select == "RMB") {
            val_usd = 7.13;
            val_thb = 0.21;
            val_rmb = 1;
        }

        // console.log(val_thb)
        // console.log(val_usd)
        // console.log(val_rmb)

        let data_currency_thb = 0;
        let data_currency_usd = 0;
        let data_currency_rmb = 0;

        let data_currency_thb_total = 0;
        let data_currency_usd_total = 0;
        let data_currency_rmb_total = 0;


        data_currency_thb = thb_data * val_thb
        data_currency_usd = usd_data * val_usd
        data_currency_rmb = rmb_data * val_rmb

        data_currency_thb_total = thb_data_total * val_thb
        data_currency_usd_total = usd_data_total * val_usd
        data_currency_rmb_total = rmb_data_total * val_rmb


        console.log(data_currency_thb)
        console.log(data_currency_usd)
        console.log(data_currency_rmb)

        console.log(data_currency_thb_total)
        console.log(data_currency_usd_total)
        console.log(data_currency_rmb_total)



        let data_res_sult = data_currency_thb + data_currency_usd + data_currency_rmb

        let data_res_sult_total = data_currency_thb_total + data_currency_usd_total + data_currency_rmb_total

        data_res_sult = data_res_sult.toFixed(2)
        data_res_sult_total = data_res_sult_total.toFixed(2)

        $('.inp_res_sub_total').val(data_res_sult)
        $('.inp_total_res').val(data_res_sult_total)



    },

    show_pic_after_get_data: async function (e) {
        let data = $(e).val();

        if ($('#show_pic').length >= 1) {
            $('#show_pic').remove();
        }

        let html = `
            <div class="modal" id="show_pic" data-bs-backdrop="false">
                <div class="modal-dialog modal-sm modal-dialog-centered" style="width: 80%; text-align: center;">
                    <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72);">
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body mx-auto">
                            <img src="${data}" alt="preview" width="500" height="600">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $('body').append(html);
        $('#show_pic').modal('show');
    },


    show_pic_save : async function(id_number){
        let res_data = await this.ajax_get_pic(id_number)

        if ($('#show_pic').length >= 1) {
            $('#show_pic').remove();
        }

        let html = `
            <div class="modal" id="show_pic" data-bs-backdrop="false">
                <div class="modal-dialog modal-sm modal-dialog-centered" style="width: 80%; text-align: center;">
                    <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72);">
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body mx-auto">
                            <img src="${res_data['picture']}" alt="preview" width="500" height="600">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $('body').append(html);
        $('#show_pic').modal('show');
    },


    ajax_get_pic : async function (id_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport/get_pic.php",
                data : {id_number : id_number},
                dataType: 'json',
                success: function (response) {
                    resolve(response)
                }
            });
        });
    },
    // show_pic_after_get_data: async function (e) {



    //     var filePath = $(e).val(); // ได้รับค่าเต็มของ path ที่มี fakepath

    //     filePath = filePath.substr(12,200)
    //     console.log(filePath)

    //     if ($('#show_pic').length >= 1) {
    //         $('#show_pic').remove();
    //     }



    //     let html = `
    //         <div class="modal" id="show_pic" data-bs-backdrop="false">
    //             <div class="modal-dialog modal-sm modal-dialog-centered" style="width: 80%; text-align: center;">
    //                 <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72);">
    //                     <div class="modal-header">
    //                         <h4 class="modal-title">Modal Heading</h4>
    //                         <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    //                     </div>
    //                     <div class="modal-body mx-auto">
    //                         <img src="${filePath}" alt="preview" width="500" height="600">
    //                     </div>
    //                     <div class="modal-footer">
    //                         <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //     `;

    //     $('body').append(html);
    //     $('#show_pic').modal('show');
    // },


    save_data_function: async function (e) {
        let arr_data = []
        let job_number = $(e).closest('tr').find('td > .sel_jobnumber').val();
        let description = $(e).closest('tr').find('td > .sel_description').val();
        let payto = $(e).closest('tr').find('td > .sel_payto').val();
        let qty = $(e).closest('tr').find('td > .inp_qty').val();
        let price = $(e).closest('tr').find('td > .inp_price').val();
        let vat = $(e).closest('tr').find('td > .inp_vat').val();
        let total = $(e).closest('tr').find('td > .inp_total_row').val();
        let currency = $(e).closest('tr').find('td > .inp_currency').val();
        let remark = $(e).closest('tr').find('td > .inp_remark').val()
        let operation = $(e).closest('tr').find('td > .inp_operation_date').val()
        let plate = $(e).closest('tr').find('td > .sel_plate').val()

        let base_64_file = $('.inp_data_file_internal').prop('files')[0];
        let type_data = base_64_file.type
        const Base_64_file = await convert_file(base_64_file);

        let data = {
            type_file : type_data,
            file : Base_64_file,
            job_number: job_number,
            description: description,
            payto: payto,
            qty: qty,
            price: price,
            vat: vat,
            total: total,
            currency: currency,
            remark: remark,
            operation: operation,
            plate: plate,
        }

        arr_data.push(data)
        console.log(arr_data)
        let res_data = await this.ajax_save_data(arr_data)


    },

    ajax_save_data : function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport/save_data_internal_transport.php",
                data: {arr_data : arr_data},
                dataType: 'json',
                success: function (response) {
                    resolve(response)
                }
            });
        });
    },


    function_show_preview_pic: async function (e) {
        let file = e.files[0];

        $('.modal').remove();
        if (file) {
            let reader = new FileReader();

            reader.onload = function (e) {
                let src = e.target.result;

                let html = `
                <div class="modal" id="show_pic" data-bs-backdrop="false">
                    <div class="modal-dialog modal-xl modal-dialog-centered" style="width: 100%; text-align: center;">
                        <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72);">
                            <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body mx-auto">
                                <div class="container">
                                    <img src="${src}" alt="preview" width="70%" height="70%">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

                $('body').append(html);
                $('#show_pic').modal('show');
            };

            reader.readAsDataURL(file);
        }
    },

    card_ex_show : async function(){
        console.log($('.card_ex_show'))
    },
}

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

