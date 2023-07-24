const function_sub_reportcs = {
    lunch_photo: async function (type_request, id_request) {
        let type_used = '';
        if (type_request == "inv") {
            type_used = "INV_picture";
        } else if (type_request == "bl") {
            type_used = "BL_picture";
        } else if (type_request == "pl") {
            type_used = "PL_picture";
        } else if (type_request == "id") {
            type_used = "ID_picture";
        } else if (type_request == "il") {
            type_used = "IL_picture";
        }
    
        let res_data = await this.ajax_request_lunch_photo(type_used, id_request)
        

    },

    ajax_request_lunch_photo: async function (type_request, id_request) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_lunch_photo.php",
                data: {
                    type_request: type_request,
                    id_request: id_request,
                },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },


    update_document_date: async function (type_request) {
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");
        let res_data = await this.ajax_update_document_date(type_request,id_number);

        if(res_data['arr_res'] == '1'){
            await Swal.fire(
                'Save it!',
                'Your save file successful.',
                'success'
              )
            await sub_reportcs.first_post_data(id_number)
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System error plese contact to tech team',
              })
        }

    },

    ajax_update_document_date: async function (type_request,id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/update_status_reportcs.php",
                data: {
                    type_request: type_request,
                    id_number: id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    update_shipping_data : async function(){
        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");
        let ats_data = $('.inp_ats').val()
        
        let res_data = await this.ajax_update_shipping_data(ats_data,id_number);

        if(res_data['arr_res'] == '1'){
            await Swal.fire(
                'Save it!',
                'Your file has been deleted.',
                'success'
              )
            await sub_reportcs.first_post_data(id_number)
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'System error plese contact to tech team',
              })
        }

    },

    ajax_update_shipping_data: async function (ats_data,id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/update_status_add_shipping.php",
                data: {
                    ats_data: ats_data,
                    id_number: id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    modal_doc: function (val_get) {
        if ($('#add_moda').length >= 1) {
            $('#add_moda').remove()
        }
        let head_modal = '';
        if (val_get == "inv") {
            head_modal = "invoice"
        } else if (val_get == "bl") {
            head_modal = "Bill of landing"
        } else if (val_get == "pl") {
            head_modal = "Packing list"
        } else if (val_get == "id") {
            head_modal = "Import Declaratio"
        } else if (val_get == "il") {
            head_modal = "Import Licence"
        }

        html = `
            <div class="modal fade" id="add_moda" docs_type="${val_get}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">${head_modal}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body ">
                            <div class="form-group">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3" for="">upload file :</label>
                                    <div class="col">
                                        <input type="file" class="form-control form-control-sm inp_file_cs " >
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="function_sub_reportcs.save_doc_image(this,'${val_get}')">Save Docs</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                
                    </div>
                </div>
            </div>`

        $('body').append(html)
        $('#add_moda').modal('show')
    },

    save_doc_image: async function (e = null,val_get) {

        var currentURL = window.location.href;
        var url = new URL(currentURL);
        var id_number = url.searchParams.get("job_number");

        let id_update = id_number;

        let base_64_file = $('.inp_file_cs').prop('files')[0];
        const Base_64_file = await convert_file(base_64_file);
        
        let data = {
            id_update : id_update,
            picture : Base_64_file,
            val_get : val_get
        }
    
    
        let res = await this.ajax_save_docs(data);
        if (res == '1') {
            $('#add_moda').modal('hide');
            Swal.fire(
                'saved!',
                'Your file has been saved.',
                'success'
            )
            
        } else {
            Swal.fire(
                'Error!',
                'Your file has not been saved.',
                'error'

            )
        }
        sub_reportcs.first_post_data(id_number)
    },

    ajax_save_docs: function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/save_docs_reportcs.php",
                data: data,
                dataType: 'json',
                success: function (response) {
                    resolve(response)
                }
            });
        });
    },
}
async function convert_file(data) {

    const base64String = await toBase64(data);
    return (base64String);
}

function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

