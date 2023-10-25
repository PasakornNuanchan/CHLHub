const setting_data_first = {

    first_set: async function () {
        let res_data = await this.ajax_get_data()
        //console.log(res_data)

        if(res_data['list'] != ''){
            let html_data = '';

            let select_payto = $('.sel_payto').parent().html();
            let select_description = $('.sel_description').parent().html();
            let select_jobnumber = $('.sel_jobnumber').parent().html();
            let select_plate = $('.sel_plate').parent().html();
            
            let data_sel_pay_to = $('.sel_payto').html()
            let data_sel_description = $('.sel_description').html();
            let data_sel_job_nubmer = $('.sel_jobnumber').html();
            let data_sel_plate = $('.sel_plate').html();

            $('.sel_jobnumber_filter_detail').html('')
            $('.sel_description_filter_detail').html('')
            $('.sel_payto_filter_detail').html('')
            $('.sel_plate_filter_detail').html('')

            $('.sel_jobnumber_filter_detail').append(data_sel_pay_to)
            $('.sel_description_filter_detail').append(data_sel_description)
            $('.sel_payto_filter_detail').append(data_sel_job_nubmer)
            $('.sel_plate_filter_detail').append(data_sel_plate)
            

            $('.table_data_internal tbody').html('');

            $.each(res_data['list'],async function (i, v) {

                let ID_number = v['ID'] ? v['ID'] : '';
                let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                let description = v['description'] ? v['description'] : '';
                let pay_to = v['pay_to'] ? v['pay_to'] : '';
                let qty = v['qty'] ? v['qty'] : '';
                let price = v['price'] ? v['price'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                //let total = v['total'] ? v['total'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let receipt = v['receipt'] ? v['receipt'] : '';
                let remark = v['remark'] ? v['remark'] : '';
                let opertaion_date = v['opertaion_date'] ? v['opertaion_date'] : '';
                let truck_number = v['truck_number'] ? v['truck_number'] : '';
    
                
                i++;
                html_data = `
                <tr class="row_data_${ID_number}" data_id="${ID_number}">
                    <td>${i}</td>
                    <td>${select_jobnumber}</td>
                    <td>${select_description}</td>
                    <td>${select_payto}</td>
                    <td><input type="number" class="form-control form-control-sm rounded inp_qty text-center" onchange="internal_transport.cal_in_row(this)"></td>
                    <td><input type="number" class="form-control form-control-sm rounded inp_price text-end" onchange="internal_transport.cal_in_row(this)"></td>
                    <td><input type="number" class="form-control form-control-sm rounded inp_vat text-center" onchange="internal_transport.cal_in_row(this)"></td>
                    <td><input type="text" class="form-control form-control-sm rounded inp_total_row text-end " disabled></td>
                    <td><select class="form-select form-select-sm rounded inp_currency" onchange="internal_transport.cal_in_row(this)">
                            <option value="THB">THB</option>
                            <option value="USD">USD</option>
                            <option value="RMB">RMB</option>
                        </select></td>
                    <td><i class="bi bi-image im_pho" onclick="internal_transport.show_pic_save(${ID_number})"></i></td>
                    <td><input type="text" class="form-control form-control-sm inp_remark rounded"></td>
                    <td><input type="date" class="form-control form-control-sm inp_date_operation rounded"></td>
                    <td>${select_plate}</td>
                    <td><button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Del</button></td>
                </tr>`;
                //<button class="btn btn-outline-success btn-sm"><i class="bi bi-save"></i> Save</button>
                //$('.table_data_internal tbody').prepend(html_data_page)
    
                await $('.table_data_internal tbody').append(html_data)
    
                let qty_cal = parseFloat(qty)
                let price_cal = parseFloat(price)
                let vat_cal = parseFloat(vat)
    
                let data_total = ((qty_cal * price_cal)*vat_cal/100)+(qty_cal*price_cal)
    
                
                await $(`.row_data_${ID_number} > td > .sel_jobnumber`).val(ref_job_id).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .sel_description`).val(description).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .sel_payto`).val(pay_to).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .inp_qty`).val(qty).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .inp_price`).val(price).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .inp_vat`).val(vat).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .inp_total_row`).val(data_total).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .inp_currency`).val(currency).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .inp_remark`).val(remark).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .inp_date_operation`).val(opertaion_date).attr('disabled',true)
                await $(`.row_data_${ID_number} > td > .sel_plate`).val(truck_number).attr('disabled',true)
                
                receipt ? '' : $('.im_pho').remove();
            })
        }
        
    },

    ajax_get_data: function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport/get_detail_first.php",
                dataType: 'json',
                success: function (response) {
                    resolve(response)
                }
            });
        });
    },
}

function removeDuplicatejob_number(array) {
    let uniqueObjects = {};

    array.forEach(function(obj) {
        if (!uniqueObjects[obj.ref_job_id]) {
            uniqueObjects[obj.ref_job_id] = obj;
        }
    });

    return Object.values(uniqueObjects);
}