<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/create-account.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                
                <span>or use your email for registeration</span>

                <?php  if(!empty($errors_signup['username'])) : ?>
                    <div class="alert alert-danger text-center"><?=$errors_signup['username']?></div>
                <? endif; ?>
                <input type="text" name="username" placeholder="Username" value="<?=old_value("username")?>">

                <?php  if(!empty($errors_signup['email'])) : ?>
                    <div class="alert alert-danger text-center"><?=$errors_signup['email']?></div>
                <? endif; ?>
                <input type="email" name="email" placeholder="Email" value="<?=old_value("email")?>">

                <?php  if(!empty($errors_signup['password'])) : ?>
                    <div class="alert alert-danger text-center"><?=$errors_signup['password']?></div>
                <? endif; ?>
                <input type="password" name="password" placeholder="Password" value="<?=old_value("password")?>">

                <input type="hidden" name="type" value="signup">
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post">
                <h1>Sign In</h1>
                
                <span>or use your email password</span>

                <?php  if(!empty($errors_login)) : ?>
                    <div class="alert alert-danger text-center"><?=$errors_login?></div>
                <? endif; ?>

                <input type="email" name="email" placeholder="Email" value="<?=old_value("email")?>">
                <input type="password" name="password" placeholder="Password" value="<?=old_value("password")?>">
                <input type="hidden" name="type" value="login">
                <a href="#">Forget Your Password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function() {
            choose_toggle();
        };

        function choose_toggle()
        {
            if(!<?php echo empty($errors_signup) ? "true" : "false";?>)
                container.classList.add("active");
        }
    </script>

    <script src="<?=ROOT?>/assets/js/create_account.js"></script>
</body>

</html>