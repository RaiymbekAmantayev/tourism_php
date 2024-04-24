<?php
$user = "root";
$password = "";
$host = "localhost";
$db = "tourism";
$dbn = "mysql:host=".$host.';dbname='.$db.';charset=utf8';
$pdo = new PDO($dbn, $user, $password);
$pdo->exec("USE $db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $login = $_SESSION['login'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->execute([':login' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $tourId = isset($_POST["response_id"]) ? $_POST["response_id"] : "";
    $userId = $user['id'];
    $checkResponseQuery = "SELECT * FROM response WHERE userID = :userId AND tourID = :tourId";
    $checkResponseStmt = $pdo->prepare($checkResponseQuery);
    $checkResponseStmt->execute([':userId' => $userId, ':tourId' => $tourId]);
    $existingResponse = $checkResponseStmt->fetch(PDO::FETCH_ASSOC);


    if($userId && !$existingResponse){
        $query = "INSERT INTO response (tourID, userID) VALUES (:tourId, :userId)";
        $statement = $pdo->prepare($query);

        $params = [
            "userId" => $userId,
            "tourId" => $tourId,
        ];
        $statement->execute($params);

        // Перенаправляем после вставки данных
        header("Location: /practice.php");
        exit();
    }
    else{
        header("Location: /practice.php");
        exit();
    }

}
?>