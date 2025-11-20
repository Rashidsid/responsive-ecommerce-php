<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout - AlhurWear</title>
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://kit.fontawesome.com/a2e0e9e3b0.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- ===== Header ===== -->
  <header class="header">
    <section class="flex">
      <a href="index.php" class="logo">
        <img src="images/pizza logo.jpg" alt="AlhurWear Logo" class="logo-img" />
        <span class="logo-text">AlhurWear</span>
      </a>

      <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="checkout.php" class="active">Checkout</a>
      </nav>

      <div class="icons">
        <div id="user-profile">
          <i class="fas fa-user-circle"></i>
          <span id="username-display"></span>
        </div>
      </div>
    </section>
  </header>

  <!-- ===== Checkout Section ===== -->
  <section class="checkout-section">
    <h1 class="heading">Checkout</h1>

    <div class="checkout-container">
      <!-- Delivery Form -->
      <form id="address-form" class="checkout-form">
        <h2>Delivery Address</h2>
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" id="cust-name" required />
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" id="cust-phone" required />
        </div>
        <div class="form-group">
          <label>Address</label>
          <textarea id="cust-address" rows="3" required></textarea>
        </div>
        <div class="form-row">
          <div class="form-group half">
            <label>City</label>
            <input type="text" id="cust-city" required />
          </div>
          <div class="form-group half">
            <label>Postal Code</label>
            <input type="text" id="cust-zip" required />
          </div>
        </div>
      </form>

      <!-- Order Summary -->
      <div class="order-summary">
        <h2>Order Summary</h2>
        <div id="summary-items" class="summary-items">
          <!-- Cart items injected here -->
        </div>
        <div class="summary-total">
          <p>Subtotal: <span id="summary-subtotal">₹0</span></p>
          <p>Delivery: <span>₹100</span></p>
          <hr />
          <p class="grand-total">Total: <span id="summary-total">₹0</span></p>
        </div>
        <button id="proceed-payment" class="btn main-btn">Proceed to Payment</button>
      </div>
    </div>
  </section>
<!-- COD Payment Modal -->
<div class="payment-modal" id="payment-modal" aria-hidden="true">
  <div class="payment-card" role="dialog" aria-modal="true" aria-labelledby="payTitle">
    <div class="payment-header">
      <h3 id="payTitle">Select Payment</h3>
      <button class="payment-close" id="payClose" aria-label="Close">&times;</button>
    </div>

    <div class="cod-box">
      <i class="fa-solid fa-truck-fast"></i>
      <div>
        <strong>Cash on Delivery (COD)</strong>
        <div style="font-size:1.3rem;color:#475569;">Pay with cash when your order arrives.</div>
      </div>
    </div>

    <div class="pay-actions">
      <button class="btn btn-secondary" id="payCancel">Cancel</button>
      <button class="btn main-btn" id="payConfirm">Place Order</button>
    </div>
  </div>
</div>

  <!-- ===== Footer ===== -->
  <section class="footer">
    <div class="credit">© 2025 AlhurWear | All rights reserved.</div>
  </section>


<script>
document.addEventListener("DOMContentLoaded", () => {

  // Proceed to Payment Modal
  const proceedPay = document.getElementById("proceed-payment");
  const modal = document.getElementById("payment-modal");
  const payClose = document.getElementById("payClose");
  const payCancel = document.getElementById("payCancel");
  const payConfirm = document.getElementById("payConfirm");

  // Show modal
  proceedPay?.addEventListener("click", () => {
    modal.classList.add("show");
  });

  // Close modal
  payClose?.addEventListener("click", () => modal.classList.remove("show"));
  payCancel?.addEventListener("click", () => modal.classList.remove("show"));

  // Place Order
  payConfirm?.addEventListener("click", () => {
    const order = {
      name: document.getElementById("cust-name").value,
      phone: document.getElementById("cust-phone").value,
      address: document.getElementById("cust-address").value,
      city: document.getElementById("cust-city").value,
      zip: document.getElementById("cust-zip").value,
      items: getCart(),
      total: calcSubtotal(getCart()) + 100,
      payment: "COD"
    };

    fetch("place-order.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(order)
    })
    .then(r => r.text())
    .then(d => {
      if (d === "success") {
        alert("🎉 Congratulations! Your order has been placed successfully.");
        clearCart();
        window.location.href = "my-orders.php";
      } else if (d === "not-logged") {
        alert("Please login to place an order");
      } else {
        alert("Error placing order. Try again later.");
      }
    });

  });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", () => {

  const proceedPay = document.getElementById("proceed-payment");
  const modal = document.getElementById("payment-modal");
  const payClose = document.getElementById("payClose");
  const payCancel = document.getElementById("payCancel");
  const payConfirm = document.getElementById("payConfirm");

  proceedPay?.addEventListener("click", () => modal.classList.add("show"));
  payClose?.addEventListener("click", () => modal.classList.remove("show"));
  payCancel?.addEventListener("click", () => modal.classList.remove("show"));

  payConfirm?.addEventListener("click", () => {
    const order = {
      name: document.getElementById("cust-name").value,
      phone: document.getElementById("cust-phone").value,
      address: document.getElementById("cust-address").value,
      city: document.getElementById("cust-city").value,
      zip: document.getElementById("cust-zip").value,
      items: getCart(),
      total: calcSubtotal(getCart()) + 100,
      payment: "COD"
    };

    fetch("place-order.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(order)
    })
    .then(r => r.text())
    .then(d => {
      if (d === "success") {
        Swal.fire({
          icon: "success",
          title: "Order Placed 🎉",
          text: "Congratulations! Your order has been placed successfully.",
          confirmButtonText: "Go to My Orders",
        }).then(() => {
          clearCart();
          window.location.href = "my-orders.php";
        });

      } else if (d === "not-logged") {
        Swal.fire({
          icon: "warning",
          title: "Login Required",
          text: "Please login to place an order",
        });

      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Something went wrong. Please try again.",
        });
      }
    });

  });

});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="js/script.js"></script>
</body>
</html>
