// input fields
const user_name = $("#name");
const email = $("#email");
const password = $("#password");
const confirmPassword = $("#confirmPassword");

// Document is ready`
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
	if (user_name.val().length == 0) {
		user_name.addClass("is-invalid");
		nameError = false;
	} else {
		user_name.removeClass("is-invalid");
		nameError = true;
	}
}

// Validate Email
function validateEmail() {
	let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
	let s = email.val();
	if (regex.test(s)) {
		email.removeClass("is-invalid");
		emailError = true;
	} else {
		email.addClass("is-invalid");
		emailError = false;
	}
}

// Validate Password
let passwordError = true;

function validatePassword() {
	if (password.val().length <= 3) {
		password.addClass("is-invalid");
		passwordError = false;
	} else {
		password.removeClass("is-invalid");
		passwordError = true;
	}
}

// Validate Confirm Password
let confirmPasswordError = true;

function validateConfirmPassword() {
	let passwordValue = $("#password").val();
	if (passwordValue != confirmPassword.val()) {
		confirmPassword.addClass("is-invalid");
		confirmPasswordError = false;
	} else {
		confirmPassword.removeClass("is-invalid");
		confirmPasswordError = true;
	}
}
