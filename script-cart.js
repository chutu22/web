//Cartegory---
const itemsliderbar = document.querySelectorAll(".cartegory-left-li")
itemsliderbar.forEach(function (menu, index) {
    menu.addEventListener("click", function () {
        menu.classList.toggle("block")
    })
});

//Product---
const baoquan = document.querySelector(".baoquan")
const chitiet = document.querySelector(".chitiet")
if (baoquan) {
    baoquan.addEventListener("click", function () {
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "block"

    })
}
if (chitiet) {
    chitiet.addEventListener("click", function () {
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"

    })
}

const butTon = document.querySelector(".product-content-right-bottom-top")
if (butTon) {
    butTon.addEventListener("click", function () {
        document.querySelector(".product-content-right-bottom-big").classList.toggle("activeB")
    })
}

const bigImg = document.querySelector(".product-content-left-big-img img")
const smallImg = document.querySelectorAll(".product-content-left-small-img img")
smallImg.forEach(function (imgItem, X) {
    imgItem.addEventListener("click", function () {
        bigImg.src = imgItem.src
    })
})
//sắp xếp sp
document.getElementById('sortSelect').addEventListener('change', function () {
    let productContainer = document.getElementById('productContainer');
    let items = Array.from(productContainer.getElementsByClassName('cartegory-right-content-item'));

    if (this.value === 'asc') {
        items.sort((a, b) => {
            let priceA = parseInt(a.getElementsByTagName('p')[0].innerText.replace('đ', ''));
            let priceB = parseInt(b.getElementsByTagName('p')[0].innerText.replace('đ', ''));
            return priceA - priceB;
        });
    } else if (this.value === 'desc') {
        items.sort((a, b) => {
            let priceA = parseInt(a.getElementsByTagName('p')[0].innerText.replace('đ', ''));
            let priceB = parseInt(b.getElementsByTagName('p')[0].innerText.replace('đ', ''));
            return priceB - priceA;
        });
    }

    productContainer.innerHTML = '';
    items.forEach(item => productContainer.appendChild(item));
});
//product-->brand
document.querySelectorAll('.brand-item').forEach(function(item) {
    item.addEventListener('click', function() {
        var brandId = this.getAttribute('data-brand-id');
        document.querySelectorAll('.cartegory-right-content-item').forEach(function(product) {
            if (product.getAttribute('data-brand-id') === brandId) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
});



// Hàm để thêm sản phẩm vào giỏ hàng
function addToCart(product) {
    // Kiểm tra dữ liệu sản phẩm truyền vào
    if (!product.product_name || !product.product_img || isNaN(product.product_sale)) {
        console.error("Dữ liệu sản phẩm không hợp lệ:", product);
        alert("Sản phẩm không hợp lệ.");
        return;
    }

    // Lấy giỏ hàng từ localStorage hoặc tạo mảng mới nếu chưa có
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    const existingProduct = cart.find(item => item.product_name === product.product_name);
    if (existingProduct) {
        existingProduct.quantity += 1; // Tăng số lượng nếu đã có
    } else {
        product.quantity = 1; // Đặt số lượng ban đầu là 1
        cart.push(product); // Thêm sản phẩm mới vào giỏ hàng
    }

    // Lưu lại giỏ hàng vào localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    alert(`${product.product_name} đã được thêm vào giỏ hàng!`);
}




// Hàm để hiển thị giỏ hàng trong giao diện

// function displayCart() {
//     const cartContainer = document.querySelector(".cart-content-left table");
//     const cart = JSON.parse(localStorage.getItem('cart')) || [];
//     cartContainer.innerHTML = `
//         <tr>
//             <th>Sản phẩm</th>
//             <th>Tên sản phẩm</th>
//             <th>Số lượng</th>
//             <th>Thành tiền</th>
//             <th>Xóa</th>
//         </tr>
//     `;
    
//     cart.forEach(item => {
//         const row = document.createElement('tr');
//         row.innerHTML = `
//             <td><img src="admin/uploads/${item.product_img}" alt="${item.product_name}"></td>
//             <td><p>${item.product_name}</p></td>
//             <td><input type="number" value="${item.quantity}" min="1" onchange="updateQuantity('${item.product_name}', this.value)"></td>
//             <td><p>${(item.product_sale * item.quantity).toLocaleString()}<sup>đ</sup></p></td>
//             <td><span onclick="removeFromCart('${item.product_name}')">X</span></td>
//         `;
//         cartContainer.appendChild(row);
//     });

//     // Hiển thị tổng tiền
//     const total = cart.reduce((sum, item) => sum + item.product_sale * item.quantity, 0);
//     document.querySelector(".cart-content-right table").innerHTML = `
//         <tr><th colspan="2">Tổng tiền giỏ hàng</th></tr>
//         <tr><td>TỔNG SẢN PHẨM</td><td>${cart.length}</td></tr>
//         <tr><td>TỔNG TIỀN HÀNG</td><td>${total.toLocaleString()}<sup>đ</sup></td></tr>
//     `;
// }

// Hiển thị giỏ hàng
function displayCart() {
    const cartContainer = document.querySelector(".cart-content-left table");
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cartContainer.innerHTML = `
        <tr>
            <th>Sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
        </tr>
    `;
    
    cart.forEach(item => {
        // Kiểm tra nếu thiếu thông tin--> bỏ qua ko hiển thị
        if (!item.product_name || isNaN(parseInt(item.product_sale)) || !item.product_img) {
            return; 
        }

        const row = document.createElement('tr');
        const productTotal = parseInt(item.product_sale) * item.quantity;
        
        row.innerHTML = `
            <td><img src="admin/uploads/${item.product_img || 'default.jpg'}" alt="${item.product_name}"></td>
            <td><p>${item.product_name}</p></td>
            <td><input type="number" value="${item.quantity}" min="1" onchange="updateQuantity('${item.product_name}', this.value)"></td>
            <td><p>${productTotal.toLocaleString()}<sup>đ</sup></p></td>
            <td><span onclick="removeFromCart('${item.product_name}')">X</span></td>
        `;
        cartContainer.appendChild(row);
    });


    const total = cart.reduce((sum, item) => sum + (parseInt(item.product_sale) * item.quantity || 0), 0);
    document.querySelector(".cart-content-right table").innerHTML = `
        <tr><th colspan="2">Tổng tiền giỏ hàng</th></tr>
        <tr><td>TỔNG SẢN PHẨM</td><td>${cart.length}</td></tr>
        <tr><td>TỔNG TIỀN HÀNG</td><td>${total.toLocaleString()}<sup>đ</sup></td></tr>
    `;
}


//Cập nhật số lượng sản phẩm
function updateQuantity(productName, quantity) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const product = cart.find(item => item.product_name === productName);
    if (product) {
        product.quantity = parseInt(quantity);
        localStorage.setItem('cart', JSON.stringify(cart));
        displayCart();
    }
}

//Xóa sản phẩm khỏi giỏ hàng
function removeFromCart(productName) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.product_name !== productName);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
}


// //Xác nhận order Admin
// function confirmCart() {
//     const cart = JSON.parse(localStorage.getItem('cart')) || [];
//     if (cart.length === 0) {
//         alert("Giỏ hàng của bạn trống!");
//         return;
//     }

//     // Chuyển đổi dữ liệu sang định dạng JSON
//     const cartData = JSON.stringify(cart);

//     // Tạo một form ẩn để gửi dữ liệu sang order.php
//     const form = document.createElement('form');
//     form.method = 'POST';
//     form.action = 'admin/order.php';

//     // Tạo input ẩn để chứa dữ liệu
//     const input = document.createElement('input');
//     input.type = 'hidden';
//     input.name = 'cartData';
//     input.value = cartData;

//     form.appendChild(input);
//     document.body.appendChild(form);

//     // Gửi form
//     form.submit();
// }

function confirmCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length === 0) {
        alert("Giỏ hàng của bạn trống!");
        return;
    }

    // Chuyển đổi dữ liệu giỏ hàng thành JSON
    const cartData = JSON.stringify(cart);

    // Tạo một form ẩn để gửi dữ liệu sang order.php
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'admin/order.php';

    // Tạo input ẩn chứa dữ liệu giỏ hàng
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'cartData';
    input.value = cartData;

    form.appendChild(input);
    document.body.appendChild(form);

    // Gửi form
    form.submit();

    // Xóa giỏ hàng sau khi gửi
    localStorage.removeItem('cart');
}



