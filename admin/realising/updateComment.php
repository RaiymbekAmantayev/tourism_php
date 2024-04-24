<?php
$user = "root";
$password = "";
$host = "localhost";
$db = "tourism";
$dbn = "mysql:host=".$host.';dbname='.$db.';charset=utf8';
$pdo = new PDO($dbn, $user, $password);
$pdo->exec("USE $db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $text = isset($_POST["text"]) ? $_POST["text"] : "";


    $updateService = $pdo->prepare("UPDATE comments SET text = :text, archive = 1, changed = 1  WHERE id = :id");
    $updateService->execute([
        ':text' => $text,
        ':id' => $id
    ]);
    header("Location: /admin/comment_view.php");
    exit();
}
?>