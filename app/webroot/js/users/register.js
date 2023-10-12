// Document is ready
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

	// Submit button
	$("#registerBtn").click(function () {
		validateName();
		validatePassword();
		validateConfirmPassword();
		validateEmail();
		if (
			nameError == true &&
			passwordError == true &&
			confirmPasswordError == true &&
			emailError == true
		) {
			return true;
		} else {
			return false;
		}
	});
});

// field validate functions

//Validate Name
function validateName() {
	const name = $("#name");

	if (name.val().length == 0) {
		name.addClass("is-invalid");
		nameError = false;
	} else {
		name.removeClass("is-invalid");
		nameError = true;
	}
}
// Validate Email
function validateEmail() {
	const email = $("#email");
	let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
	let s = email.value;
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
	const password = $("#password");

	if (password.val().length < 3) {
		password.addClass("is-invalid");
		passwordError = false;
	} else {
		password.removeClass("is-invalid");
		passwordError = true;
	}
}

// Validate Confirm Password

let confirmPasswordError = true;
$("#conpassword").keyup(function () {
	validateConfirmPassword();
});
function validateConfirmPassword() {
	const confirmPassword = $("#confirmPassword");
	let passwordValue = $("#password").val();
	if (passwordValue != confirmPassword.val()) {
		confirmPassword.addClass("is-invalid");
		confirmPasswordError = false;
	} else {
		confirmPassword.removeClass("is-invalid");
		confirmPasswordError = true;
	}
}
