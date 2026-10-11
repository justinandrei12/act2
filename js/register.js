$(document).ready(function () {
    $("#registerForm").validate({
        rules: {
            full_name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            full_name: {
                required: "Please enter your full name.",
                minlength: "Name must be at least 2 characters long."
            },
            email: {
                required: "Please enter your email address.",
                email: "Please enter a valid email address."
            },
            password: {
                required: "Please enter a password.",
                minlength: "Password must be at least 8 characters long."
            },
            confirm_password: {
                required: "Please re-enter your password.",
                equalTo: "Passwords do not match."
            }
        },
        errorElement: "span",
        errorClass: "error-message",
        highlight: function (element) {
            $(element).addClass("input-error");
        },
        unhighlight: function (element) {
            $(element).removeClass("input-error");
        },
        submitHandler: function (form) {
            
            $("#register-alert").html(
                '<div class="alert-success">Registration successful! You can now login.</div>'
            );

            form.reset();

            setTimeout(function () {
                window.location.href = "login.html";
            }, 1500);
        }
    });
});