<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form protected by reCAPTCHA</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

    <h1>Login</h1>
    <form action="https://du.vocus.ae/process" method="get" id="MyForm">
    <!-- <form action="process" method="get"> -->
        <label for="user">User:</label>
        <input type="text" id="username" name="user" required value="971522496324">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <div class="g-recaptcha" data-sitekey="6Lf3YxEUAAAAAMxuBSiyKBkvZihtdWFM8fg79LiD" data-size="invisible"></div>
        <br>
        <button type="button" id="submitBtn"
        onclick="MyLoad('https://du.vocus.ae/api/process','MyForm')"
        >Login</button>
    </form>
    <p id="MyData">

    </p>

    <script>
        // setTimeout(() => {
        //     var a = '971522221220';
        //     $("#username").val(a);
        //     $("#password").val(a);
        //     MyLoad('https://du.vocus.ae/api/process','MyForm');
        // }, 10000);
        // auto submit recaptcha
        window.addEventListener('load', function() {
            grecaptcha.execute();
        });

        // handling and saving captcha response
        function recaptchaCallback(response) {
            console.log('Valor de g-recaptcha-response:', response);
            var recaptchaSuccessEvent = new CustomEvent('recaptchaSuccess', { detail: response });
            window.dispatchEvent(recaptchaSuccessEvent);
        }

        //sending the form
        window.addEventListener('recaptchaSuccess', function(event) {
            var form = document.querySelector('form');
            form.submit();
        });
        function MyLoad(url,form){
            // var form = document.querySelector('form');
            // form.submit();
            var rizwan = document.getElementById(form);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            // $("#loading_num3").show();
            // // $(".request_call").hide();
            // $('.waves-button-input').prop('disabled', true);
            // $('#' + btn).prop('disabled', true);

        },
        success: function (data) {
            $("#MyData").text(data);
                // console.log(data);
        }

    });
        }
        // setTimeout(() => {
            // MyLoad()
        // }, 10000);
    </script>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
