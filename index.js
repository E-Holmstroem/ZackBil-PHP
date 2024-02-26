
$(document).ready(function() {
    // Check if mode preference is stored in localStorage
    var mode = localStorage.getItem("mode");

    // Set initial mode based on stored preference or default to dark mode
    if (mode === "light") {
        $("link[rel='stylesheet']").attr("href", "css/lightindex.css");
        $("img[class='tjänstebild 1']").attr("src", "Bilder/lightköp-bil.png");
        $("img[class='tjänstebild 2']").attr("src", "Bilder/lightköp-däck.png");
        $("img[class='tjänstebild 3']").attr("src", "Bilder/lightsälj-bil.png");
        $("img[class='tjänstebild 4']").attr("src", "Bilder/lightfinans.png");
        $("img[class='tjänstebild 5']").attr("src", "Bilder/lightservice.png");
        $(".change").text("OFF");
    } else {
        $("link[rel='stylesheet']").attr("href", "css/index.css");
        
        $("img[class='tjänstebild 1']").attr("src", "Bilder/köp-bil.jpg");
        $("img[class='tjänstebild 2']").attr("src", "Bilder/köp-däck.jpg");
        $("img[class='tjänstebild 3']").attr("src", "Bilder/sälj-bil.jpg");
        $("img[class='tjänstebild 4']").attr("src", "Bilder/finans.jpg");
        $("img[class='tjänstebild 5']").attr("src", "Bilder/service.jpg");
        $(".change").text("ON");
    }

    // Toggle mode when the switch is clicked
    $(".change").on("click", function() {
        if ($(this).text() === "ON") {
            $(this).text("OFF");
            $("link[rel='stylesheet']").attr("href", "css/lightindex.css");
            $("img[class='tjänstebild 1']").attr("src", "Bilder/lightköp-bil.png");
            $("img[class='tjänstebild 2']").attr("src", "Bilder/lightköp-däck.png");
            $("img[class='tjänstebild 3']").attr("src", "Bilder/lightsälj-bil.png");
            $("img[class='tjänstebild 4']").attr("src", "Bilder/lightfinans.png");
            $("img[class='tjänstebild 5']").attr("src", "Bilder/lightservice.png");
            // Store mode preference in localStorage
            localStorage.setItem("mode", "light");
        } else {
            $(this).text("ON");
            $("link[rel='stylesheet']").attr("href", "css/index.css");
            $("img[class='tjänstebild 1']").attr("src", "Bilder/köp-bil.jpg");
        $("img[class='tjänstebild 2']").attr("src", "Bilder/köp-däck.jpg");
        $("img[class='tjänstebild 3']").attr("src", "Bilder/sälj-bil.jpg");
        $("img[class='tjänstebild 4']").attr("src", "Bilder/finans.jpg");
        $("img[class='tjänstebild 5']").attr("src", "Bilder/service.jpg");
            // Store mode preference in localStorage
            localStorage.setItem("mode", "dark");
        }
    });
});
