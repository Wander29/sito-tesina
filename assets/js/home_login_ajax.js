$(document).ready(function() {

    $('#login_ut').submit(function(event) {
        event.preventDefault();
        $(".progress_cont").toggleClass("dn");
        var form = $(this), 
            url = form.attr("action"), 
            type = form.attr("method"),
            data = {};
       
        var formData = { //valori del form inseriti
            'utente'            : $('#utente').val(),
            'psw'               : $('#psw').val()
        };
        
        $.ajax({
			type 		: type, // define the type of HTTP verb we want to use (POST for our form)
			url 		: url, // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true
		})
            .done(function(risp) {
                $(".progress_cont").toggleClass("dn");
                if (risp.login) {
                    window.location.href = "public/strumenti.html";
                } else {
                    M.toast(risp.errore_login, 1000);
                }
            })
			.fail(function(risp) {
                $(".progress_cont").toggleClass("dn");
                M.toast(risp.errore, 1000);
			});
        });
        return false;
    });
