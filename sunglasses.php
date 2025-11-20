<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AlhurWear – Sunglasses</title>

  <!-- Font Awesome (keep one include) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Your main CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <style>
    /* Page-specific tweaks */
    .page-hero {
      margin-top: 7rem;
      text-align:center;
      padding: 2rem 1rem 1rem;
    }
    .page-hero h1{ font-size:3.2rem; margin:0 0 .4rem 0; color:var(--black); }
    .page-hero p{ color:var(--light-color); font-size:1.6rem; }

    .sunglass-grid{
      max-width:1200px; margin:0 auto; padding: 1rem 2rem 4rem;
      display:grid; gap:2rem;
      grid-template-columns: repeat(3, minmax(0,1fr));
    }
    @media (max-width:1000px){ .sunglass-grid{ grid-template-columns: repeat(2,1fr);} }
    @media (max-width:600px){ .sunglass-grid{ grid-template-columns: 1fr;} }

    .sg-card{
      background:#fff; border-radius:14px; overflow:hidden;
      box-shadow: 0 8px 16px rgba(0,0,0,.08);
      border:1px solid #eee;
      animation: fadeUp .5s ease both;
    }
    .sg-card:nth-child(odd){ animation-delay:.05s; }
    .sg-card:nth-child(even){ animation-delay:.12s; }

    .sg-card img{ width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .sg-body{ padding:1.2rem 1.4rem 1.6rem; }
    .sg-title{ font-size:1.8rem; color:#111; margin: .2rem 0 .8rem; }
    .sg-price{ font-size:1.6rem; }
    .old-price{ color:#888; text-decoration: line-through; margin-right:.6rem; }
    .new-price{ color:#e11d48; font-weight:700; }

    @keyframes fadeUp{
      from{ opacity:0; transform: translateY(10px); }
      to{ opacity:1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <!-- ===== Header (reuse your existing header markup) ===== -->
 <header class="header">
  <section class="flex">
    <a href="index.php" class="logo">
      <img src="images/alhur logo.jpg" alt="AlhurWear Logo" class="logo-img" />
      <span class="logo-text">AlhurWear</span>
    </a>

    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="sunglasses.php">Sunglasses</a>
      <a href="cart.php">Cart</a>

      <?php if(isset($_SESSION['user'])): ?>
        <a href="my-orders.php">My Orders</a>
        <a href="logout.php" class="btn logout-btn">Logout</a>
      <?php else: ?>
        <a href="#" class="btn login-signup-btn">Login / Signup</a>
      <?php endif; ?>
    </nav>

    <button id="menu-btn" class="fa-solid fa-bars"></button>
  </section>
</header>


  <div class="page-hero">
    <h1>Sunglasses</h1>
    <p>Trending frames, polarized lenses & everyday classics.</p>
  </div>

  <!-- ===== Sunglasses Grid ===== -->
  <section aria-label="Sunglasses list">
  <div class="sunglass-grid">

    <!-- YM129 -->
    <a class="sg-card" href="sunglass-detail.php?id=YM129">
      <img src="images/sunglass1.jpg" alt="YM129">
      <div class="sg-body">
        <h3 class="sg-title">YM129</h3>
        <div class="sg-price"><span class="old-price">Rs 4,000</span><span class="new-price">Rs 3,800</span></div>
      </div>
    </a>

    <!-- YM2616 -->
    <a class="sg-card" href="sunglass-detail.php?id=YM2616">
      <img src="images/sunglass2.jpg" alt="YM2616">
      <div class="sg-body">
        <h3 class="sg-title">YM2616</h3>
        <div class="sg-price"><span class="old-price">Rs 1,800</span><span class="new-price">Rs 1,620</span></div>
      </div>
    </a>

  </div>
</section>


  

  <!-- Your JS (navbar + popup logic you already have) -->
  <script src="js/script.js"></script>
</body>
</html>
