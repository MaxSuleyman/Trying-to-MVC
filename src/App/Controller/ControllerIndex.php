<?php


namespace App\Controller;
use App\View\View;
use mysql_xdevapi\Exception;


class ControllerIndex
{
    private $db;
    private $view;

    public function __construct(object $db, object $view)
    {
        $this->db = $db;
        $this->view = $view;
    }

    /**
     * метод обработки данных передающий их в метод поиска в таблице n-ого кол-ва записей и их передача во View
     */
    public function findAllArticles($page, int $limit)
    {
        try {
            if ($page === null or $page == 0) {
                $page = 1;
            }

            if ($limit === null or $limit == 0) {
                throw new \Exception("Укажите кол-во записей для вывода на странице");
            }
            $data = $this->db->findAllArticles($page, $limit);
            $this->view->viewArticles($data);
        }catch (\Exception $e) {
            return "Исключение => " . $e->getMessage() . "<br>";
        }
    }

    /**
     * метод получения кол-ва записей в таблице
     */
    public function countArticles()
    {
        return $this->db->getCountArticles();
    }

    /**
     * метод обработки и вызова метода удаления записи
     * $ID - ID записи по которому производится поиск и удаление
     */
    public function deleteArticle(int $id)
    {
        try {
            if ($id == null) {
                return "Не корректный ID записи";
            }
            $id = intval($id);
            $this->db->deleteArticle($id);
        }catch (Exception $e) {
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

        /**
         * проверка существования страницы и ее значения
         */
        if(empty($page) or $page < 0 or $page == 0 or $page == null) {
            $page = 1;
        }

        /** общее число страниц */
        $total = ((($totalRowsFromTable)/$limit));
        /** откругление до целого значения */
        $total = ceil($total);

        /** если запрошена не существующая страница, выведет на экран сообщение об ошибке */
        if ($page > $total) {
            return ["Такой страницы не существует"];
        } else {
            // масси содержащий номер страницы и общее кол-во страниц для вывода записей на экран
            $dataToView = [$page, $total];
            $this->view->viewPagination($dataToView);
        }
    }
}