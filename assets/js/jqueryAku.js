function transition() {
    $(".transition").toggleClass("anim-trans");
};

$("#antrian").hide();

$(document).ready(function () {
    var isZeuss = false;
    var $zeus = $('#infoKesehatan');
    var $zeuss = $('#antrian');

    $zeuss.hide();

    setInterval(transition, 5000);

    setInterval(function () {
        var coba = (isZeuss) ? $zeuss : $zeus;
        var $fadeOutBanner = (isZeuss) ? $zeuss : $zeus;
        var $fadeInBanner = (isZeuss) ? $zeus : $zeuss;

        // transition();
        $fadeOutBanner.fadeOut(5000, function () {
            $fadeInBanner.fadeIn(4000);
            isZeuss = !isZeuss;
        });
    }, 5000);
});