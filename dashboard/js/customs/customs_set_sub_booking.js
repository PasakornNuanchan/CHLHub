const customs_set_sub_booking ={
    ajax_set_preview_booking : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/set_sub_booking.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    
    set_sub_booking_preview_data: async function (job_number){
        let res_data = await customs_set_sub_booking.ajax_set_preview_booking(job_number);
        // sub page booking (Booking Detail)
        $('.inp-shper').val(res_data['booking']['shipper_number']).attr('disabled',true);
        $('.inp-shptrm').val(res_data['booking']['st_number']).attr('disabled',true);
        $('.inp-carrier').val(res_data['booking']['carrier_number']).attr('disabled',true);
        $('.inp-prtrecieve').val(res_data['booking']['port_of_receipt_number']).attr('disabled',true);
        $('.inp-prtload').val(res_data['booking']['port_of_loading_number']).attr('disabled',true);
        $('.inp-ts_port').val(res_data['booking']['ts_port_number']).attr('disabled',true);
        $('.inp-delivery').val(res_data['booking']['port_of_delivery_number']).attr('disabled',true);
        $('.inp-jobno').val(res_data['booking']['job_number']).attr('readonly',true);
        $('.inp-bkno').val(res_data['booking']['booking_number']).attr('readonly',true);
        $('.inp-rmk').val(res_data['booking']['remark']).attr('readonly',true);
        $('.inp-M_vessel').val(res_data['booking']['mother_vessel']).attr('readonly',true);
        $('.inp-mother-voy-no').val(res_data['booking']['voy_no_mother']).attr('readonly',true);
        $('.inp-feeder_vessel').val(res_data['booking']['feeder_vessel']).attr('readonly',true);
        $('.inp-feeder_voy_no').val(res_data['booking']['voy_no_feeder']).attr('readonly',true);
        $('.inp-etd').val(res_data['booking']['etd']).attr('readonly',true);
        $('.inp-eta').val(res_data['booking']['eta']).attr('readonly',true);
        
        // sub page booking (Container Information)
        $('.inp-cargodes').val(res_data['cninform']['cargo']).attr('readonly',true);

        $('.inp-hscode').val(res_data['cninform']['hs_code']+' '+res_data['cninform']['hs_decription']).attr('disabled',true);
        $('.inp-cargo_type').val(res_data['cninform']['cargo_type']).attr('disabled',true);
        $('.inp-cargo_qty').val(res_data['cninform']['quantity']).attr('readonly',true);
        $('.inp-cargo_gw').val(res_data['cninform']['gw']).attr('readonly',true);
        $('.inp-cargo_vol').val(res_data['cninform']['volume']).attr('readonly',true);
        $('.inp-cargo_marks').val(res_data['cninform']['mark']).attr('readonly',true);

      
    },
}
