$(document).ready(function () {
    
    const STATIC_USER = "admin";
    const STATIC_PASS = "12345";

    $("#loginForm").validate({
        rules: {
            username: {
                required: true,
                minlength: 3
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Please enter your username.",
                minlength: "Username must be at least 3 characters long."
            },
            password: {
                required: "Please enter your password."
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
            const username = $("#username").val().trim();
            const password = $("#password").val().trim();

            if (username === STATIC_USER && password === STATIC_PASS) {
            
                sessionStorage.setItem("isLoggedIn", "true");
                sessionStorage.setItem("username", username);

                $("#login-alert").html('<div class="alert-success">Login successful! Redirecting...</div>');
                
                setTimeout(function () {
                    window.location.href = "index.html";
                }, 1000);
            } else {
    
                $("#login-alert").html('<div class="alert-error">Invalid username or password!</div>');
            }
        }
    });
});