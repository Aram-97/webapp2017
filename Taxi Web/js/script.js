$(document).ready(function () {
    // Add smooth scrolling to all links
    $("a").on('click', function (event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll    
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        }
    });
});


$(document).ready(function(){
    // Activate Carousel
    $("#slide-wrap").carousel();
    
    // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#slide-wrap").carousel(0);
        
    });
    $(".item2").click(function(){
        $("#slide-wrap").carousel(1);
    });
    $(".item3").click(function(){
        $("#slide-wrap").carousel(2);
    });
   
    
    // Enable Carousel Controls
    $(".left").click(function(){
        $("#slide-wrap").carousel("prev");
    });
    $(".right").click(function(){
        $("#slide-wrap").carousel("next");
    });
});


$('.flip').hover(function () {
    $(this).find('.card').toggleClass('flipped');

});
