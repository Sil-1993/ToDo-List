 <main class="container pt-5">
    <div class="card mb-5">
        <div class="card-header">To Do List</div>
        <div class="card-block p-0">
            <table id="tasks" class="table table-bordered table-sm m-0">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>For</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   	$i = 0;
					if ($tasks->num_rows > 0) {
						while($row = $tasks->fetch_assoc()) {
							?>
							<tr>
		                        <td>
									<div class="custom-control custom-checkbox mr-sm-2">
										<input id="task-<?php echo $row['task_id']; ?>" name="task-select[]" type="checkbox" class="custom-control-input" data-id="<?php echo $row['task_id']; ?>"<?php echo ($row['task_status'] == '1' ? ' disabled' : ''); ?>>
										<label for="task-<?php echo $row['task_id']; ?>" class="custom-control-label">&nbsp;</label>
									</div>
		                        </td>
		                        <td><?php echo $row['task_id']; ?></td>
		                        <td><?php echo $row['task_name']; ?></td>
		                        <td><?php echo $row['task_description']; ?></td>
		                        <td><?php echo date('d-m-Y H:i', strtotime($row['task_date'])); ?></td>
		                        <td><?php echo $row['task_user']; ?></td>
		                        <td><?php echo ($row['task_status'] == '1' ? 'Completed' : 'Pending'); ?></td>
		                        <td>
		                        	 <button type="button" class="btn btn-secondary task-edit" data-id="<?php echo $row['task_id']; ?>"<?php echo ($row['task_status'] == '1' ? ' disabled' : ''); ?>>Edit</button>
		                        	 <button type="button" class="btn btn-danger task-remove" data-id="<?php echo $row['task_id']; ?>"<?php echo ($row['task_status'] == '1' ? ' disabled' : ''); ?>>Remove</button>
		                        	 <button type="button" class="btn btn-success task-completed" data-id="<?php echo $row['task_id']; ?>"<?php echo ($row['task_status'] == '1' ? ' disabled' : ''); ?>>Completed</button>
		                        </td>
		                    </tr>
		                    <?php
		                    if ($row['task_status'] != '1') {
								$i++;
							}
						}
					}
                   ?>
                </tbody>
                <tfoot>
		            <tr>
		                <th colspan="8">
		                    <?php
		                    if ($tasks->num_rows > 0) {
		                    	?><button type="button" class="btn btn-default" data-toggle="modal" data-target="#remove-selected"<?php echo ($i == 0 ? ' disabled' : ''); ?>>Remove selected</button><?php
							}
		                    ?>
		                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add-task">Add task</button>
		                </th>
		            </tr>
		        </tfoot>
            </table>
        </div>
    </div>
    <div>
    	<small>Today its <span id="current-time"><?php echo date('Y-m-d H:i:s'); ?></span></small>
    </div>
</main>


<div id="add-task" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-task-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="add-task-title" class="modal-title">New task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="add-name" class="col-form-label">Name:</label>
						<input id="add-name" name="name" type="text" class="form-control" required maxlength="255">
					</div>
					<div class="form-group">
						<label for="add-description" class="col-form-label">Description:</label>
						<textarea id="add-description" name="description" class="form-control" rows="3" maxlength="500"></textarea>
					</div>
					<div class="form-group">
						<label for="add-date" class="col-form-label">Date:</label>
						<input id="add-date" name="date" class="form-control" type="datetime-local" value="<?php echo date('Y-m-d'); ?>T<?php echo date('H:i'); ?>" required>
					</div>
					<div class="form-group">
						<label for="add-for-user" class="col-form-label">For user:</label>
						<select id="add-for-user" name="for-user" class="form-control" required>
							<option value="Dennis">Dennis</option>
							<option value="Peter">Peter</option>
							<option value="Michelle">Michelle</option>
							<option value="Daan">Daan</option>
							<option value="Esther">Esther</option>
						</select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="edit-task" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-task-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="edit-task-title" class="modal-title">Edit task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="edit-name" class="col-form-label">Name:</label>
						<input id="edit-name" name="name" type="text" class="form-control" required maxlength="255">
					</div>
					<div class="form-group">
						<label for="edit-description" class="col-form-label">Description:</label>
						<textarea id="edit-description" name="description" class="form-control" rows="3" maxlength="500"></textarea>
					</div>
					<div class="form-group">
						<label for="edit-date" class="col-form-label">Date:</label>
						<input id="edit-date" name="date" class="form-control" type="datetime-local" value="<?php echo date('Y-m-d'); ?>T<?php echo date('H:i'); ?>" required>
					</div>
					<div class="form-group">
						<label for="edit-for-user" class="col-form-label">For user:</label>
						<select id="edit-for-user" name="for-user" class="form-control" required>
							<option value="Dennis">Dennis</option>
							<option value="Peter">Peter</option>
							<option value="Michelle">Michelle</option>
							<option value="Daan">Daan</option>
							<option value="Esther">Esther</option>
						</select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<input id="edit-id" name="id" type="hidden" class="form-control" required value="0">
				</form>
			</div>
		</div>
	</div>
</div>

<div id="remove-selected" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-task-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 id="add-task-title" class="modal-title">Remove selected tasks</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<p>Are you sure about removing the selected tasks?</p>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
						<button type="submit" class="btn btn-primary">Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="scripts/task.js"></script>