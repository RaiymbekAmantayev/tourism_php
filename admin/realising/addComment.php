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

    $tourId = isset($_POST["tour_id"]) ? $_POST["tour_id"] : "";
    $userId = $user['id'];
    $text = isset($_POST["text"]) ? $_POST["text"] : "";


    if($userId){
        $query = "INSERT INTO comments (text,tourID, userID) VALUES (:text, :tourId, :userId)";
        $statement = $pdo->prepare($query);

        $params = [
            "text" => $text,
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
        exit();;
    }

}
?>