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



            /** подключение классов */
            require_once 'src/Connect.php';
            require_once 'App/Model/Db.php';
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

            /** объект контроллера, принимает на вход объект модели и массив с данными*/
            $controller = new Controller($modelDB);

            /**
             * вызов метода обработчика для получения
             */
            $controller->callGetNumRows($_GET['page'], $limit);
            /** получение из БД кол-ва записей в таблице */
            $totalRowsFromTable = $controller->callGetCountTable();



            /**
             * вызов метода обрабочика для метода удаления записи
             */
            if (isset($_GET['id']) and !empty($_GET['id'])) {
                $id = $_GET['id'];
                $id = intval($id);
                $controller->callDeleteRow($id);
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
            echo $controller->pagination($dataPagination);
            ?>

            <div id="space"></div>
        </center>
    </body>
</html>