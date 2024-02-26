
$(document).ready(function() {
    // Check if mode preference is stored in localStorage
    var mode = localStorage.getItem("mode");

    // Set initial mode based on stored preference or default to dark mode
    if (mode === "light") {
        $("link[rel='stylesheet']").attr("href", "css/lightregister.css");
        $(".change").text("OFF");
    } else {
        $("link[rel='stylesheet']").attr("href", "css/register.css");
        $(".change").text("ON");
    }

    // Toggle mode when the switch is clicked
    $(".change").on("click", function() {
        if ($(this).text() === "ON") {
            $(this).text("OFF");
            $("link[rel='stylesheet']").attr("href", "css/lightregister.css");
            // Store mode preference in localStorage
            localStorage.setItem("mode", "light");
        } else {
            $(this).text("ON");
            $("link[rel='stylesheet']").attr("href", "css/register.css");
            // Store mode preference in localStorage
            localStorage.setItem("mode", "dark");
        }
    });
});
