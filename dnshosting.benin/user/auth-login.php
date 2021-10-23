<?php
  session_start();
  require_once "../model/Db_Handler.php";
  $db=new Db_Handler();
  $error1=false ;
  $error2=false ;
  $error=false;
  $errorsms="";
  $errorsms1="";
  $errorsms2="";
  $email;
  $pass;
  if ($_SERVER['REQUEST_METHOD'] =="POST") {
    
  if(!empty($_POST["email"])){
     $email=$_POST["email"];
     $email=filter_var($email,FILTER_SANITIZE_STRING);

    }
    else{
     $error1=true;
     $errorsms1="Vous devez entrer un surnom";
    }
    if(!empty($_POST["pass"])){
     $pass=$_POST["pass"];
     $pass=filter_var($pass,FILTER_SANITIZE_STRING);
    }
    else{
     $error2=true;
     $errorsms2="Vous devez entrer un mot de passe";
    }
     
     if(!$error1 && !$error2){
      $response=$db->isLoginUser($email,$pass);
      //include('connectbd.php');
      //       $bdd_select = $db->prepare('SELECT * from users');
      //       $bdd_select->execute();
      //       while ($row = $bdd_select->fetch()) {
      //         if ($row['login'] == $email && $row['psw'] == $pass) {
      //           $response = true;
      //          }
      //         } 
      if($response){
            $_SESSION["email"]=$email;
            $_SESSION["userpass"]=$pass;
            header("Location: index.php");
          }else{
        $error=true;
        $errorsms="ID ou mot de passe inconnu";
        $_SESSION['errorsms'] = $errorsms;
        $_SESSION['error'] = $error;
        header("Location: autlogin.php");
      }
      

     }       

  }
?>

<!doctype html>
<html lang="fr">

    <head>
        
        <meta charset="utf-8" />
        <title>DNS Hosting | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-pattern">
        <div class="bg-overlay"></div>
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6 col-md-8">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="">
                                    <div class="text-center">
                                        <a class="navbar-brand text-dark" style="font-weight:bold;" href="index.html"><img style="max-width: 100px;" src="../img/full_logo_benindns.png" alt="">Hosting</a>
                                    </div>
                                    <!-- end row -->
                                    <h4 class="font-size-18 text-muted mt-2 text-center">Bienvenue !</h4>
                                    <p class="mb-5 text-center">Veuillez vous conecter pour continuer.</p>
                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label class="form-label" for="username">Email</label>
                                                    <input type="email" name="email" class="form-control" id="username" placeholder="Enter votre email" required="">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="userpassword">Mot de pass</label>
                                                    <input name="pass" type="password" class="form-control" id="userpassword" placeholder="Entrer votre mot de passe" required="">
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="customControlInline">
                                                            <label class="form-label" class="form-check-label" for="customControlInline">Remember me</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="text-md-end mt-3 mt-md-0">
                                                            <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid mt-4">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p class="text-white-50">Don't have an account ? <a href="auth-register.html" class="fw-medium text-primary"> Register </a> </p>
                            <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> Upzet. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
