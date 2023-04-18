var PDF_REMARK = '';
const quartation_markup = {
    get_quono: '',

    init: async function (e = null) {
        await quartation_markup.html_consignee();
        quartation_markup.check_get();
    },
    ajax_get_consingee: function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: 'post',
                url: 'php/Ajax_select/get_consignee.php',
                data: {},
                dataType: 'json',
                success: function (res) {
                    resolve(res)
                },
            })
        })
    },
    html_consignee: async function (data) {
        let res = await quartation_markup.ajax_get_consingee()
        let html = ''
        $.each(res, function (i, k) {
            html += `<option value="${k['ID']}">${k['consignee_name']}</option>`
        })
        $('.sel_consignee').html(html)
    },
    check_get: function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=')

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined
                        ? true
                        : decodeURIComponent(sParameterName[1])
                }
            }
            return false
        }
        let get_quo = getUrlParameter('quartation_number')
        quartation_markup.get_quono = getUrlParameter('quartation_number')
        let get_action = getUrlParameter('action')

        let quartation_number = get_quo == false ? null : get_quo
        let action = get_action == false ? null : get_action

        if (action == 'preview') {
            quartation_markup.set_preview_data(quartation_number)
        } else {
        }
    },
    set_preview_data: async function (quartation_number = null) {
        let res = await quartation_markup.ajax_get_preview_data(quartation_number);
        await this.html_shipment()
        console.log(res);
        let title = res['title'];
        let quo_no = title['title_number'];
        let commodity = title['title_commodity'];
        let consign_no = title['title_consignee_number'];
        let st = title['title_status'];
        let term = title['title_term'];
        let type = title['title_type'];
        let title_user_sale = title['fname'];
        let title_user_sale_l = title['lname'];
        $('.inp_quono').val(quo_no);
        st = st == 1 ? 'sign' : 'waiting sign'

        $('.inp_sign_st').val(st);
        $('.inp_commodity').val(commodity);
        $('.sel_consignee').val(consign_no);
        $('.sel_title_type').val(type);
        $('.inp_sale_user').val(title_user_sale+" "+title_user_sale_l);
        $('.sel_term').val(term);

        let num = 0
        $.each(res['base'], function (i, v) {
            let text_remark = v['r_remark'] === "" ? v['r_container_type'] : v['r_remark'];
            num += 1;
            html = `
                <tr class="booking_container" data_id='${v['ID']}' data_set="base">
                    <td align="center">${num}</td>
                    <td><input type="input" class="form-control form-control-sm" readonly 
                        title="${v['r_carrier_name'] + ' : ' + v['locateL'] + ' -> ' + v['locateD']}" 
                        value="${v['r_carrier_name'] + ' : ' + v['locateL'] + ' -> ' + v['locateD']}"></td>
                    <td><select name="" id="" class="form-select form-select-sm sel_base_type" disabled>
                            <option value="">Plese select type</option>
                            <option value="Import">Import</option>
                            <option value="Export"selected>Export</option>
                            <option value="Other">Other service</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_base_price inp_price" id="" readonly></td>
                    <td><select name="" class="form-select form-select-sm sel_base_curr sel_curr" id="" disabled>
                            <option value="THB">THB</option>
                            <option value="USD">USD</option>
                            <option value="RMB">RMB</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_remark" id=""></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_price"></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_result" readonly></td>
                </tr>
            `;
            $('.tbl_service_desc tbody').append(html);
            $('.tbl_service_desc tbody tr:last').find('.sel_base_type').val();
            $('.tbl_service_desc tbody tr:last').find('.inp_base_price').val(v['price_qty']);
            $('.tbl_service_desc tbody tr:last').find('.sel_base_curr').val(v['r_curr']);
            $('.tbl_service_desc tbody tr:last').find('.inp_remark').val(text_remark);
            $('.tbl_service_desc tbody tr:last').find('.inp_markup_price').val(v['r_markup']);
            $('.tbl_service_desc tbody tr:last').find('.inp_markup_result').val(parseFloat(v['price_qty'] + v['r_markup']));

        });

        //truck
        $.each(res['truck'], function (i, v) {
            if (v['type'] == 'import') {
                c_type = 'Import'
            } else if (v['type'] == 'export') {
                c_type = 'Export'
            }
            num += 1;
            html = `
                <tr class="booking_container" data_id='${v['ID']}' data_set="truck">
                    <td align="center">${num}</td>
                    <td><input type="input" class="form-control form-control-sm" readonly 
                        title="${'Truck (' + c_type + ') ' + v['pickup'] + ' -> ' + v['dropoff']}" 
                        value="${'Truck (' + c_type + ') ' + v['pickup'] + ' -> ' + v['dropoff']}"></td>
                    <td><select name="" id="" class="form-select form-select-sm sel_truck_type" disabled>
                    <option value="">Plese select type</option>
                    <option value="Import">Import</option>
                    <option value="Export"selected>Export</option>
                    <option value="Other">Other service</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_truck_price inp_price" id="" readonly></td>
                    <td><select name="" class="form-select form-select-sm sel_truck_curr sel_curr" id="" disabled>
                            <option value="THB">THB</option>
                            <option value="USD">USD</option>
                            <option value="RMB">RMB</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_remark" id=""></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_price"></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_result" readonly></td>
                </tr>
            `;
            $('.tbl_service_desc tbody').append(html);
            $('.tbl_service_desc tbody tr:last').find('.sel_truck_type').val(c_type);
            $('.tbl_service_desc tbody tr:last').find('.inp_truck_price').val(v['price']);
            $('.tbl_service_desc tbody tr:last').find('.sel_truck_curr').val(v['currency']);
            $('.tbl_service_desc tbody tr:last').find('.inp_remark').val(v['remark']);
            $('.tbl_service_desc tbody tr:last').find('.inp_markup_price').val(v['markup']);
            $('.tbl_service_desc tbody tr:last').find('.inp_markup_result').val(parseFloat(v['price'] + v['markup']));


        });

        //sup
        $.each(res['sup_service'], function (i, v) {
            num += 1;
            html = `
                <tr class="booking_container" data_id='${v['ID']}' data_set="sup">
                    <td align="center">${num}</td>
                    <td><input type="input" class="form-control form-control-sm" readonly 
                        title="${v['description']}" 
                        value="${v['description']}"></td>
                    <td><select name="" id="" class="form-select form-select-sm sel_sup_type" disabled>
                    <option value="">Plese select type</option>
                    <option value="Import">Import</option>
                    <option value="Export"selected>Export</option>
                    <option value="Other">Other service</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_sup_price inp_price" id="" readonly></td>
                    <td><select name="" class="form-select form-select-sm sel_sup_curr sel_curr" id="" disabled>
                            <option value="THB">THB</option>
                            <option value="USD">USD</option>
                            <option value="RMB">RMB</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_remark" id=""></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_price"></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_result" readonly></td>
                </tr>
            `;
            $('.tbl_service_desc tbody').append(html);
            $('.tbl_service_desc tbody tr:last').find('.sel_sup_type').val(v['type']);
            $('.tbl_service_desc tbody tr:last').find('.inp_sup_price').val(v['price']);
            $('.tbl_service_desc tbody tr:last').find('.sel_sup_curr').val(v['currency']);
            $('.tbl_service_desc tbody tr:last').find('.inp_remark').val(v['remark']);
            $('.tbl_service_desc tbody tr:last').find('.inp_markup_price').val(v['markup']);
            $('.tbl_service_desc tbody tr:last').find('.inp_markup_result').val(parseFloat(v['price'] + v['markup']));

        });
        $('.inp_desc_qty').val(num);
        quartation_markup.result_summary();

    },
    result_summary: function () {
        calculate();
        $('.inp_markup_price').on('input', function () {
            if (isNaN(this.value)) {
                this.value = this.value.replace(/[^0-9.]/g, ''); // clear the input
            } else {
                let parent = $(this).closest('.booking_container');
                let price = $('.inp_price', parent).val();
                let markup = isNaN($(this).val()) || $(this).val() == '' ? 0 : $(this).val();
                $('.inp_markup_result', parent).val(parseFloat(markup) + parseFloat(price));
            }

            calculate();
        });

        function calculate(param) {
            var sum_after_mark_USD = 0;
            var sum_after_mark_THB = 0;
            var sum_after_mark_RMB = 0;

            var sumUSD = 0;
            var sumTHB = 0;
            var sumRMB = 0;

            $('.inp_markup_price').each(function () {
                let parent = $(this).closest('.booking_container');
                let curr = $('.sel_curr', parent).val();
                if (curr == 'THB') {
                    sum_after_mark_THB += parseFloat($('.inp_price', parent).val());
                    sumTHB += parseFloat((!!$(this).val()) ? $(this).val() : 0);
                } else if (curr == 'USD') {
                    sum_after_mark_USD += parseFloat($('.inp_price', parent).val());
                    sumUSD += parseFloat((!!$(this).val()) ? $(this).val() : 0);
                } else if (curr == 'RMB') {
                    sum_after_mark_USD += parseFloat($('.inp_price', parent).val());
                    sumRMB += parseFloat((!!$(this).val()) ? $(this).val() : 0);
                }

            });

            var percen_usd = 0;
            var percen_thb = 0;
            var percen_rmb = 0;

            $('.inp_sum_beforemarkup_usd').val(sum_after_mark_USD)
            $('.inp_sum_markup_usd').val(sumUSD); // markup
            $('.inp_sum_aftermarkup_usd').val(parseFloat(sum_after_mark_USD + sumUSD)); //total
            percen_usd = (((sum_after_mark_USD + sumUSD) / sum_after_mark_USD) * 100) - 100
            percen_usd = percen_usd ? percen_usd : 0;
            $('.inp_per_usd').val('+' + percen_usd.toFixed(2) + '%')

            $('.inp_sum_beforemarkup_thb').val(sum_after_mark_THB)
            $('.inp_sum_markup_thb').val(sumTHB); // markup
            $('.inp_sum_aftermarkup_thb').val(parseFloat(sum_after_mark_THB + sumTHB)); //total
            percen_thb = (((sum_after_mark_THB + sumTHB) / sum_after_mark_THB) * 100) - 100
            percen_thb = percen_thb ? percen_thb : 0;
            $('.inp_per_thb').val('+' + percen_thb.toFixed(2) + '%')

            $('.inp_sum_beforemarkup_rmb').val(sum_after_mark_RMB)
            $('.inp_sum_markup_rmb').val(sumRMB); // markup
            $('.inp_sum_aftermarkup_rmb').val(parseFloat(sum_after_mark_RMB + sumRMB)); //total
            percen_rmb = (((sum_after_mark_RMB + sumRMB) / sum_after_mark_RMB) * 100) - 100
            percen_rmb = percen_rmb ? percen_rmb : 0;
            $('.inp_per_rmb').val('+' + percen_rmb.toFixed(2) + '%')

            $('.inp_per_tt').val('+' + (percen_usd + percen_thb + percen_rmb).toFixed(2) + '%')
        }
    },
    ajax_get_preview_data: async function (number = null) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation_markup/set_preview_quotation_markup.php",
                data: { 'data': number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    save_markup: async function () {
        let arr_save = {};
        let pdf_remark = PDF_REMARK;

        $('.booking_container').each(function (index, element) {
            let ID = $(this).attr('data_id');
            let remark = $('.inp_remark', this).val();
            let markup = $('.inp_markup_price', this).val();
            let key = $(this).attr('data_set');
            let obj = {
                'ID': ID,
                'remark': remark,
                'markup': markup,
            }

            if (!arr_save[key]) {
                arr_save[key] = [];
            }
            arr_save[key].push(obj);
        });
        arr_save['pdf_remark'] = pdf_remark;
        arr_save['quo_no'] = quartation_markup.get_quono;
        console.log(arr_save);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await quartation_markup.ajax_save_markup(arr_save);
                console.log(res);
                if (res['st'] == '1') {
                    Swal.fire(
                        'saved!',
                        'Your data has been saved.',
                        'success'
                    );
                } else {
                    Swal.fire(
                        'Error!',
                        'Your data has not been saved. Please contact administrator.',
                        'error'
                    );
                }

            }
        })
    },
    ajax_save_markup: function (obj = {}) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation_markup/save_markup.php",
                data: obj,
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    sign_markup: async function (obj = {}) {
        arr_save = {
            'quo_no': $('.inp_quono').val(),
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await quartation_markup.ajax_sign_markup(arr_save);
                console.log(res);
                if (res['st'] == '1') {
                    Swal.fire(
                        'saved!',
                        'Your data has been saved.',
                        'success'
                    );
                } else {
                    Swal.fire(
                        'Error!',
                        'Your data has not been saved. Please contact administrator.',
                        'error'
                    );
                }

            }
        })
    },
    ajax_sign_markup: function (data = {}) {
        console.log(data);
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation_markup/sign_markup.php",
                data: data,
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    //export
    export_markup_pdf: async function () {
        let quo_no = quartation_markup.get_quono;
        window.open("php/quotation_markup/export_markup_pdf.php?quo_no=" + quo_no, '_blank');
    },

    html_shipment: async function () {
        let res_data = await this.ajax_get_shipment();
        let html = ''
        $.each(res_data, function (i, k) {
            html += `
                <option value="${k['ID']}">${k['st_name']}</option>
                `
        })

        $('.sel_term').append(html)
    },

    ajax_get_shipment: function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: 'post',
                url: 'php/Ajax_select/get_shipment.php',
                data: {},
                dataType: 'json',
                success: function (res) {
                    resolve(res)
                },
            })
        })
    },
}


$(document).ready(function () {
    quartation_markup.init();

});