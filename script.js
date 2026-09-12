const celebrateBtn = document.getElementById("celebrateBtn");

celebrateBtn.addEventListener("click", function () {


document.querySelector(".hero-content h1").innerHTML =
    "🎄 Let the Christmas Magic Begin! ✨";

celebrateBtn.innerHTML = "Merry Christmas! ❤️🎅";

createSnowBurst();

});

function createSnowBurst() {


for (let i = 0; i < 40; i++) {

    const snow = document.createElement("div");

    snow.innerHTML = "❄️";

    snow.style.position = "fixed";
    snow.style.left = Math.random() * 100 + "vw";
    snow.style.top = Math.random() * 100 + "vh";
    snow.style.fontSize = Math.random() * 20 + 15 + "px";
    snow.style.zIndex = "200";

    document.body.appendChild(snow);

    setTimeout(() => {
        snow.remove();
    }, 2500);

}

}
