document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("downloadBtn")
        .addEventListener("click", function () {
            var element = document.getElementById("elementToPrint");
            console.log(element);
            html2pdf(element, {
                margin: 10,
                filename: "invitation.pdf",
                image: {
                    type: "jpeg",
                    quality: 0.98,
                },
                html2canvas: {
                    scale: 2,
                },
                jsPDF: {
                    unit: "mm",
                    format: "a4",
                    orientation: "portrait",
                },
            }).then(function (pdf) {
                var blob = pdf.output("blob");
                var url = URL.createObjectURL(blob);
                var a = document.createElement("a");
                a.href = url;
                a.download = "invitation.pdf";
                a.click();
                URL.revokeObjectURL(url);
            });
        });
});

(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 1);
    };
    spinner();

    // Initiate the wowjs
    new WOW().init();

    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".sticky-top").css("top", "0px");
        } else {
            $(".sticky-top").css("top", "-100px");
        }
    });

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });
    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>',
        ],
    });

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
        },
    });
})(jQuery);

$("input[name='cin']").on({
    input: function (e) {
        e.target.value = e.target.value.toUpperCase();
    },
});
