const quartation = {
    addhtmlbase_server: function (e = null) {
        let sl_carrier = $(".db-select-carrier").html();
        let sl_pol = $(".db-select-pol").html();
        let sl_pod = $(".db-select-pod").html();
        html = `
                <div class="base-add">
                <H4>Base Service</H4>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Carrier :</label>
                            <div class="col-lg-5 col-md-5">
                                ${sl_carrier}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Container size :</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4">
                                            <select class="form-select form-select-sm inp-ts_port">
                                                <option value="" selected>Select size</option>
                                                <option value="">40HQ</option>
                                                <option value="">20DC</option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-4 col-lg-2 align-self-center mb-0" for="pwd2">Container Quantity</label>
                                        <div class="col-lg-2 col-md-2">
                                            <input type="text" class="form-control form-control-sm">
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Port of loading</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            ${sl_pol}
                                        </div>
                                        <label class="control-label col-sm-2 col-md-3 col-lg-2 align-self-center mb-0" for="pwd2">Port of Delivery</label>
                                        <div class="col-lg-4">
                                            ${sl_pod}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Budget :</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4">
                                            <input type="text" class="form-control form-control-sm" readonly>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <select name="" class="form-select form-select-sm" id="" disabled>
                                                <option value="" selected>THB</option>
                                                <option value="">USD</option>
                                                <option value="">RMB</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <button type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" onclick="quartation.addhtmlbase_server();" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Route</button>
                                            <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_base(); style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-dash-lg"></i> Delete Route</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        $(".base-row").append(html);
    },
    addhtmlsub_tbl: function () {
        html = `
            <tr class="sub_des">
                <td class=""><select name="" class="form-select form-select-sm" id="">
                    <option value="" selected>Plese Select service</option>
                    <option value="">DF/DO Fee</option>
                    <option value="">THC</option>
                    <option value="">Seal Fee</option>
                    <option value="">Handling Charge</option>
                    <option value="">Import Duty With Vat</option>
                    <option value="">Customs Clearance Charge</option>
                    <option value="">Customs fee</option>
                    <option value="">Customs Inspection Charge</option>
                    <option value="">Gate Charge</option>
                    <option value="">Pick-up Empty Container Fee</option>
                    <option value="">Return Laden Container Fee</option>
                    <option value="">Container Cleaning Charge</option>
                    <option value="">Equipment Maintenance Fee</option>
                    <option value="">Demurrage & Detention</option>
                    <option value="">Over time Charge for truck</option>
                    <option value="">Storage Charge</option>
                    <option value="">Over time charge for customer </option>
                    <option value="">insurance</option>
                    <option value="">Surrender BL Fee</option>
                    <option value="">AMS (amtomated manifest system)</option>
                    <option value="">Carrier Security Charge</option>
                    <option value="">Port Security Charge (PU)</option>
                </select></td>
                <td><select name="" id="" class="form-select form-select-sm">
                    <option value="">Import</option>
                    <option value="">Export</option>
                    <option value="" selected>Other service</option>
                </select></td>
                <td><input type="input" class="form-control form-control-sm " id="" placeholder=""></td>
                <td><select name="" class="form-select form-select-sm" id="">
                    <option value="">THB</option>
                </select></td>
                <td><input type="input" class="form-control form-control-sm " id="" placeholder=""></td>
                <td  onclick="quartation.del_sup_row(this);"><svg class="del-tr"  width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="red"></path>
                        <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="red"></path>
                    </svg>
                </td>
            </tr>
            `;
        $('[name="sub-tbl"]>tbody').append(html);
    },
    del_sup_row: function (e = null) {
        $(e).closest("tr").remove();
    },


    check_get : function () {  
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
        let get_quo = getUrlParameter('quartation_number');
        let get_action = getUrlParameter('action');

        let quartation_number = get_quo==false ? null : get_quo;
        let action = get_action==false ? null : get_action;

        if (action == 'preview') {
            quartation.set_preview_data(quartation_number);
        }else{

        }
    },
    set_preview_data : async function (quartation_number = null) { 
        let res_data = await quartation.ajax_set_preview_data(quartation_number);
        console.log(res_data);






        
    },
    ajax_set_preview_data : function (quartation_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation/get_preview_data.php",
                data: {'quartation_number' : quartation_number},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
};


$(function () {
    quartation.check_get();
});