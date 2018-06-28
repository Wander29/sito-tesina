$(document).ready(function() {

    $('#login_ut').submit(function(event) {
        event.preventDefault();
        $(".progress_cont").toggleClass("dn");
        var form = $(this), 
            url = form.attr("action"), 
            type = form.attr("method"),
            data = {};
       
        var formData = { //valori del form inseriti
            'ut'            : $('#utente').val(),
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
                console.log(risp)
                $(".progress_cont").toggleClass("dn");
                if (risp.login) {
                    window.location.href = "public/home.html";
                } else {
                    M.toast({
                        html: risp.errore_login,
                        displayLength: 1000
                    })
                }
            })
			.fail(function(risp) {
                console.log(risp)
                $(".progress_cont").toggleClass("dn");
                M.toast({
                        html: risp.errore,
                        displayLength: 1000
                    })
			});
        });
        return false;
    });
