const customs_set_sub_customs = {
    ajax_set_preview_booking: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/set_sub_customs.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    set_preview_table_document: async function (job_number) {
        // sub page Customs&Document
        $('[name = tbl_job_status] tbody').html('');
        //status
        let res_data = await customs_set_sub_customs.ajax_set_preview_booking(job_number)
        console.log(res_data)
        inv_status = (res_data['dts']['INV_receiv_by'] != "" && res_data['dts']['INV_check_by'] == "") ? '' : 'disabled';


        bl_status = (res_data['dts']['BL_receiv_by'] != "" && res_data['dts']['BL_check_by'] == "") ? '' : 'disabled';


        pl_status = (res_data['dts']['PL_receiv_by'] != "" && res_data['dts']['PL_check_by'] == "") ? '' : 'disabled';


        id_status = (res_data['dts']['ID_receiv_by'] != "" && res_data['dts']['ID_check_by'] == "") ? '' : 'disabled';


        il_status = (res_data['dts']['IL_receiv_by'] != "" && res_data['dts']['IL_check_by'] == "") ? '' : 'disabled';

        html_detail_des = `
                    <tr>
                        <td>Invoice : </td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['INV_receiv_by']}</td>
                        <td align="center">${res_data['dts']['inv_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['INV_check_by']}</td>
                        <td align="center">${res_data['dts']['inv_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_inv()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${inv_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Bill of lading</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['BL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['bl_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['BL_check_by']}</td>
                        <td align="center">${res_data['dts']['bl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_bl()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${bl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Packing list</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['PL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['pl_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['PL_check_by']}</td>
                        <td align="center">${res_data['dts']['pl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_pl()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${pl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Declaration</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['ID_receiv_by']}</td>
                        <td align="center">${res_data['dts']['id_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['ID_check_by']}</td>
                        <td align="center">${res_data['dts']['id_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_id()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${id_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Licence</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['IL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['il_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['IL_check_by']}</td>
                        <td align="center">${res_data['dts']['il_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_il()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${il_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                `;
        $('[name = tbl_job_status] tbody').html(html_detail_des);
        $('.inp-etd').val(res_data['dts']['']).attr('readonly', true);
        $('.inp-clearance_by').val(res_data['dts']['custom_by']).attr('readonly', true);
        $('.inp-datetime_success').val(res_data['dts']['Cus_suc_datetime']).attr('readonly', true);


        if (res_data['dts']['custom_by'] == null || res_data['dts']['custom_by'] == "") {
            status_btn = '';
        } else {
            status_btn = 'hidden';
        }

        $('.add_btn_clearance').html('');
        html_btn = `
        <div style="float: right">
            <button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs.push_action_clearance()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${status_btn}><i class="bi bi-check-square"></i> Clearance success</button>
        </div>`;
        $('.add_btn_clearance').append(html_btn);
    },

    // clerance
    push_action_clearance: async function (save_data) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await customs_set_sub_customs.ajax_save_push_clearance(customs.job_number_global)
                console.log(res);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'

                )
                customs_set_sub_customs.set_preview_table_document(customs.job_number_global);
            }
        })
    },

    //push description
    push_action_inv: async function (save_data) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await customs_set_sub_customs.ajax_save_push_inv(customs.job_number_global)
                console.log(res);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                customs_set_sub_customs.set_preview_table_document(customs.job_number_global);
            }
        })
    },
    push_action_bl: async function (save_data) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await customs_set_sub_customs.ajax_save_push_bl(customs.job_number_global)
                console.log(res);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                customs_set_sub_customs.set_preview_table_document(customs.job_number_global);
            }
        })
    },
    push_action_pl: async function (save_data) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await customs_set_sub_customs.ajax_save_push_pl(customs.job_number_global)
                console.log(res);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                customs_set_sub_customs.set_preview_table_document(customs.job_number_global);
            }
        })
    },
    push_action_id: async function (save_data) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await customs_set_sub_customs.ajax_save_push_id(customs.job_number_global)
                console.log(res);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                customs_set_sub_customs.set_preview_table_document(customs.job_number_global);
            }
        })
    },
    push_action_il: async function (save_data) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await customs_set_sub_customs.ajax_save_push_il(customs.job_number_global)
                console.log(res);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                customs_set_sub_customs.set_preview_table_document(customs.job_number_global);
            }
        })
    },

    ajax_save_push_clearance: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_clearance.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    ajax_save_push_inv: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_inv.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_push_bl: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_bl.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_push_pl: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_pl.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_push_id: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_id.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_push_il: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_il.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

}
