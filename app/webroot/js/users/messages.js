// add new message
$(document).ready(function () {
	const add_recipient = $("#add-recipient");
	// select2 add recipient dropdown
	add_recipient.select2({
		placeholder: "Search for a recipient",
	});

	$.ajax({
		url: `${window.location.origin}/message_board/users/get_users`, // users/get_users
		method: "get",
		dataType: "json",
		success: function (users) {
			let users_array = [];

			$.each(users, (i, user) => {
				user = user.User;

				let user_option = {
					id: user.id,
					text: user.name,
					photo: user.photo,
				};

				users_array.push(user_option);

				// add_recipient.append(user_option).trigger("change");
			});

			add_recipient.select2({ data: users_array });
		},
	});

	function formatUsers(user) {
		const base_url = `${window.location.origin}/message_board/img`;
		const default_image = `${base_url}/empty-image.jpeg`;

		var user_select;

		if (!user.photo) {
			user_select = $(
				`<span><img src="${default_image}" class="dropdown-img" /> ${user.text}</span>`
			);
		} else {
			user_select = $(
				`<span><img src="${base_url}/profile-photos/${user.photo}" class="dropdown-img /> ${user.text}</span>`
			);
		}

		return user_select;
	}

	add_recipient.select2({
		templateResult: formatUsers,
	});
});
