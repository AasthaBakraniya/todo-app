<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>To-Do List</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="text-center mb-4">To-Do List</h2>

    <!-- ADD TASK FORM -->
    <div class="card p-4 mb-4">
        <div class="mb-3">
            <label class="form-label">Task</label>
            <input type="text" id="title" class="form-control" placeholder="Enter task" />
        </div>
        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" id="start_date" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" id="end_date" class="form-control" />
        </div>
        <button class="btn btn-primary" onclick="addTask()">Add Task</button>
    </div>

    <!-- TASK TABLE -->
    <div class="card p-3 mb-3">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Task</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="taskTable"></tbody>
        </table>
    </div>

</div>

<script src="script.js"></script>

</body>
</html>
