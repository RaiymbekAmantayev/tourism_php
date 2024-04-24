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
    if (isset($_POST['form_id'])){
        $form_id = $_POST['form_id'];
        if ($form_id === 'del') {
            // Получение ID записи, которую нужно удалить
            $id = $_POST['id'];
            // SQL-запрос на удаление записи из таблицы
            $sql = "DELETE FROM clicks WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);

            // После удаления перенаправьте пользователя или выполните другие действия
            header("Location: /practice.php");
            exit();
        }elseif ($form_id == "archive"){
            $id_leave = $_POST['id'];
            $archive = 0;
            $sql_leave= "UPDATE clicks Set archive = :archive WHERE id = :id";
            $stmt_leave = $pdo->prepare($sql_leave);
            $stmt_leave->execute([
                ':id'=>$id_leave,
                'archive'=>$archive

            ]);
            header("Location: /practice.php");
            exit();
        }
    }

}
?>