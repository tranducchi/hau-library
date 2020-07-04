$(document).ready(function (){
    $(".cart.nav-item").click(function(e){
        e.preventDefault()
        $('.show-cart-book').toggleClass('show-cart')
    });
    $(document).on('click', function(){
        $('.show-cart-book').removeClass('show-cart');
    });
    $('.cart.nav-item, .show-cart-book').on('click', function(e){
        e.stopPropagation();
    });
    // get book
})
