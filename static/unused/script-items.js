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
]

const itemsEl = document.querySelector(".items")

renderItems()

function renderItems() {
    ITEMS.forEach((item) => {
        const itemEl = document.createElement('div')
        itemEl.classList.add('item')
        itemEl.innerHTML = `
            <img src="${item.image}" alt="" />
            <button>Add to Cart</button>
        `
        itemsEl.appendChild(itemEl)
    })
}


