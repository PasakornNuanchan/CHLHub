const booking_list_set = {
   
    set_data_rows: async function (job_doc_pt) {
        
        $('.head-of-menu').html('Booking List');
        // let res_data = await booking_list_set.ajax_set_preview_data(job_doc_pt);
        // console.log(res_data);
        //breadcrumb
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-booking-list.php" target="" style="color:white;">Booking main list</a></li>`;
        $('.bcpage').append(html_bdpage);
        //$('[name = "data_table_list"] tbody').html('');

        // $.each(res_data['booking_list'], function (i, v) {         
        //     pf_amount = parseFloat(v['total_amount_request']);
        //     // console.log(pf_amount);
        //     html_set_pct = `
        //     <tr>
        //     <td>${v['create_date']}</td>
        //     <td>${v['job_number']}</td>
        //     <td>${v['mbl']}</td>
        //     <td>${v['carrier_name']}</td>
        //     <td>${v['consignee_name']}</td>
        //     <td>${v['location_name']},${v['country']}</td>
        //     <td>${v['eta']}</td>
        //     <td><button type="button" onclick="booking_list.preview('${v['job_number']}');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
        // </tr>
        //     `;

        //     $('[name = "data_table_list"] tbody').append(html_set_pct);
           
        // });
      
      
    }, 
    

    // ajax_set_preview_data: function (job_doc_pt) {
        
    //     return new Promise(function (resolve, reject) {
    //         $.ajax({
    //             type: "post",
    //             url: "php/booking-list/get_detail.php",
    //             data: {},
    //             dataType: "json",
    //             success: function (response) {
    //                 resolve(response);
    //             }
    //         });
    //     });
    // },

};

