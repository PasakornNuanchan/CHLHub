const quartation_markup = {
    get_quono : '',

    init :async function (e=null) {  
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
    set_preview_data :async function (quartation_number=null) {  
        let res = await quartation_markup.ajax_get_preview_data(quartation_number);
        console.log(res);
        let title = res['title'];
        let quo_no = title['title_number'];
        let commodity = title['title_commodity'];
        let consign_no = title['title_consignee_number'];
        let st = title['title_status'];
        let term = title['title_term'];
        let type =title['title_type'];
        let title_user_sale = title['title_user_sale'];
        $('.inp_quono').val(quo_no);
        $('.inp_sign_st').val(st);
        $('.inp_commodity').val(commodity);
        $('.sel_consignee').val(consign_no);
        $('.sel_title_type').val(type);
        $('.inp_sale_user').val(title_user_sale);

        let num = 0
        $.each(res['base'], function (i, v) { 
            num += 1;
            html = `
                <tr class="booking_container" data_id='${v['ID']}' data_set="base">
                    <td align="center">${num}</td>
                    <td><input type="input" class="form-control form-control-sm" readonly 
                        title="${v['r_carrier_name']+ ' : ' + v['locateL'] + ' -> ' + v['locateD']}" 
                        value="${v['r_carrier_name']+' : ' + v['locateL'] + ' -> ' + v['locateD']}"></td>
                    <td><select name="" id="" class="form-select form-select-sm sel_base_type" disabled>
                            <option value="">Plese select type</option>
                            <option value="">Import</option>
                            <option value=""selected>Export</option>
                            <option value="">Other service</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_base_price inp_price" id="" readonly></td>
                    <td><select name="" class="form-select form-select-sm sel_base_curr sel_curr" id="" disabled>
                            <option value="THB">THB</option>
                            <option value="USD">USD</option>
                            <option value="RMB">RMB</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_base_remark" id=""></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_price"></td>
                    <td><input type="input" class="form-control form-control-sm" readonly></td>
                </tr>
            `;
            $('.tbl_service_desc tbody').append(html);
            $('.tbl_service_desc tbody tr:last').find('.sel_base_type').val();            
            $('.tbl_service_desc tbody tr:last').find('.inp_base_price').val(v['price_qty']);
            $('.tbl_service_desc tbody tr:last').find('.sel_base_curr').val(v['r_curr']);
            $('.tbl_service_desc tbody tr:last').find('.inp_base_remark').val(v['r_container_type']);
        });

        //truck
        $.each(res['truck'], function (i, v) { 
            if (v['type'] == 'import') {
                c_type = 'Import'
            }else if (v['type'] == 'export'){
                c_type = 'Export'
            }
            num += 1;
            html = `
                <tr class="booking_container" data_id='${v['ID']}' data_set="truck">
                    <td align="center">${num}</td>
                    <td><input type="input" class="form-control form-control-sm" readonly 
                        title="${'Truck ('+c_type+') ' + v['pickup'] + ' -> '+ v['dropoff'] }" 
                        value="${'Truck ('+c_type+') ' + v['pickup'] + ' -> '+ v['dropoff'] }"></td>
                    <td><select name="" id="" class="form-select form-select-sm sel_truck_type" disabled>
                            <option value="">Plese select type</option>
                            <option value="Import">Import</option>
                            <option value="Export">Export</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_truck_price inp_price" id="" readonly></td>
                    <td><select name="" class="form-select form-select-sm sel_truck_curr sel_curr" id="" disabled>
                            <option value="THB">THB</option>
                            <option value="USD">USD</option>
                            <option value="RMB">RMB</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_truck_remark" id=""></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_price"></td>
                    <td><input type="input" class="form-control form-control-sm" readonly></td>
                </tr>
            `;
            $('.tbl_service_desc tbody').append(html);
            $('.tbl_service_desc tbody tr:last').find('.sel_truck_type').val(c_type);            
            $('.tbl_service_desc tbody tr:last').find('.inp_truck_price').val(v['price']);
            $('.tbl_service_desc tbody tr:last').find('.sel_truck_curr').val(v['currency']);
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
                            <option value="Export">Export</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_sup_price inp_price" id="" readonly></td>
                    <td><select name="" class="form-select form-select-sm sel_sup_curr sel_curr" id="" disabled>
                            <option value="THB">THB</option>
                            <option value="USD">USD</option>
                            <option value="RMB">RMB</option>
                        </select></td>
                    <td><input type="input" class="form-control form-control-sm inp_sup_remark" id=""></td>
                    <td><input type="input" class="form-control form-control-sm inp_markup_price"></td>
                    <td><input type="input" class="form-control form-control-sm" readonly></td>
                </tr>
            `;
            $('.tbl_service_desc tbody').append(html);
            $('.tbl_service_desc tbody tr:last').find('.sel_sup_type').val(v['type']);            
            $('.tbl_service_desc tbody tr:last').find('.inp_sup_price').val(v['price']);
            $('.tbl_service_desc tbody tr:last').find('.sel_sup_curr').val(v['currency']);
            $('.tbl_service_desc tbody tr:last').find('.inp_sup_remark').val(v['remark']);
        });
            $('.inp_desc_qty').val(num);
        quartation_markup.result_summary();
        
    },
    result_summary : function () { 
        calculate();
        $('.inp_markup_price').on('input', function() {
            if (isNaN(this.value)) {
                this.value = this.value.replace(/[^0-9.]/g, ''); // clear the input
            }
            calculate();
        });

        function calculate(param) {  
            var sum_after_mark = 0;
            var sum = 0;
            $('.inp_markup_price').each(function() {
                let parent = $(this).closest('.booking_container');
                sum_after_mark += parseFloat($('.inp_price',parent).val());
                sum += parseFloat((!!$(this).val())? $(this).val() : 0);
            });
            $('.inp_sum_markup_usd').val(sum);            
            $('.inp_sum_aftermarkup_usd').val(parseFloat(sum_after_mark+sum));

        }
    },
    ajax_get_preview_data :async  function (number = null) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation_markup/set_preview_quotation_markup.php",
                data: {'data' : number},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    
}


$(document).ready(function () {
    quartation_markup.init();
});