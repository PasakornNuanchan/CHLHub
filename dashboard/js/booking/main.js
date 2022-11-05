// alert('xxxx');
const booking = {

    select_port: function () {
        $.ajax({
            type: "post",
            url: "../ajax_request/booking.php",
            data: "data",
            dataType: "text",
            success: function (response) {
                alert(response);
            }
        });
    },
    test : function(){
        html = `
            <option>${'please select'}</option>
            <option>${'test 1'}</option>
        `;
        $('[name="ts-port"]').html(html);
    }
};
