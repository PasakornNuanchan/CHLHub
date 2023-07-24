const edit_page_th = {
    count_header_global: 0,
    count_service_global: 0,
    count_event_global: 0,

    start: async function () {
        // await this.add_header();
        // await this.add_service();
        // await this.add_event();
        // await this.add_about();
        // await this.add_contact_us();

        let res = await this.ajax_set_data_preview();
        console.log(res)
        count_header = 0;
        await $.each(res['header'], async function (i, v) {
            let html_header_set = '';
            i++;
            count_data_header = i;
            html_header_set = `
            <div class="row mt-2 md-2  header_raw header_data_${v['ID']}" header_data = ${v['ID']} >
                <div class="col-xl-2"><label>header ${i}</label></div>
                <div class="col-xl-4"><input type="text" class="form-control header_context_raw header_context${i}" placeholder="Context" value="${v['context']}"></div>
                <div class="col-xl-2">
                    <select class="form-select size_sel${v['ID']} size_sel_raw">
                        <option value="masthead-subheading">masthead-subheading</option>
                        <option value="masthead-heading">masthead-heading</option>
                        <option value="h1">header 1</option>
                        <option value="h2">header 2</option>
                        <option value="h3">header 3</option>
                        <option value="h4">header 4</option>
                        <option value="h5">header 5</option>
                        <option value="context">context</option>
                    </select>
                </div>
                <div class="col-xl-1">
                    <button class="btn btn-block btn-danger btn-sm mt-2 " onclick="edit_page_th.delete_header(this);">Delete</button>
                </div>
            </div>
            `;


            await $('.header_pageth').append(html_header_set)

            $(`.size_sel${v['ID']}`).val(v['size'])
            $(`.position_sel${v['ID']}`).val(v['align_ment'])

        })
        this.count_header_global = count_data_header;


        await $.each(res['service'], function (i, v) {
            let html_service_set = '';
            count_data_service = i;
            i++;
            html_service_set = `
            <div class="service_raw" service_data = ${v['ID']}>
                <div class="row mt-2 ">
                    <div class="col-xl-2"><label>service ${i}</label></div>
                    <div class="col-xl-2">
                        <input type="text" class="form-control service_name_raw service_name${v['ID']}" value="${v['service_name']}" placeholder="Sevice name">
                    </div>
                    <div class="col-xl-2">
                        <input type="text" class="form-control service_symbol_raw service_synbol${v['ID']}" value="${v['sym_bol']}" placeholder="symbol">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8"><input type="text" class="form-control service_context_raw service_context${v['ID']}" value="${v['context']}"placeholder="Context"></div>
                    <div class="col-xl-1">
                        <button class="btn btn-block btn-danger btn-sm mt-2 " onclick="edit_page_th.delete_service(this);">Delete</button>
                    </div>
                </div>
            </div>
            `;
            $('.service_pageth').append(html_service_set)
            $(`.service_size${v['ID']}`).val(v['size'])
            $(`.service_position${v['ID']}`).val(v['align_ment'])
        })
        this.count_service_global = count_data_service;
        let html_about = `
        <div class="row mt-2">
            <div class="col-xl-2"><label>about</label></div>
            <div class="col-xl-8">
                <textarea class="form-control about_context_raw " about_id=${res['about']['ID']} id="exampleFormControlTextarea1" rows="3" >${res['about']['context']}</textarea>
            </div>
        </div>
        `;
        $('.about_pageth').append(html_about)

        let html_count_event = 0;
        $.each(res['event'], function (i, v) {
            let html_event_set = '';
            let html_event_photo = '';
            i++;


            $.each(res['photo'][`${v['ID']}`], function (i1, v1) {

                html_event_photo += `
                
                    <div class="photo_emt row mt-2" photo_id=${v1['ID']} event_id= ${v['ID']} event_e=${i}>
                        <div class="col-xl-2"></div>
                        <div class="col-xl-3">
                            <input type="text" class="form-control photo_name" value="${v1['photo_name']}">
                        </div>
                        <div class="col-xl-2"><button class="btn btn-danger btn-sm" onclick="edit_page_th.delete_event_photo(this)">Delete photo</button></div>
                    </div>
                
                `;

            })


            html_event_set = `
            <div class="event_raw" event_data = ${v['ID']} event_e=${i}>
                <div class="row mt-2">
                    <div class="col-xl-2"><label>Event ${i}</label></div>
                    <div class="col-xl-4">
                        <input type="text" class="form-control event_name" placeholder="Event name" value="${v['event_name']}">
                    </div>
                    <div class="col-xl-2">
                        <button class="btn btn-block btn-success btn-sm " onclick="edit_page_th.add_photo('${i}');">add photo</button>
                        <button class="btn btn-block btn-danger btn-sm " onclick="edit_page_th.delete_event(this);">Delete event</button>
                    </div>
                </div>
                <div class="add_multi_photo add_multi_photo${i}" event_data = ${v['ID']}>
                ${html_event_photo}
                </div>
            </div>
            `;

            $('.event_pageth').append(html_event_set)
            html_count_event = i
        })
        this.count_event_global = html_count_event;
        
        await this.add_contact_us();
        $('.data_address').val(res['contact']['address']).attr('address_id', res['contact']['ID']);
        $('.data_tel').val(res['contact']['tel'])
        $('.data_mobile').val(res['contact']['mobile'])
        $('.data_email').val(res['contact']['email'])


    },

    add_header: async function () {

        let html_header = '';
        this.count_header_global++;
        html_header = `
        <div class="row mt-2 md-2 header_raw header_raw${this.count_header_global}">
            <div class="col-xl-2"><label>header ${this.count_header_global} </label></div>
            <div class="col-xl-4"><input type="text" class="form-control header_context_raw header_context" placeholder="Context"></div>
            <div class="col-xl-2">
                <select class="form-select size_sel size_sel_raw">
                    <option value="masthead-subheading">masthead-subheading</option>
                    <option value="masthead-heading">masthead-heading</option>
                    <option value="h1">header 1</option>
                    <option value="h2">header 2</option>
                    <option value="h3">header 3</option>
                    <option value="h4">header 4</option>
                    <option value="h5">header 5</option>
                    <option value="context">context</option>
                </select>
            </div>
            <div class="col-xl-1">
                <button class="btn btn-block btn-danger btn-sm mt-2 " onclick="edit_page_th.delete_header(this);">Delete</button>
            </div>
        </div>
        
        `;


        $('.header_pageth').append(html_header)
    },

    add_service: async function () {
        let html_service = '';
        this.count_service_global++;
        html_service = `
        <div class="service_raw ">
            <div class="row mt-2 ">
                <div class="col-xl-2"><label>service ${this.count_service_global}</label></div>
                <div class="col-xl-2">
                    <input type="text" class="form-control service_name_raw" placeholder="Sevice name">
                </div>
                <div class="col-xl-2">
                    <input type="text" class="form-control service_symbol_raw" placeholder="symbol">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xl-2"></div>
                <div class="col-xl-8"><input type="text" class="form-control service_context_raw" placeholder="Context"></div>
                <div class="col-xl-1">
                    <button class="btn btn-block btn-danger btn-sm mt-2 " onclick="edit_page_th.delete_service(this);">Delete</button>
                </div>
            </div>
        </div>
        `;
        $('.service_pageth').append(html_service)

    },

    add_event: async function () {
        this.count_event_global++;

        let html_event = '';
        html_event = `
            <div class="event_raw" event_e=${this.count_event_global}>
                <div class="row mt-2">
                    <div class="col-xl-2"><label>Event </label></div>
                    <div class="col-xl-4">
                        <input type="text" class="form-control event_name" placeholder="Event photo name" >
                    </div>
                    <div class="col-xl-2">
                        <button class="btn btn-block btn-success btn-sm " onclick="edit_page_th.add_photo('${this.count_event_global}');">add photo</button>
                    </div>
                </div>
                <div class="photo_multi add_multi_photo${this.count_event_global}">
                
                </div>
            </div>
        `;
        $('.event_pageth').append(html_event)

    },

    add_photo: async function (val_set) {
        console.log(val_set)
        let html_photo = '';
        html_photo = `
        <div class="photo_emt row mt-2" event_e=${val_set}>
            <div class="col-xl-2"></div>
            <div class="col-xl-3">
                <input type="text" class="form-control photo_name" >
            </div>
            <div class="col-xl-2"><button class="btn btn-danger btn-sm">Delete photo</button></div>
        </div>
        `;
        $(`.add_multi_photo${val_set}`).append(html_photo)

    },

    add_about: async function () {
        let html_about = '';
        html_about = `
        <div class="row mt-2">
            <div class="col-xl-2"><label>about</label></div>
            <div class="col-xl-8">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
        `;

        $('.about_pageth').append(html_about)
    },

    add_contact_us: async function () {
        let html_contact = '';
        html_contact = `
        <div class="row mt-2">
            <div class="col-xl-2">
                <label>Address</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control data_address">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xl-2">
                <label>Tel</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control data_tel">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xl-2">
                <label>Mobile</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control data_mobile">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xl-2">
                <label>Email</label>
            </div>
            <div class="col-xl-8">
                <input type="text" class="form-control data_email">
            </div>
        </div>
        `;

        $('.contact_pageth').append(html_contact)
    },

    ajax_set_data_preview: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/edit_pageth/get_data_pageth.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    delete_header_arr: [],
    delete_header_obj: {},

    delete_header: function (type_data) {
        let keep_id = $(type_data).closest('.header_raw').attr('header_data')
        let keep_set = keep_id ? keep_id : '';
        if (keep_set != '') {
            this.delete_header_obj = {
                keep_set: keep_set
            }
            this.delete_header_arr.push(this.delete_header_obj)
        }

        $(type_data).closest('.header_raw').remove();
        this.count_header_global--;

    },

    delete_service_arr: [],
    delete_service_obj: {},

    delete_service : function (type_data) {
        let keep_id = $(type_data).closest('.service_raw').attr('service_data')
        let keep_set = keep_id ? keep_id : '';

        if (keep_set != '') {
            this.delete_service_obj = {
                keep_set: keep_set
            }
            this.delete_service_arr.push(this.delete_service_obj)
        }

        $(type_data).closest('.service_raw').remove();
        this.count_service_global--;
        // console.log(this.delete_service_arr)

    },

    delete_event_arr : [],
    delete_event_obj : {},

    delete_event : function (vale){
        let keep_id = $(vale).closest('.event_raw').attr('event_data');
        let keep_set = keep_id ? keep_id : '';

        if (keep_set != '') {
            this.delete_event_obj = {
                keep_set: keep_set
            }
            this.delete_event_arr.push(this.delete_event_obj)
        }

        $(vale).closest('.event_raw').remove();
        this.count_event_global--;
        // console.log(this.delete_event_arr)

    },

    delete_event_photo_arr : [],
    delete_event_photo_obj : {},


    delete_event_photo : function(vale){
        let keep_id = $(vale).closest('.photo_emt').attr('photo_id')
        let keep_set = keep_id ? keep_id : '';

        if(keep_set != ''){
            this.delete_event_photo_obj = {
                keep_set : keep_set
            }
            this.delete_event_photo_arr.push(this.delete_event_photo_obj)
        }
        $(vale).closest('.photo_emt').remove();
        // console.log(this.delete_event_photo_arr)

    },

    get_data_before_save: async function () {

        let header_data_arr = []
        let header_data_obj = {}
        $('.header_raw').each(function (i, v) {
            let header_raw = $(this).attr('header_data')
            let header_context_raw = $('.header_context_raw', this).val()
            let size_sel_raw = $('.size_sel_raw', this).val()

            header_data_obj = {
                header_raw: header_raw,
                header_context_raw: header_context_raw,
                size_sel_raw: size_sel_raw
            }
            header_data_arr.push(header_data_obj)
        })

        let service_data_arr = []
        let service_data_obj = {}
        $('.service_raw').each(function () {
            let service_raw = $(this).attr('service_data');
            let service_name_raw = $('.service_name_raw', this).val()
            let service_symbol_raw = $('.service_symbol_raw', this).val()
            let service_context_raw = $('.service_context_raw', this).val()
            service_data_obj = {
                service_raw: service_raw,
                service_name_raw: service_name_raw,
                service_symbol_raw: service_symbol_raw,
                service_context_raw: service_context_raw
            }
            service_data_arr.push(service_data_obj)
        })

        let about_data_arr = []
        let about_data_obj = {}
        let about_raw = $('.about_context_raw').attr('about_id')
        let about_context_raw = $('.about_context_raw').val()
        about_data_obj = {
            about_raw: about_raw,
            about_context_raw: about_context_raw
        }
        about_data_arr.push(about_data_obj)

        let contact_data_arr = []
        let contact_data_obj = {}

        $('.about_pageth').each(function () {
            let address_id_raw = $('.data_address').attr('address_id')
            let address_raw = $('.data_address').val()
            let moblie_raw = $('.data_mobile').val()
            let email_raw = $('.data_email').val()
            let tel_raw = $('.data_tel ').val()

            contact_data_obj = {
                address_id_raw: address_id_raw,
                address_raw: address_raw,
                moblie_raw: moblie_raw,
                email_raw: email_raw,
                tel_raw: tel_raw
            }

            contact_data_arr.push(contact_data_obj)
        })
        let event_data_arr = []
        let event_data_obj = {}

        $('.event_raw').each(function () {

            let event_id_raw = $(this).attr('event_data')
            let event_e_raw = $(this).attr('event_e')
            let event_name = $('.event_name', this).val()

            event_data_obj = {
                event_id_raw: event_id_raw,
                event_e_raw : event_e_raw,
                event_name: event_name,
            }

            event_data_arr.push(event_data_obj)
        })
        
        let event_data_photo_arr = []
        let event_data_photo_obj = {}

        $('.photo_emt').each(function(){
            let photo_id_raw = $(this).attr('photo_id')
            let photo_e_raw = $(this).attr('event_e')
            let photo_name = $('.photo_name',this).val()

            event_data_photo_obj = {
                photo_id_raw : photo_id_raw,
                photo_e_raw : photo_e_raw,
                photo_name : photo_name,   
            }

            event_data_photo_arr.push(event_data_photo_obj)
        })
        
        // console.log(contact_data_arr)
        // console.log(header_data_arr)
        // console.log(service_data_arr)
        // console.log(about_data_arr)
        // console.log(this.delete_header_arr)
        // console.log(this.delete_service_arr)
        // console.log(event_data_arr)
        // console.log(event_data_photo_arr)
        console.log(this.delete_event_arr)
        console.log(this.delete_event_photo_arr)

        let res_save = await this.ajax_sent_data_raw(contact_data_arr,header_data_arr,service_data_arr,about_data_arr,this.delete_header_arr,this.delete_service_arr,event_data_arr,event_data_photo_arr,this.delete_event_arr,this.delete_event_photo_arr)
        console.log(res_save)

        if(res_save['arr_suc']['sta'] == '1' || res_save['arr_suc']['stc'] == '1' || res_save['arr_suc']['sth'] == '1' 
        || res_save['arr_suc']['sts'] == '1' || res_save['arr_suc']['stdh'] == '1' || res_save['arr_suc']['stds'] == '1' 
        || res_save['arr_suc']['stev'] == '1' || res_save['arr_suc']['stevp'] == '1' || res_save['arr_suc']['stde'] == '1' || res_save['arr_suc']['stdep'] == '1'){
            Swal.fire(
                'saved!',
                'Your file has been saved.',
                'success'
            )
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pls contact to tech team',
            })
        }
    },
    ajax_sent_data_raw: function (contact_data_arr, header_data_arr, service_data_arr, about_data_arr, delete_header, delete_service,event_data_arr,event_data_photo_arr,delete_event_arr,delete_event_photo_arr) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/edit_pageth/save_data_page.php",
                data: {
                    contact_data_arr: contact_data_arr,
                    header_data_arr: header_data_arr,
                    service_data_arr: service_data_arr,
                    about_data_arr: about_data_arr,
                    delete_header: delete_header,
                    delete_service: delete_service,
                    event_data_arr : event_data_arr,
                    event_data_photo_arr : event_data_photo_arr,
                    delete_event_arr : delete_event_arr,
                    delete_event_photo_arr : delete_event_photo_arr,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}