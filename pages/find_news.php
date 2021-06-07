<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style/style.css">
    <title>Найти запись</title>
    <meta charset="UTF-8">
</head>

<body>
<center>
    <h1>Найти запись</h1>

    <div>
        <a href="../index.php" id="link">На главную</a>
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
    require_once '../App/Model/Db.php';
    require_once '../App/View/View.php';
    require_once '../App/Controller/Controller.php';
    require_once '../src/Connect.php';

    use src\Connect;
    use App\Model\Db;

    $connect = new Connect();
    $model = new Db($connect->connect);

    /** получение id для функции удаления записи */
    /** запуск метода удаления записи при нажатии на кнопку */
    if (isset($_POST['id']) and !empty($_POST['id'])) {
        try {
            /** установка для id типа данных */
            $id = intval($_POST['id']);
            $controller = new Controller($model);
            $controller->callFindOneRow($id);
        }catch (Error $error) {
            die("Error =>" . $error->getMessage());
        }
    }


    ?>
</center>
</body>
</html>
