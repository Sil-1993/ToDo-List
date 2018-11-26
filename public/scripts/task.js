$(document).ready(()=> {
	$('#add-task form').on('submit', (ev) => {
		ev.preventDefault();

		let formInput = new FormData(ev.target);

		$.ajax({
			type: 'POST',
			url: '/task/add',
			data: formInput,
			processData: false,
			contentType: false,
			success: () => {
				window.location.reload();
			}
		});
	});

	$('#edit-task form').on('submit', (ev) => {
		ev.preventDefault();

		let formInput = new FormData(ev.target);

		$.ajax({
			type: 'POST',
			url: '/task/edit',
			data: formInput,
			processData: false,
			contentType: false,
			success: () => {
				window.location.reload();
			}
		});
	});

	$('#remove-selected form').on('submit', (ev) => {
		ev.preventDefault();

		let ids = [];
		document.querySelectorAll('#tasks input[name="task-select[]"]:checked').forEach((el) => {
			ids.push(el.dataset.id);
		});

		$.ajax({
			type: 'POST',
			url: '/task/remove-selected',
			data: {ids: ids},
			success: () => {
				window.location.reload();
			}
		});
	});

	$('#tasks .task-remove').on('click', (ev) => {
		let id = ev.target.dataset.id;

		$.ajax({
			type: 'POST',
			url: '/task/remove',
			data: {id: id},
			success: () => {
				window.location.reload();
			}
		});
	});

	$('#tasks .task-edit').on('click', (ev) => {
		let id = ev.target.dataset.id;

		$.ajax({
			type: 'POST',
			url: '/task/info',
			data: {id: id},
			success: (data) => {
				let parsed = JSON.parse(data);

				$('#edit-id').val(parsed.task_id);
				$('#edit-name').val(parsed.task_name);
				$('#edit-description').text(parsed.task_description);
				$('#edit-date').val(parsed.task_date);
				$('#edit-for-user').val(parsed.task_user);

				$('#edit-task').modal('show');
			}
		});
	});

	$('#tasks .task-completed').on('click', (ev) => {
		let id = ev.target.dataset.id;

		$.ajax({
			type: 'POST',
			url: '/task/completed',
			data: {id: id},
			success: () => {
				window.location.reload();
			}
		});
	});


	let url = 'http://localhost:8080';
	$.ajax({
		url: url,
		method: 'POST',
		data: {endPoint: url}
	}).done((response) => {
		$('#current-time').text(response);
	}); 
});