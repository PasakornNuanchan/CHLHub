const create_bill_to = {
    modal_start : async function (){
        if ($('#add_moda_bill_to').length >= 1) {
            $('#add_moda_bill_to').remove()
        }


        let res_data_row = await this.ajax_request_billto();
        let html_data_list = '';
        
            $.each(res_data_row['bill_to'],function(i,v){


                let id_number = v['ID'] ? v['ID'] : '';
                let corp_name = v['corp_name'] ? v['corp_name'] : '';
                let tax_id = v['tax_id'] ? v['tax_id'] : '';
                let address = v['address'] ? v['address'] : '';

                i++;
                html_data_list += `
                <tr>
                    <td>${i}</td>
                    <td>${corp_name}</td>
                    <td>${tax_id}</td>
                    <td class="sticktopaddress" style="text-overflow: ellipsis; width:100px">${address}</td>
                </tr>
                `;
            })
        
        
        
        html = `
            <div class="modal  fade" id="add_moda_bill_to" >
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Description</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body ps-5">
                            <div class="part_input_description mt-3 p-4">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-2">
                                            <label>Corp name</label>
                                        </div>
                                        <div class="col-10">
                                            <input class="form-control form-control-sm rounded inp_get_corp_billto" maxlength="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-2">
                                            <label>Tax id</label>
                                        </div>
                                        <div class="col-10">
                                            <input class="form-control form-control-sm rounded inp_get_tax_id_billto" maxlength="40">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-2">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-10">
                                            <textarea class="form-control rounded inp_address_billto" row="4" maxlength="400"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end"><button class="btn btn-success btn-sm" onclick="create_bill_to.save_data_billto()">save</button></div>
                            </div>
                            <div class="bd-example table-responsive mt-4" style="height:300px;">
                                <table class="table table-hover table_description_add" style="overflow: scroll;">
                                    <thead>
                                        <tr class="text-center" >
                                            <th class="sticky-top"">No.</th>
                                            <th class="sticky-top">Corp Name</th>
                                            <th class="sticky-top">Tax id</th>
                                            <th class="sticky-top">Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${html_data_list}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>`

        $('body').append(html)
        $('#add_moda_bill_to').modal('show')
    },

    ajax_request_billto : async function(){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv/get_data_bill_to_add.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    save_data_billto : async function (){
        let corp_billto =  $('.inp_get_corp_billto').val()
        let tax_id_billto =  $('.inp_get_tax_id_billto').val()
        let address_billto =  $('.inp_address_billto').val()
        
        if(corp_billto == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your data corp name for saved',
            })
        }else{
            let obj_data = {
                corp_billto : corp_billto,
                tax_id_billto : tax_id_billto,
                address_billto : address_billto,
            }
            
            let res_data_save = await this.ajax_save_description(obj_data)
            if(res_data_save == '1'){
                await Swal.fire(
                    'Save it!',
                    'Your file has been save.',
                    'success'
                )
                await $('#add_moda_bill_to').modal('hide');
                await setup.setting_default();
                let data_card_body_save = $('.card_body_save').length
                
                if(data_card_body_save == 1){
                    await setup.add_list()
                }
                // console.log(data_card_body_save)
                await create_bill_to.modal_start()
            }
        }

        
    },

    ajax_save_description : async function(obj_data){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv/save_data_billto_add.php",
                data : obj_data,
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}