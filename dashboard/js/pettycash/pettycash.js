const booking = {
    select_port: function () {
        $.ajax({
            type: "post",
            url: "../ajax_request/booking.php",
            data: "data",
            dataType: "text",
            success: function (response) {
                alert(response);
            },
        });
    },
    addconthtml: function () {
        let html_select = $(".td-sel-conttype").html();
        html = `
        <tr class="pettycash_detail">
            <td class="td-sel-conttype"><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                </select></td>
            <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>THB</option>
                <option value="">USD</option>
                <option value="">RMB</option>
            </select></td>
            <td>
                <button type="button" class="btn btn-warning rounded-pill btn-xs"><i class="bi bi-pencil-fill"></i> Edit</button>
                <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-trash"></i> Delete</button>
            </td>
        </tr>
        `;
        $('[name="pettycash-tbl"]>tbody').append(html);
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

        } else {

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

        if (action == 'preview') {
            booking.set_preview_data(job_number);
        } else {

        }
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
        $('.inp-jobno').val(res_data['job_number']);
        $('.inp-bkno').val(res_data['booking_number']).attr('readonly', true);
        $('.inp-remark').val(res_data['remark']).attr('readonly', true);
        $('.inp-M_vessel').val(res_data['mother_vessel']).attr('readonly', true);
        $('.inp-mother-voy-no').val(res_data['voy_no_mother']).attr('readonly', true);
        $('.feeder_vessel').val(res_data['feeder_vessel']).attr('readonly', true);
        $('.inp-feeder_voy_no').val(res_data['voy_no_feeder']).attr('readonly', true);
        $('.inp-shper').val(res_data['shipper_number']).attr('disabled', true);
        $('.inp-shptrm').val(res_data['st_number']).attr('disabled', true);
        $('.inp-carrier').val(res_data['carrier_number']).attr('disabled', true);
        $('.inp-prtrecieve').val(res_data['port_of_receipt_number']).attr('disabled', true);
        $('.inp-delivery').val(res_data['port_of_delivery_number']).attr('disabled', true);

        $('.inp-prtload').val(res_data['port_of_loading_number']).attr('disabled', true);
        $('.inp-ts_port').val(res_data['ts_port_number']).attr('disabled', true);
        $('.inp-etd').val(res_data['etd']).attr('readonly', true);
        $('.inp-eta').val(res_data['eta']).attr('readonly', true);

    },
};
