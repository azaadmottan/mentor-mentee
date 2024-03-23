
// document.querySelector("form").addEventListener("submit", function (event) {
//     event.preventDefault();
// });

let btn = document.getElementById("topBtn");

const topFunction = () => {
    document.documentElement.scrollTop = 0;
}

window.onscroll = function () {

    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 60) {
        btn.style.display = "block";
    }
    else {
        btn.style.display = "none";
    }
}

const typedTextSpan = document.querySelector(".typed-text");
const cursorSpan = document.querySelector(".cursor");

const textArray = ["Engineering", "Computer Application", "Hotel Management", "Management and Commerce", "Agriculture", "Diploma", "Pharmacy", "Degree College", "College of Education", "Applied Sciences"];
const typingDelay = 100;
const erasingDelay = 100;
const newTextDelay = 800;                           // Delay between current and next text

let textArrayIndex = 0;
let charIndex = 0;

function type() {
    if (charIndex < textArray[textArrayIndex].length) {

        if (!cursorSpan.classList.contains("typing"))
        {
            cursorSpan.classList.add("typing");
        }   
        typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
        charIndex++;
        setTimeout(type, typingDelay);
    } 
    else {

        cursorSpan.classList.remove("typing");
        setTimeout(erase, newTextDelay);
    }
}

function erase() {
    if (charIndex > 0) {
        if (!cursorSpan.classList.contains("typing"))
            cursorSpan.classList.add("typing");
            typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex - 1);

        charIndex--;
        setTimeout(erase, erasingDelay);
    } 
    else {
        cursorSpan.classList.remove("typing");
        textArrayIndex++;
        if (textArrayIndex >= textArray.length) textArrayIndex = 0;
        setTimeout(type, typingDelay + 1100);
    }
}


document.addEventListener("DOMContentLoaded", function () {
    // On DOM Load initiate the effect
    if (textArray.length) setTimeout(type, newTextDelay + 250);
});
