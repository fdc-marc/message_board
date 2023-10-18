$(document).ready(function () {
	//birthdate datepicker

	$("#birthdate").datepicker({
		format: "yyyy-mm-dd",
		changeMonth: true,
		changeYear: true,
	});

	// preview uploaded profile photo
	$("#profile-photo").on("change", function () {
		var input = this;
		var imagePreview = $("#image-preview")[0];

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				imagePreview.src = e.target.result;
			};

			reader.readAsDataURL(input.files[0]);
		}
	});
});
