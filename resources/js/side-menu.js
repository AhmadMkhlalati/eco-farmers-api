(function () {
    "use strict";

    // Side Menu
    $(".menu-toggle").on("click",function (){
        var sidbar = $(".side-nav");
        var toggel = $(".arrow-menu");
        if(sidbar.attr('class').split(" ").includes("side-nav--simple")){
            sidbar.removeClass("side-nav--simple");
            $("#logo_words").show()
            toggel.css('transform','rotateY(0deg)')

        }
        else{
            sidbar.addClass("side-nav--simple");
            toggel.css('transform','rotateY(176deg)')

            $("#logo_words").hide()

        }
    });
    $(".side-menu").on("click", function () {
        if ($(this).parent().find("ul").length) {
            if ($(this).parent().find("ul").first()[0].offsetParent !== null) {
                $(this)
                    .find(".side-menu__sub-icon")
                    .removeClass("transform rotate-180");
                $(this).removeClass("side-menu--open");
                $(this)
                    .parent()
                    .find("ul")
                    .first()
                    .slideUp(300, function () {
                        $(this).removeClass("side-menu__sub-open");
                    });
            } else {
                $(this)
                    .find(".side-menu__sub-icon")
                    .addClass("transform rotate-180");
                $(this).addClass("side-menu--open");
                $(this)
                    .parent()
                    .find("ul")
                    .first()
                    .slideDown(300, function () {
                        $(this).addClass("side-menu__sub-open");
                    });
            }
        }
    });
})();
