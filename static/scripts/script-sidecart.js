const ITEMS = [
    {
        id: 1,
        name: "Binder",
        price: 150,
        image: "static/images/slideshow/t1.jpg",
        qty: 1
    },
    {
        id: 2,
        name: "Ballpens",
        price: 80,
        image: "static/images/slideshow/t2.jpg",
        qty: 1
    },
    {
        id: 3,
        name: "Calculator",
        price: 550,
        image: "static/images/slideshow/t3.jpg",
        qty: 1
    },
    {
        id: 4,
        name: "Highlighters",
        price: 250,
        image: "static/images/slideshow/t4.jpg",
        qty: 1
    },
]


const openBtn = document.getElementById("open_cart_btn")
const cart = document.getElementById("sidecart")
const closeBtn = document.getElementById("close_btn")
const backdrop = document.querySelector(".backdrop")

const itemsEl = document.querySelector(".product-lists")
const cartItems = document.querySelector(".cart_items")
const itemsNum = document.getElementById("items_num")
const subtotalPrice = document.getElementById("subtotal_price")

let cart_data = []

openBtn.addEventListener("click", openCart)
closeBtn.addEventListener("click", closeCart)
backdrop.addEventListener("click", closeCart)

renderItems()
renderCartItems()

function openCart() {
    cart.classList.add("open")
    backdrop.style.display = "block"

    setTimeout(() => {
        backdrop.classList.add("show")
    }, 0)
}

function closeCart() {
    cart.classList.remove("open")
    backdrop.classList.remove("show")

    setTimeout(() => {
        backdrop.style.display = "none"
    }, 500);
}

function addItem(idx, itemId) {
    const foundedItem = cart_data.find(
        item => item.id.toString() === itemId.toString()
    )

    if (foundedItem) {
        increaseQty(itemId)
    } else {
        cart_data.push(ITEMS[idx])
    }

    updateCart()
    openCart() //optional
}

function removeCartItem(itemId) {
    cart_data = cart_data.filter((item) => item.id != itemId)

    updateCart()
}

function increaseQty(itemId) {
    cart_data = cart_data.map((item) =>
        item.id.toString() === itemId.toString()
            ? { ...item, qty: item.qty + 1 }
            : item
    )

    updateCart()
}

function decreaseQty(itemId) {
    cart_data = cart_data.map((item) =>
        item.id.toString() === itemId.toString()
            ? { ...item, qty: item.qty > 1 ? item.qty - 1 : item.qty }
            : item
    )

    updateCart()
}

function calcItemsNum() {
    let itemsCount = 0

    cart_data.forEach((item) => (itemsCount += item.qty))

    itemsNum.innerHTML = itemsCount
}

function calcSubtotalPrice() {
    let subtotal = 0

    cart_data.forEach((item) => (subtotal += item.price * item.qty))

    subtotalPrice.innerText = subtotal
}

// function renderItems() {
//     ITEMS.forEach((item, idx) => {
//         const itemEl = document.createElement('div')
//         itemEl.classList.add('item')
//         itemEl.onclick = () => addItem(idx, item.id)
//         itemEl.innerHTML = `
//             <img src="${item.image}" alt="" />
//             <button>Add to Cart</button>
//         `
//         itemsEl.appendChild(itemEl)
//     })
// }

function renderItems() {
    ITEMS.forEach((item, idx) => {
        const itemEl = document.createElement('div')
        itemEl.classList.add('product-card')
        itemEl.onclick = () => addItem(idx, item.id)
        itemEl.innerHTML = `
            <img src="${item.image}" alt="" />
                <h4>${item.name}</h4>
                    <div>
                        <span>₱${item.price}</span>
                        <button>Add to Cart</button>
                        <!-- <button>+</button> -->
                    </div>
        `
        itemsEl.appendChild(itemEl)
    })
}

function renderCartItems() {
    cartItems.innerHTML = ''
    cart_data.forEach((item) => {
        const cartItem = document.createElement('div')
        cartItem.classList.add('cart_item')
        cartItem.innerHTML = `
            <div class="remove_item" onclick="removeCartItem(${item.id})">
                        <span>&times;</span>
                    </div>
                    <div class="item_img">
                        <img src="${item.image}" alt="">
                    </div>
                    <div class="item_details">
                        <p>${item.name}</p>
                        <strong>₱${item.price}</strong>
                        <div class="qty">
                            <span onclick="decreaseQty(${item.id})">-</span>
                            <strong>${item.qty}</strong>
                            <span onclick="increaseQty(${item.id})">+</span>
                        </div>
                    </div>
        `
        cartItems.appendChild(cartItem)
    })
}

function updateCart() {
    renderCartItems()
    calcItemsNum()
    calcSubtotalPrice()
}

