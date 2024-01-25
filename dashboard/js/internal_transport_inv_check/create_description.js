const create_description = {
    modal_start : async function (){
        if ($('#add_moda_description').length >= 1) {
            $('#add_moda_description').remove()
        }


        let res_data_row = await this.ajax_request_description();
        let html_data_list = '';
        
            $.each(res_data_row['description'],function(i,v){


                let id_number = v['ID'] ? v['ID'] : '';
                let description_name = v['description_name'] ? v['description_name'] : '';
                i++;
                html_data_list += `
                <tr>
                    <td>${i}</td>
                    <td>${description_name}</td>
                </tr>
                `;
            })
        
        
        
        html = `
            <div class="modal  fade" id="add_moda_description" >
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
                                            <label>Description</label>
                                        </div>
                                        <div class="col-10">
                                            <input class="form-control form-control-sm rounded inp_get_description_des_add" maxlength="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end"><button class="btn btn-success btn-sm" onclick="create_description.save_data_description()">save</button></div>
                            </div>
                            <div class="bd-example table-responsive mt-4" style="height:300px;">
                                <table class="table table-hover table_description_add" style="overflow: scroll;">
                                    <thead>
                                        <tr class="text-center" >
                                            <th class="sticky-top">No.</th>
                                            <th class="sticky-top">Description name</th>
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
        $('#add_moda_description').modal('show')
    },

    ajax_request_description : async function(){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv/get_data_description_add.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    save_data_description : async function (){
        let data_description =  $('.inp_get_description_des_add').val()
        
        if(data_description == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your data description for saved',
            })
        }else{
            let obj_data = {
                data_description : data_description,
            }
            
            let res_data_save = await this.ajax_save_description(obj_data)
            if(res_data_save == '1'){
                await Swal.fire(
                    'Save it!',
                    'Your file has been save.',
                    'success'
                )
                await $('#add_moda_description').modal('hide');
                await setup.setting_default();
                let data_card_body_save = $('.card_body_save').length
                
                if(data_card_body_save == 1){
                    await setup.add_list()
                }
                // console.log(data_card_body_save)
                await create_description.modal_start()
            }
        }

        
    },

    ajax_save_description : async function(obj_data){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/internal_transport_inv/save_data_description_add.php",
                data : obj_data,
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}