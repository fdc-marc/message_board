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

	add_recipient.select2({
		templateResult: formatUsers,
	});

	// delete conversation
	$(".deleteConvoBtn").on("click", function () {
		const conversation_id = $(this).data("convo-id");
		const convo_container = $(this).closest(".convo-container");

		console.log(conversation_id);
		if (!confirm("Are you sure you want to delete conversation?")) return;

		$.ajax({
			url: `${window.location.origin}/message_board/messages/delete_conversation`,
			method: "POST",
			dataType: "json",
			data: { id: conversation_id },
			success: function (result) {
				if (result) {
					convo_container.remove();
				}
			},
		});
	});
});

// helper functions

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
