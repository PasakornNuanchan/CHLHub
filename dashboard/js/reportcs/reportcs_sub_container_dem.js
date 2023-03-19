const reportcs_sub_container_dem = {
    db_dem_container_global : '',
    ajax_set_preview_data: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/reportcs/set_data_dem.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    set_preview_data: async function (job_number) {

        let res_data = await reportcs_sub_container_dem.ajax_set_preview_data(job_number);
        console.log(res_data);

        html_dem_charge = '';
        db_dem_container = $('.sel-dem-container').parent().html()
        reportcs_sub_container_dem.db_dem_container_global = db_dem_container
        let db_dem_cy = $('.inp-dem-cy').parent().html()
        let db_dem_rtn = $('.inp-dem-rtn').parent().html()
        $('.Demurrage-part-add').html('');

        num_dem = '1';
        if(res_data['dem'] != "0 results"){
        $.each(res_data['dem'], async function (i, v) {

            container_id = v['container_id']

            $html_dem_rum = '';

            if(num_dem == 1){
                $html_dem_rum =  `<button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="reportcs.push_action_del_dem(${v['ID']},this);" disabled><i class="bi bi-dash-lg"></i> Delete Driver</button>`;
            }else{
                $html_dem_rum = `<button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="reportcs.push_action_del_dem(${v['ID']},this);" ><i class="bi bi-dash-lg"></i> Delete Driver</button>`;
            }


            html_dem_charge = `    
        <div class="Demurrage-part-del Demurrage-part-del${v['ID']}" Demurrage_part_del="${v['ID']}">
        <br>
            <h5>Demurrage No.${num_dem}</h5>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2">Container number:</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="db-sel-dem db-sel-dem${i}">
                                ${db_dem_container}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2">CY :</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="input" class="form-control form-control-sm inp-cy-dem" value="${v['CY']}" readonly>
                        </div>
                        <label class="control-label col-sm-3 col-lg-1" style="text-align:center;">OLD RTN :</label>
                        <div class="col-lg-4">
                            <input type="input" class="form-control form-control-sm inp-rtn-dem" value="${v['RTN']}"readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2">Demurrage To :</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="date" class="form-control form-control-sm inp-rtn-new-dem" value="${v['new_dem_time']}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2">Document :</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="file" class="form-control form-control-sm inp-doc-dem">
                        </div>
                        <div class="col-lg-4">
                        ${$html_dem_rum}
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
            num_dem++;
            $('.Demurrage-part-add').append(html_dem_charge);
            $(`.db-sel-dem${i} > select`).val(container_id)



        })
    }
    },
};
