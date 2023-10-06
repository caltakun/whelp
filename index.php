<?php
include_once 'assets/conn/dbconnect.php';
// include_once 'assets/conn/server.php';
?>


<!-- login -->
<!-- check session -->
<?php
session_start();
// session_destroy();
if (isset($_SESSION['patientSession']) != "") {
header("Location: patient/patient.php");
}
if (isset($_POST['login']))
{
$icPatient = mysqli_real_escape_string($con,$_POST['icPatient']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$icPatient'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
if ($row['password'] == $password)
{
$_SESSION['patientSession'] = $row['icPatient'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: patient/patient.php");
} else {
?>
<script>
alert('wrong input ');
</script>
<?php
}
}
?>
<!-- register -->
<?php
if (isset($_POST['signup'])) {
$patientFirstName = mysqli_real_escape_string($con,$_POST['patientFirstName']);
$patientLastName  = mysqli_real_escape_string($con,$_POST['patientLastName']);
$patientEmail     = mysqli_real_escape_string($con,$_POST['patientEmail']);
$icPatient     = mysqli_real_escape_string($con,$_POST['icPatient']);
$password         = mysqli_real_escape_string($con,$_POST['password']);
$month            = mysqli_real_escape_string($con,$_POST['month']);
$day              = mysqli_real_escape_string($con,$_POST['day']);
$year             = mysqli_real_escape_string($con,$_POST['year']);
$patientDOB       = $year . "-" . $month . "-" . $day;
$patientGender = mysqli_real_escape_string($con,$_POST['patientGender']);
//INSERT
$query = " INSERT INTO patient (  icPatient, password, patientFirstName, patientLastName,  patientDOB, patientGender,   patientEmail )
VALUES ( '$icPatient', '$password', '$patientFirstName', '$patientLastName', '$patientDOB', '$patientGender', '$patientEmail' ) ";
$result = mysqli_query($con, $query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Register success. Please Login to make an appointment.');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('User already registered. Please try again');
</script>
<?php
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cesa Ortho Dental Clinic</title>
        <link rel="icon" type="image/x-icon" href="assets/img/cesaorthoICONwebtab.png">
        <!-- JS script -->
        <script src="jsscript.js"></script>
        <!-- Bootstraps -->
        <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link rel="stylesheet" href="indexBGstyle.css">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet"> =
        <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <!-- TABLE CSS -->
        <link rel="stylesheet" href="tablestyle.css">
        <link rel="stylesheet" href="indexBGstyle.css">
        <!-- Icon Description -->
        <link rel="stylesheet" href="iconDESCRIPTION.css">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" /> -->
        <link href='https://fonts.googleapis.com/css?family=Manrope' rel='stylesheet'>
        <link href="assets/css/material.css" rel="stylesheet">
    </head>
    <body>
        <!-- navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img alt="Brand" src="assets/img/cesaorthoLOGO.png" height="50px"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                    <ul class="nav navbar-nav navbar-right">
                        

                        <!-- <li><a href="adminlogin.php">Admin</a></li> -->
                        <li><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>           
                        <!-- <li>
                            <p class="navbar-text">Already have an account?</p>
                        </li> -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                                <div class="form-group">
                                                    <label class="sr-only" for="icPatient">Email</label>
                                                    <input type="text" class="form-control" name="icPatient" placeholder="ID Number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Sign in</button>
                                                    <hr>
                                                    <p class="text-center small"><a href="adminlogin.php">Login as admin</a></p>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Sign Up </h3> 
                    </div>
                    <div class="modal-body">
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                        <h4>Join us for a healthier smile.</h4>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="patientFirstName" value="" class="form-control input-lg" placeholder="First Name" required />
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="patientLastName" value="" class="form-control input-lg" placeholder="Last Name" required />
                                            </div>
                                        </div>
                                        
                                        <input type="text" name="patientEmail" value="" class="form-control input-lg" placeholder="Your Email"  required/>
                                        <input type="number" name="icPatient" value="" class="form-control input-lg" placeholder="Your ID Number"  required/>
                                        
                                        <!-- <label for="password">Password:</label> -->
                                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password"  required/>
                                        <!-- <label for="confirm_password">Confirm Password:</label> -->
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control input-lg" placeholder="Confirm Password"  required/>
                                        <span id="message"></span>
                                        <br>
                                        <label style="font-weight:bold">Birth Date</label>
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <select name="month" class = "form-control input-lg" required>
                                                    <option value="">Month</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">May</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Aug</option>
                                                    <option value="09">Sep</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="day" class = "form-control input-lg" required>
                                                    <option value="">Day</option>
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="year" class = "form-control input-lg" required>
                                                    <option value="">Year</option>
                                                    
                                                    <option value="1981">1981</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1999">1999</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                </select>
                                            </div>
                                        </div>
                                        <label style="font-weight:bold">Gender : </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="patientGender" value="male" required/>Male
                                        </label>
                                        <label class="radio-inline" >
                                            <input type="radio" name="patientGender" value="female" required/>Female
                                        </label>
                                        <br />
                                        <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>
                                        
                                        <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">Create my account</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->
        <!-- modal container end -->

        <!-- 1st section start -->
        <!-- <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite"> -->
            <section id="promo-1" class="indexBG">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="greetingsINDEX">
                        <!-- <img src="assets/img/cesaorthoLOGO.png" alt="Logo"> -->
                        <h2>Make appointment today!</h2>
                        <p>This is Doctor's Schedule. Please <span class="label label-danger">Login</span> to make an appointment. </p>
                        </div>

                            
                        <!-- date textbox -->
                       
                        <div class="input-group" style="margin-bottom:10px;">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar" style='color: white'>
                                </i>
                            </div>
                            <input class="form-control" style='color: white' id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
                        </div>
                       
                        <!-- date textbox end -->

                        <!-- script start -->
                        <script>

                            function showUser(str) {
                                
                                if (str == "") {
                                    document.getElementById("txtHint").innerHTML = "";
                                    return;
                                } else { 
                                    if (window.XMLHttpRequest) {
                                        // code for IE7+, Firefox, Chrome, Opera, Safari
                                        xmlhttp = new XMLHttpRequest();
                                    } else {
                                        // code for IE6, IE5
                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                                        }
                                    };
                                    xmlhttp.open("GET","getuser.php?q="+str,true);
                                    console.log(str);
                                    xmlhttp.send();
                                }
                            }
                        </script>
                        
                        <!-- script start end -->
                     
                        <!-- table appointment start -->
                        <!-- <div id="txtHint"><b> </b></div> -->
                        
                        <!-- table appointment end -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6 col-md-offset-1">
                        <div class="video-wrapper">
                            <iframe width="560" height="315" src="http://www.youtube.com/embed/cRWCHwt4_xQ?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            </section>
        <!-- </section> -->
        <section id="content-1-9" class="content-1-9 content-block">
            <div class="container">
                <div class="underlined-title">
                    <h1>Services</h1>
                    <hr>
</style>
</head>
<body>
    <div class="slideshow-container">

    <div class="mySlides fade">
    <!-- <div class="numbertext">1 / 10</div> -->
    <img src="tooth extraction.png" style="width:100%">
    </div>

    <div class="mySlides fade">
    <!-- <div class="numbertext">2 / 10</div> -->
    <img src="retainer.png" style="width:100%">
    </div>

    <div class="mySlides fade">
    <!-- <div class="numbertext">3 / 10</div> -->
    <img src="TMj treatment.png" style="width:100%">
    </div>
    <div class="mySlides fade">
    <!-- <div class="numbertext">4 / 10</div> -->
    <img src="wisdom tooth surgery.png" style="width:100%">
    </div>
    <div class="mySlides fade">
    <!-- <div class="numbertext">5 / 10</div> -->
    <img src="treatment.png" style="width:100%">
    </div>
    <div class="mySlides fade">
    <!-- <div class="numbertext">6 / 10</div> -->
    <img src="root canal surgery.png" style="width:100%">
    </div>
    <div class="mySlides fade">
    <!-- <div class="numbertext">7 / 10</div> -->
    <img src="jacket crown.png" style="width:100%">
    </div>
    <div class="mySlides fade">
    <!-- <div class="numbertext">8 / 10</div> -->
    <img src="dental implants.png" style="width:100%">
    </div>
    <div class="mySlides fade">
    <!-- <div class="numbertext">9 / 10</div> -->
    <img src="dental filling.png" style="width:100%">
    </div>
    <div class="mySlides fade">
    <!-- <div class="numbertext">10 / 10</div> -->
    <img src="dental braces.png" style="width:100%">
    </div>

    </div>
    <br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span>
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span>
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

                </div>
                <!-- <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-10">
                            <h4>Cosmetic Dentistry</h4>
                            <img src="assets/img/CosmeticDentistry.jpg" alt="Img">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-10">
                            <h4>Cosmetic Dentistry</h4>
                            <img src="assets/img/CosmeticDentistry.jpg" alt="Img">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-10">
                            <h4>Cosmetic Dentistry</h4>
                            <img src="assets/img/CosmeticDentistry.jpg" alt="Img">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-10">
                            <h4>Cosmetic Dentistry</h4>
                            <img src="assets/img/CosmeticDentistry.jpg" alt="Img">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-10">
                            <h4>Cosmetic Dentistry</h4>
                            <img src="assets/img/CosmeticDentistry.jpg" alt="Img">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-10">
                            <h4>Cosmetic Dentistry</h4>
                            <img src="assets/img/CosmeticDentistry.jpg" alt="Img">
                        </div>
                    </div>
                </div> -->
                <!-- /.row -->
            <!-- </div> -->
            <!-- /.container -->
            <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                            <span class=""><img src="assets/img/liscence.png" alt="icon"></span>
                        </div>
                        <div class="col-xs-10">
                            <h4>License Dentist</h4>
                            <p>Kids, teens, adults — we offer clinically excellent treatment for all ages.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                            <span class=""><img src="assets/img/Vector.png" alt="icon"></span>
                        </div>
                        <div class="col-xs-10">
                            <h4>Patient Comfort  #1</h4>
                            <p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                            <span class=""><img src="assets/img/SVG.png" alt="icon"></span>
                        </div>
                        <div class="col-xs-10">
                            <h4>COVID-19 Protocols!</h4>
                            <p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                            <span class=""><img src="assets/img/screw.png" alt="icon"></span>
                        </div>
                        <div class="col-xs-10">
                            <h4>Dental Implants</h4>
                            <p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                            <span class=""><img src="assets/img/syringe.png" alt="icon"></span>
                        </div>
                        <div class="col-xs-10">
                            <h4>Cosmetic Dentistry</h4>
                            <p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                            <span class=""><img src="assets/img/calendar.png" alt="icon"></span>
                        </div>
                        <div class="col-xs-10">
                            <h4>Effortless Appoinment</h4>
                            <p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="content-1-9" class="content-1-9 content-block">
            <div class="container">
                <div class="underlined-title">
                    <h1>Get in Touch</h1>
                    <hr>
                    <h2>Feel free to drop us a line to contact us</h2>
                </div>
            <!-- <div class="contact-container">
                <h2>Become a patient for life!</h2>
                <p>We can't wait to get to know you anad provide excellent care.</p>
                <button class="num-btn"><a href="#" data-toggle="modal" data-target="#myModal">Schedule an Appointment</a></button>
                <div class="google-map">
                <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d490.6739578379098!2d123.89339843152138!3d10.310506867612936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9994ee311ce97%3A0xbdf1df7c12b41b!2sCesa%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1695638747505!5m2!1sen!2sph" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="contact-icons">
                    <div class="social-med">
                    <a href="#"><i class="fa-brands fa-instagram fa-bounce" style="font-size:36px">  @cesadentalclinic</i></a>
                    <a href="https://www.facebook.com/cesadentalclinic"><i class="fa-brands fa-facebook fa-fw fa-bounce"  style="font-size:36px"> Cesa Dental Clinic</i></a>
                    </div>
                    <div class="contact-loc">
                        <span class="glyphicon glyphicon-map-marker"></span><p>Rm. 104, Doña Luisa Building, Fuente Osmeña Cir, Cebu City, 6000 Cebu</p>
                    </div>
                    <div class="contact-tele">
                        <span class="glyphicon glyphicon-earphone"></span><p>2550537 / 09663308422</p>
                    <div class="contact-sched">
                    <span class="glyphicon glyphicon-time"></span><p>Tuesday - Thursday 7:30am - 4pm, Friday 8am - 2pm</p>
                    </div>
                    </div>
                </div>
            </div> -->
        </section>
        <div class="footer">
            <div class="footer-container">
                <div class="foot-about">
                    <!-- <p class="pull-left small"><a href ="https://www.facebook.com/cesadentalclinic">© Cesa Ortho - Facebook Page </a></p> -->
                <h4>About Us</h4>
                <br>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.  </p>
                <br><br><br>
                <a href="#" data-toggle="modal" data-target="#myModal">SCHEDULE APPOINMENT</a>
                </div>
            </div>
            <div class="footer-container">
                <div class="soc-media">
                    <h4>Contact Us</h4>
                    <br>
                    <div class="contact-foot">
                        <span class="glyphicon glyphicon-earphone"></span><p>255-0537 / 0966 330 8422</p>
                        <br>
                        <span class="glyphicon glyphicon-time"></span><p>Tuesday - Thursday 7:30am - 4pm, Friday 8am - 2pm</p>
                        <br>
                        <span class="glyphicon glyphicon-time"></span><p>Tuesday - Thursday 7:30am - 4pm, Friday 8am - 2pm</p>
                    </div>
                </div>
            </div>
            <div class="footer-container">
                <div class="sched">
                    <div class="foot-loc">
                        <span class="glyphicon glyphicon-map-marker"></span><p>Rm. 104, Doña Luisa Building, Fuente Osmeña Cir, 6000 Cebu</p>
                    </div>
                    <!-- <div class="foot-contact">
                        <span class="glyphicon glyphicon-earphone"></span><p>2550537 / 09663308422</p>
                    </div> -->
                    <div class="foot-sched">
                        <span class="glyphicon glyphicon-time"></span><p>Tuesday - Thursday 7:30am - 4pm, Friday 8am - 2pm</p>
                    </div>
                <!--Google map-->
                <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d490.6739578379098!2d123.89339843152138!3d10.310506867612936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9994ee311ce97%3A0xbdf1df7c12b41b!2sCesa%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1695638747505!5m2!1sen!2sph" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
    <script src="script.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    </script>
    <!-- date start -->
  
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })

    })

</script>

    <!-- date end -->
   
</body>
</html>