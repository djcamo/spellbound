$(document).ready( () => {
	const contactForm = $("#contactForm");
	let err;
	contactForm.on("submit", (e) => {
		e.preventDefault();
		let name = $("#name").val();
		let email = $("#email").val();
		let phone = $("#phone").val();
		let message = $("#message").val();
		if (name == "") {
			let parentName = $("#name").parent();
			parentName.addClass('has-error');
			$("#name").attr("placeholder", "Your name...is required");
			err = true;
		}
		if (email == "") {
			let parentEmail = $("#email").parent();
			parentEmail.addClass('has-error');
			$("#email").attr("placeholder", "Your email...is required");
			err = true;
		}
		if (err == true) {
			err = false;
			return false;
		} else {
			let parentName = $("#name").parent();
			parentName.removeClass('has-error');
			let parentEmail = $("#email").parent();
			parentEmail.removeClass('has-error');
		}
		$.ajax({
			type: "POST",
			url: "includes/send_email.php",
			data: {
				name: name,
				email: email,
				phone: phone,
				message: message,
				captcha: grecaptcha.getResponse()
			},
			success: (data) => {
				if (data.indexOf("true") > 0) {
					//console.log("SUCCESS");
					let parentEls = $(".g-recaptcha").parent();
					parentEls.removeClass('has-error');
					$('#alert').fadeIn(200);
				} else {
					//console.log("failed");
					let parentEls = $(".g-recaptcha").parent();
					parentEls.addClass('has-error');
					return false;
				}
			}
		})
	});
});