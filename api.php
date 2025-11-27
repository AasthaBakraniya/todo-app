<?php
include "db.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case "GET":
        $result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        echo json_encode($tasks);
        break;

    case "POST":
        if (!$input) {
            echo json_encode(["error" => "No input received"]);
            exit;
        }

        $title = $input["title"];
        $start = $input["start_date"];
        $end = $input["end_date"];

        $stmt = $conn->prepare("INSERT INTO tasks (title, start_date, end_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $start, $end);
        $stmt->execute();

        echo json_encode(["success" => true]);
        break;

    case "PUT":
        $id = $input["id"];
        $title = $input["title"];
        $start = $input["start_date"];
        $end = $input["end_date"];

        $stmt = $conn->prepare("UPDATE tasks SET title=?, start_date=?, end_date=? WHERE id=?");
        $stmt->bind_param("sssi", $title, $start, $end, $id);
        $stmt->execute();

        echo json_encode(["success" => true]);
        break;

    case "DELETE":
        parse_str($_SERVER["QUERY_STRING"], $params);
        $id = $params["id"];

        $stmt = $conn->prepare("DELETE FROM tasks WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        echo json_encode(["success" => true]);
        break;
}
?>
