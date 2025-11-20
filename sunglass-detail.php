<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AlhurWear – Sunglass Detail</title>

  <!-- Font Awesome (single include) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Your main CSS -->
  <link rel="stylesheet" href="css/style.css"/>

  <style>
    /* ===== Page styles (self-contained) ===== */
    .product-wrap{
      max-width:1200px;margin:8rem auto 3rem;
      display:grid;grid-template-columns:1.1fr .9fr;gap:2rem;padding:0 2rem;
    }
    .p-gallery{position:relative}
    .p-img{background:#fff;border:1px solid #eee;border-radius:12px;overflow:hidden}
    .p-img img{width:100%;display:block;aspect-ratio:4/3;object-fit:cover}

    /* 360 badge */
    .p360-btn{
      position:absolute; top:12px; right:12px;
      background:#10b981; color:#fff; font-weight:700;
      border:none; border-radius:999px; padding:.6rem .9rem;
      display:inline-flex; align-items:center; gap:.4rem; cursor:pointer;
      box-shadow:0 6px 14px rgba(0,0,0,.15);
    }
    .p360-btn i{font-size:1.2rem}

    /* 360 overlay */
    .viewer360{
      position:fixed; inset:0; background:rgba(0,0,0,.7);
      display:none; align-items:center; justify-content:center; z-index:100000;
    }
    .viewer360.show{display:flex}
    .viewer360-inner{
      width:min(900px,96vw); height:min(620px,78vh);
      background:#111; border-radius:14px; position:relative; overflow:hidden;
      display:grid; place-items:center;
    }
    .viewer360-close{
      position:absolute; top:10px; right:10px; background:transparent; border:none; color:#fff; font-size:2rem; cursor:pointer;
    }
    .viewer360 img{max-width:100%; max-height:100%; object-fit:contain; user-select:none; pointer-events:none}
    .viewer360-hint{
      position:absolute; bottom:10px; left:50%; transform:translateX(-50%);
      color:#e5e7eb; font-size:1.2rem; opacity:.9; background:rgba(255,255,255,.08);
      padding:.4rem .7rem; border-radius:8px;
    }

    .p-info h1{font-size:2.4rem;margin:.2rem 0 .6rem;color:#111}
    .brand{color:#6b7280;font-size:1.4rem}
    .price{font-size:2.2rem;color:#0f172a;font-weight:800;margin:.4rem 0 1.2rem}
    .old{color:#94a3b8;text-decoration:line-through;margin-right:.6rem;font-weight:500}
    .off{color:#059669;font-weight:700;font-size:1.4rem;margin-left:.4rem}

    .opt-title{font-size:1.4rem;color:#475569;margin:.8rem 0 .4rem}
    .swatches{display:flex;gap:.6rem}
    .swatch{width:28px;height:28px;border-radius:999px;border:2px solid #fff;outline:2px solid #d1d5db;cursor:pointer}
    .swatch.active{outline-color:#111}
    .swatch[title*="Sand"]{background:linear-gradient(135deg,#1f2937 50%, #111827 50%);}
    .swatch[title*="Leopard"]{background:#6b4f31}
    .swatch[title*="White Transparent"]{background:linear-gradient(135deg,#f3f4f6 50%,#93c5fd 50%);}
    .swatch[title*="White"]{background:#e5e7eb}
    .swatch[title*="Black"]{background:#111827}
    .swatch[title*="Blue"]{background:#2563eb}
    .swatch[title*="Pink"]{background:#f9a8d4}

    .btn-primary{background:#10b981;color:#fff;border:none;border-radius:10px;padding:1.1rem 1.4rem;font-size:1.6rem;cursor:pointer}
    .btn-primary:hover{filter:brightness(.95)}

    .tech{margin-top:1.6rem;border-top:1px solid #e5e7eb;padding-top:1rem}
    .tech h3{font-size:1.6rem;margin:0 0 .6rem;color:#111}
    .tech p{font-size:1.4rem;color:#374151;margin:.2rem 0}

    @media (max-width:980px){ .product-wrap{grid-template-columns:1fr} }
  </style>
</head>
<body>

  <!-- Header -->
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


  <main class="product-wrap" id="product-root"></main>

  <script>
    // ===== Products data =====
    const PRODUCTS = {
      "YM129": {
        brand: "AlhurWear",
        title: "YM129 – Square Sunglass",
        image: "images/sunglass1.jpg",
        mrp: 4000, price: 3800, off: 5,
        colors: [
          {label:"Black/Blue", code:"black-blue"},
          {label:"White/Blue", code:"white-blue"},
          {label:"White Transparent/Blue", code:"white-transparent-blue"}
        ],
        tech: [
          "Acetate Frame With Polarized Lens, UV400",
          "Weight: 25g"
        ],
        framesBase: "images/360/YM129/frame_", framesCount: 36
      },
      "YM2616": {
        brand: "AlhurWear",
        title: "YM2616 – Classic Sunglass",
        image: "images/sunglass2.jpg",
        mrp: 1800, price: 1620, off: 10,
        colors: [
          {label:"Sand Black/Black", code:"sand-black"},
          {label:"Sand Black/Blue", code:"sand-blue"},
          {label:"Leopard/Brown", code:"leopard-brown"},
          {label:"White/Black", code:"white-black"},
          {label:"Pink", code:"pink"}
        ],
        tech: [
          "PC Frame With Polarized Lens, UV400",
          "Weight: 52g"
        ],
        framesBase: "images/360/YM2616/frame_", framesCount: 36
      }
    };

    // ===== Render page =====
    const params = new URLSearchParams(location.search);
    const id = params.get("id") || "YM129";
    const p = PRODUCTS[id];

    const root = document.getElementById("product-root");
    if (!p) {
      root.innerHTML = "<p style='margin-top:8rem;padding:2rem'>Product not found.</p>";
    } else {
      root.innerHTML = [
        '<section class="p-gallery">',
          '<div class="p-img product-image">',
            '<img src="' + p.image + '" alt="' + p.title + '" id="mainImg">',
          '</div>',
          '<button class="p360-btn" id="btn360"><i class="fa-solid fa-rotate"></i> 360°</button>',
        '</section>',
        '<section class="p-info" data-product-id="' + id + '">',
          '<div class="brand">' + p.brand + '</div>',
          '<h1 class="product-title">' + p.title + '</h1>',
          '<div class="price">',
            '<span class="old">Rs ' + p.mrp.toLocaleString() + '</span> ',
            '<span class="product-price">Rs ' + p.price.toLocaleString() + '</span>',
            '<span class="off">(' + p.off + '% OFF)</span>',
          '</div>',
          '<div class="opt-title">Frame · Color</div>',
          '<div class="swatches" id="swatches">',
            p.colors.map(function(c,i){
              return '<button class="swatch ' + (i===0?'active':'') + '" title="' + c.label + '" data-code="' + c.code + '" aria-label="' + c.label + '"></button>';
            }).join(''),
          '</div>',
          '<div style="margin:1.4rem 0 1.8rem">',
            '<button class="btn-primary" id="addToCart">ADD TO CART</button>',
          '</div>',
          '<div class="tech">',
            '<h3>Technical information</h3>',
            p.tech.map(function(t){ return '<p>'+t+'</p>'; }).join(''),
            '<p style="color:#6b7280;margin-top:.6rem">Product id: ' + id + '</p>',
          '</div>',
        '</section>',
        '<div class="viewer360" id="viewer360">',
          '<div class="viewer360-inner">',
            '<button class="viewer360-close" id="close360">&times;</button>',
            '<img id="frameImg" alt="' + p.title + ' 360 view">',
            '<div class="viewer360-hint">Drag left/right to rotate</div>',
          '</div>',
        '</div>'
      ].join('');
    }

    // ===== Behaviors (if product exists) =====
    if (p) {
      // Swatches
      var sw = document.getElementById("swatches");
      sw.addEventListener("click", function(e){
        var b = e.target.closest(".swatch"); if(!b) return;
        sw.querySelectorAll(".swatch").forEach(function(x){ x.classList.remove("active"); });
        b.classList.add("active");
      });

 // Add to cart (stores into localStorage.cart)
document.getElementById("addToCart").addEventListener("click", function(){
  let selected = sw.querySelector(".swatch.active").getAttribute("title");

  addToCart({
    id: id,
    title: p.title,
    price: p.price,
    color: selected,
    qty: 1,
    img: p.image
  });

  // Show success message (toast)
  alert("Product added successfully to your cart!");

});






      // 360 viewer
      var btn360 = document.getElementById("btn360");
      var overlay = document.getElementById("viewer360");
      var close360 = document.getElementById("close360");
      var frameImg = document.getElementById("frameImg");

      function pad3(n){ return String(n).padStart(3,'0'); }
      var total = p.framesCount || 0;
      var frames = [];
      for (var i=1;i<=total;i++){ frames.push(p.framesBase + pad3(i) + '.jpg'); }

      var idx = 0, dragging = false, lastX = 0;
      function show(i){ frameImg.src = frames.length ? frames[i] : p.image; }

      btn360.addEventListener("click", function(){
        overlay.classList.add("show");
        idx = 0; show(idx);
      });
      close360.addEventListener("click", function(){ overlay.classList.remove("show"); });
      overlay.addEventListener("click", function(e){ if(e.target === overlay) overlay.classList.remove("show"); });

      function start(x){ dragging = true; lastX = x; }
      function move(x){
        if(!dragging) return;
        var delta = x - lastX;
        if (Math.abs(delta) > 6) {
          idx = (idx + (delta > 0 ? -1 : 1) + (frames.length || 1)) % (frames.length || 1);
          show(idx);
          lastX = x;
        }
      }
      function end(){ dragging = false; }

      overlay.addEventListener("mousedown", function(e){ start(e.clientX); });
      overlay.addEventListener("mousemove", function(e){ move(e.clientX); });
      overlay.addEventListener("mouseup", end);
      overlay.addEventListener("mouseleave", end);

      overlay.addEventListener("touchstart", function(e){ start(e.touches[0].clientX); }, {passive:true});
      overlay.addEventListener("touchmove",  function(e){ move(e.touches[0].clientX); }, {passive:true});
      overlay.addEventListener("touchend", end);
    }
  </script>

  <!-- Shared site JS (navbar/popup, cart engine, etc.) -->
  <script src="js/script.js"></script>
</body>
</html>
