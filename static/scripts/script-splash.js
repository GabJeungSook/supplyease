var indexValue = 0;
function slideShow(){
    setTimeout(slideShow, 5000);
    var x;
    const images = document.querySelectorAll(".images img");
    for(x = 0; x < images.length; x++) {
        images[x].style.display = "none";
    }
    indexValue++;
    if(indexValue > images.length){indexValue = 1}
    images[indexValue -1].style.display = "block";
}
slideShow();
