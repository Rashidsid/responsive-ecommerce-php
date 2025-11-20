/***********************
 * NAVBAR + AUTH POPUP *
 ***********************/
document.addEventListener('DOMContentLoaded', () => {
  // Navbar toggle
  const menuBtn = document.querySelector('#menu-btn');
  const navbar  = document.querySelector('.navbar');

  menuBtn?.addEventListener('click', () => {
    navbar.classList.toggle('active');
    menuBtn.classList.toggle('fa-bars');
    menuBtn.classList.toggle('fa-xmark');
  });

  document.querySelectorAll('.navbar a').forEach(link =>
    link.addEventListener('click', () => {
      navbar.classList.remove('active');
      menuBtn?.classList.add('fa-bars');
      menuBtn?.classList.remove('fa-xmark');
    })
  );

  // Auth popup
  const popup = document.getElementById("auth-popup");
  const openBtn = document.querySelector(".login-signup-btn");
  const closeBtn = document.getElementById("close-popup");
  const signupForm = document.getElementById("signup-form");
  const loginForm = document.getElementById("login-form");
  const switchToLogin = document.getElementById("switch-to-login");
  const switchToSignup = document.getElementById("switch-to-signup");
  const shopNowBtn = document.getElementById('shop-now');

  openBtn?.addEventListener("click", e => { e.preventDefault(); popup?.classList.add("active"); });
  closeBtn?.addEventListener("click", () => popup?.classList.remove("active"));
  window.addEventListener("click", e => { if (e.target === popup) popup?.classList.remove("active"); });

  switchToLogin?.addEventListener("click", e => {
    e.preventDefault(); signupForm?.classList.remove("active"); loginForm?.classList.add("active");
  });
  switchToSignup?.addEventListener("click", e => {
    e.preventDefault(); loginForm?.classList.remove("active"); signupForm?.classList.add("active");
  });

 shopNowBtn?.addEventListener("click", e => {
  e.preventDefault();
  fetch("check-session.php")
  .then(res => res.text())
  .then(isLogged => {
    if(isLogged === "yes") {
      document.querySelector("#menu").scrollIntoView({ behavior: "smooth" });
    } else {
      popup.classList.add("active");
      signupForm.classList.remove("active");
      loginForm.classList.add("active");
    }
  });
});


  /**************
   * SIGNUP API *
   **************/
  document.getElementById("signup-form")?.addEventListener("submit", function(e){
    e.preventDefault();
    const name = document.getElementById("signup-name").value.trim();
    const email = document.getElementById("signup-email").value.trim();
    const phone = document.getElementById("signup-phone").value.trim();
    const password = document.getElementById("signup-password").value.trim();

    fetch("signup.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `name=${name}&email=${email}&phone=${phone}&password=${password}`
    })
    .then(res => res.text())
    .then(data => {
      if(data === "success"){
        alert("Signup successful! Please login.");
        signupForm.reset();
        signupForm.classList.remove("active");
        loginForm.classList.add("active");
      } else alert(data);
    });
  });

// LOGIN
document.getElementById("login-form").addEventListener("submit", function(e){
  e.preventDefault();

  let data = new FormData();
  data.append("email", document.getElementById("login-email").value);
  data.append("password", document.getElementById("login-password").value);

  fetch("login.php", { method: "POST", body: data })
  .then(res => res.text())
  .then(response => {
    if(response === "success"){
      alert("Login Successful");
      window.location = "index.php"; // or cart.html
    } else {
      alert("Invalid email or password");
    }
  });
});


});


/*******************
 * CART ENGINE (LS) *
 *******************/
function getCart() {
  try { return JSON.parse(localStorage.getItem('cart') || '[]'); }
  catch { return []; }
}
function setCart(items) { localStorage.setItem('cart', JSON.stringify(items)); }
function addToCart(item) {
  const cart = getCart();
  const idx = cart.findIndex(x => x.id === item.id && x.color === item.color);
  if (idx >= 0) cart[idx].qty += item.qty || 1;
  else cart.push({ ...item, qty: item.qty || 1 });
  setCart(cart);
}
function removeFromCart(index) { const cart = getCart(); cart.splice(index, 1); setCart(cart); }
function updateQty(index, qty) { const cart = getCart(); cart[index].qty = Math.max(1, parseInt(qty || 1, 10)); setCart(cart); }
function clearCart() { setCart([]); }

function formatINR(n) { return '₹' + Number(n).toLocaleString('en-IN'); }
function calcSubtotal(cart) { return cart.reduce((sum, i) => sum + i.price * i.qty, 0); }

/* Render checkout summary (#summary-items) */
function renderCheckoutSummary() {
  const itemsWrap = document.getElementById('summary-items');
  const subEl = document.getElementById('summary-subtotal');
  const totalEl = document.getElementById('summary-total');
  if (!itemsWrap || !subEl || !totalEl) return;

  const cart = getCart();
  itemsWrap.innerHTML = '';

  if (!cart.length) {
    itemsWrap.innerHTML = `<p style="padding:.5rem 0;">No items in cart.</p>`;
  } else {
    cart.forEach((item) => {
      const row = document.createElement('div');
      row.className = 'summary-item';
      row.style.display = 'flex';
      row.style.justifyContent = 'space-between';
      row.innerHTML = `
        <span>${item.title} (${item.color})</span>
        <span>${item.qty} × ${formatINR(item.price)}</span>
      `;
      itemsWrap.appendChild(row);
    });
  }

  const subtotal = calcSubtotal(cart);
  const total = subtotal + 100;

  subEl.textContent = formatINR(subtotal);
  totalEl.textContent = formatINR(total);
}


/*************************
 * PAGE-SPECIFIC BEHAVIOR *
 *************************/
document.addEventListener('DOMContentLoaded', () => {
  const path = window.location.pathname;

  // Proceed to Checkout button redirect
document.getElementById("checkout-btn")?.addEventListener("click", () => {
  window.location.href = "checkout.php";
});




  /* CHECKOUT PAGE */
  if (path.endsWith('checkout.php')) {
    renderCheckoutSummary();

    const proceedBtn = document.getElementById('proceed-payment');
    const modal = document.getElementById('payment-modal');
    const payClose = document.getElementById('payClose');
    const payCancel = document.getElementById('payCancel');
    const payConfirm = document.getElementById('payConfirm');

    proceedBtn?.addEventListener('click', () => {
      modal.classList.add('show');
    });

    payClose?.addEventListener('click', () => modal.classList.remove('show'));
    payCancel?.addEventListener('click', () => modal.classList.remove('show'));

    /**************
     * PLACE ORDER *
     **************/
    payConfirm?.addEventListener("click", () => {
  const order = {
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
    if(d === "success"){
      Swal.fire({
        icon: "success",
        title: "Congratulations!",
        text: "Your order has been placed successfully 🎉",
        confirmButtonColor: "#3085d6",
      }).then(() => {
        clearCart();
        window.location.href = "my-orders.php";
      });

    } else if (d === "not-logged") {
      Swal.fire({
        icon: "warning",
        title: "Please login first",
        text: "You need to login to place an order",
        confirmButtonColor: "#d33"
      });

    } else {
      Swal.fire({
        icon: "error",
        title: "Order Failed",
        text: "Something went wrong. Try again later."
      });
    }
  });
});

  }
});

/* Eye button for password */
const toggleLoginPwd = document.getElementById("toggleLoginPwd");
const loginPwd = document.getElementById("login-password");

toggleLoginPwd?.addEventListener("click", () => {
  const type = loginPwd.getAttribute("type") === "password" ? "text" : "password";
  loginPwd.setAttribute("type", type);
  toggleLoginPwd.classList.toggle("fa-eye-slash");
});

/* user icon dropdown */
document.addEventListener("click", function(e){
  const icon = document.getElementById("userIcon");
  const menu = document.getElementById("userDropdown");

  if(icon && icon.contains(e.target)){
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
  } 
  else if(menu && !menu.contains(e.target)){
    menu.style.display = "none";
  }
});


/* cart */
function renderCart() {
  const cartWrap = document.getElementById("cart-items");
  if (!cartWrap) return;

  const cart = getCart();
  cartWrap.innerHTML = "";

  if (!cart.length) {
    cartWrap.innerHTML = `<p style="padding:1rem;font-size:1.6rem;">Your cart is empty.</p>`;
    return;
  }

  cart.forEach((item, i) => {
    const row = document.createElement("div");
    row.className = "cart-item-row";
    row.innerHTML = `
      <img src="${item.img}" class="cart-img">
      <div class="cart-info">
        <h3>${item.title}</h3>
        <p>${item.color}</p>
        <p>₹${item.price}</p>
        <input type="number" value="${item.qty}" min="1" onchange="updateQty(${i}, this.value)">
        <button onclick="removeFromCart(${i})">Remove</button>
      </div>
    `;
    cartWrap.appendChild(row);
  });

  const subtotal = calcSubtotal(cart);
  document.getElementById("subtotal").innerText = "₹" + subtotal;
  document.getElementById("total").innerText = "₹" + (subtotal + 100);
}

document.addEventListener("DOMContentLoaded", () => {
  renderCart();
});
