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
                        <td align="center"><div class="fs-5 mb-1 inv_pic_show"><i class="bi bi-file-earmark-image" onclick="customs_set_sub_customs.download_file('INV_picture','${res_data['dts']['ID']}')"></i></div></td>
                        <td align="center">${res_data['dts']['INV_receiv_by']}</td>
                        <td align="center">${res_data['dts']['inv_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['INV_check_by']}</td>
                        <td align="center">${res_data['dts']['inv_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_inv()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${inv_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Bill of lading</td>
                        <td align="center"><div class="fs-5 mb-1 bl_pic_show"><i class="bi bi-file-earmark-image" onclick="customs_set_sub_customs.download_file('BL_picture','${res_data['dts']['ID']}')"></i></div></td>
                        <td align="center">${res_data['dts']['BL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['bl_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['BL_check_by']}</td>
                        <td align="center">${res_data['dts']['bl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_bl()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${bl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Packing list</td>
                        <td align="center"><div class="fs-5 mb-1 pl_pic_show"><i class="bi bi-file-earmark-image" onclick="customs_set_sub_customs.download_file('PL_picture','${res_data['dts']['ID']}')"></i></div></td>
                        <td align="center">${res_data['dts']['PL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['pl_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['PL_check_by']}</td>
                        <td align="center">${res_data['dts']['pl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_pl()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${pl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Declaration</td>
                        <td align="center"><div class="fs-5 mb-1 id_pic_show"><i class="bi bi-file-earmark-image" onclick="customs_set_sub_customs.download_file('ID_picture','${res_data['dts']['ID']}')"></i></div></td>
                        <td align="center">${res_data['dts']['ID_receiv_by']}</td>
                        <td align="center">${res_data['dts']['id_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['ID_check_by']}</td>
                        <td align="center">${res_data['dts']['id_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_id()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${id_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Licence</td>
                        <td align="center"><div class="fs-5 mb-1 il_pic_show"><i class="bi bi-file-earmark-image" onclick="customs_set_sub_customs.download_file('IL_picture','${res_data['dts']['ID']}')"></i></div></td>
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
        $('.inp_clearance_date_plan').val(res_data['dtsa']['clearlance_date'])

        res_data['dts']['INV_picture'] == '' ? $('.inv_pic_show').attr('hidden', true) : '';
        res_data['dts']['BL_picture'] == '' ? $('.bl_pic_show').attr('hidden', true) : '';
        res_data['dts']['PL_picture'] == '' ? $('.pl_pic_show').attr('hidden', true) : '';
        res_data['dts']['ID_picture'] == '' ? $('.id_pic_show').attr('hidden', true) : '';
        res_data['dts']['IL_picture'] == '' ? $('.il_pic_show').attr('hidden', true) : '';

        if (res_data['dts']['custom_by'] == null || res_data['dts']['custom_by'] == "") {
            status_btn = '';
        } else {
            status_btn = 'hidden';
        }

        $('.add_btn_clearance').html('');
        html_btn = `
        <div style="float: right">
            <button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs_set_sub_customs.push_action_clearance()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${status_btn}><i class="bi bi-check-square"></i> Clearance success</button>
        </div>`;
        $('.add_btn_clearance').append(html_btn);
        $('.add_container_upload').html('');
        let html_container_upload ='';    
        $.each(res_data['container'],function(i,v){

            let container_nubmer = v['container_number'] ? v['container_number'] : "";
            let up_datetime_cntr = v['up_datetime_cntr'] ? v['up_datetime_cntr'] : "";
            let up_pro_cntr = v['up_pro_cntr'] ? v['up_pro_cntr'] : "";
            let up_f = v['up_f'] ? v['up_f'] : "";
            let up_l = v['up_l'] ? v['up_l'] : "";
            let up_status_cntr = v['up_status_cntr']? v['up_status_cntr'] : "";
            let id = v['ID']? v['ID'] : "";

            let cf = '';
            let tb = '';
            if(up_status_cntr == '1'){
                cf = "disabled";
                tb = "";
            }else if(up_status_cntr == '2'){
                tb = "disabled";
                cf = "";
            }
            html_container_upload += `
            <div class="form-group row">
                <div class="row">
                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">cntr no. ${container_nubmer} :</label>
                    <div class="col-sm-9 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <input type="input" class="form-control form-control-sm" value="${up_f+' '+up_l}" readonly>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <input type="input" class="form-control form-control-sm" value="${up_datetime_cntr}" readonly>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                                <button class="btn btn-success" ${cf} onclick="customs_set_sub_customs.modal_ship('upl_f','${id}')">Confirm</button>
                                <button class="btn btn-danger " ${tb} onclick="customs_set_sub_customs.modal_ship('upl_t','${id}')">Troubleshoot</button>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                                <input type="input" class="form-control form-control-sm" value="${up_pro_cntr}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        })
        $('.add_container_upload').append('Conatiner upload'+html_container_upload);

        $('.add_container_ar').html('');
        
        let html_container_ar = '';
        $.each(res_data['container'],function(i,v){
            let id = v['ID'] ? v['ID'] : '';

            let cntr_f = v['cntr_f'] ? v['cntr_f'] : '';
            let cntr_l = v['cntr_l'] ? v['cntr_l'] : '';
            let cntr_pro = v['cntr_pro'] ? v['cntr_pro'] : '';
            let cntr_status_ar = v['cntr_status_ar'] ? v['cntr_status_ar'] : '';
            let cntr_datetime = v['cntr_datetime'] ? v['cntr_datetime'] : '';
            let cntr_up_by = v['cntr_up_by'] ? v['cntr_up_by'] : '';
            let container_nubmer = v['container_number'] ? v['container_number'] : "";

            let cf = '';
            let tb = '';
            if(cntr_status_ar == '1'){
                cf = "disabled";
                tb = "";
            }else if(cntr_status_ar == '2'){
                tb = "disabled";
                cf = "";
            }
            html_container_ar += `
            <div class="form-group row">
                <div class="row">
                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">cntr no. ${container_nubmer} :</label>
                    <div class="col-sm-9 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <input type="input" class="form-control form-control-sm" value="${cntr_f+' '+cntr_l}" readonly>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <input type="input" class="form-control form-control-sm" value="${cntr_datetime}" readonly>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                                <button class="btn btn-success" ${cf} onclick="customs_set_sub_customs.modal_ship('conar_f','${id}')">Confirm</button>
                                <button class="btn btn-danger " ${tb} onclick="customs_set_sub_customs.modal_ship('conar_t','${id}')">Troubleshoot</button>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                                <input type="input" class="form-control form-control-sm" value="${cntr_pro}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        })
        $('.add_container_ar').append('Conatiner arrived'+html_container_ar);

        $('.add_container_cy').html('');
        
        let html_container_cy = '';
        $.each(res_data['container'],function(i,v){
            let id = v['ID'] ? v['ID'] : '';

            let cy_f = v['cy_f'] ? v['cy_f'] : '';
            let cy_l = v['cy_l'] ? v['cy_l'] : '';
            let cy_pro_cntr = v['cy_pro_cntr'] ? v['cy_pro_cntr'] : '';
            let cy_status_cntr = v['cy_status_cntr'] ? v['cy_status_cntr'] : '';
            let cy_datetime_cntr = v['cy_datetime_cntr'] ? v['cy_datetime_cntr'] : '';
            let cntr_up_by = v['cntr_up_by'] ? v['cntr_up_by'] : '';
            let container_nubmer = v['container_number'] ? v['container_number'] : "";

            let cf = '';
            let tb = '';
            if(cy_status_cntr == '1'){
                cf = "disabled";
                tb = "";
            }else if(cy_status_cntr == '2'){
                tb = "disabled";
                cf = "";
            }
            html_container_cy += `
            <div class="form-group row">
                <div class="row">
                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">cntr no. ${container_nubmer} :</label>
                    <div class="col-sm-9 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <input type="input" class="form-control form-control-sm" value="${cy_f+' '+cy_l}" readonly>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <input type="input" class="form-control form-control-sm" value="${cy_datetime_cntr}" readonly>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                                <button class="btn btn-success" ${cf} onclick="customs_set_sub_customs.modal_ship('cyf','${id}')">Confirm</button>
                                <button class="btn btn-danger " ${tb} onclick="customs_set_sub_customs.modal_ship('cyt','${id}')">Troubleshoot</button>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                                <input type="input" class="form-control form-control-sm" value="${cy_pro_cntr}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        })
        $('.add_container_cy').append('Conatiner arrived'+html_container_cy);


        let ship_st = res_data['dtcr']['ship_arrived_status'] ? res_data['dtcr']['ship_arrived_status'] : '';
        let ship_time = res_data['dtcr']['ship_arrievd_st'] ? res_data['dtcr']['ship_arrievd_st'] : '';
        let ship_p = res_data['dtcr']['ship_pro'] ? res_data['dtcr']['ship_pro'] : '';
        let ship_f = res_data['dtcr']['f_ship'] ? res_data['dtcr']['f_ship'] : '';
        let ship_l = res_data['dtcr']['l_ship'] ? res_data['dtcr']['l_ship'] : '';
        let cus_st = res_data['dtcr']['Cus_status'] ? res_data['dtcr']['Cus_status'] : '';
        let cus_time = res_data['dtcr']['Cus_suc_datetime'] ? res_data['dtcr']['Cus_suc_datetime'] : '';
        let cus_pro = res_data['dtcr']['cus_pro'] ? res_data['dtcr']['cus_pro'] : '';
        let cus_f = res_data['dtcr']['f_cus'] ? res_data['dtcr']['f_cus'] : '';
        let cus_l = res_data['dtcr']['l_cus'] ? res_data['dtcr']['l_cus'] : '';
        let cy_time = res_data['dtcr']['cy_rtn'] ? res_data['dtcr']['cy_rtn'] : '';
        let cy_f = res_data['dtcr']['f_cy'] ? res_data['dtcr']['f_cy'] : '';
        let cy_l = res_data['dtcr']['l_cy'] ? res_data['dtcr']['l_cy'] : '';

        let drop_status = res_data['dtcr']['drop_status'] ? res_data['dtcr']['drop_status'] : '';
        let drop_datetime = res_data['dtcr']['drop_datetime'] ? res_data['dtcr']['drop_datetime'] : '';
        let drop_pro = res_data['dtcr']['drop_pro'] ? res_data['dtcr']['drop_pro'] : '';
        let drop_f = res_data['dtcr']['drop_f'] ? res_data['dtcr']['drop_f'] : '';
        let drop_l = res_data['dtcr']['drop_l'] ? res_data['dtcr']['drop_l'] : '';


        $('.inp-c_dropb').val(drop_f+' '+drop_l)
        $('.inp-c_dropt').val(drop_datetime)
        $('.inp-c_dropp').val(drop_pro)


        $('.inp-sab').val(ship_f + ' ' + ship_l)
        $('.inp-sat').val(ship_time)
        $('.inp-cus_by').val(cus_f + ' ' + cus_l)
        $('.inp-cus_time').val(cus_time)
        $('.inp-cyb').val(cy_f + ' ' + cy_l)
        $('.inp-cyt').val(cy_time)

        $('.inp-cus_p').val(cus_pro)
        $('.inp-sap').val(ship_p)

        if (ship_st == "1") {
            $('.ship_cf').attr('disabled', true);
            $('.ship_tb').attr('disabled', false);
        } else if (ship_st == "2") {
            $('.ship_tb').attr('disabled', true)
            $('.ship_cf').attr('disabled', false);
        }

        if (cus_st == "1") {
            $('.cus_cf').attr('disabled', true);
            $('.cus_tb').attr('disabled', false);
        } else if (ship_st == "2") {
            $('.cus_tb').attr('disabled', true)
            $('.cus_cf').attr('disabled', false);
        }

        if (drop_status == "1") {
            $('.cd_cf').attr('disabled', true);
            $('.cd_tb').attr('disabled', false);
        } else if (drop_status == "2") {
            $('.cd_tb').attr('disabled', true)
            $('.cd_cf').attr('disabled', false);
        }


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

    download_file: function (e = null, valid) {


        let type = e;


        console.log(type)
        console.log(valid)

        let data = {
            'type': type,
            'valid': valid
        }

        $.ajax({
            type: "post",
            url: "php/customs/download_file_sub_custom.php",
            data: data,
            dataType: 'json',
            success: function (response) {
                var newTab = window.open();
                newTab.document.write('<html><body><img src="' + response + '"></body></html>');
            }
        });
    },
    modal_ship: function (type_st,id) {
        let context_1 = '';
        let textbox_1 = '';
        if (type_st == "saf") {
            context_1 = "ship has arrived ?";
            textbox_1 = "";
        } else if (type_st == "satb") {
            context_1 = "ship has problem ?";
            textbox_1 = `<input type="input" class="form-control text-center inp_get_pro " placeholder="plese put your problem">`
        } else if (type_st == "ccf") {
            context_1 = "customs clearance has successful ?";
            textbox_1 = "";
        } else if (type_st == "cctb") {
            context_1 = "customs clearance has problem";
            textbox_1 = `<input type="input" class="form-control text-center inp_get_pro" placeholder="plese put your problem">`
        } else if (type_st == "upl_f"){
            context_1 = "container upload successful ?";
            textbox_1 = "";
        } else if (type_st == "upl_t"){
            context_1 = "container upload has problem ?";
            textbox_1 = `<input type="input" class="form-control text-center inp_get_pro" placeholder="plese put your problem">`;
        } else if (type_st == "cdf"){
            context_1 = "container dropodd has successful ?";
            textbox_1 = "";
        } else if (type_st == "cdt"){
            context_1 = "container dropoff has problem ?";
            textbox_1 = `<input type="input" class="form-control text-center inp_get_pro" placeholder="plese put your problem">`;
        } else if (type_st == "conar_f"){
            context_1 = "container has arrived is successful ?";
            textbox_1 = "";
        } else if (type_st == "conar_t"){
            context_1 = "container has problem ?";
            textbox_1 = `<input type="input" class="form-control text-center inp_get_pro" placeholder="plese put your problem">`;
        } else if (type_st == "cyf"){
            context_1 = "Return to CY has successful ?";
            textbox_1 = "";
        } else if (type_st == "cyt"){
            context_1 = "Return to CY has problem ?";
            textbox_1 = `<input type="input" class="form-control text-center inp_get_pro" placeholder="plese put your problem">`;
        }
        Swal.fire({
            title: `Are you sure ${context_1}`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            html: `${textbox_1}`,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let input_data = $('.inp_get_pro').val()
                
                let res_return = await this.ajax_modal_ship(type_st,input_data,id)
                
                
                    if (res_return == true) {
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
                     customs_set_sub_customs.set_preview_table_document(customs.job_number_global);
            }
        })
    },

    ajax_modal_ship: function (type_st,input_data,id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/st_up.php",
                data: {
                    'type_st': type_st,
                    'input_data': input_data,
                    'job_number' : customs.job_number_global,
                    'id' : id,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                }
            });
        });
    },

    // modal_container : function(type_st){
    //     if ($('#add_moda').length >= 1) {
    //         $('#add_moda').remove()
    //     }

    //     let head_modal = '';
    //     if(type_st == "cond"){
    //         head_modal = "Container Dropoff side ship status"
    //     }else if(type_st == "conf"){
    //         head_modal = "Container upload to truck for delivery"
    //     }

    //     html = `
    //         <div class="modal fade" id="add_moda">
    //             <div class="modal-dialog modal-xl">
    //                 <div class="modal-content">
    //                     <!-- Modal Header -->
    //                     <div class="modal-header">
    //                     <h4 class="modal-title">${head_modal}</h4>
    //                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    //                     </div>

    //                     <!-- Modal body -->
    //                     <div class="modal-body ps-3">
    //                         <div class="form-group">
    //                             <div class="form-group">
    //                                 <div class="row">
    //                                     <div class="col-sm-3 col-md-3 col-lg-3">
    //                                         <label class="control-label">Container number</label>
    //                                     </div>
    //                                     <div class="col-sm-3 col-md-3 col-lg-3 text-center">
    //                                         <input class="form-control form-control-sm" readonly>
    //                                     </div>
    //                                     <div class="col-sm-3 col-md-3 col-lg-3 text-center">
    //                                         <button class="btn btn-success btn-sm mr-2">Success</buttom>
    //                                         <button class="btn btn-danger btn-sm">Troubleshoot</buttom>
    //                                     </div>
                                        
    //                                     <div class="col-sm-3 col-md-3 col-lg-3 text-center">
    //                                         <input class="form-control form-control-sm" readonly>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>

    //                     <!-- Modal footer -->
    //                     <div class="modal-footer">
    //                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    //                     </div>

    //                 </div>
    //             </div>
    //         </div>`

    //     $('body').append(html)
    //     $('#add_moda').modal('show')
    // },

}
