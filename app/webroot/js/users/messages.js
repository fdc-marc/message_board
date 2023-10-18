const BASE_IMG_URL = window.location.origin + "/message_board/img";

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

		if (!reply_data.content) {
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

	// search conversation
	var search_timeout = null;
	$("#searchConversation").on("keyup", function () {
		const user_id = $("#index_user_id").val();
		clearTimeout(search_timeout);

		search_timeout = setTimeout(function () {
			var query = $("#searchConversation").val();
			$.ajax({
				url: `${window.location.origin}/message_board/messages/search_conversation`,
				type: "POST",
				data: { query: query },
				success: function (conversations) {
					conversations = JSON.parse(conversations);
					$(".conversation-section").empty();

					$.each(conversations, (i, conversation) => {
						const message = conversation.Message[0];
						const msg_img = message.user.photo
							? `${BASE_IMG_URL}/profile-photos/${message.user.photo}`
							: `${BASE_IMG_URL}/empty-image.jpeg`;

						if (message.user_id == user_id) {
							const senderContainer = `
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
												<button class="btn btn-info btn-sm filterViewBtn" data-convo-id="${conversation.Conversation.id}">View</button>
													<button class="btn btn-danger btn-sm deleteMessageBtn" data-message-id="${message.id}">Delete</button>
												</div>
												<div class="col-6 d-flex justify-content-end align-items-center">
													${message.time_sent}
												</div>
											</div>
										</div>
									</div>
									<div class="col-1 px-0">
									<img class="convo-img" src="${msg_img}">
								</div>
								</div>
							</div>`;
							$(".conversation-section").append(senderContainer);
						} else {
							const receiverContainer = `
							<div class="convo-container">
								<div class="row">
								<div class="col-1 px-0">
								<img class="convo-img" src="${msg_img}">
								</div>
									<div class="col-11">
										<div class="row convo-content p-3">
											<div class="col-12 d-flex align-items-center">
												<p class="text-truncate mb-0">${message.content}</p>
											</div>
										</div>
										<div class="row convo-footer px-3">
											<div class="col-12 d-flex justify-content-end">
												<div class="col-6 d-flex justify-content-start align-items-center">
												<button class="btn btn-info btn-sm filterViewBtn" data-convo-id="${conversation.Conversation.id}">View</button>
													<button class="btn btn-danger btn-sm deleteMessageBtn" data-message-id="${message.id}">Delete</button>
												</div>
												<div class="col-6 d-flex justify-content-end align-items-center">
													${message.time_sent}
												</div>
											</div>
										</div>
									</div>

								
								</div>
							</div>`;
							$(".conversation-section").append(receiverContainer);
						}
					});
				},
			});
		}, 1000);
	});

	// filtered conversations view button
	$(".conversation-section").on("click", ".filterViewBtn", function () {
		const convo_id = $(this).data("convo-id");

		window.location.assign(
			`${window.location.origin}/message_board/messages/view/${convo_id}`
		);
	});

	// search message
	$("#searchMessage").on("keyup", function () {
		const convo_id = $(this).data("convo-id");
		const user_id = $("#view_user_id").val();
		clearTimeout(search_timeout);

		search_timeout = setTimeout(function () {
			var query = $("#searchMessage").val();
			$.ajax({
				url: `${window.location.origin}/message_board/messages/search_message`,
				type: "POST",
				data: { query: query, convo_id: convo_id },
				success: function (messages) {
					messages = JSON.parse(messages);

					$(".messages-section").empty();

					$.each(messages, (i, message) => {
						const msg = message.Message;
						const user = message.User;
						const msg_img = user.photo
							? `${BASE_IMG_URL}/profile-photos/${user.photo}`
							: `${BASE_IMG_URL}/empty-image.jpeg`;

						console.log(msg);
						console.log(user_id);
						if (msg.user_id == user_id) {
							const senderContainer = `
								<div class="convo-container">
									<div class="row">
	
										<div class="col-11">
											<div class="row convo-content p-3">
												<div class="col-12 d-flex align-items-center">
													<p class="text-truncate mb-0">${msg.content}</p>
												</div>
											</div>
											<div class="row convo-footer px-3">
												<div class="col-12 d-flex justify-content-end">
													<div class="col-6 d-flex justify-content-start align-items-center">
													
														<button class="btn btn-danger btn-sm deleteMessageBtn" data-message-id="${msg.id}">Delete</button>
													</div>
													<div class="col-6 d-flex justify-content-end align-items-center">
														${msg.time_sent}
													</div>
												</div>
											</div>
										</div>
										<div class="col-1 px-0">
										<img class="convo-img" src="${msg_img}">
									</div>
									</div>
								</div>`;
							$(".messages-section").append(senderContainer);
						} else {
							const receiverContainer = `
								<div class="convo-container">
									<div class="row">
									<div class="col-1 px-0">
									<img class="convo-img" src="${msg_img}">
									</div>
										<div class="col-11">
											<div class="row convo-content p-3">
												<div class="col-12 d-flex align-items-center">
													<p class="text-truncate mb-0">${msg.content}</p>
												</div>
											</div>
											<div class="row convo-footer px-3">
												<div class="col-12 d-flex justify-content-end">
													<div class="col-6 d-flex justify-content-start align-items-center">
														<button class="btn btn-danger btn-sm deleteMessageBtn" data-message-id="${msg.id}">Delete</button>
													</div>
													<div class="col-6 d-flex justify-content-end align-items-center">
														${msg.time_sent}
													</div>
												</div>
											</div>
										</div>
	
									
									</div>
								</div>`;
							$(".messages-section").append(receiverContainer);
						}
					});
				},
			});
		}, 1000);
	});
});

// helper functions

function formatUsers(user) {
	const default_image = `${BASE_IMG_URL}/empty-image.jpeg`;

	var user_select;

	if (!user.photo) {
		user_select = $(
			`<span><img src="${default_image}" class="dropdown-img" /> ${user.text}</span>`
		);
	} else {
		user_select = $(
			`<span><img src="${BASE_IMG_URL}/profile-photos/${user.photo}" class="dropdown-img /> ${user.text}</span>`
		);
	}

	return user_select;
}
