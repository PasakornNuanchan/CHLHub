const data_summarize_list_set = {

    set_data_rows: async function (job_doc_pt) {
        
        let res_data = await data_summarize_list_set.ajax_set_preview_data(job_doc_pt);
        

        $('.head-of-menu').html('Data Summarize List');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-data-summarize-list.php" target="" style="color:white;">Data Summarize list</a></li>`;
        $('.bcpage').append(html_bdpage);

        console.log(res_data);
        $('[name = "data_table_list"] tbody').html('');

        $.each(res_data['sm_list'], function (i, v) {         
            let booking_status = '';
            let transport_status = '';
            let clearlance_date = '';
            if(v['booking_number']=="" || v['consignee_number']=="" || v['shipper_number']=="" || v['carrier_number']==""){
                booking_status = "<span class='badge rounded-pill bg-danger'>False</span>";
            }else{
                booking_status = "<span class='badge rounded-pill bg-success'>Success</span>"; 
            }

            if(v['clearlance_date'] == null){
                clearlance_date = "<span class='badge rounded-pill bg-danger'>False</span>";
            }else{
                clearlance_date = "<span class='badge rounded-pill bg-success'>Success</span>";
            }
            
            if(v['c_qty'] == '0'){
                transport_status = "<span class='badge rounded-pill bg-danger'>False</span>";
            } else{
                transport_status = "<span class='badge rounded-pill bg-success'>Success</span>";
            }
            
            html_set_pct = `
            <tr>
            <td>${v['create_date']}</td>
            <td>${v['job_number']}</td>
            <td>${booking_status}</td>
            <td>${transport_status}</td>
            <td>${clearlance_date}</td>
            <td><button type="button" onclick="data_summarize_list.preview('${v['job_number']}');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
        </tr>
            `;

            $('[name = "data_table_list"] tbody').append(html_set_pct);
           
        });
      
      
    }, 
    

    ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/data_summarize_list/get_detail.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

};


function number_format(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}