<?php
$user = "root";
$password = "";
$host = "localhost";
$db = "tourism";
$dbn = "mysql:host=".$host.';dbname='.$db.';charset=utf8';
$pdo = new PDO($dbn, $user, $password);
$pdo->exec("USE $db");

// Обработка нажатия кнопки удаления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['del'])) {
        // Получение ID записи, которую нужно удалить
        $id = $_POST['id'];
        // SQL-запрос на удаление записи из таблицы
        $sql = "DELETE FROM response WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        // После удаления перенаправьте пользователя или выполните другие действия
        header("Location: /practice.php");
        exit();
    }
}
?>