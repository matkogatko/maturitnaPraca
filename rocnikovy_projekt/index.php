<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=2.0">
  <title>sneaker gang</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/slider.css">
</head>
<!--Horná časť stránky-->

<body>
  <header class="container main-header">
    <div>
      <a href="index.php">
        <img src="img/SNEAKER2.png" height="90">
      </a>
    </div>
    <nav class="main-nav">
      <ul class="main-menu" id="main-menu">
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
  <!--Slide Show-->

  <main>
    <section class="slides-container">
      <div class="slide fade">
        <img src="img/Vítaj.png">
      </div>

      <div class="slide fade">
        <img src="img/Kúp si nieco.png">
      </div>

      <a id="prev" class="prev">❮</a>
      <a id="next" class="next">❯</a>

    </section>


    <div id="Sme">
      <h6>Sme radi, že ste sa rozhodli u nás nakupovať a dúfame, že budete spokojný s našimi službami.</h6>
    </div>
    <!--Accordeon časť stránky-->

    <div id="BEST SELLERS">
      <h4>BEST SELLERS</h4>
    </div>
    <script src="js/app.js"></script>
    <button class="accordion">Nike Air Force 1 07 Triple White</button>
    <div class="panel">
      <img src="img/triple white.webp" alt="Nike Air Force 1 07 Triple White" style="width:30%" height="30%">
      <h3> od 117€</h3>
    </div>
    <script src="js/app.js"></script>

    <script src="js/app.js"></script>
    <button class="accordion">
      TRAVIS SCOTT UNION O2 FULL ZIP UP HOODIE</button>
    <div class="panel">
      <img src="img/Nevtelenterv_12_750x.png.webp" alt="TRAVIS SCOTT UNION O2 FULL ZIP UP HOODIE" style="width:30%" height="30%">
      <h3>od 157€</h3>
    </div>
    <script src="js/app.js"></script>
    <script src="js/app.js"></script>
  </main>
  <!--Footer-->
  <footer>
    <p>&copy; <?php echo date('Y') ?> Sneaker Gang. All rights reserved.</p>
    <p><a href="/privacy">Privacy Policy</a> | <a href="/terms">Terms of Service</a></p>
  </footer>
  <script src="js/app.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/slider.js"></script>
</body>

</html>