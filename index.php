<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP Backend Assignment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Quizinator</title>
</head>

<body>
    <div class="login">
        <input type="text" id="email" name="email" placeholder="Username/Email">
        <input type="password" id="password" name="password" placeholder="Password" autocomplete="new-password">
        <div id='button'>
            <input type="submit" value="Log In" id='login_button'>
        </div>

        <div id='login_msg'>

        </div>
    </div>
    <div class='signup'>
        <p>*All fields are required</p>
        <form action="/php_backend_assignment/php/signup.php" method="post">
            <input type="text" name="name" placeholder="Name" required="required"> <br>
            <input type="password" name="password" id="p" placeholder="Password" required="required" onkeyup="pass_check()">
            <br><label id="password_length_check_result"></label> <br>
            <input type="password" name="password2" id="p2" placeholder="Confirm Passowrd" required="required" onkeyup="pass_check()">
            <br><label id="pass"></label> <br>
            <script type="text/javascript">
                var check_password = 0;

                function pass_check() {
                    var p = document.getElementById('p').value;
                    var p2 = document.getElementById('p2').value;
                    if (p2) {
                        if (p != p2) {
                            var msg = "Passwords dont match".fontcolor("red");
                            document.getElementById('pass').innerHTML = msg;
                            check_password = 0;
                        } else {
                            var msg = "Passwords match".fontcolor("green");
                            document.getElementById('pass').innerHTML = msg;
                            check_password = 1;
                        }
                    }
                }
            </script>
            <input type="email" id="signup_email" name="email" placeholder="Email" required="required"> <br><label class="text-danger" id="signup_email_result"></label> <br>
            <input type="text" id="username" name="username" placeholder="Username" required="required"><br><label class="text-danger" id="username_result"></label> <br>
            Gender: <input type="radio" name="gender" value="m" required="required">Male <input type="radio" name="gender" value="f" required="required">Female <br>
            <input type="text" name="mobile" placeholder="Mobile" required="required"> <br>
            <input type="text" name="enroll" placeholder="Enroll No." required="required"> <br>
            <input type="text" name="branch" placeholder="Branch" required="required"> <br>
            <input type="text" name="year" placeholder="Year" required="required"> <br>
            <input type="submit" value="Submit" id="submit">
        </form>
     
        <script>
            $("#p").keyup(function(event) {
                event.preventDefault();
                if ($("#p").val().length < 8)
                    $("#password_length_check_result").html("<div class='text-danger'>Password Length Too Small</div>");
                else
                    $("#password_length_check_result").html("<div class='text-success'>Password Length Good</div>");
            });
            $('#login_msg').empty();
            $('#login_button').on('click', function(e) {
                e.preventDefault();
                var email_input = $("#email").val();
                var password_input = $("#password").val();

                $.ajax({
                    type: "post",
                    url: "/php_backend_assignment/php/login.php",
                    data: {
                        email: email_input,
                        password: password_input
                    },
                    success: function(response) {
                        if (response == "true") {
                            $('#login_msg').empty();
                            window.location.replace('/php_backend_assignment/php/welcome.php');
                        } else if (response == "false")
                            $('#login_msg').html("INVALID USERNAME OR PASSWORD");

                    }
                });
            });
            $("#signup_email").keyup(function(event) {
                event.preventDefault();
                var email_input = $("#signup_email").val();

                $.ajax({
                    type: "post",
                    url: "/php_backend_assignment/php/check_email_signup.php",
                    data: {
                        email: email_input
                    },
                    success: function(response) {

                        if (response == "false") {
                            $("#signup_email_result").html("Email Already Exists");
                        } else if (response == "true")
                            $("#signup_email_result").empty();
                    }
                });

            });
            $("#username").keyup(function(event) {
                event.preventDefault();
                var username_input = $("#username").val();

                $.ajax({
                    type: "post",
                    url: "/php_backend_assignment/php/check_username_signup.php",
                    data: {
                        username: username_input
                    },
                    success: function(response) {

                        if (response == "false") {
                            $("#username_result").html("Username Already Exists");
                        } else if (response == "true")
                            $("#username_result").empty();
                    }
                });

            });
            var m = '<?php echo $_SESSION[msg_signup]; ?>';
            if (m)
                alert(m);
            <?php $_SESSION[msg_signup] = ""; ?>
        </script>
</body>

</html> 