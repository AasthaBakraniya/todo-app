const API = "http://localhost/todo-app/api.php";

// Escape single quotes for safe HTML insertion
function escapeQuotes(str) {
  return str.replace(/'/g, "\\'");
}

// Load all tasks and render table rows
async function loadTasks() {
  const res = await fetch(API);
  const tasks = await res.json();

  const table = document.getElementById("taskTable");
  table.innerHTML = "";

  tasks.forEach((task) => {
    let row = `
      <tr>
        <td>${task.title}</td>
        <td>${task.start_date || ""}</td>
        <td>${task.end_date || ""}</td>
        <td>
          <button class="btn btn-warning btn-sm me-2" onclick="editTask(${task.id}, '${escapeQuotes(task.title)}', '${task.start_date}', '${task.end_date}')">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteTask(${task.id})">X</button>
        </td>
      </tr>
    `;
    table.innerHTML += row;
  });
}

// Add a new task
async function addTask() {
  const title = document.getElementById("title").value.trim();
  const start = document.getElementById("start_date").value;
  const end = document.getElementById("end_date").value;

  if (!title) {
    alert("Task title cannot be empty!");
    return;
  }

  await fetch(API, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ title, start_date: start, end_date: end }),
  });

  // Clear input fields after adding
  document.getElementById("title").value = "";
  document.getElementById("start_date").value = "";
  document.getElementById("end_date").value = "";

  loadTasks();
}

// Edit a task using prompt dialogs
async function editTask(id, oldTitle, oldStart, oldEnd) {
  const title = prompt("Edit task title:", oldTitle);
  if (title === null || title.trim() === "") return; // Cancel or empty input

  const start_date = prompt("Edit start date (YYYY-MM-DD):", oldStart);
  if (start_date === null) return;

  const end_date = prompt("Edit end date (YYYY-MM-DD):", oldEnd);
  if (end_date === null) return;

  await fetch(API, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id, title, start_date, end_date }),
  });

  loadTasks();
}

// Delete a task by ID
async function deleteTask(id) {
  if (!confirm("Are you sure you want to delete this task?")) return;

  await fetch(`${API}?id=${id}`, { method: "DELETE" });
  loadTasks();
}

// Load tasks when page loads
loadTasks();
