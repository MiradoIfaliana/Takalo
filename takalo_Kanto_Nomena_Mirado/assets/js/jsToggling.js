// switch theme 
// import Swup from './dist/swup.min.js';
function onThemeChange() {
    let cssStyleSheet = document.getElementById("mainStyle");
    let path = (cssStyleSheet.href).substring((cssStyleSheet.href).length-9, (cssStyleSheet.href).length);
    if(path === "style.css") {
        cssStyleSheet.href = "assets/css/style_dark.css";
        document.getElementById("header_logo").src = "assets/image/menu-image5.jpg";
        document.getElementById("theme_icon").className = "fas fa-sun";
    } else {
        cssStyleSheet.href = "assets/css/style.css";
        document.getElementById("header_logo").src = "assets/image/menu-image1.jpg";
        document.getElementById("theme_icon").className = "fas fa-moon";
    }
}

