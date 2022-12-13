const booking = {
    select_port: function () {
        $.ajax({
            type: "post",
            url: "../ajax_request/booking.php",
            data: "data",
            dataType: "text",
            success: function (response) {
                alert(response);
            },
        });
    },
};
