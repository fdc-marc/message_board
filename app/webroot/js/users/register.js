// register form elements
const user_name = $("#name");
const name_valid = $("#name_valid");
const email = $("#email");
const email_valid = $("#email_valid");
const password = $("#password");
const password_valid = $("#password_valid");
const confirmPassword = $("#confirmPassword");
const confirmpass_valid = $("#confirmpass_valid");

$(document).ready(function () {
	$("#name").on("blur", () => {
		validateName();
	});
	$("#email").on("blur", () => {
		validateEmail();
	});
	$("#password").keyup(function () {
		validatePassword();
	});
	$("#conpassword").keyup(function () {
		validateConfirmPassword();
	});

	// Submit button
	$("#registerBtn").click(function () {
		validateName();
		validatePassword();
		validateConfirmPassword();
		validateEmail();

		let validation_passed =
			nameError == true &&
			passwordError == true &&
			confirmPasswordError == true &&
			emailError == true;

		if (validation_passed) {
			const register_data = {
				name: user_name,
				email: email,
				password: password,
			};

			$.ajax({
				url: "register",
				type: "POST",
				data: register_data,
				dataType: "json",
				success: function (data) {
					console.log("Done");
				},
			});
		} else {
			return false;
		}
	});
});

// field validate functions

//Validate Name
function validateName() {
	if (user_name.val().length < 5 || user_name.val().length > 20) {
		user_name.addClass("is-invalid");
		name_valid.removeClass("invalid-feedback");
		nameError = false;
	} else {
		user_name.removeClass("is-invalid");
		name_valid.addClass("invalid-feedback");
		nameError = true;
	}
}

// Validate Email
function validateEmail() {
	let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
	let s = email.val();
	if (regex.test(s)) {
		email.removeClass("is-invalid");
		email_valid.addClass("invalid-feedback");
		emailError = true;
	} else {
		email.addClass("is-invalid");
		email_valid.removeClass("invalid-feedback");

		emailError = false;
	}
}

// Validate Password
let passwordError = true;

function validatePassword() {
	if (password.val().length <= 3) {
		password.addClass("is-invalid");
		password_valid.removeClass("invalid-feedback");

		passwordError = false;
	} else {
		password.removeClass("is-invalid");
		password_valid.addClass("invalid-feedback");
		passwordError = true;
	}
}

// Validate Confirm Password
let confirmPasswordError = true;

function validateConfirmPassword() {
	let passwordValue = $("#password").val();
	if (passwordValue != confirmPassword.val()) {
		confirmPassword.addClass("is-invalid");
		confirmpass_valid.removeClass("invalid-feedback");
		confirmPasswordError = false;
	} else {
		confirmPassword.removeClass("is-invalid");
		confirmpass_valid.addClass("invalid-feedback");
		confirmPasswordError = true;
	}
}
