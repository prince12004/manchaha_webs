<?php $this->load->view('User/header')?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.gstatic.com" />
<link href="http://virtuoustek.net/timesheet//assets/admin/images/favicon.png" rel="shortcut icon" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.navbar,
.header-main,
.newsLetter-section,
.footer-section,
#profile-menu {
    display: none;
}

.login100-form {
    width: 100%;
}

.login100-form-title {
    display: block;
    font-size: 30px;
    color: #333333;
    line-height: 1.2;
    text-align: center;
}

a img{
    height: 200px;
    margin-top: 10px;
}
.wrap-input100 {
    width: 100%;
    position: relative;
    border-bottom: 2px solid #adadad;
    margin-top: 37px;
}

.validate-input {
    position: relative;
}

.container-login100-form-btn {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding-top: 13px;
}

.wrap-login100-form-btn {
    width: 100%;
    display: block;
    position: relative;
    z-index: 1;
    border-radius: 25px;
    overflow: hidden;
    margin: 0 auto;
}

input {
    border: none;
    width: 100%;
    font-size: 20px;
}

.login100-form-bgbtn {
    position: absolute;
    z-index: -1;
    width: 300%;
    height: 100%;
    background: #a64bf4;
    background: -webkit-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff) !important;
    /* background: -o-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff) !important;
  background: -moz-linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff) !important;
  background: linear-gradient(right, #21d4fd, #b721ff, #21d4fd, #b721ff); */
    top: 0;
    left: -100%;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.login100-form-bgbtn:hover {
    background: -webkit-linear-gradient(left, #21d4fd, #b721ff, #21d4fd, #b721ff) !important;
    /* background: -o-linear-gradient(left, #21d4fd, #b721ff, #21d4fd, #b721ff) !important;
  background: -moz-linear-gradient(left, #21d4fd, #b721ff, #21d4fd, #b721ff) !important;
  background: linear-gradient(left, #21d4fd, #b721ff, #21d4fd, #b721ff); */
}

.login100-form-btn {
    font-family: Poppins-Medium;
    font-size: 15px;
    color: #fff;
    line-height: 1.2;
    text-transform: uppercase;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    width: 100%;
    height: 50px;
}

button {
    outline: none !important;
    border: none;
    background: transparent;
}

.login-text {
    font-weight: 600;
    margin-top: 20px;
    font-size: 24px;

}
</style>
<div class="main-page-section">
    <div class="main-content am">
        <h1>Admin</h1>
        <h3> Login</h3>
    </div>
</div>
<div class="login-container" style="width: 50%; padding: 20px;">
    <form class="login100-form" action="<?php echo base_url('Welcome/admin_login'); ?>" id="login-form" method="POST">
        <span class="login100-form-title p-b-26">
            Login
        </span>
        <span class="login100-form-title p-b-48">
            <a href="#"><img src="http://mnnchaha.com/assets/images/header-new-logo.png" alt="logo" /></a>
        </span>
        <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">

            <input class="input100" type="email" name="email" placeholder="Email" maxlength="50" autofocus>
            <!-- <span class="focus-input100" data-placeholder="Email"></span> -->
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" id="password-field" type="password" name="password" placeholder="Password"
                maxlength="50">

            <!-- <span class="focus-input100" data-placeholder="Password"></span> -->
        </div>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">
                    Login
                </button>
            </div>
        </div>


    </form>
</div>


<style>
label.error {
    color: red;
}
</style>
<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script src="http://virtuoustek.net/timesheet//assets/admin/js/honey-custom.js"></script>

<script type="text/javascript">
// runAllForms();

$(function() {
    // Validation
    $("#login-form").validate({
        // Rules for form validation
        rules: {
            email: {
                required: true,

            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 20
            }
        },

        // Messages for form validation
        messages: {
            email: {
                required: 'Please enter your email id.',

            },
            password: {
                required: 'Please enter your password'
            }
        },

        // Do not change code below
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        }
    });
});
</script>


</body>
<?php $this->load->view('User/footer')?>

</html>