            var image = document.getElementById("image");
            var currentPos = 0;
            var currentPos2 = 0;
            var currentPos3 = 0;
            var images = ["/img/dance/armin.png", "/img/dance/hardwell.jpg", "/img/dance/nicky.jpg"];
            var images2 = ["./img/gare.jpg", "./img/nordanians.jpg", "./img/soul.jpeg"];
            var images3 = ["./img/dance/armin.png", "./img/dance/tiesto.jpeg", "./img/dance/afrojack.jpg"];

            function volgendefoto() {
                if (++currentPos >= images.length)
                    currentPos = 0;

                image.src = images[currentPos];
                image3.src = images[currentPos];
            }

            function volgendefoto2() {
                if (++currentPos2 >= images2.length)
                    currentPos2 = 0;

                image2.src = images2[currentPos2];
            }

            function volgendefoto3() {
                if (++currentPos3 >= images3.length)
                    currentPos3 = 0;

                image3.src = images3[currentPos3];
            }

            setInterval(volgendefoto, 5000);
            setInterval(volgendefoto2, 5000);
            setInterval(volgendefoto3, 5000);


// Get the modal
var modal = document.getElementsByClassName('modal');

// Get the button that opens the modal
var btn = document.getElementsByClassName("myBtn");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close");

// When the user clicks the button, open the modal
btn[0].onclick = function() {
    modal[0].style.display = "block";
}

btn[1].onclick = function() {
    modal[1].style.display = "block";
}

btn[2].onclick = function() {
    modal[2].style.display = "block";
}

btn[3].onclick = function() {
    modal[3].style.display = "block";
}

btn[4].onc5lick = function() {
    modal[4].style.display = "block";
}

btn[5].onclick = function() {
    modal[5].style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span[0].onclick = function() {
    modal[0].style.display = "none";
}

span[1].onclick = function() {
    modal[1].style.display = "none";
}

span[2].onclick = function() {
    modal[2].style.display = "none";
}

span[3].onclick = function() {
    modal[3].style.display = "none";
}

span[4].onclick = function() {
    modal[4].style.display = "none";
}

span[5].onclick = function() {
    modal[5].style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
