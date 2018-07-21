<?php
/**
 * Created by PhpStorm.
 * User: eragera
 * Date: 1/7/18
 * Time: 3:46 AM
 */
require_once('config.php');
session_destroy();
unset($_SESSION)
?>

<html>
    <head>
        <?php require_once("head.php");?>
    </head>
    <body>
        <?php require_once("header.php");?>
        <div class="content alpha my-5 p-5 col-7">
            <article class="form-parent">
                <!-- Material form register -->
                <form id="registerForm" method="post" action="signupLanding.php">
                    <p class="h4 text-center mb-4 title"><span>Sign up</span></p>

                    <!-- Material input text -->
                    <div class="md-form">
                        <i class="fa fa-user prefix grey-text"></i>
                        <input type="text" name="username" id="materialFormRegisterNameEx" class="form-control" onblur="checkUserExists(this.value)" required maxlength="20" pattern=".{3,20}" data-msg-pattern="Username must be atleast 3 characters and at most 20">
                        <label for="materialFormRegisterNameEx">Your Username</label>
                    </div>
                    <span id="userValid"></span>
                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="email" name="email" id="materialFormRegisterEmailEx" class="form-control" onblur="checkEmailExists(this.value)" required>
                        <label for="materialFormRegisterEmailEx">Your email</label>
                    </div>
                    <span id="emailValid"></span>

                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-exclamation-triangle prefix grey-text"></i>
                        <input type="email" name="emailRepeat" equalTo="#materialFormRegisterEmailEx" id="materialFormRegisterConfirmEx" class="form-control" required data-msg-pattern="Both fields must match.">
                        <label for="materialFormRegisterConfirmEx">Confirm your email</label>
                    </div>

                    <!-- Material input password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="materialFormRegisterPasswordEx" class="form-control" required onfocus="$('#passwordRule').toggle()" onblur="$('#passwordRule').toggle()" data-msg-pattern="Password does not match criteria!">
                        <label for="materialFormRegisterPasswordEx">Your password</label>
                    </div>
                    <div class="ruleSet" id="passwordRule">
                        Password must feature the following criteria:
                        <ul>
                            <li>A lowercase letter</li>
                            <li>An uppercase letter</li>
                            <li>A number</li>
                            <li>Minimum 8 characters</li>
                        </ul>
                    </div>
                    <!-- Material input password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" name="passwordRepeat" equalTo="#materialFormRegisterPasswordEx" id="materialFormRegisterPasswordConfirmEx" class="form-control" required data-msg-pattern="Passwords do not match">
                        <label for="materialFormRegisterPasswordConfirmEx">Confirm your password</label>
                    </div>

                    <div class="text-center my-5">
                        <div class="g-recaptcha" data-theme='dark' data-sitekey="<?=RECAPTCHA_PUBLIC_KEY?>" data-callback="enableBtn"></div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-outline-secondary" id="register" type="submit">Register<i class="fa fa-paper-plane-o ml-2"></i></button>
                    </div>
                </form>
                <?php require_once("script.php");?>
                <!--suppress JSUnusedLocalSymbols -->
                <script>
                    //Things to be done at the start
                    $("#passwordRule").toggle();
                    $("#register").prop('disabled', true);

                    function enableBtn(){
                        $("#register").prop('disabled', false);
                    }
                    function checkEmailExists(value){
                        $.ajax({
                            url: "validate.php",
                            type: "POST",
                            data: {email: value},
                            dataType: "text",
                            success: function(res) {
                                if (res.length !== 0) {
                                    $(`<label id="materialFormRegisterEmailEx-error" class="error active" for="materialFormRegisterEmailEx">${res}</label>`).insertAfter("#materialFormRegisterEmailEx");
                                    $('#materialFormRegisterEmailEx').removeClass("valid").addClass("error");
                                    //disableSubmit(true);
                                } //else disableSubmit(false);
                            }});
                    }
                    function checkUserExists(value){
                        $.ajax({
                            url: "validate.php",
                            type: "POST",
                            data: {username: value},
                            dataType: "text",
                            success: function(res) {
                                if (res.length !== 0) {
                                    $(`<label id="materialFormRegisterNameEx-error" class="error active" for="materialFormRegisterNameEx">${res}</label>`).insertAfter("#materialFormRegisterNameEx");
                                    $('#materialFormRegisterNameEx').removeClass("valid").addClass("error");
                                    //disableSubmit(true);
                                } //else disableSubmit(false);
                            }});
                    }
                    $("#registerForm").validate();
                </script>
                <!-- Material form register -->
            </article>
        </div>
    </body>
</html>
