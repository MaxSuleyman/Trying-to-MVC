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
                <a href="pages/add_news.php" id="link">Добавить запись</a>
                <a href="pages/edit_news.php" id="link">Редактировать запись</a>
                <a href="pages/find_news.php">Найти запись</a>
            </div>

            <div id="space"></div>

            <?php
            /**  пространство имен класса для работы с БД */
            use App\Model\Db;

            /** пространство имен класса подключения к БД */
            use src\Connect;

            /** пространство имен класса пагинатора */
            use App\Model\Pagination;

            /** подключение классов */
            require_once 'src/Connect.php';
            require_once 'App/Model/Db.php';
            require_once 'App/Model/Pagination.php';
            require_once 'App/Controller/Controller.php';
            require_once 'App/View/View.php';


            /** объект переменной подключения к БД */
            $connect = new Connect();
            /** объект модели для работы с таблицами в Бд */
            $modelDB = new Db($connect->connect);

            /** $dataDb - массив данных передаваемый в метод поиска n-ого кол-ва записей
             * $limit - кол-во записей выводимых на одну страницу
             * $page - номер страницы передаваемый в класс пагинации
            */
            $limit = 5;
            $dataDb = [
                'page' => $_GET['page'],
                'limit' => $limit
            ];

            /** объект контроллера, принимает на вход объект модели и массив с данными*/
            $controller = new Controller($modelDB, $dataDb);

            $controller->returnToModel('getAll');

            /** получение из БД кол-ва записей в таблице */
            $totalRowsFromTable = $controller->returnToModel('getCountTable');

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
            echo $controller->pagination($dataPagination);
            ?>

            <div id="space"></div>
        </center>
    </body>
</html>