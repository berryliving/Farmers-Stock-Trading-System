<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Farmers Stock Trading</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="bootstrap\js\bootstrap.min.js"></script>
  <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
  <link rel="stylesheet" href="login.css"/>
  <script src="js/jquery.min.js"></script>
  <script src="js/skel.min.js"></script>
  <script src="js/skel-layers.min.js"></script>
  <script src="js/init.js"></script>
  <noscript>
    <link rel="stylesheet" href="css/skel.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-xlarge.css" />
  </noscript>
  <link rel="stylesheet" href="indexfooter.css" />
  <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
</head>

<body>

<?php
  require 'menu.php';
?>

<!-- Banner -->
<section id="banner" class="wrapper">
  <div class="container">
    <h2>Farming</h2>
    <p>Your Product Our Market</p>
    <br><br>
    <center>
      <div class="row uniform">
        <div class="6u 12u$(xsmall)">
          <button class="button fit" onclick="document.getElementById('id01').style.display='block'" style="width:auto">LOGIN</button>
        </div>

        <div class="6u 12u$(xsmall)">
          <button class="button fit" onclick="document.getElementById('id02').style.display='block'" style="width:auto">REGISTER</button>
        </div>
      </div>
    </center>


  </section>

<!-- One -->
<section id="one" class="wrapper style1 align-center">
  <div class="container">
    <header>
      <h2>Farming</h2>
      <p>Explore the new way of trading...</p>
    </header>
    <div class="row 200%">
      <section class="4u 12u$(small)">
        <i class="icon big rounded fa-clock-o"></i>
        <p>Digital Market</p>
      </section>
      <section class="4u 12u$(small)">
        <i class="icon big rounded fa-comments"></i>
        <p>farm-Chart</p>
      </section>
      <section class="4u$ 12u$(small)">
        <i class="icon big rounded fa-user"></i>
        <p>Register with us</p>
      </section>
    </div>
  </div>
</section>


<!-- Footer -->
<footer class="footer-distributed" style="background-color:black" id="aboutUs">
  <center>
    <h1 style="font: 35px calibri;">Contact Us</h1>
  </center>
  <div class="footer-left">
    <h3 style="font-family: 'Times New Roman', cursive;">Farming &copy;2023 </h3>
    <div class="logo">
      <a href="index.php"><img src="images/logo.jpg" width="200px"></a>
    </div>
    <br />
    <p style="font-size:20px;color:white">Your product Our market !!!</p>
    <br />
  </div>

  <div class="footer-center">
    <div>
      <i class="fa fa-map-marker"></i>
      <p style="font-size:20px">P.O.Box 111<span>Dar-es-salaam</span></p>
    </div>
    <div>
      <i class="fa fa-phone"></i>
      <p style="font-size:20px">0688172233</p>
    </div>
    <div>
      <i class="fa fa-envelope"></i>
      <p style="font-size:20px"><a href="mailto:stockfarming@gmail.com" style="color:white">farmingstocktrading@gmail.com</a></p>
    </div>
  </div>

  <div class="footer-right">
    <p class="footer-company-about" style="color:white">
      <span style="font-size:20px"><b>Contact Farmers Stock Trading</b></span>
      Farmers Stock Trading is e-commerce trading platform for farming products.
    </p>
    <div class="footer-icons">
      <!-- <a  href="#"><i style="margin-left: 0;margin-top:5px;"class="fa fa-facebook"></i></a>
      <a href="#"><i style="margin-left: 0;margin-top:5px" class="fa fa-instagram"></i></a>
      <a href="#"><i style="margin-left: 0;margin-top:5px" class="fa fa-youtube"></i></a> -->
      <ul class="icons">
        <li><a href="#" class="icon rounded fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon round fa-instagram"><span class="label">Instagram</span></a></li>
        <li><a href="#" class="icon rounded fa-facebook"><span class="label">Facebook</span></a></li><br>
        <li><a href="#" class="icon rounded fa-pinterest"><span class="label">Pinterest</span></a></li>
        <li><a href="#" class="icon rounded fa-google-plus"><span class="label">Google+</span></a></li>
        <li><a href="#" class="icon rounded fa-linkedin"><span class="label">LinkedIn</span></a></li>
      </ul>
    </div>
  </div>
</footer>


<div id="id01" class="modal">

  <form class="modal-content animate" action="Login/login.php" method='POST'>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <h3>Login</h3>
      <form method="post" action="Login/login.php">
        <div class="row uniform 50%">
          <div class="7u$">
            <input type="text" name="uname" id="uname" value="" placeholder="UserName" style="width:80%" required/>
          </div>
          <div class="7u$">
            <input type="password" name="pass" id="pass" value="" placeholder="Password" style="width:80%" required/>
          </div>
        </div>
        <div class="row uniform">
          <p><b>Category : </b></p>
          <div class="3u 12u$(small)">
            <input type="radio" id="farmer" name="category" value="1" checked>
            <label for="farmer">Farmer</label>
          </div>
          <div class="3u 12u$(small)">
            <input type="radio" id="buyer" name="category" value="0">
            <label for="buyer">Buyer</label>
          </div>
        </div>
        <center>
        <div class="row uniform">
          <div class="7u 12u$(small)">
            <input type="submit" value="Login" />
          </div>
        </div>
        </center>

      </form>
    </div>
  </form>
</div>


<div id="id02" class="modal">

  <form class="modal-content animate" action="Login/signUp.php" method='POST'>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <section>
        <h3>SignUp</h3>
        <form method="post" action="Login/signUp.php">
          <center>
            <div class="row uniform">
              <div class="3u 12u$(xsmall)">
                <input type="text" name="name" id="name" value="" placeholder="Name" required/>
              </div>
              <div class="3u 12u$(xsmall)">
                <input type="text" name="username" id="username" value="" placeholder="UserName" required/>
              </div>
            </div>
            <div class="row uniform">
              <div class="3u 12u$(xsmall)">
                <input type="text" name="mobile" id="mobile" value="" placeholder="Mobile Number" required/>
              </div>

              <div class="3u 12u$(xsmall)">
                <input type="email" name="email" id="email" value="" placeholder="Email" required/>
              </div>
            </div>
            <div class="row uniform">
              <div class="3u 12u$(xsmall)">
                <input type="password" name="password" id="password" value="" placeholder="Password" required/>
              </div>
              <div class="3u 12u$(xsmall)">
                <input type="password" name="pass" id="pass" value="" placeholder="Retype Password" required/>
              </div>
            </div>
            <div class="row uniform">
              <div class="6u 12u$(xsmall)">
                <input type="text" name="addr" id="addr" value="" placeholder="Address" style="width:80%" required/>
              </div>
            </div>
            <div class="row uniform">
              <p>
                <b>Category:</b>
              </p>
              <div class="3u 12u$(small)">
                <select id="category" name="category">
                  <option value="0"> - Select category: -</option>
                  <option value="1">Farmer</option>
                  <option value="2">Buyer</option>
                </select>
              </div>
            </div>

            <!-- Lipanamba input for Farmer -->
            <div id="farmerLipanambaInput" style="display: none;">
              <div class="row uniform">
                <div class="6u 12u$(xsmall)">
                  <input type="text" name="lipanamba" id="lipanamba" value="" placeholder="Lipanamba" style="width: 80%" required/>
                </div>
              </div>
            </div>

            <div class="row uniform">
              <div class="3u 12u$(small)">
                <input type="submit" value="Submit" name="submit" class="special" />
              </div>
              <div class="3u 12u$(small)">
                <input type="reset" value="Reset" name="reset"/>
              </div>
            </div>
          </center>
        </form>
      </section>
    </div>
  </form>

  <script>
  // Get the modal
  var modal = document.getElementById('id01');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  var modal1= document.getElementById('id02');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal1) {
      modal1.style.display = "none";
    }
  }

  document.getElementById('category').addEventListener('change', function() {
    var farmerLipanambaInput = document.getElementById("farmerLipanambaInput");
    if (this.value === "1") {
      farmerLipanambaInput.style.display = "block";
    } else {
      farmerLipanambaInput.style.display = "none";
    }
  });
  </script>


</body>
</html>
