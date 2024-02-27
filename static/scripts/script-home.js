const header = document.querySelector("header");
let menu = document.querySelector("#icon");
const navbar = document.querySelector(".navbar");

let isOpen = false; // To keep track of menu state

menu.onclick = () => {
    isOpen = !isOpen; // Toggle menu state
    if (isOpen) {
        menu.textContent = "X"; // Set the text content to "X" when menu is open
    } else {
        menu.textContent = "="; // Remove the text content when menu is closed
    }
    navbar.classList.toggle("open");
};

// Add an event listener to close the navbar when a list item is clicked
navbar.addEventListener("click", (event) => {
    if (event.target.tagName === "A") { // Check if the clicked element is an anchor tag
        isOpen = false; // Set the menu state to closed
        menu.textContent = "="; // Remove the text content
        navbar.classList.remove("open"); // Close the navbar
    }
});