grecaptcha.ready(function() {
    grecaptcha.execute('6LevuuIUAAAAAKxQw3x37Lciz4csaSItqk2g6e82', {
        action: 'login'
    }).then(function(token) {
        var recaptchaResponse = document.getElementById('recaptcha');
        recaptchaResponse.value = token;
    });
});