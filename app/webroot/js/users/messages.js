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
					convo_container.fadeOut(400, () => convo_container.remove());
				}
			},
		});
	});

	// add reply message
	$(".replyMessageBtn").on("click", function () {
		const user_image = $(this).data("msg-img");

		const reply_data = {
			conversation_id: $(this).data("convo-id"),
			user_id: $(this).data("user-id"),
			receiver_id: $(this).data("receiver-id"),
			content: $("#replyMessage").val(),
		};

		if (!content) {
			alert("Please enter a message");
			return;
		}

		$.ajax({
			url: `${window.location.origin}/message_board/messages/add_reply`,
			method: "POST",
			dataType: "json",
			data: reply_data,
			success: function (message) {
				if (message) {
					$("#replyMessage").val("");
					const msgContainer = `
					<div class="convo-container">
						<div class="row">

							<div class="col-11">
								<div class="row convo-content p-3">
									<div class="col-12 d-flex align-items-center">
										<p class="text-truncate mb-0">${message.content}</p>
									</div>
								</div>
								<div class="row convo-footer px-3">
									<div class="col-12 d-flex justify-content-end">
										<div class="col-6 d-flex justify-content-start align-items-center">
											<button class="btn btn-danger btn-sm deleteMessageBtn" data-message-id="${message.id}">Delete</button>
										</div>
										<div class="col-6 d-flex justify-content-end align-items-center">
											${message.time_sent}
										</div>
									</div>
								</div>
							</div>
							<div class="col-1 px-0">
							<img class="convo-img" src="${user_image}">
						</div>
						</div>
					</div>`;

					$(".messages-section").prepend(msgContainer);
				}
			},
		});
	});

	// delete single message
	$(".messages-section").on("click", ".deleteMessageBtn", function () {
		const message_id = $(this).data("message-id");
		const message_container = $(this).closest(".convo-container");

		if (!confirm("Are you sure you want to delete message?")) return;

		$.ajax({
			url: `${window.location.origin}/message_board/messages/delete_message`,
			method: "POST",
			dataType: "json",
			data: { id: message_id },
			success: function (result) {
				if (result) {
					message_container.fadeOut(400, () => message_container.remove());
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
