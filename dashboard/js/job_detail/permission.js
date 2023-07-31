const permission_file = {
    check_permission : async function (){
        let res_data = await this.get_permission();

        if(res_data['data_permission']['job_detail'] == "2"){
            $('#job_detail_tab_target').find('.form-control').attr('disabled',true)
            $('#job_detail_tab_target').find('.form-select').attr('disabled',true)
            $('#job_detail_tab_target').find('.form-check-input').attr('disabled',true)
            $('#job_detail_tab_target').find('.btn').remove()
        }else if(res_data['data_permission']['job_detail'] == "3"){
            $('#job_detail_tab').remove()
            $('#job_detail_tab_target').remove()
        }

        if(res_data['data_permission']['transport'] == "2"){
            $('#transport_tab_target').find('.form-control').attr('disabled',true)
            $('#transport_tab_target').find('.form-select').attr('disabled',true)
            $('#transport_tab_target').find('.form-check-input').attr('disabled',true)
            $('#transport_tab_target').find('.btn').remove()
        }else if(res_data['data_permission']['transport'] == "3"){
            $('#transport_tab').remove()
            $('#transport_tab_target').remove()
        }


        if(res_data['data_permission']['reportcs'] == "2"){
            $('#reportcs_tab_target').find('.form-control').attr('disabled',true)
            $('#reportcs_tab_target').find('.form-select').attr('disabled',true)
            $('#reportcs_tab_target').find('.form-check-input').attr('disabled',true)
            $('#reportcs_tab_target').find('.btn').remove()
        }else if(res_data['data_permission']['reportcs'] == "3"){
            $('#reportcs_tab').remove()
            $('#reportcs_tab_target').remove()
        }

        if(res_data['data_permission']['customs'] == "2"){
            $('#customs_tab_target').find('.form-control').attr('disabled',true)
            $('#customs_tab_target').find('.form-select').attr('disabled',true)
            $('#customs_tab_target').find('.form-check-input').attr('disabled',true)
            $('#customs_tab_target').find('.btn').remove()
        }else if(res_data['data_permission']['customs'] == "3"){
            $('#customs_tab').remove()
            $('#customs_tab_target').remove()
        }

        if(res_data['data_permission']['billing'] == "2"){
            $('#billing_tab_target').find('.form-control').attr('disabled',true)
            $('#billing_tab_target').find('.form-select').attr('disabled',true)
            $('#billing_tab_target').find('.form-check-input').attr('disabled',true)
            $('#billing_tab_target').find('.btn').remove()
        }else if(res_data['data_permission']['billing'] == "3"){
            $('#billing_tab').remove()
            $('#billing_tab_target').remove()
        }

        if(res_data['data_permission']['withdraw'] == "2"){
            $('#withdraw_tab_target').find('.form-control').attr('disabled',true)
            $('#withdraw_tab_target').find('.form-select').attr('disabled',true)
            $('#withdraw_tab_target').find('.form-check-input').attr('disabled',true)
            $('#withdraw_tab_target').find('.btn').remove()
        }else if(res_data['data_permission']['withdraw'] == "3"){
            $('#withdraw_tab').remove()
            $('#withdraw_tab_target').remove()
        }

    },


    get_permission: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_permission.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    }
}