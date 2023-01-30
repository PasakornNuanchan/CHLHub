const data_sum = {
    
    check_get: function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        let get_job_number = getUrlParameter('job_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job_number == false ? null : get_job_number;
        let action = get_action == false ? null : get_action;

        //customs.job_number_global = job_number;
        
        
        
        if (action == 'preview') {
            
            data_sum.set_data_preview(job_number);
           
        } else {

        }
    },
    set_data_preview: async function (job_number){
        let res_data = await data_sum.ajax_set_data_preview(job_number);
        console.log(res_data);
        
        //Shipper's Data
        $('.inp-client-name').val(res_data['jt']['consignee_name']).attr('readonly',true);
        $('.inp-client-tel').val(res_data['jt']['consignee_tel']).attr('readonly',true);
        $('.inp-client-email').val(res_data['jt']['consignee_email']).attr('readonly',true);
        $('.inp-client-linkman').val(res_data['jt']['consignee_linkman']).attr('readonly',true);

        $('.inp-shipper-name').val(res_data['jt']['shipper_name']).attr('readonly',true);
        $('.inp-shipper-tel').val(res_data['jt']['shipper_tel']).attr('readonly',true);
        $('.inp-shipper-email').val(res_data['jt']['shipper_email']).attr('readonly',true);
        $('.inp-shipper-linkman').val(res_data['jt']['shipper_linkman']).attr('readonly',true);
    
        $('.inp-pol').val(res_data['jt']['pol_location']+", "+res_data['jt']['pol_country']).attr('readonly',true);
        $('.inp-pod').val(res_data['jt']['pod_location']+", "+res_data['jt']['pod_country']).attr('readonly',true);
        $('.inp-c-qty').val(res_data['jt']['count_cntr']).attr('readonly',true);

        $('.inp-sale-name').val(res_data['jt']['first_name']+" "+res_data['jt']['last_name']).attr('readonly',true);


        //$('.html_op_data_add').html('');
        $('.inp-agent-booking').val(res_data['op']['agent_booking']).attr('readonly',true);
        $('.inp-agent-tel').val(res_data['op']['agent_tel']).attr('readonly',true);
        $('.inp-agent-email').val(res_data['op']['agent_email']).attr('readonly',true);
        $('.inp-agent-linkman').val(res_data['op']['agent_linkman']).attr('readonly',true);


        $('.inp-vslvoy').val(res_data['op']['feeder_vessel']+' '+res_data['op']['voy_no_feeder']).attr('readonly',true);
        $('.inp-so').val(res_data['op']['booking_number']).attr('readonly',true);
        $('.inp-cls').val(res_data['op']['st_name']).attr('readonly',true);

        $('.inp-cntr-no').val(res_data['op']['concatcntr']).attr('readonly',true);
        $('.inp-etd').val(res_data['op']['etd']).attr('readonly',true);
        $('.inp-eta').val(res_data['op']['eta']).attr('readonly',true);

        $('.inp-cus-name').val(res_data['op']['customs_name']).attr('readonly',true);
        $('.inp-cus-tel').val(res_data['op']['customs_tel']).attr('readonly',true);
        $('.inp-cus-linkman').val(res_data['op']['customs_linkman']).attr('readonly',true);
        $('.inp-dock').val(res_data['op']['terminal']).attr('readonly',true);



        $('.inp-trailers').val(res_data['op']['concattrailers']).attr('readonly',true);
        $('.inp-trailers-tel').val(res_data['op']['concattel']).attr('readonly',true);
        $('.inp-trailers-linkman').val(res_data['op']['concatlinkman']).attr('readonly',true);

        
        $('.inp-carrier-name').val(res_data['op']['carrier_name']).attr('readonly',true);
        
        $('.inp-bl').val(res_data['op']['hbl']).attr('readonly',true);
        $('.inp-headvsl').val(res_data['op']['mother_vessel']+' '+res_data['op']['voy_no_mother']).attr('readonly',true);
        
        $('.inp-market').val(res_data['op']['market_first']+' '+res_data['op']['market_last']).attr('readonly',true);
        $('.inp-bl').val(res_data['op']['hbl']).attr('readonly',true);
          

        


        html_incom_ar = '';
        $('[name = tbl-income] tbody').html('');

        
        $.each(res_data['ar'],function(i,v){

            amc = parseFloat(v['amtinclvat']);

            html_incom_ar = `
            <tr>
                <td>${v['billing_item_name']}</td>
                <td align="right">${number_format(amc.toFixed(2))}</td>
                <td>test</td>
                <td>${v['currency']}</td>
                <td>test</td>
            </tr>
            `;
        $('[name = tbl-income] tbody').append(html_incom_ar);
        });
    },


    ajax_set_data_preview : function(job_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/data_summarize/get_preview_data.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}

function number_format(nStr) {
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

