const job_detail = {


    set_header_page: async function () {

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");


        let res = await this.get_job_number(id_number)
        
        $('.head-of-menu').html('Job Detail');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Job Detail</a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Job (Job Number ${res})</li>
        `;
        $('.bcpage').append(html_bdpage);



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

        let get_action = getUrlParameter('action');

        
        if (get_action == "preview") {
            await setting_data_default.setting_data(id_number);
            await sub_gang_bl.setting_first_bl_gang();
            await sub_job_detail.first_post_data(id_number);
            await sub_transport.first_post_data(id_number);
            await sub_reportcs.first_post_data(id_number);
            await sub_customs.first_post_data(id_number);
            //await sub_bl.first_post_data(id_number);
            await sub_billing.first_post_data_ar(id_number);
            await sub_billing.first_post_data_ap(id_number);
            await sub_withdraw.first_post_data(id_number);
            await permission_file.check_permission()
            // await log_job_check.lock_job_checl()
        } else if (get_action == "create") {
            await setting_data_default.setting_data();
            await create_job.setting_create_job();
        } else if (get_action == "invoice_mode"){
            await setting_data_default.setting_data(id_number);
            await sub_billing.first_post_data_ar(id_number);
            await sub_billing.first_post_data_ap(id_number);
            $('#transport_tab').remove()
            $('#job_detail_tab').remove()
            $('#reportcs_tab').remove()
            $('#withdraw_tab').remove()
            $('#customs_tab').remove()
            $('#job_detail_tab_target').removeClass("show")
            $('#job_detail_tab_target').removeClass("active")
            
            $('#billing_tab_target').addClass("active")
            $('#billing_tab_target').addClass("show")
            $('.btn_add_new_list_ap').remove()
            $('.btn_add_new_list_ar').remove()
            $('.hide_mode_invoice').remove()
            $('.btn_del_ar').remove()
            $('.btn_delete_list_billing').remove()
            $('.inp_box_select_ap').remove()
            $('.inp_box_select_ar').remove()
            $('.btn_save_mode_invoice').html('<button class="btn btn-success" onclick="function_sub_billing.save_all_billing()"><i class="bi bi-save"></i> Save</button>')

            $('.sel_data_billing_ap').attr('disabled',false)
            $('.inp_billing_to_ap').attr('disabled',false)
            $('.inp_currency_ap').attr('disabled',false)
            $('.inp_qty').attr('disabled',false)
            $('.inp_unit_price').attr('disabled',false)
            $('.inp_vat').attr('disabled',false)
            $('.chb_tax_hold').attr('disabled',false)
            $('.inp_remark_ap').attr('disabled',false)

            $('.select_code_billing_ar').attr('disabled',false)
            $('.select_bill_to_ar').attr('disabled',false)
            $('.inp_currency_ar').attr('disabled',false)
            $('.inp_qty_ar').attr('disabled',false)
            $('.inp_unit_price').attr('disabled',false)
            $('.inp_vat_ar').attr('disabled',false)
            $('.inp_wt_percentage').attr('disabled',false)
            $('.inp_remark').attr('disabled',false)

        }


    },

    
    get_job_number : async function (id_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
            type: "post",
            url: "php/job_detail/get_job_number.php",
            data : {id_number :id_number},
            dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

};
