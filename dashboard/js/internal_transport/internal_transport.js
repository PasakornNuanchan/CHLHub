const internal_transport = {

    set_header_page : async function () {
        //$('.table_data_internal tbody').html('')
        //$('.inp_let_start').attr('checked',true)
    },


    add_rows_req : async function (){
        $('.table_data_internal > tbody > tr').lenght;
        let html_data_page = "";
        html_data_page = `
        <tr>
            <td>1</td>
            <td><select class="form-select form-select-sm rounded">
                    <option value="">-- please select description -- </option>
                    <option value="1">Fuel cost</option>
                    <option value="2">Maintenance cost</option>
                    <option value="3">Highway cost</option>
                </select></td>
            <td><input type="number" class="form-control form-control-sm rounded inp_qty text-center" onchange="internal_transport.cal_in_row(this)"></td>
            <td><input type="number" class="form-control form-control-sm rounded inp_price text-end" onchange="internal_transport.cal_in_row(this)"></td>
            <td><input type="number" class="form-control form-control-sm rounded inp_vat text-center" onchange="internal_transport.cal_in_row(this)"></td>
            <td><input type="text" class="form-control form-control-sm rounded inp_total_row text-end " disabled></td>
            <td><select class="form-select form-select-sm rounded inp_currency" onchange="internal_transport.cal_in_row(this)">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                </select></td>
            <td><button class="btn btn-outline-primary btn-sm "><i class="bi bi-upload"></i> upload picture</button>
                <button class="btn btn-outline-warning btn-sm "><i class="bi bi-upload"></i> re-upload picture</button>
            </td>
            <td><input type="number" class="form-control form-control-sm rounded"></td>
        </tr>`;
        $('.table_data_internal tbody').append(html_data_page)
    },

    cal_in_row : async function (e){

        //in rows
        $('.table_data_internal > tbody > tr').each(function(i,v){
            
            let data_qty = parseFloat($('.inp_qty',this).val())
            let data_price = parseFloat($('.inp_price',this).val())
            let data_vat = parseFloat($('.inp_vat',this).val())

            data_qty = isNaN(data_qty) ? 0 : data_qty;
            data_price = isNaN(data_price) ? 0 : data_price;
            data_vat = isNaN(data_vat) ? 0 : data_vat;

            let data_total_row = 0;
            data_total_row = parseFloat(data_qty*data_price)+((data_qty*data_price)*(data_vat/100));
            data_total_row_fix = data_total_row.toFixed(2)
            $('.inp_total_row',this).val(data_total_row_fix)
        })      
        await this.cal_result();
    },

    cal_result : async function (e){

        let thb_data = 0;
        let usd_data = 0;
        let rmb_data = 0;

        let data_currency_select = $(e).attr('data_c')
        data_currency_select = data_currency_select === undefined ? 'THB' : data_currency_select;

        $('.table_data_internal > tbody > tr').each(function(i,v){
            let data_total = parseFloat($('.inp_total_row',this).val())
            let data_currency = $('.inp_currency',this).val()
            data_total = isNaN(data_total) ? 0 : data_total;

            if(data_currency == "THB"){
                thb_data = thb_data + data_total;
            }else if(data_currency == "USD"){
                usd_data = usd_data + data_total;
            }else if(data_currency == "RMB"){
                rmb_data = rmb_data + data_total;
            }
        })     

        let thb_data_total = 0;
        let usd_data_total = 0;
        let rmb_data_total = 0;


        $('.table_data_internal > tbody > tr').each(function(i,v){
            let data_qty = parseFloat($('.inp_qty',this).val())
            let data_price = parseFloat($('.inp_price',this).val())
            let data_currency = $('.inp_currency',this).val()
            let data_res = data_qty*data_price;
            data_res = isNaN(data_res) ? 0 : data_res;

            
            if(data_currency == "THB"){
                thb_data_total = thb_data + data_res;
            }else if(data_currency == "USD"){
                usd_data_total = usd_data + data_res;
            }else if(data_currency == "RMB"){
                rmb_data_total = rmb_data + data_res;
            }
        })     
        // console.log(thb_data)
        // console.log(usd_data)
        // console.log(rmb_data)

        let val_usd = 0;
        let val_thb = 0;
        let val_rmb = 0;
        
        if(data_currency_select == "THB"){
            val_usd = 34.55;
            val_thb = 1;
            val_rmb = 4.84;
        }else if(data_currency_select == "USD"){
            val_usd = 1;
            val_thb = 0.029;
            val_rmb = 0.14;
        }else if(data_currency_select == "RMB"){
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
      

      
    }
}