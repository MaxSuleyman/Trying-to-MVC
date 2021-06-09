<?php define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../style/style.css">
    <title>Найти запись</title>
    <meta charset="UTF-8">
</head>

<body>
<center>
    <h1>Найти запись</h1>

    <div>
        <a href="../../index.php" id="link">На главную</a>
        <a href="edit_news.php" id="link">Редактировать запись</a>
        <a href="add_news.php">Добавить запись</a>
    </div>

    <div id="space"></div>

    <div id="container">
        <div id="container_inner">
            <form action="find_news.php" method="POST">

                <p>ID записи</p>
                <input type="text" name="id"><br>

                <button name="find" id="add_button">Найти</button>

            </form>
        </div>
    </div>
    <?php
    // подключение классов
    require_once '../App/Db.php';
    require_once '../App/View/View.php';
    require_once '../App/Controller/ControllerFindNews.php';
    require_once '../App/Connect.php';
    require_once '../App/Model/ArticleModel.php';

    use App\Connect;
    use App\Db;
    use App\Controller\ControllerFindNews;

    $connect = new Connect();
    $db = new Db($connect->connect);
    $view = new \App\View\View();

    /** получение id для функции удаления записи */
    /** запуск метода удаления записи при нажатии на кнопку */
    if (isset($_POST['id']) and !empty($_POST['id'])) {
        try {
            /** установка для id типа данных */
            $id = intval($_POST['id']);
            $controller = new ControllerFindNews($db, $view);
            $controller->findOneArticle($id);
        }catch (Error $error) {
            die("Error =>" . $error->getMessage());
        }
    }


    ?>
</center>
</body>
</html>
