<?php
    session_start();

    if ($_SESSION['id'] != "") {
        header('location:home.php');
    
        exit();
    }

    $configs = include('config.php');
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Quottle</title>
	<meta name="Author" content="Ruben Kuilder"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
	<link rel="stylesheet" type="text/css" href="assets/style/main.css">
    <script src="assets/script/main.js"></script>
</head>
<body>
    
    <div class="topbar login">
        <img class="icon-left" src="assets/images/icon-left.svg" />
        <img class="logo" src="assets/images/logo.png" />
        <img class="icon-right" src="assets/images/icon-right.svg" />
    </div>
    
    <div class="page-container">
        <div class="login-page">
            <div class="wrapper">
                <h1 class="welcome">Hi there, <br /> Welcome back!</h1>

                <div class="form-wrapper">
                    <form action="login.php" method="post">
                        <input type="text" name="login-email" placeholder="Email" required>
                        <input type="password" name="login-pass" placeholder="Password" required>
                        <input type="submit" name="submit" value="sign in">
                        <p class="forgot-pw">Forgot password?</p>
                    </form>
                </div>

                <p class="create-one">Don't have an account? <span class="highlight show-register">Create one</span></p>
            </div>
        </div>

        <div class="registration-page">
            <div class="wrapper">
                <h1 class="welcome">Account creation</h1>

                <div class="form-wrapper">
                    <form action="register.php" method="post">
                        <input type="text" name="email" placeholder="Email">
                        <input type="text" name="name" placeholder="First- and lastname">
                        <input type="password" name="pass" placeholder="Password">
                        <input type="password" placeholder="Password verification">
                        <input type="submit" value="Create account">
                    </form>
                </div>

                <p class="tclink">By signing up you indicate that you have read and agreed to the <span class="bold">Terms and Conditions</span></p>
            </div>
            
            <div class="tc-container">
                <div class="tc-content">
                    <span class="title">TERMS AND CONDITIONS</span>
                    <br />
                    <br />
                    <span class="header">1. Introduction</span>
                    These Website Standard Terms and Conditions written on this webpage shall manage your use of this website. These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.
                    <br />
                    <br />
                    <span class="header">2. Intellectual Property Rights</span>
                    Other than the content you own, under these Terms, Quottle and/or its licensors own all the intellectual property rights and materials contained in this Website.
                    <br />
                    <br />
                    <br />
                    You are granted limited license only for purposes of viewing the material contained on this Website.
                    <br />
                    <br />
                    <span class="header">3. Restrictions</span>
                    You are specifically restricted from all of the following
                    <br />
                    <br />
                    <ul>
                        <li>publishing any Website material in any other media;</li>
                        <li>selling, sublicensing and/or otherwise commercializing any Website material;</li>
                        <li>publicly performing and/or showing any Website material;</li>
                        <li>using this Website in any way that is or may be damaging to this Website;</li>
                        <li>using this Website in any way that impacts user access to this Website;</li>
                        <li>using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;</li>
                        <li>engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;</li>
                        <li>using this Website to engage in any advertising or marketing.</li>
                    </ul>
                    <br />
                    <br />
                    Certain areas of this Website are restricted from being access by you and Quottle may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.
                    <br />
                    <br />
                    <span class="header">4. Your Content</span>
                    In these Website Standard Terms and Conditions, “Your Content” shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant Quottle a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.
                    <br />
                    <br />
                    Your Content must be your own and must not be invading any third-party’s rights. Quottle reserves the right to remove any of Your Content from this Website at any time without notice.
                    <br />
                    <br />
                    <span class="header">5. No warranties</span>
                    This Website is provided “as is,” with all faults, and Quottle express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.
                    <br />
                    <br />
                    <span class="header">6. Limitation of liability</span>
                    In no event shall Quottle, nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract.  Quottle, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.
                    <br />
                    <br />
                    <span class="header">7. Indemnification</span>
                    You hereby indemnify to the fullest extent Quottle from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.
                    <br />
                    <br />
                    <span class="header">8. Severability</span>
                    If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.
                    <span class="header">Variation of Terms</span>
                    Quottle is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.
                    <br />
                    <br />
                    <span class="header">9. Assignment</span>
                    Quottle is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.
                    <br />
                    <br />
                    <span class="header">10. Entire Agreement</span>
                    These Terms constitute the entire agreement between Quottle and you in relation to your use of this Website, and supersede all prior agreements and understandings.
                </div>
                <div class="acceptTC">I accept the terms and conditions.</div>
            </div>
        </div>
    </div>

</body>
</html>
