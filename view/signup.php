<?php include_once "header.php";?>
<div class="container-signup-form">
    <h1 class="signup-title">signup</h1>
        <div class="signup-form">
            <form action="index.php?page=signup" class="signup-form__container" method="post">
                <div class="signup-form__group">
                    <label for="" class="signup-form__name">Fullname</label>
                    <input type="text" value="" class="signup-form__input" name="tennguoidung">
                </div>
                <div class="signup-form__group">
                    <label for="" class="signup-form__name">username</label>
                    <input type="text" value="" class="signup-form__input" name="taikhoan">
                </div>
                <div class="signup-form__group">
                    <label for="" class="signup-form__name">Password</label>
                    <input type="password" value="" class="signup-form__input" name="matkhau">
                </div>
                <div class="signup-form__group">
                    <label for="" class="signup-form__name">Re-Password</label>
                    <input type="password" value="" class="signup-form__input" name="nhaplaimatkhau">
                </div>
                <div class="signup-form__control">
                    <input type="submit" name="btn_signup" value="ĐĂNG KÝ" class="signup-form__btn">
                </div>
            </form>
            <?php
            if(isset($thongbao)){
                echo "$thongbao";
            }
            ?>
            <div class="signup-form__socials">
                <p class="signup-form__socials-title">Or Log In Using</p>
                <div class="signup-fom__socials-group">
                    <a href="#" class="signup-fom__socials--facebook">
                        <i class="auth-form__socials-icon fa-brands fa-square-facebook"></i>
                        <span class="auth-form__socials-title">
                            Kết nối với Facebook
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="signup-form-controls">
            <a href="" class="signup-form-controls--cancel">
                Cancel
            </a>
            <a href="" class="signup-form-controls--signup">
                Log In
            </a>
        </div>
    </div>



<?php include_once "footer.php";?>
