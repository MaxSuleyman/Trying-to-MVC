<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../style/style.css">
        <title>Новости</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <center>
            <h1>Редактировать запись</h1>

            <div id="space"></div>

            <div>
                <a href="../../index.php" id="link">На главную</a>
                <a href="add_news.php" id="link">Добавить запись</a>
                <a href="find_news.php">Найти запись</a>
            </div>

            <div id="space"></div>

            <!--блок формы редактирования записей-->
            <div id="container">
                <div id="container_inner">
                    <form action="edit_news.php" method="POST">
                        <p>ID записи</p>
                        <input type="text" name="id"><br>

                        <p>Название заголовка</p>
                        <input type="text" name="title"><br>

                        <p>Текст новости</p>
                        <textarea name="text" id="" cols="30" rows="10"></textarea><br>

                        <button name="edit" id="add_button">Редактрировать</button>
                    </form>
                </div>
            </div>

            <?php
            define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
            // подключение классов
            require_once DOCUMENT_ROOT . '/vendor/autoload.php';

            use src\App\Connect;
            use src\App\DbArticle;
            use src\App\Controller\ControllerEditNews;
            use src\App\View\View;

            $connect = new Connect();
            $model = new DbArticle($connect->connect);
            $view = new View();

            /** получение id для функции удаления записи */
            /** запуск метода удаления записи при нажатии на кнопку */
            if (isset($_POST['edit'])) {
                try {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $text = $_POST['text'];
                    $controller = new ControllerEditNews($model, $view);
                    echo $controller->editArticle($title, $text, $id);
                }catch (Error $error) {
                    die("Error =>" . $error->getMessage());
                }
            }
            ?>
        </center>
    </body>
</html>
