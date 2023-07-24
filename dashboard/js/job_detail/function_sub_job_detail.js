const function_sub_job_detail = {

    arr_delete_container: [],

    delete_row_table_container: async function (data) {
        let tr_master = $(data).closest('tr')
        let get_container = tr_master.attr('container_id')

        if (get_container != '') {
            obj_delete_container = {
                raw_data_delete: get_container
            }
            this.arr_delete_container.push(obj_delete_container)
        }

        $(tr_master).remove()
    },


    get_data_all_page: async function () {

        Swal.fire({
            title: `Are you sure save this data`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let job_number = $('.inp_jobnumber').val()
                let booking_number = $('.inp_bookingnumber').val()
                let consignee = $('.inp_consignee').val()
                let shipper = $('.inp_shipper').val()
                let shipment = $('.inp_shipment').val()
                let remark = $('.inp_remark').val()
                let carrier = $('.inp_carrier').val()
                let port_of_receipt = $('.inp_port_of_receipt').val()
                let port_of_loading = $('.inp_port_of_loading').val()
                let ts_port = $('.inp_ts_port').val()
                let port_of_delivery = $('.inp_port_of_delivery').val()
                let mother = $('.inp_mother_vessel').val()
                let feeder = $('.inp_feeder_vessel').val()
                let etd = $('.inp_etd').val()
                let eta = $('.inp_eta').val()
                let inv = $('.inp_inv').val()
                let mbl = $('.inp_mbl').val()
                let hbl = $('.inp_hbl').val()
                let cargo_des = $('.inp_cargo_des').val()
                let cargo_type = $('.inp_cargo_type').val()
                let quantity = $('.inp_quantity').val()
                let gw = $('.inp_gw').val()
                let vol = $('.inp_vol').val()
                let remark_container = $('.inp_remark_container').val()
                let booking_agent = $('.inp_booking_agent').val()
                let arr_detail_save = []

                obj_detail_save = {
                    job_number: job_number,
                    booking_number: booking_number,
                    consignee: consignee,
                    shipper: shipper,
                    shipment: shipment,
                    remark: remark,
                    carrier: carrier,
                    port_of_receipt: port_of_receipt,
                    port_of_loading: port_of_loading,
                    ts_port: ts_port,
                    port_of_delivery: port_of_delivery,
                    mother: mother,
                    feeder: feeder,
                    etd: etd,
                    eta: eta,
                    inv: inv,
                    mbl: mbl,
                    hbl: hbl,
                    cargo_des: cargo_des,
                    cargo_type: cargo_type,
                    quantity: quantity,
                    gw: gw,
                    vol: vol,
                    remark_container: remark_container,
                    booking_agent: booking_agent
                }

                arr_detail_save.push(obj_detail_save)
                let arr_detail_container = [];
                let obj_detail_container = {};

                $('.table_data_container > tbody > tr').each(function (e) {

                    let container_id = $(this).attr('container_id')
                    let container_type = $(".inp_container_type option:selected", this).val();
                    let container_number = $('.inp_container_number', this).val();
                    let cntw = $('.inp_cntr', this).val();
                    let soc = $('.inp_soc', this).is(":checked") ? '1' : '2' ;
                    let ow = $('.inp_ow', this).is(":checked") ? '1' : '2' ;
                    let cy = $('.inp_cy', this).val();
                    let rtn = $('.inp_rtn', this).val();

                    
                    obj_detail_container = {
                        container_id: container_id,
                        container_type: container_type,
                        container_number: container_number,
                        cntw: cntw,
                        soc: soc,
                        ow: ow,
                        cy: cy,
                        rtn: rtn,
                    }

                    arr_detail_container.push(obj_detail_container)


                });
            

                var currentURL = window.location.href;
                var url = new URL(currentURL);
                var id_number = url.searchParams.get("job_number");

                let res_return = await this.ajax_sent_data_raw(arr_detail_save, arr_detail_container, this.arr_delete_container, id_number)

                if (res_return['arr_data_container_information'] == '1' || res_return['arr_data_delete_container'] == '1' || res_return['arr_data_job_title'] == '1' || res_return['arr_data_save_container'] == '1') {
                    Swal.fire(
                        'saved!',
                        'Your data has been saved.',
                        'success'
                    )
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'System has problem plese contact to thailand tech team ',
                    })
                }
            }
        })
    },

    ajax_sent_data_raw: function (arr_detail_save, arr_detail_container, delete_data, id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/save_data_job_detail.php",
                data: {
                    arr_detail_save: arr_detail_save,
                    arr_detail_container: arr_detail_container,
                    delete_data: delete_data,
                    id_number: id_number
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    add_row_new_container: function () {

        let html_add_new_container = "";
        html_add_new_container = `
    <tr class="text-center header_container_data">
        <td>${html_container_type}</td>
        <td><input type="text" class="form-control form-control-sm inp_container_number"></td>
        <td><input type="number" class="form-control form-control-sm inp_cntr"></td>
        <td><input type="checkbox" class="form-check-input inp_soc"></td>
        <td><input type="checkbox" class="form-check-input inp_ow"></td>
        <td><input type="date" class="form-control form-control-sm inp_cy"></td>
        <td><input type="date" class="form-control form-control-sm inp_rtn"></td>
        <td><button class="btn btn-sm btn-danger" onclick="function_sub_job_detail.delete_row_table_container(this)"><i class="bi bi-trash text-white"></i></button></td>
    </tr>
    `;

        $('.table_data_container > tbody').append(html_add_new_container)
    }


}