<?php define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style/style.css">
        <title>Главная</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <center>
            <h1>Главная</h1>

            <div>
                <a href="src/templates/add_news.php" id="link">Добавить запись</a>
                <a href="src/templates/edit_news.php" id="link">Редактировать запись</a>
                <a href="src/templates/find_news.php">Найти запись</a>
            </div>

            <div id="space"></div>

            <?php
            /**  пространство имен класса для работы с БД */
            use src\App\DbArticle;

            /** пространство имен класса подключения к БД */
            use src\App\Connect;
            use src\App\View\View;
            use src\App\Controller\ControllerIndex;


            /** подключение классов */
            require_once DOCUMENT_ROOT . '/vendor/autoload.php';

            /** объект переменной подключения к БД */
            $connect = new Connect();
            /** объект модели для работы с таблицами в Бд */
            $db = new DbArticle($connect->connect);
            $view = new View();

            /** $dataDb - массив данных передаваемый в метод поиска n-ого кол-ва записей
             * $limit - кол-во записей выводимых на одну страницу
             * $page - номер страницы передаваемый в класс пагинации
            */
            $limit = 5;

            /** объект контроллера, принимает на вход объект модели и массив с данными*/
            $controller = new ControllerIndex($db, $view);

            /**
             * вызов метода обработчика для получения записей из таблице
             */
            $controller->findAllArticles($_GET['page'], $limit);



            /** получение из БД кол-ва записей в таблице */
            $totalRowsFromTable = $controller->countArticles();



            /**
             * вызов метода обрабочика для метода удаления записи
             */
            if (isset($_GET['id']) and !empty($_GET['id'])) {
                $id = $_GET['id'];
                $id = intval($id);
                $controller->deleteArticle($id);
            }

            /** массив данных для метода пагинации
             * page - номер страницы на которой необходимо вывести данные
             * limit - кол-во выводимых на одной странице записей
             * totalRowsFromTable - общее кол-во записей в таблице
             */
            $dataPagination = [
                'page' => $_GET['page'],
                'limit' => $limit,
                'totalRowsFromTable' => $totalRowsFromTable
            ];

            /** вывод меню навигации на экран */
            $controller->pagination($dataPagination);
            ?>

            <div id="space"></div>
        </center>
    </body>
</html>