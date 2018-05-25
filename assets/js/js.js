var sideActive = true;
var mainContWidth = 0;

$(document).ready(function(){
/* Active Page Navbar */
    var url = window.location.href;
    var activePage = url;
    $('.my-nav-list a').each(function () {
        var linkPage = this.href;
        if (activePage == linkPage) {
            $(this).removeAttr("href").css("cursor","default");
            $(this).parent().addClass("active-nav");
        }
    });
/* Scroll Reveal */
    window.sr = ScrollReveal();
    sr.reveal('.my-nav-list', {
        duration: 700,
        origin: 'top',
        mobile: false
    });
    sr.reveal('h1', {
        duration: 1200,
        distance: '100px',
        origin: 'right',
        mobile: false
    });
    
    mainContWidth = 100 - (25000/(window.innerWidth)); /* Larghezza di '#my-main-container' su cui calcolare la progress bar */
    
    sideMenuFunctions();
    mostraPrBar();
    
    $(window).scroll(function(){
        sideMenuFunctions();
        mostraPrBar();
    });
    $(window).resize(function(){
        progressBar();
    });
        
//Smooth Scrolling
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
    
//TOOLTIPS
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
});

function sideMenuFunctions(){
    var scrollY = document.body.scrollTop;
    if( scrollY >= 60){ openSideMenu(); }
    else{ if(scrollY == 0) { closeSideMenu(); } };
}
    function openSideMenu(){
        if(window.innerWidth > 880)
        {
            document.getElementById('side-menu').style.width = "250px";
            document.getElementById('my-main-container').style.marginTop = "70px";
        }
        sideActive = true; 
    }
    function closeSideMenu(){
        document.getElementById('side-menu').style.width = "0px";
        document.getElementById('my-main-container').style.marginTop = "0px";
        sideActive = false;
    }

function mostraPrBar(){
    if (sideActive === true) { 
            $(".progress-bar").show(600); 
            progressBar(); } 
        else{ $(".progress-bar").hide(200); } 
}
    function progressBar()
    {
        var newScroll = Math.round(document.body.scrollTop);
        var percScroll = ((100/(document.documentElement.scrollHeight - window.innerHeight) * newScroll) * mainContWidth) / 100;
        $("#progBar").css("width", percScroll + "%");
    }

/* BOTTONI */
    $("p.btnName").click(function(){
        $(this).closest('div.btnList').next('div.txtBtnList').toggle(400,"swing").siblings('div.txtBtnList').hide(400,"swing"); /*closest ritorna il primo parente corrispondente all'elemento tra parentesi. Parent restituisce il primo parente. Next il prossimo fratello. Siblings tutti i fratelli*/
        // aggiugne/toglie classe per effetto selezionato
        if ($(this).hasClass('btnSelected')) 
            { $(this).removeClass('btnSelected'); }
        else{ 
                var selected = document.getElementsByClassName('selected')[0];
                if (typeof selected !== 'undefined') { selected.classList.remove('selected'); } //toglie la classe selezionato da un'altro bottone se non ci si clicca 2 volte
                $(this).addClass('btnSelected'); }
    });
    
/*SCROLL UP*/
    // Nascondo l'icona al caricamento della pagina
    $("#scroll-up").hide();
    // Intercetto lo scroll di pagina
    $(window).scroll(function()
    {
        // Se l'evento scroll si verifica, mostro l'icona (invisibile) con effetto dissolvenza
        if ($("#scroll-up").is(":hidden")) 
        {   $("#scroll-up").fadeIn(1000); }
        // Se si verifica il ritorno ad inizio pagina, nascondo l'icona con effetto dissolvenza
         if ($(window).scrollTop() == 0)
        {   $("#scroll-up").fadeOut(400);
            $("#scroll-up").is(":hidden"); }
    });
    // Al click sull'icona, torno ad inizio pagina con movenza fluida
    $("#scroll-up").click(function()
    {   $("html,body").animate({scrollTop: 0}, 500, function(){});
        $("#scroll-up").is(":hidden") });