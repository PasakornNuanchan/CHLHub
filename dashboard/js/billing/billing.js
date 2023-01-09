const billing = {
    
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

        console.log(action);
        
        if (action == 'preview') {
            billing.set_preview_data(job_number);
           
        } else {
        }
    },
    set_preview_data: async function (job_doc_pt) {
        
        
        let res_data = await billing.ajax_set_preview_data(job_doc_pt);
        console.log(res_data);
      
      
    }, 

    ajax_set_preview_data: function (job_number) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_preview_data.php",
                data: {'job_number':job_number},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    addarhtml: function () {
        let html_select = $(".td-sel-conttype").html();
        html = `
        <tr class="text-center">
            <td>1</td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td>Prepaid</td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>THB</option>
                <option value="">USD</option>
                <option value="">RMB</option>
            </select></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="text" class="form-control"></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="checkbox" class="form-check-input"></td>
            <td onclick="billing.del_container_row(this);">
                <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
            </td>
            <td>
                <button type="button" class="btn btn-success rounded-pill btn-xs" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
            </td>
            </tr>
        `;
        $('[name="billing-ar-tbl"]>tbody').append(html);
    },
    del_container_row: function (e = null) {
        $(e).closest("tr").remove();
     },



    addaphtml: function () {
        let html_select = $(".td-sel-conttype").html();
        html = `
        <tr class="text-center">
            <td>1</td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td>Prepaid</td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>THB</option>
                <option value="">USD</option>
                <option value="">RMB</option>
            </select></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="text" class="form-control"></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="checkbox" class="form-check-input"></td>
            <td onclick="billing.del_container_row(this);">
                <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
            </td>
            <td>
                <button type="button" class="btn btn-success rounded-pill btn-xs" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
            </td>
            </tr>
        `;
        $('[name="billing-ap-tbl"]>tbody').append(html);
    },
    del_container_row: function (e = null) {
        $(e).closest("tr").remove();
     },
    


};
