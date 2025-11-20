<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AlhurWear – Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Country code picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css" />


  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/a2e0e9e3b0.js" crossorigin="anonymous"></script>
</head>

<body>


<!-- ===== Header ===== -->
<?php session_start(); ?>
<header class="header">
  <section class="flex">
    <a href="index.php" class="logo">
      <img src="images/alhur logo.jpg" alt="AlhurWear Logo" class="logo-img" />
      <span class="logo-text">AlhurWear</span>
    </a>

    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="#menu">Products</a>
      <a href="#about">About</a>
      <a href="cart.php">Cart</a>
      <a href="#contact">Contact</a>

      <?php if(isset($_SESSION['user_id'])): ?>

<div class="user-menu">
    <button id="userIcon" class="user-icon">
        <i class="fa-solid fa-user"></i>
    </button>

    <div class="user-dropdown" id="userDropdown">
        <a href="profile.php">Manage My Account</a>
        <a href="my-orders.php">My Orders</a>
        <a href="logout.php">Log out</a>
    </div>
</div>

<?php else: ?>

<a href="#" class="btn login-signup-btn">Login / Signup</a>

<?php endif; ?>

    </nav>
     <div id="menu-btn" class="fas fa-bars"></div>
  </section>
</header>




  <!-- ===== Hero background video ===== -->
  <!-- HERO (Black Friday style) -->
<section class="hero" id="home" aria-label="Black Friday Early Access">
  <div class="hero__inner">
    <div class="hero__kicker">ALHURWEAR | BLACK FRIDAY</div>
    <h1 class="hero__title">Black Friday Early Access is Here</h1>
    <p class="hero__subtitle">The biggest deals of the year are here early</p>
    <a href="#" id="shop-now" class="hero__btn">Shop Now</a>
  </div>
</section>


  <!-- ===== About ===== -->
  <section class="about" id="about">
    <h1 class="heading">About Us</h1>
    <div class="box-container">
      <div class="box">
        <img src="images/about-1.svg" alt="">
        <h3>Made with love</h3>
        <p>Every AlhurWear piece is handmade with passion and precision.</p>
      </div>
      <div class="box">
        <img src="images/about-2.svg" alt="">
        <h3>Fast Delivery</h3>
        <p>Free delivery within 4 km on every order.</p>
      </div>
    </div>
  </section>

  <!-- ===== Products ===== -->
  <!-- ===== Products (Categories) ===== -->
<section class="menu" id="menu">
  <h1 class="heading">Shop by Category</h1>

  <div class="category-grid">
    <!-- Sunglasses (clickable) -->
    <a class="category-card cat-sunglass" href="sunglasses.php" aria-label="Browse Sunglasses">
      <div class="cat-content">
        <h3>Sunglasses</h3>
        <p>See all styles</p>
      </div>
    </a>

    <!-- Clothes (disabled placeholder) -->
    <div class="category-card cat-cloth disabled" aria-label="Clothes coming soon">
      <div class="cat-content">
        <h3>Clothes</h3>
        <p>Coming soon</p>
      </div>
    </div>
  </div>
</section>


  <!-- ===== Footer ===== -->
  <section class="footer">
    <div class="box-container">
      <div class="box"><i class="fas fa-phone"></i><h3>Phone</h3><p>+977 9743279112</p></div>
      <div class="box"><i class="fas fa-map-marker-alt"></i><h3>Address</h3><p>Kathmandu, Nepal</p></div>
      <div class="box"><i class="fas fa-envelope"></i><h3>Email</h3><p>alhurwear@gmail.com</p></div>
    </div>
    <div class="credit">© 2025 AlhurWear | All rights reserved.</div>
  </section>

  <!-- ===== Login/Signup Popup (frosted) ===== -->
  <div id="auth-popup" class="auth-popup">
    <div class="auth-container">
      <button class="close-btn" id="close-popup">&times;</button>

      <!-- Sign Up -->
      <form id="signup-form" class="auth-form active">
        <h2>Get Started</h2>
        <div class="input-group"><label>Full Name</label><input id="signup-name" type="text" required></div>
        <div class="input-group"><label>Email</label><input id="signup-email" type="email" required></div>
        <div class="input-group">
  <label for="signup-phone">Contact</label>
  <input id="signup-phone" type="tel" placeholder="Enter your phone number" required />
</div>
<input type="hidden" id="phone-full" name="phone_full">

        <div class="input-group"><label>Password</label><input id="signup-password" type="password" required></div>
        <div class="checkbox-group">
          <input type="checkbox" id="agree" required>
          <label for="agree">I agree to the processing of <a href="#">Personal data</a></label>
        </div>
        <button type="submit" class="main-btn">Sign up</button>
        <div class="social-login">
          <p>Sign up with</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-google"></i></a>
          </div>
        </div>
        <p class="toggle-text">Already have an account? <a href="#" id="switch-to-login">Sign in</a></p>
      </form>

      <!-- Login -->
      <form id="login-form" class="auth-form">
        <h2>Welcome back</h2>
        <div class="input-group"><label>Email</label><input id="login-email" type="email" required></div>
        <div class="input-group">
  <label>Password</label>
  <div class="password-wrapper">
      <input id="login-password" type="password" required>
      <i class="fa-solid fa-eye" id="toggleLoginPwd"></i>
  </div>
</div>

        <div class="checkbox-group"><input type="checkbox" id="remember"><label for="remember">Remember me</label></div>
        <button type="submit" class="main-btn">Sign in</button>
        <div class="social-login">
          <p>Sign in with</p>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-google"></i></a>
          </div>
        </div>
        <p class="toggle-text">Don’t have an account? <a href="#" id="switch-to-signup">Sign up</a></p>
      </form>
    </div>
  </div>

  <script src="js/script.js"></script>

</body>
</html>
