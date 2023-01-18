const quartation_markup = {
    get_quono : '',

    init : function (e=null) {  
        quartation_markup.check_get();
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
        let quo_no = title['quo_number'];
        let commodity = title['title_commodity'];
        let consign_no = title['title_consignee_number'];
        let st = title['title_status'];
        let term = title['title_term'];
        let type =title['title_type'];
        let title_user_sale = title['title_user_sale'];
        $('.inp_quono').val(quo_no);
        $('.inp_sign_st').val(st);
        $('.inp_commodity').val(commodity);








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