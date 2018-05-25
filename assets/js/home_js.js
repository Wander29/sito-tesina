window.sr = ScrollReveal();
    if(window.innerWidth > 700)
    {
        sr.reveal('.btn-home', {
            duration: 2000,
            origin: 'right',
            distance: '400px'
        });

        sr.reveal('#main-title', {
            duration: 2000,
            origin: 'top',
            delay: 100
        });

        sr.reveal('.header-content p', {
            duration: 2000,
            origin: 'left',
            delay: 500,
            distance: '500px'
        });
    }

    $(document).ready(function(){
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html, body').animate({
                  scrollTop: target.offset().top
                }, 1000);
              }
            }
        });
        $('#btn-log').click(function(){
            $('#login-tab').css({'visibility' : 'visible'});
            $('#start-tab').toggleClass('hide-tab');
            $('#login-tab').toggleClass('hide-tab');
            sr.reveal('#login-tab', {
                duration: 1000,
                origin: 'top',
                distance: '50px'
            });
            $('#wrap-login').css({'opacity' : 0.7});
        })
    });

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var options = {
        'html'          : true
    }
    var instances = M.Tooltip.init(elems, options);
});