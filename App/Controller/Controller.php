<?php

/** пространство имен класса визуализации */
use App\View\View;

class Controller
{
    private $model;


    public function __construct(object $model)
    {
        $this->model = $model;
    }

    /**
     * метод обработки данных передающий их в метод поиска в таблице n-ого кол-ва записей и их передача во View
     */
    public function callGetNumRows($page, int $limit)
    {
        try {
            if ($page === null or $page == 0) {
                $page = 1;
            }

            if ($limit === null or $limit == 0) {
                return "Укажите кол-во записей для вывода на странице";
            }

            $dataToView = $this->model->getNumRows($page, $limit);
            $viewResult = new View();
            $viewResult->viewArticles($dataToView);
            return $viewResult;
        }catch (Error $error) {
            die("Error => " . $error->getMessage());
        }
    }

    /**
     * метод получения кол-ва записей в таблице
     */
    public function callGetCountTable()
    {
        return $this->model->getCountTable();
    }

    /**
     * метод обработки данных передающий их в метод поиска в таблице записи и передача ее во View
     * $id - ID записи по которому производится поиск в таблице
     */
    public function callFindOneRow(int $id)
    {
        try {
            $dataToView = $this->model->getOneRow($id);

            if (empty($dataToView)) {
                echo "Запись с ID = $id не найдена<br>";
            }
            $viewResult = new View();
            $viewResult->viewArticles($dataToView);
            return $viewResult;
        } catch (Error $e) {
            die("Error => " . $e->getMessage());
        }
    }

    /**
     * метод обработки и вызова метода удаления записи
     * $ID - ID записи по которому производится поиск и удаление
     */
    public function callDeleteRow(int $id)
    {
        try {
            if ($id == null) {
                return "Не корректный ID записи";
            }
            $id = intval($id);
            $this->model->deleteRow($id);
        }catch (Error $e) {
            die("Error => " . $e->getMessage());
        }
    }

    /**
     * метод обработки данных и передачи их в метод добавления в таблицу
     */
    public function callInsert(string $title, string $text)
    {
        try {
            $this->model->insert($title, $text);
            return "Запись успешно добавлена";
        }catch (Error $e) {
            die("Error => " . $e->getMessage());
        }
    }

    /**
     * метод обработки данных для редактирования записи
     */
    public function callEdit(string $title, string $text, string $id)
    {
        if (empty($title) or empty($text) or empty($id)) {
            return "Заполните поля формы";
        }
        try {
            $this->model->edit($title, $text, $id);
            return "Запись успешно отредактирована";
        }catch (Error $e) {
            die("Error => " . $e->getMessage());
        }
    }

    /**
     * метод расчета меню навигации
     * @param $data - данные для вывода пагианции
     * @return mixed|string|string[] - возвращает строку меню из метода визулизации
     *
     */
    public function pagination(array $data)
    {
        $page = intval($data['page']);
        $limit = intval($data['limit']);
        $totalRowsFromTable = intval($data['totalRowsFromTable']);

        // общее число страниц */
        $total = ((($totalRowsFromTable)/$limit));
        // откругление до целого значения
        $total = ceil($total);

        // проверка существования страницы и ее значения
        if(empty($page) or $page < 0 or $page == 0 or $page == null) {
            $page = 1;
        }

        // если запрошена не существующая страница, выведет на экран сообщение об ошибке
        if ($page > $total) {
            return ["Такой страницы не существует"];
        } else {
            // масси содержащий номер страницы и общее кол-во страниц для вывода записей на экран
            $dataToView = [$page, $total];
            $viewResult = new View();
            return $viewResult->viewPagination($dataToView);
        }
    }
}