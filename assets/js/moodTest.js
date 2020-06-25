window.addEventListener('load', function () {
    document.getElementById("happyBtn").addEventListener("click", function () {
        document.getElementById("bgMood").style.display = "none";
        document.getElementById("moodTest").style.display = "none";
    });
    document.getElementById("sadBtn").addEventListener("click", function () {
        document.getElementById("moodTest").style.display = "none";
        document.getElementById("listPsycho").style.display = "block";
    });
    document.getElementById("no").addEventListener("click", function () {
        document.getElementById("titleMood").innerText = "Prendre soin de soi";
        document.getElementById("textMood").innerText = "Essayez de vous changer les idées et de prendre du temps pour vous :) !";
        document.getElementById("yes").style.display = "none";
        document.getElementById("no").innerHTML = "<i class=\"far fa-smile-beam\"></i>";
        document.getElementById("no").addEventListener("click", function () {
            document.getElementById("listPsycho").style.display = "none";
            document.getElementById("bgMood").style.display = "none";
        });
    });
})