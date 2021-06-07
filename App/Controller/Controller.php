<?php

/** пространство имен класса визуализации */
use App\View\View;

class Controller
{
    private $model;
    private $data;
    private $method;

    public function __construct(object $model, array $data)
    {
        $this->model = $model;
        $this->data = $data;
    }

    /**
     * @param $data - данные поступающие из формы отправки
     */
    public function returnToModel(string $method)
    {
        $this->method = $method;
        switch ($this->method) {
            case 'getCountTable':
                return $this->model->getCountTable();
            case 'getAll':
                try {
                    $page = intval($this->data['page']);
                    if ($page === null or $page === 0) {
                        $page = 1;
                    }

                    $limit = intval($this->data['limit']);

                    $dataToView = $this->model->getAll($page, $limit);
                    $viewResult = new View($dataToView);
                    $viewResult->viewArticles();
                    return $viewResult;
                }catch (Error $error) {
                    die("Error => " . $error->getMessage());
                }
            case 'getOne':
                try {
                    $id = intval($this->data['id']);
                    $dataToView = $this->model->getOne($id);
                    $viewResult = new View($dataToView);
                    $viewResult->viewArticles();
                    return $viewResult;
                }catch (Error $error) {
                    die("Error => " . $error->getMessage());
                }
            case 'delete':

            default:
                return "";
        }
    }

    public function pagination($data)
    {
        $page = intval($data['page']);
        $limit = intval($data['limit']);
        $totalRowsFromTable = intval($data['totalRowsFromTable']);

        // проверка кол-ва страниц, если равно 0, то начальной странице устанавливается значение 1 */
        if ($page == 0) {
            $page = 1;
        }
        // общее число страниц */
        $total = ((($totalRowsFromTable-1)/$limit)+1);
        // откругление до целого значения
        $total = round($total, 0, PHP_ROUND_HALF_UP);

        // проверка существования страницы и ее значения
        if(empty($page) or $page < 0) {
            $page = 1;
        }

        // если запрошена не существующая страница, выведет на экран сообщение об ошибке
        if ($page > $total) {
            return ["Такой страницы не существует"];
        } else {
            // масси содержащий номер страницы и общее кол-во страниц для вывода записей на экран
            $dataToView = [$page, $total];
            $viewResult = new View($dataToView);
            return $viewResult->viewPagination();
        }
    }
}