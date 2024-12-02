<?php include_once "header.php"; ?>
<div class="container-login-form">
    <h1 class="login-title">LOGIN</h1>
    <div class="login-form">
        <form action="index.php?page=login" class="login-form__container" method="post">
            <div class="login-form__group">
                <label for="" class="login-form__name">Username</label>
                <input type="text" value="" class="login-form__input" name="tai_khoan">
            </div>
            <?php
            if (isset($thongbaotaikhoan)) {
                echo "$thongbaotaikhoan";
            }
            ?>
            <div class="login-form__group" style="margin-bottom: 16px;">
                <label for="" class="login-form__name">Password</label>
                <input type="password" value="" class="login-form__input" name="mat_khau">
            </div>
            <?php
            if (isset($thongbaomatkhau)) {
                echo "$thongbaomatkhau";
            }
            ?>
            <div class="login-form__control">
                <input type="submit" name="btn_login" value="ĐĂNG NHẬP" class="login-form__btn">
            </div>
        </form>

        <div class="login-form__socials">
            <p class="login-form__socials-title">Or Log In Using</p>
            <div class="login-fom__socials-group">
                <a href="#" class="login-fom__socials--facebook">
                    <i class="auth-form__socials-icon fa-brands fa-square-facebook"></i>
                    <span class="auth-form__socials-title">
                        Kết nối với Facebook
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="login-form-controls">
        <a href="index.php" class="login-form-controls--cancel" style=" color: #fff;">
            Cancel
        </a>
        <a href="index.php?page=signup" class="login-form-controls--login">
            Sign Up
        </a>
    </div>
</div>



<?php include_once "footer.php"; ?>