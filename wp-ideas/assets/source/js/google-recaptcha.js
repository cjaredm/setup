//--------------------------------------------------------------
// GOOGLE RECAPTCHA
//--------------------------------------------------------------

const siteKey = '6Lcu19EUAAAAAGFG7E5B_c2yMBGP1PsbF2Rmm_G0';

const captchaField = document.querySelector('#g-recaptcha-response');

if (captchaField) {
	grecaptcha.ready(function() {
		grecaptcha.execute(`${siteKey}`, { action: 'homepage' }).then(function(token) {
			captchaField.value = token;
		});
	});
}
