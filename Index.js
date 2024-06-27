$(document).ready(function(){
    $('#loginForm').submit(function(event){
        event.preventDefault();
        
        var username = $('#username').val();
        var password = $('#password').val();
        
        $.ajax({
            type: 'POST',
            url: '/login.php',
            data: {
                username: username,
                password: password
            },
            success: function(response){
                if (response.success) {
                    // Redirigir si la autenticación es exitosa
                    window.location.href = '/Frontend/Pages/HomePage.html';
                } else {
                    // Mostrar mensaje de error si la autenticación falla
                    $('#message').text(response.errorMsg).css('color', 'red');
                }
            }
        });
    });
});