<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=2.0">
  <title>sneaker gang</title>
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/banner.css">

</head>
<!--Horná časť stránky-->

<body>
  <header class="container main-header">
    <div class="logo-holder">
      <a href="index.php"><img src="img/SNEAKER2.png" height="90"></a>
    </div>
    <nav class="main-nav">
      <ul class="main-menu" id="main-menu container">

        <li><a href="index.php">HOME</a></li>
        <li><a href="sneakers.php">SNEAKERS</a></li>
        <li><a href="clothing.php">CLOTHING</a></li>
        <li><a href="info.php">INFO</a></li>
        <li><a href="home.php">
            <img src="icon.png" alt="Icon" width="30" height="30">
          </a></li>
        <li><a href="cart.php">
            <img src="shopping_cart.webp" alt="Cart" width="30" height="30">
            (<span id="cart-count">0</span>)
          </a></li>
      </ul>
      <a class="hamburger" id="hamburger">
        <i class="fa fa-bars"></i>
      </a>
    </nav>
  </header>
  <!--Ostatné info-->
  <main>
    <section class="banner">
      <div class="container text-black">
        <h1>Kontaktuj nás</h1>
      </div>
    </section>

    </section>
    <section class="container">
      <div class="row">
        <form action="/submit_form" method="post">
          <!--Formulár-->
          <label for="meno">Meno:</label>
          <input type="text" id="meno" name="meno" required>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <br>
          <label>Pohlavie:</label>
          <label><input type="radio" name="pohlavie" value="muz"> Muž</label>
          <label><input type="radio" name="pohlavie" value="zena"> Žena</label>
          <br>
          <label><input type="radio" name="suhlas" value="muz"> Súhlas so spracovaním osobných údajov</label>
          <br>
          <label><input type="checkbox" name="subscribe" checked> Daj odber pre novinky</label>
          <br>

          <label for="sprava">Správa:</label>
          <textarea id="sprava" name="sprava" rows="4" cols="50" required></textarea>
          <input type="submit" value="Submit">
        </form>
        <div class="col-50 text-right">
          <h3>Write to us on our social networks or at our Email, which you can find at the bottom of the page.</h3>
          <h5>Here you can find our instagram</p>
            <a href="https://www.instagram.com/matoziro/" target="_blank" style="color: black;">INSTAGRAM
              <img src="img/logo ig.webp" sizes="20px" alt="Instagram Logo" style="width: 80px; height: auto;"></imgsrc>
            </a>
        </div>
      </div>
    </section>
  </main>

  <!--Dolná časť stránky-->
  <footer class="container bg-dark text-white">
    <div class="row">
      <div class="col-25 text-left">
        <h4>Contact<br> us</h4>
        <p><i class="fa fa-envelope" aria-hidden="true"><a href="mailto:sneaker-gang@gmail.com"> sneaker-gang@gmail.com</a></i></p>
        <p><i class="fa fa-phone" aria-hidden="true"><a href="tel:0908875239"> 0908875239</a></i></p>
      </div>

      <div class="col-25 text-left">
        <div class="row">
          <footer>
            <p>&copy; <?php echo date('Y') ?> Sneaker Gang. All rights reserved.</p>
            <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
          </footer>
        </div>
  </footer>
  <script src="js/menu.js"></script>
</body>

</html>