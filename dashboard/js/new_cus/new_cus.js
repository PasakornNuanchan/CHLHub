const new_cus = {

    set_data_head : async function () {
    
        $('.head-of-menu').html('New Customer list');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-new_cus.php" target="" style="color:white;">New Customer list</a></li>`;
        $('.bcpage').append(html_bdpage);

    }, 

    delete_data : async function (k){
        
        Swal.fire({
            title: `Are you sure for delete`,
            text: `you sure click on Yes, save it!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await this.ajax_sent_data(k)

                if (res == '1') {
                    await Swal.fire(
                        'saved!',
                        'Your data has been saved.',
                        'success'
                    )
                     location.reload();
                } else {
                    await Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'System has problem plese contact to thailand tech team ',
                    })
                }

            }
        })

    },

    ajax_sent_data: function (k) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/new_cus/delete_data_customer.php",
                data: {'data' : k},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                }
            });
        });

    }
}