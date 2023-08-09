const customs_calendar_set = {

    global_week_set: 0,
    global_arr_week: [],

    lunch_page_header : async function(){
        $('.head-of-menu').html('')
        $('.head-of-menu').append('Customs Clearance Calendar Schedule')
        $('.header-bcpage').remove()
        $('.header-master-page').css('height','160px')
    },


    runtime_lunch: async function () {
        arr_obj_time = {}
        arr_time = []
        var date = new Date();
        date.setDate(date.getDate() - 31);
        for (let i = 0; i < 31; i++) {
            date.setDate(date.getDate() + 1);
            var p_t = String(date)
            var day = p_t.substring(0, 3);
            var day_t = p_t.substring(4, 7);
            var day_w = p_t.substring(8, 10);
            var day_y = p_t.substring(11, 15);

            arr_obj_time = {
                day: day,
                day_t: day_t,
                day_w: day_w,
                day_y: day_y
            }

            arr_time.push(arr_obj_time)
        }

        var date = new Date();
        for (let i = 0; i < 31; i++) {
            date.setDate(date.getDate() + 1);
            var p_t = String(date)
            var day = p_t.substring(0, 3);
            var day_t = p_t.substring(4, 7);
            var day_w = p_t.substring(8, 10);
            var day_y = p_t.substring(11, 15);

            arr_obj_time = {
                day: day,
                day_t: day_t,
                day_w: day_w,
                day_y: day_y
            }

            arr_time.push(arr_obj_time)
        }
        html_btn_m = '';
        const u_m = arr_time.filter((obj, index) => arr_time.findIndex((item) => item.day_t === obj.day_t) === index)
        $.each(u_m, function (i, v) {
            let day = v['day_t'] ? v['day_t'] : '';
            let day_y = v['day_y'] ? v['day_y'] : '';
            html_btn_m += `
            <button class="btn btn-sm btn-primary" onclick="customs_calendar_set.select_mounth('${day}','${day_y}')">${day}</button>`;

        })

        var date_start = new Date();
        data_start_r = String(date_start)
        var date_start_y = data_start_r.substring(11, 15);
        var date_start_t = data_start_r.substring(4, 7);

        $('.btnmz').append(`<button class="btn btn-sm btn-primary " onclick="customs_calendar_set.select_day('dy')">Day</button>
        <button class="btn btn-sm btn-primary " onclick="customs_calendar_set.select_type('wk')">Week</button>
        <button class="btn btn-sm btn-primary " onclick="customs_calendar_set.select_mounth('${date_start_t}','${date_start_y}')">Month</button>`)

        let first1 = arr_time[0];
        let last1 = arr_time[arr_time.length - 1];
        let data_m_s = await this.change_month_to_number(first1['day_t'])
        let gen_date_start = first1['day_y'] + '-' + data_m_s + '-' + first1['day_w']
        let data_m_e = await this.change_month_to_number(last1['day_t'])
        let gen_date_end = last1['day_y'] + '-' + data_m_e + '-' + last1['day_w']
        res_calandar_task = await this.ajax_get_data_calendar(gen_date_start, gen_date_end)
        console.log(res_calandar_task)
        await this.select_mounth(date_start_t, date_start_y)
    },

    change_month_to_number: async function (data_val) {
        switch (data_val) {
            case "Jan":
                data_val = "01";
                return data_val;
            case "Feb":
                data_val = "02";
                return data_val;
            case "Mar":
                data_val = "03";
                return data_val;
            case "Apr":
                data_val = "04";
                return data_val;
            case "May":
                data_val = "05";
                return data_val;
            case "Jun":
                data_val = "06";
                return data_val;
            case "Jul":
                data_val = "07";
                return data_val;
            case "Aug":
                data_val = "08";
                return data_val;
            case "Sep":
                data_val = "09";
                return data_val;
            case "Oct":
                data_val = "10";
                return data_val;
            case "Nov":
                data_val = "11";
                return data_val;
            case "Dec":
                data_val = "12";
                return data_val;
        }
    },

    ajax_get_data_calendar: function (gen_date_start, gen_date_end) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs_calendar/calendar_detail.php",
                data: {
                    gen_date_start: gen_date_start,
                    gen_date_end: gen_date_end
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    setting_header_table : async function (){
        $('.p_data > thead > tr').addClass(`bg-gradient`)
        $('.p_data > thead > tr').css({'background-color':'#0D47A1','color' :'aliceblue'})
        $('.p_data').css({'border-radius':'10px'})
    },
    select_mounth: async function (date_start_t, date_start_y) {

        $('.p_data > thead').html('')
        $('.p_data > thead').append(`<tr><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td><td>Sun</td></tr>`)
        await this.setting_header_table();
        
        $('.p_data > tbody').html('');
        $('.h_mounth').html('')
        $('.h_mounth').append(date_start_t + ' ' + date_start_y)
        $('.btnmr').html('')
        $('.btnmr').append(html_btn_m)
        let htmltbo = '';
        let htmltdm = '';
        let htmltdt = '';
        let htmltdw = '';
        let htmltdth = '';
        let htmltdf = '';
        let htmltdsa = '';
        let htmltds = '';

        await $.each(arr_time, async function (i, v) {

            var day = v['day'] ? v['day'] : '';
            var dayt = v['day_t'] ? v['day_t'] : '';
            var daym = await customs_calendar_set.change_month_to_number(dayt)
            var dayw = v['day_w'] ? v['day_w'] : '';
            var dayy = v['day_y'] ? v['day_y'] : '';

            if (dayt == date_start_t) {
                if (day == "Mon") {
                    htmltdm += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}</h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
                } else if (day == "Tue") {
                    htmltdt += `<div class="${dayw + daym + dayy}"><div "class="${dayw + daym + dayy + 'number'}"><h6>${dayw}</h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
                } else if (day == "Wed") {
                    htmltdw += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}</h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
                } else if (day == "Thu") {
                    htmltdth += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}</h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
                } else if (day == "Fri") {
                    htmltdf += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}</h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
                } else if (day == "Sat") {
                    htmltdsa += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}</h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
                } else if (day == "Sun") {
                    htmltds += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}</h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;

                    htmltbo = `
                    <tr>
                        <td style="vertical-align:top; width:10%">${htmltdm}</td>
                        <td style="vertical-align:top; width:10%">${htmltdt}</td>
                        <td style="vertical-align:top; width:10%">${htmltdw}</td>
                        <td style="vertical-align:top; width:10%">${htmltdth}</td>
                        <td style="vertical-align:top; width:10%">${htmltdf}</td>
                        <td style="vertical-align:top; width:10%">${htmltdsa}</td>
                        <td style="vertical-align:top; width:10%">${htmltds}</td>
                    </tr>`;
                    $('.p_data > tbody').append(htmltbo)
                    htmltdm = '';
                    htmltdt = '';
                    htmltdw = '';
                    htmltdth = '';
                    htmltdf = '';
                    htmltdsa = '';
                    htmltds = '';
                }
            }
        })
        htmltbo = '';

        if (htmltdm !== '' || htmltdt !== '' || htmltdw !== '' || htmltdth !== '' || htmltdf !== '' || htmltdsa !== '' || htmltds !== '') {
            htmltbo = `
            <tr>
                <td style="vertical-align:top">${htmltdm}</td>
                <td style="vertical-align:top">${htmltdt}</td>
                <td style="vertical-align:top">${htmltdw}</td>
                <td style="vertical-align:top">${htmltdth}</td>
                <td style="vertical-align:top">${htmltdf}</td>
                <td style="vertical-align:top">${htmltdsa}</td>
                <td style="vertical-align:top">${htmltds}</td>
            </tr>`;
            $('.p_data > tbody').append(htmltbo)
        }

        await this.set_today_date()

        await $.each(res_calandar_task['calendar'], function (i, v) {
            let html_data = '';
            let ID = v['ID'] ? v['ID'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let data_task = v['date_task'] ? v['date_task'] : '';
            let type_work = v['TYPE'] ? v['TYPE'] : '';

            let data_task_parse = String(data_task)
            let d_time = data_task_parse.substring(8, 10);
            let m_time = data_task_parse.substring(5, 7);
            let y_time = data_task_parse.substring(0, 4);

            html_data = `<button class="btn btn-sm btn-outline-primary col-xl-12 mt-1 bic" onclick="customs_calendar_set.opentabcus('${ID}')">${type_work + ' : ' + job_number + ' (' + consignee_name + ')'}</button><br>`


            if ($(`.${d_time + m_time + y_time + 'text'} > .bic`).length < 5) {
                $(`.${d_time + m_time + y_time + 'text'}`).append(html_data)
            } else {
                if ($(`.${d_time + m_time + y_time + 'text'} > .bsm`).length < 1) {
                    $(`.${d_time + m_time + y_time + 'text'}`).append(`<button class="btn btn-sm btn-block bsm" onclick="customs_calendar_set.modal_show_see_more(${d_time + m_time + y_time})">see more</button>`)
                }
            }
        })

    },


    modal_show_see_more: async function (data_val) {
        console.log(data_val)
        if ($('#modal_see_more').length >= 1) {
            $('#modal_see_more').remove()
        }

        html_data_see = '';
        $.each(res_calandar_task['calendar'], function (i, v) {
            let ID = v['ID'] ? v['ID'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let data_task = v['date_task'] ? v['date_task'] : '';
            let type_work = v['TYPE'] ? v['TYPE'] : '';

            let data_task_parse = String(data_task)
            let d_time = data_task_parse.substring(8, 10);
            let m_time = data_task_parse.substring(5, 7);
            let y_time = data_task_parse.substring(0, 4);

            if (data_val == d_time + m_time + y_time) {
                html_data_see += `<button class="btn btn-sm btn-outline-primary mt-1" onclick="customs_calendar_set.opentabcus('${ID}')">${type_work + ' : ' + job_number + ' (' + consignee_name + ')'}</button><br>`;
            }

        })

        html = `
            <div class="modal" id="modal_see_more" data-bs-backdrop="false" >
                <div class="modal-dialog modal-sm modal-dialog-centered " style="width: 80%;";
                text-align: center;">
                    <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72); ">
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body mx-auto">
                            ${html_data_see}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            `
        $('body').append(html)
        $('#modal_see_more').modal('show')

    },

    select_day: async function () {
        var date_start = new Date();
        var p_t = String(date_start)

        var day_t = p_t.substring(4, 7);
        var day_w = p_t.substring(8, 10);

        let htmltbo = '';
        let htmltd = '';


        $('.p_data > thead').html('')
        $('.p_data > tbody').html('')
        $('.btnmr').html('')
        
        $('.p_data > thead').append('<tr><td class="day_of_week_day"></td></tr>')

        $('.p_data > tbody').append()
        await this.setting_header_table();
        let round_today = 0;

        await $.each(arr_time, async function (i, v) {
            var day = v['day'] ? v['day'] : '';
            var dayt = v['day_t'] ? v['day_t'] : '';
            var daym = await customs_calendar_set.change_month_to_number(dayt)
            var dayw = v['day_w'] ? v['day_w'] : '';
            var dayy = v['day_y'] ? v['day_y'] : '';


            htmltd = `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}<div class="month_show">${dayt}</div></h6></div><br></div>`;

            htmltbo = `
                <tr>
                    <td style="vertical-align:left;" align="center" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 " href="#${'cola' + dayw + daym + dayy}" data-bs-toggle="collapse">${htmltd}
                    <div id="${'cola' + dayw + daym + dayy}" class="${dayw + daym + dayy + 'text'} collapse"></div>
                    <div class="${dayw + daym + dayy+'dataincl'}"></div></td>
                </tr>`;

            $('.p_data > tbody').append(htmltbo)
        })

        await this.set_today_date();

        // loop paste data
        await $.each(res_calandar_task['calendar'], function (i, v) {
            let html_data = '';
            let ID = v['ID'] ? v['ID'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let data_task = v['date_task'] ? v['date_task'] : '';
            let type_work = v['TYPE'] ? v['TYPE'] : '';
            

            let data_task_parse = String(data_task)
            let d_time = data_task_parse.substring(8, 10);
            let m_time = data_task_parse.substring(5, 7);
            let y_time = data_task_parse.substring(0, 4);

            html_data = `<button class="btn btn-sm btn-sm-lg btn-outline-primary col-xl-3 mt-1 bic" onclick="customs_calendar_set.opentabcus('${ID}')">${type_work + ' : ' + job_number + ' (' + consignee_name + ')'}</button><br>`

            $(`.${d_time + m_time + y_time + 'text'}`).append(html_data)
        })

        // loop check length
        await $.each(arr_time, async function (i, v) {
            var dayt = v['day_t'] ? v['day_t'] : '';
            var daym = await customs_calendar_set.change_month_to_number(dayt)
            var dayw = v['day_w'] ? v['day_w'] : '';
            var dayy = v['day_y'] ? v['day_y'] : '';

            let g_search = (dayw+daym+dayy)
            let get_le_badge = ($(`.${g_search+'text'} > .bic`).length)

            if(get_le_badge != 0 ){
                $(`.${g_search+'dataincl'}`).append(`<div class="badge bg-primary">+${get_le_badge}</div>`)
            }
            
        })

    },


    select_type: async function (data_get) {
        var date_start = new Date();
        var p_t = String(date_start)

        var day_t = p_t.substring(4, 7);
        var day_w = p_t.substring(8, 10);

        let htmltbo = '';
        let htmltdm = '';
        let htmltdt = '';
        let htmltdw = '';
        let htmltdth = '';
        let htmltdf = '';
        let htmltdsa = '';
        let htmltds = '';
        let daym = '';

        $('.p_data > thead').html('')
        $('.p_data > thead').append(`<tr><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td><td>Sun</td></tr>`)
        await this.setting_header_table();
        $('.p_data > tbody').html('')
        $('.btnmr').html('')


        let arr_week_obj = {}
        let arr_week = []
        customs_calendar_set.global_arr_week = arr_week;
        let round_today = 0;

        $('.btnmr').append(`<button class="btn btn-sm btn-primary" onclick="customs_calendar_set.select_week('p')">previous</button>
            <button class="btn btn-sm btn-primary" onclick="customs_calendar_set.select_week('n')">next</button>`)

        $.each(arr_time, async function (i, v) {
            if (v['day_t'] == day_t && v['day_w'] == day_w) {
                round_today = 1;
            }
            var day = v['day'] ? v['day'] : '';
            var dayt = v['day_t'] ? v['day_t'] : '';
            switch (dayt) {
                case "Jan":
                    daym = "01";
                    break;
                case "Feb":
                    daym = "02";
                    break;
                case "Mar":
                    daym = "03";
                    break;
                case "Apr":
                    daym = "04";
                    break;
                case "May":
                    daym = "05";
                    break;
                case "Jun":
                    daym = "06";
                    break;
                case "Jul":
                    daym = "07";
                    break;
                case "Aug":
                    daym = "08";
                    break;
                case "Sep":
                    daym = "09";
                    break;
                case "Oct":
                    daym = "10";
                    break;
                case "Nov":
                    daym = "11";
                    break;
                case "Dec":
                    daym = "12";
                    break;
            }
            var dayw = v['day_w'] ? v['day_w'] : '';
            var dayy = v['day_y'] ? v['day_y'] : '';
            if (day == "Mon") {
                htmltdm += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}<div class="month_show">${dayt}</div></h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
            }
            if (day == "Tue") {
                htmltdt += `<div class="${dayw + daym + dayy}"><div "class="${dayw + daym + dayy + 'number'}"><h6>${dayw}<div class="month_show">${dayt}</div></h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
            }
            if (day == "Wed") {
                htmltdw += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}<div class="month_show">${dayt}</div></h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
            }
            if (day == "Thu") {
                htmltdth += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}<div class="month_show">${dayt}</div></h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
            }
            if (day == "Fri") {
                htmltdf += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}<div class="month_show">${dayt}</div></h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
            }
            if (day == "Sat") {
                htmltdsa += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}<div class="month_show">${dayt}</div></h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;
            }
            if (day == "Sun") {
                htmltds += `<div class="${dayw + daym + dayy}"><div class="${dayw + daym + dayy + 'number'}"><h6>${dayw}<div class="month_show">${dayt}</div></h6></div> <div class="${dayw + daym + dayy + 'text'}"></div><br></div>`;

                htmltbo = `
                    <tr>
                        <td style="vertical-align:top">${htmltdm}</td>
                        <td style="vertical-align:top">${htmltdt}</td>
                        <td style="vertical-align:top">${htmltdw}</td>
                        <td style="vertical-align:top">${htmltdth}</td>
                        <td style="vertical-align:top">${htmltdf}</td>
                        <td style="vertical-align:top">${htmltdsa}</td>
                        <td style="vertical-align:top">${htmltds}</td>
                    </tr>`;

                arr_week_obj = {
                    htmltbo: htmltbo,
                    round_today: round_today,
                    month: dayt,
                    year: dayy,
                }

                arr_week.push(arr_week_obj)
                round_today = 0;
                //$('.p_data > tbody').append(htmltbo)
                htmltdm = '';
                htmltdt = '';
                htmltdw = '';
                htmltdth = '';
                htmltdf = '';
                htmltdsa = '';
                htmltds = '';
                return;
            }
        })
        $.each(arr_week, async function (i, v) {
            if (v['round_today'] == '1') {
                $('.p_data > tbody').append(v['htmltbo'])
                customs_calendar_set.global_week_set = i
            }
        })

        await this.set_today_date();

        // waiiting paste data
        await $.each(res_calandar_task['calendar'], function (i, v) {
            let html_data = '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let data_task = v['date_task'] ? v['date_task'] : '';
            let type_work = v['TYPE'] ? v['TYPE'] : '';

            let data_task_parse = String(data_task)
            let d_time = data_task_parse.substring(8, 10);
            let m_time = data_task_parse.substring(5, 7);
            let y_time = data_task_parse.substring(0, 4);

            html_data = `<button class="btn btn-sm btn-outline-primary col-xl-12 mt-1 bic" onclick="customs_calendar_set.opentabcus('${job_number}')">${type_work + ' : ' + job_number + ' (' + consignee_name + ')'}</button><br>`
            $(`.${d_time + m_time + y_time + 'text'}`).append(html_data)
        })
    },


    select_week: async function (val) {

        $('.p_data > tbody').html('')
        if (val == 'p') {
            customs_calendar_set.global_week_set--
        } else if (val == 'n') {
            customs_calendar_set.global_week_set++
        }



        let arr_week = customs_calendar_set.global_arr_week
        $('.h_mounth').html('')

        $('.h_mounth').append(arr_week[customs_calendar_set.global_week_set]['month'] + ' ' + arr_week[customs_calendar_set.global_week_set]['year'])
        $('.p_data > tbody').append(arr_week[customs_calendar_set.global_week_set]['htmltbo'])

        await this.set_today_date()
        // waiiting paste data
        await $.each(res_calandar_task['calendar'], function (i, v) {
            let html_data = '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let data_task = v['date_task'] ? v['date_task'] : '';
            let type_work = v['TYPE'] ? v['TYPE'] : '';

            let data_task_parse = String(data_task)
            let d_time = data_task_parse.substring(8, 10);
            let m_time = data_task_parse.substring(5, 7);
            let y_time = data_task_parse.substring(0, 4);

            html_data = `<button class="btn btn-sm btn-outline-primary col-xl-12 mt-1 bic" onclick="customs_calendar_set.opentabcus('${job_number}')">${type_work + ' : ' + job_number + ' (' + consignee_name + ')'}</button><br>`
            $(`.${d_time + m_time + y_time + 'text'}`).append(html_data)
        })

    },

    set_today_date: async function () {
        var get_date_start_m = '';
        var get_date_start_d = data_start_r.substring(8, 10);
        var get_date_start_rm = data_start_r.substring(4, 7);
        switch (get_date_start_rm) {
            case "Jan":
                get_date_start_m = "01";
                break;
            case "Feb":
                get_date_start_m = "02";
                break;
            case "Mar":
                get_date_start_m = "03";
                break;
            case "Apr":
                get_date_start_m = "04";
                break;
            case "May":
                get_date_start_m = "05";
                break;
            case "Jun":
                get_date_start_m = "06";
                break;
            case "Jul":
                get_date_start_m = "07";
                break;
            case "Aug":
                get_date_start_m = "08";
                break;
            case "Sep":
                get_date_start_m = "09";
                break;
            case "Oct":
                get_date_start_m = "10";
                break;
            case "Nov":
                get_date_start_m = "11";
                break;
            case "Dec":
                get_date_start_m = "12";
                break;
        }

        var get_date_start_y = data_start_r.substring(11, 15);

        $(`.${get_date_start_d + get_date_start_m + get_date_start_y + 'number'}`).addClass("badge bg-warning")
        $(`.${get_date_start_d + get_date_start_m + get_date_start_y + 'number'}`).css({ "color": "white" })

    },
    

    opentabcus : function (job_number) {
        //console.log(window.open = `'CHL-Customs.php?job_number=`+ job_number+`&action=preview'`+,+`_blank`);
        window.open(
            `job_detail.php?job_number=${job_number}&action=preview`,'_blank' // <- This is what makes it open in a new window.
        );
    },
};

