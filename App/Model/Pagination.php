<?php


namespace App\Model;


class Pagination
{
    public function pagination(int $page, int $limit, int $totalRowsFromTable)
    {

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
            $arr = [$page, $total];
            $this->page = $page;
            $this->total = $total;
        }
    }
}