<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../style/style.css">
        <title>Добавить запись</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <center>
            <h1>Добавить запись</h1>

            <div>
                <a href="../../index.php" id="link">На главную</a>
                <a href="edit_news.php" id="link">Редактировать запись</a>
                <a href="find_news.php" id="link">Найти запись</a>
            </div>

            <div id="space"></div>

            <div id="container">
                <div id="container_inner">
                    <form action="add_news.php" method="POST">

                        <p>Название заголовка</p>
                        <input type="text" name="title"><br>

                        <p>Текст новости</p>
                        <textarea name="text" id="" cols="30" rows="10"></textarea><br>

                        <button name="add" id="add_button">Добавить</button>

                    </form>
                </div>
            </div>
            <?php
            define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
            // подключение классов
            require_once DOCUMENT_ROOT . '/vendor/autoload.php';

            use src\App\Connect;
            use src\App\DbArticle;
            use src\App\Controller\ControllerAddNews;
            use src\App\View\View;

            $connect = new Connect();
            $model = new DbArticle($connect->connect);
            $view = new View();

            /** получение id для функции удаления записи */
            /** запуск метода удаления записи при нажатии на кнопку */
            if (isset($_POST['add']) and !empty($_POST['title']) and !empty($_POST['text'])) {
                try {
                    $title = $_POST['title'];
                    $text = $_POST['text'];
                    $controller = new ControllerAddNews($model, $view);
                    echo $controller->insertArticle($title, $text);
                }catch (Error $error) {
                    die("Error =>" . $error->getMessage());
                }
            }

            ?>
        </center>
    </body>
</html>
