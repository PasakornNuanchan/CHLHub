const booking = {
    addconthtml: function () {
        let html_select = $(".td-sel-conttype").html();
        let db_sel_container = $('.inp-container_type').parent().html();
        html = `
        <tr class="booking_container">
            <td>${db_sel_container}</td>
            <td><input type="input" class="form-control form-control-sm inp-contqty" id="pwd2" placeholder=""></td>
            <td><input type="input" class="form-control form-control-sm inp-single-wieght" id="pwd2" placeholder=""></td>
            <td><input class="form-check-input inp-soc" type="checkbox" value="" id="flexCheckDefault"></td>
            <td><input class="form-check-input inp-ow" type="checkbox" value="" id="flexCheckDefault"></td>
            <td onclick="booking.del_container_row(this);"><svg class="del-tr" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                    <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                </svg>
            </td>
        </tr>
        `;
        $('[name="container-tbl"]>tbody').append(html);
    },
    del_container_row: function (e = null) {
        $(e).closest("tr").remove();
    },
    validate_input: function (elements_class = [],container) {
        valid_st = true;
        $.each(elements_class, function (k, v) {
            if ($(v).val() == "" || $(v).val() == null || $(v).val() == undefined) {
                $(v).addClass("is-invalid");
                valid_st = false;
            } else {
                $(v).removeClass("is-invalid");
            }
        });

        if (container.length == 0) {
            $('.inp-container_type').addClass("is-invalid");
            valid_st = false; 
        }else{
            $('.inp-container_type').removeClass("is-invalid");
        }
        return valid_st;
    },
    save_booking: async function () {
        let valid = true;
        let bk_no = $(".inp-bkno").val();
        let shipper = $(".inp-shper").find(":selected").val();
        let shipterm = $(".inp-shptrm").find(":selected").val();
        let remark = $(".inp-rmk").val();
        let carrier = $(".inp-carrier").find(":selected").val();
        let port_recieve = $(".inp-prtrecieve").find(":selected").val();
        let port_load = $(".inp-prtload").find(":selected").val();
        let ts_port = $(".inp-ts_port").find(":selected").val();
        let port_delivery = $(".inp-delivery").find(":selected").val();
        let mother_vessel = $(".inp-M_vessel").val();
        let mother_voy_no = $(".inp-mother-voy-no").val();
        let feeder_vessel = $(".feeder_vessel").val();
        let feeder_voy_no = $(".inp-feeder_voy_no").val();
        let etd = $(".inp-etd").val();
        let eta = $(".inp-eta").val();

        let cy = $(".inp-cy").val();
        let rtn = $(".inp-rtn").val();

        let cargo_desc = $(".inp-cargodes").val();
        let hs_code = $(".inp-hscode").find(":selected").val();
        let cargo_type = $(".inp-cargo_type").find(":selected").val();
        let cargo_qty = $(".inp-cargo_qty").val();
        let cargo_gw = $(".inp-cargo_gw").val();
        let cargo_vol = $(".inp-cargo_vol").val();
        let cargo_marks = $(".inp-cargo_marks").val();


        //container section
        let container = [];
        $(".booking_container").each(function (e) {
            let cont_tmp = {};

            let type = $(".inp-container_type option:selected", this).val();
            let qty = $(".inp-contqty", this).val();
            let weight = $(".inp-single-wieght", this).val();
            let soc = $(".inp-soc:checked", this).length > 0 ? "1" : "0";
            let ow = $(".inp-ow:checked", this).length > 0 ? "1" : "0";
            let count = qty;
            while (count > 0) {
                cont_tmp = {
                    type: type,
                    weight: weight,
                    soc: soc,
                    ow: ow,
                    cy: cy,
                    rtn: rtn,
                };
                container.push(cont_tmp);
                count--;
            }
        });

        datavalid = [
            ".inp-bkno",
            ".inp-shptrm",
            ".inp-carrier",
            ".inp-prtload",
            ".inp-ts_port",
            ".inp-etd",
            ".inp-cy",
            ".inp-rtn",
            ".inp-eta",
        ];
        // valid = await booking.validate_input(datavalid,container);
        // if (valid === false) {
        //     Swal.fire({
        //         icon: "warning",
        //         title: "Warning!",
        //         text: "some of the inputs are blank please fill",
        //     });
        //     return;
        // }



        //end container section
        let data = {
            'bk_no': bk_no,
            'shipper': shipper,
            'shipterm': shipterm,
            'remark': remark,
            'carrier': carrier,
            'port_recieve': port_recieve,
            'port_load': port_load,
            'ts_port': ts_port,
            'port_delivery': port_delivery,
            'mother_vessel': mother_vessel,
            'mother_voy_no': mother_voy_no,
            'feeder_vessel': feeder_vessel,
            'feeder_voy_no': feeder_voy_no,
            'etd': etd,
            'eta': eta,
            'container': container,
            'cargo_desc': cargo_desc,
            'hs_code': hs_code,
            'cargo_type': cargo_type,
            'cargo_qty': cargo_qty,
            'cargo_gw': cargo_gw,
            'cargo_vol': cargo_vol,
            'cargo_marks': cargo_marks,
        };

        let res = await booking.ajax_save_booking(data);
        console.log(res.st);
        if (res['st'] == '1') {
            Swal.fire(
                'Succedd',
                'Data saved!',
                'success'
              );
           
        }else{
            
            Swal.fire(
                'Error',
                'Insert failed!' + res['err'],
                'error'
              );
        }
        
    },
    ajax_save_booking: function (data) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: "post",
                url: "php/booking/saving_booking.php",
                data: data,
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    resolve(res);
                },
                error: function (error) {
                    reject(error);
                },
            });
        });
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
        let get_job = getUrlParameter('job_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job==false ? null : get_job;
        let action = get_action==false ? null : get_action;

        if (action == 'preview') {
            booking.set_default_data();
            booking.set_preview_data(job_number);
        }else{

        }
    },
    set_default_data : async function(){
        let set_data_default = await booking.ajax_set_default_data();
        console.log(set_data_default);

        let html_represent = '';
        $.each(set_data_default['ab'], function (i, k) {
            html_represent += `
            <option value="${k['ID']}">${k['agent_name_corp']}</option>
            `;
        });
        $('.db-sel-represent',).append(html_represent);
    },
    ajax_set_default_data : async function () { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/booking/set_defualt_data.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    ajax_set_preview_data : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/booking/get_preview_data.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    set_preview_data :async function (job_number) { 
        let res_data = await booking.ajax_set_preview_data(job_number);
        console.log(res_data);

         // breadcrumb
         $('.bcpage').html('');
         html_bc = `
         <li class="breadcrumb-item"><a href="CHL-booking-list.php" style="color:white;">Booking List</a></li>
         <li class="breadcrumb-item active page-item" aria-current="page">Booking (Job Number ${res_data['booking']['job_number']})</li>`;
         $('.bcpage').append(html_bc)
        
        $('.head-of-menu').html('Booking');
        $('.inp-jobno').val(res_data['booking']['job_number']);
        $('.inp-bkno').val(res_data['booking']['booking_number']);
        $('.inp-rmk').val(res_data['booking']['remark']);
        $('.inp-M_vessel').val(res_data['booking']['mother_vessel']);
        $('.inp-mother-voy-no').val(res_data['booking']['voy_no_mother']);
        $('.feeder_vessel').val(res_data['booking']['feeder_vessel']);
        $('.inp-feeder_voy_no').val(res_data['booking']['voy_no_feeder']);
        $('.inp-shper').val(res_data['booking']['shipper_number']);
        $('.inp-shptrm').val(res_data['booking']['st_number']);
        $('.inp-carrier').val(res_data['booking']['ID_carrier']);
        
        $('.inp-prtrecieve').val(res_data['booking']['port_of_receipt_number']);
        $('.inp-delivery').val(res_data['booking']['port_of_delivery_number']);

        $('.inp-prtload').val(res_data['booking']['port_of_loading_number']);
        $('.inp-ts_port').val(res_data['booking']['ts_port_number']);
        $('.inp-etd').val(res_data['booking']['etd']);
        $('.inp-eta').val(res_data['booking']['eta']);

        $('.inp-cargodes').val(res_data['contain']['cargo']);
        $('.inp-hscode').val(res_data['contain']['hs']);
        $('.inp-cargo_type').val(res_data['contain']['cargo_type']);
        $('.inp-cargo_qty').val(res_data['contain']['quantity']);
        $('.inp-cargo_gw').val(res_data['contain']['gw']);
        $('.inp-cargo_vol').val(res_data['contain']['volume']);
        $('.inp-cargo_marks').val(res_data['contain']['mark']);
       


        let db_sel_container = $('.inp-container_type').parent().html();
        $('[name = container-tbl] tbody').html('');
        html_table_container ='';
        $.each(res_data['container_table'],function(i,v){
            if(v['soc']== 1){
                soc_status = "checked";
            }else{
                soc_status = "unchecked";
            }
            if(v['ow']== 1){
                ow_status = "checked";
            }else{
                ow_status = "unchecked";
            }
        
            html_table_container = `
            <tr class="booking_container">
                <td>${db_sel_container}</td>
                <td><input type="number" class="form-control form-control-sm inp-contqty" style="text-align:right;" value="${v['container_count']}"></td>
                <td><input type="number" class="form-control form-control-sm inp-single-wieght" style="text-align:right;" value="${v['single_cnt']}"></td>
                <td><input class="form-check-input inp-soc" type="checkbox" ${soc_status} ></td> 
                <td><input class="form-check-input inp-ow" type="checkbox"${ow_status} ></td>
                <td onclick="">
                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.7688 8.71387H16.2312C18.5886 8.71387 20.5 10.5831 20.5 12.8885V17.8254C20.5 20.1308 18.5886 22 16.2312 22H7.7688C5.41136 22 3.5 20.1308 3.5 17.8254V12.8885C3.5 10.5831 5.41136 8.71387 7.7688 8.71387ZM11.9949 17.3295C12.4928 17.3295 12.8891 16.9419 12.8891 16.455V14.2489C12.8891 13.772 12.4928 13.3844 11.9949 13.3844C11.5072 13.3844 11.1109 13.772 11.1109 14.2489V16.455C11.1109 16.9419 11.5072 17.3295 11.9949 17.3295Z" fill="currentColor"></path>
                        <path opacity="0.4" d="M17.523 7.39595V8.86667C17.1673 8.7673 16.7913 8.71761 16.4052 8.71761H15.7447V7.39595C15.7447 5.37868 14.0681 3.73903 12.0053 3.73903C9.94257 3.73903 8.26594 5.36874 8.25578 7.37608V8.71761H7.60545C7.20916 8.71761 6.83319 8.7673 6.47754 8.87661V7.39595C6.4877 4.41476 8.95692 2 11.985 2C15.0537 2 17.523 4.41476 17.523 7.39595Z" fill="currentColor"></path>
                    </svg>
                </td>
            </tr>
            `;
            $('[name = container-tbl] tbody').append(html_table_container);
            $('[name = container-tbl] tbody tr:last').find($('.inp-container_type')).val(v['container_type_number']);
            
            
            //$(`.inp-container_type${i} > select`).val(v['container_type_number']);
        });
        
        
        

    },
};

