const booking = {
    data_id: '',
    job_number_global: '',
    db_sel_container_global: '',
    addconthtml: function () {
        let html_select = $(".td-sel-conttype").html();
        let db_sel_container = booking.db_sel_container_global
        html = `
        <tr class="booking_container">
            <td>${db_sel_container}</td>
            <td><input type="number" class="form-control form-control-sm inp-contqty" id="pwd2" placeholder=""></td>
            <td><input type="number" class="form-control form-control-sm inp-single-wieght" id="pwd2" placeholder=""></td>
            <td><input class="form-check-input inp-soc" type="checkbox"  id="flexCheckDefault"></td>
            <td><input class="form-check-input inp-ow" type="checkbox" id="flexCheckDefault"></td>
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
    validate_input: function (elements_class = [], container) {
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
        } else {
            $('.inp-container_type').removeClass("is-invalid");
        }
        return valid_st;
    },

    save_booking: async function () {
        let valid = true;
        let job_number = $(".inp-jobno").val()
        this.job_number_global = job_number;
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

        let represent = $(".db-sel-represent").val();


        if (shipper == "" || shipterm == "" || port_recieve == "" || port_load == "" || ts_port == "" || port_delivery == "" || etd == "" || eta == ""
            || hs_code == "" || cargo_type == "" || cargo_qty == "" || cargo_vol == "" || cargo_gw == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Detail data is missing plese check your data !',
            })
        } else {
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
                'valid': this.data_id,
                'job_number': this.job_number_global,
                'represent' : represent
            };


            await booking.ajax_save_booking(data);

        }




    },

    ajax_save_booking: async function (data) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: "post",
                url: "php/booking/saving_booking.php",
                data: data,
                dataType: "json",
                success: function () {
                    // console.log(res);
                    // resolve(res);
                    Swal.fire(
                        'Succedd',
                        'Data saved!',
                        'success'
                    )
                },
                error: function (error) {
                    reject(error);
                },
            });
        });
    },
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
        let get_job = getUrlParameter('job_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job == false ? null : get_job;
        let action = get_action == false ? null : get_action;
        this.job_number_global = job_number;
        if (action == 'preview') {
            booking.set_default_data();
            booking.set_preview_data(job_number);
        } else {

        }
    },
    set_default_data: async function () {
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
    ajax_set_default_data: async function () {
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

    ajax_set_preview_data: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/booking/get_preview_data.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    set_preview_data: async function (job_number) {
        let res_data = await booking.ajax_set_preview_data(job_number);
        console.log(res_data);

        // breadcrumb
        $('.bcpage').html('');
        html_bc = `
         <li class="breadcrumb-item"><a href="CHL-booking-list.php" style="color:white;">Booking List</a></li>
         <li class="breadcrumb-item active page-item" aria-current="page">Booking (Job Number ${res_data['booking']['job_number']})</li>`;
        $('.bcpage').append(html_bc)


        this.data_id = res_data['booking']['ID'];
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
        $('.inp-carrier').val(res_data['booking']['carrier_number']);

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
        $('.inp-sel-booking-agent').val(res_data['booking']['booking_agent'])


        let db_sel_container = $('.inp-container_type').parent().html();
        booking.db_sel_container_global = db_sel_container
        $('[name = container-tbl] tbody').html('');
        html_table_container = '';
        if (res_data['container_table'] != "0 results") {
            $.each(res_data['container_table'], function (i, v) {
                if (v['soc'] == 1) {
                    soc_status = "checked";
                } else {
                    soc_status = "unchecked";
                }
                if (v['ow'] == 1) {
                    ow_status = "checked";
                } else {
                    ow_status = "unchecked";
                }

                html_table_container = `
            <tr class="booking_container${i}" booking_container="${v['ID']}">
                <td>${db_sel_container}</td>
                <td><input type="number" class="form-control form-control-sm inp-contqty" style="text-align:right;" value="${v['container_count']}"></td>
                <td><input type="number" class="form-control form-control-sm inp-single-wieght" style="text-align:right;" value="${v['single_cnt']}"></td>
                <td><input class="form-check-input inp-soc" type="checkbox" ${soc_status} ></td> 
                <td><input class="form-check-input inp-ow" type="checkbox"${ow_status} >
                 <input type="hidden" class="form-control form-control-sm inp_number_container" style="text-align:right;" value="1"></td>
                <td onclick="">
                    
                </td>
            </tr>
            `;
                $('[name = container-tbl] tbody').append(html_table_container);
                $('[name = container-tbl] tbody tr:last').find($('.inp-container_type')).val(v['container_type_number']);


                //$(`.inp-container_type${i} > select`).val(v['container_type_number']);
            });
        }

    },

    save_container_function: async function () {

        container_arr = []
        container_arr_temp = {}
        let cy_con = $('.inp-cy').val()
        let rtn_con = $('.inp-rtn').val()
        let job_con = $('.inp-jobno').val()


        $('[name = container-tbl] tbody > tr').each(function (i, e) {

            let con_type = $('.inp-container_type', this).val();
            let qty = $('.inp-contqty', this).val();
            let slw = $('.inp-single-wieght', this).val();
            let soc = $('.inp-soc', this).val();
            let ow = $('.inp-ow', this).val();
            let st_container = $('.inp_number_container', this).val();

            container_arr_temp = {
                con_type: con_type,
                qty: qty,
                slw: slw,
                soc: soc,
                ow: ow,
                st_container: st_container,
                cy_con: cy_con,
                rtn_con: rtn_con,
                job_number: job_con
            }

            container_arr.push(container_arr_temp)

        })
        console.log(container_arr)
        await booking.ajax_save_container_booking(container_arr)
        Swal.fire(
            'saved!',
            'Your file has been saved.',
            'success'
        )
        await this.set_preview_data(booking.job_number_global)

    },

    ajax_save_container_booking: async function (container_arr) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/booking/save_container.php",
                data: { 'container_arr': container_arr },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },


    modal_del_container: async function () {
        if ($('#pcad_modal').length >= 1) {
            $('#pcad_modal').remove()
        }

        console.log(booking.job_number_global)
        let data_result = await booking.ajax_get_delete(booking.job_number_global);


        if (data_result['sql_sel_del'] != "data_error") {
            let html_data_in_modal = '';
            $.each(data_result['sql_sel_del'], function (i, v) {
                html_data_in_modal += `
            <tr>
                <td>${v['container_type']}</td>
                <td>${v['single_cnt']}</td>
                <td>${v['cy']}</td>
                <td>${v['rtn']}</td>
            </tr>
            `;
            })

            html = `
            <div class="modal fade" id="pcad_modal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Delete data</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="table-responsive ">
                            <table id="basic-table" class="table table-hover " name="billing-ap-tbl" role="grid" style="border-radius: 12px;">
                                <thead>
                                    <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                        <th>container type</th>
                                        <th>single_cnt</th>
                                        <th>cy</th>
                                        <th>rtn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ${html_data_in_modal}
                                </tbody>
                            </table>
                            </div>
                        </div>
                
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="booking.sv_delete_container()">Delete</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>`

            $('body').append(html)
            $('#pcad_modal').modal('show')
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'There is no information to search for.',
            })
        }

    },

    ajax_get_delete: async function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/booking/get_delete_container.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    sv_delete_container : async function(){
        let res = await this.ajax_sv_delete_container()
        
        if(res == '1'){
            Swal.fire(
                'saved!',
                'Your file has been saved.',
                'success'
            )
        }
        await $('#pcad_modal').modal('hide')
        await this.set_preview_data(booking.job_number_global)
    },

    ajax_sv_delete_container : async function(){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/booking/delete_container.php",
                data: { 'job_number': booking.job_number_global },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    }
};

