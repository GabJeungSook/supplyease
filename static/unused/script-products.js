// document.addEventListener('DOMContentLoaded', () => {
//     const addToCartBtns = document.querySelectorAll('.add-to-cart-btn')

//     addToCartBtns.forEach(btn =>(
//         btn.addEventListener('click', () =>(
//             const productCard = btn.closest('.product-card')
//             const productId = productCard.dataset.productId;

//             // Perform the necessary actions, such as adding the product to the cart
//             console.log(`Product ID ${productId} added to cart.`)
//         }
//     )
//     })
// }




// document.addEventListener('DOMContentLoaded', () => {
//     const productTemplate = document.querySelector('.product-template');
//     const productList = document.querySelector('.items');

//     // Product data
//     const products = [
//         { id: 1, name: 'Product 1', price: 'PHP 30.00', description: 'Spring Notebook, 40 leaves, color pink.', stars: 2 },
//         { id: 2, name: 'Product 2', price: 'PHP 40.00', description: 'Spring Notebook, 40 leaves, color blue.', stars: 3 }
//     ];

//     // Generate HTML for each product
//     products.forEach(product => {
//         const productClone = productTemplate.cloneNode(true);
//         productClone.querySelector('.product-card').setAttribute('data-product-id', product.id);
//         productClone.querySelector('.namePrice h4').textContent = product.name;
//         productClone.querySelector('.namePrice span').textContent = product.price;
//         productClone.querySelector('p').textContent = product.description;
//         productClone.querySelector('.stars i').textContent = '*'.repeat(product.stars);
//         productList.appendChild(productClone);
//     });

//     // Remove the template from the DOM
//     productTemplate.remove();

//     // Add click event listener to the "Add to Cart" buttons
//     const addToCartBtns = document.querySelectorAll('.add-to-cart-btn');

//     addToCartBtns.forEach(btn => {
//         btn.addEventListener('click', () => {
//             const productCard = btn.closest('.product-card');
//             const productId = productCard.dataset.productId;

//             // Perform the necessary actions, such as adding the product to the cart
//             console.log(`Product ID ${productId} added to cart.`);
//         });
//     });
// });





const productTemplate = document.querySelector('.product-template');
const productList = document.querySelector('.product-lists');

// Product data
const products = [
    { name: 'Product 1', price: 'PHP 30.00', description: 'Spring Notebook, 40 leaves, color pink.', stars: 2 },
    { name: 'Product 2', price: 'PHP 40.00', description: 'Spring Notebook, 40 leaves, color blue.', stars: 3 }
];

// Generate HTML for each product
products.forEach(product => { 
    const productClone = productTemplate.cloneNode(true); 
    productClone.querySelector('.namePrice h4').textContent = product.name; 
    productClone.querySelector('.namePrice span').textContent = product.price; 
    productClone.querySelector('p').textContent = product.description; 
    productClone.querySelector('.stars i').textContent = '*'.repeat(product.stars); 
    productList.appendChild(productClone); 
});

// Remove the template from the DOM 
productTemplate.remove();