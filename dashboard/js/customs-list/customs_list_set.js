const customs_list_set = {
   
    set_data_rows: async function (job_doc_pt) {
        
        
        let res_data = await customs_list_set.ajax_set_preview_data(job_doc_pt);


        $('.head-of-menu').html('Customs Clearance List');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-Customs-list.php" target="" style="color:white;">Customs Clearance Main List</a></li>`;
        $('.bcpage').append(html_bdpage);
        
        console.log(res_data);
        $('[name = "data_table_list"] tbody').html('');

        $.each(res_data['customs'], function (i, v) {         
            pf_amount = parseFloat(v['total_amount_request']);
            document_status = '';
            transport_status ='';
            if(v['document_status'] == 1){
                document_status = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Success</span>';
            }else{
                document_status = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">fail</span>';
            }
            if(v['transport_status'] == 1){
                transport_status ='<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Success</span>';
            }else{
                transport_status ='<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">fail</span>';
            }
            
            html_set_pct = `
            <tr>
                <td>${v['create_date']}</td>
                <td>${v['job_number']}</td>
                <td>${v['type_import_export']}</td>
                <td>${v['consignee_name']}</td>
                <td>${v['eta']}</td>
                <td>${v['location_name']} , ${v['country']}</td>
                <td>${document_status}</td>
                <td>${transport_status}</td>
                <td><button type="button" onclick="customs_list.preview('${v['job_number']}');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
        </tr>
            `;

            $('[name = "data_table_list"] tbody').append(html_set_pct);
           
        });
      
      
    },ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs_list/get_detail.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

};

