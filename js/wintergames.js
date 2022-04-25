let slideQR = document.getElementById('infoSlideQR');
let slideRes = document.getElementById('infoSlideRes');

let onder = document.getElementById('evenementInfo');

function slideZijdeQR () {

    slideQR.style.width = "40%";
    slideQR.style.opacity = "100%";

    slideRes.style.width = "0%";
    slideRes.style.opacity = "0%";

    if (window.matchMedia("(max-width: 650px)").matches) {

        slideQR.style.width = "100%";
        slideQR.style.opacity = "100%";

        slideRes.style.width = "0%";
        slideRes.style.opacity = "0%";

    }
}

function slideZijdeRes () {
    slideRes.style.width = "40%";
    slideRes.style.opacity = "100%";

    slideQR.style.width = "0%";
    slideQR.style.opacity = "0%";

    if (window.matchMedia("(max-width: 650px)").matches) {

        slideRes.style.width = "100%";
        slideRes.style.opacity = "100%";

        slideQR.style.width = "0%";
        slideQR.style.opacity = "0%";

    }
}

function infoTerug() {

    slideRes.style.width = "0%";
    slideRes.style.opacity = "0%";

    slideQR.style.width = "0%";
    slideQR.style.opacity = "0%";
}

function naarOnder() {
    onder.scrollIntoView();
}

// document.getElementById("inloggen").addEventListener("click", on);

function on(){
    document.getElementById("overlay").style.display = "flex";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}
