const login = {
    login: function() {
        let user = $('#email').val();
        let pass = $('#password').val();
        let data = {user,pass};
        $.ajax({
            type: "post",
            url: "../function/auth/check_login.php",
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response);
                window.location.href = '../CHL-Booking-list.php';

            }
        });
      }
  };