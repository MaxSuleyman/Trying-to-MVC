<?php

namespace App\View;

/**
 * Class View
 * @package App\View
 * класс визуализации интерфейса
 */
class View
{
    /**
     * метод выводящий найденые в таблице записи
     */
    public function viewArticles(array $data) {
        foreach ($data as $key => $value) {
            ?>
            <div id="container">
                <div id="container_inner">
                    <div id="title">
                        <?php echo $data[$key]->title; ?>
                        <a href="../index.php?id=<?php echo $data[$key]->id?>" name="delete" id="delete_button">Удалить</a>
                        <a name="remove" id="delete_button">ID = <?php echo $data[$key]->id?></a>
                    </div><br>

                    <div id="content">
                        <?php echo $data[$key]->text;?>
                    </div>
                </div>
            </div>

            <div id="space"></div>
            <?php
        }
    }

    /**
     * @param $data - данные для формирования меню навигации
     * @return mixed|string - возвращает строку с меню навигации
     */
    public function viewPagination(array $data)
    {
        if (gettype($data[0]) == 'string') {
            return $data[0];
        }

        // Проверяем нужны ли стрелки назад */
        if ($data[0] != 1) {
            $pervpage = '<a href="/index.php?page=1"><<</a>
        <a href="/index.php?page=' . ($data[0] - 1) . '"><</a> ';
        }

        // Проверяем нужны ли стрелки вперед */
        if ($data[0] != $data[1]) {
            $nextpage = '  <a href="/index.php?page=' . ($data[0] + 1) . '">></a>
        <a href="/index.php?page=' . $data[1] . '">>></a> ';
        }

        // Находим две ближайшие станицы с обоих краев, если они есть */
        if($data[0] - 2 > 0) {
            $page2left = ' <a href="/index.php?page=' . ($data[0] - 2) . '">' . ($data[0] - 2) . '</a>  ';
        }

        if($data[0] - 1 > 0) {
            $page1left = '<a href="/index.php?page=' . ($data[0] - 1) . '">' . ($data[0] - 1) . '</a>  ';
        }

        if($data[0] + 2 <= $data[1]) {
            $page2right = '  <a href="/index.php?page=' . ($data[0] + 2) . '">' . ($data[0] + 2) . '</a>';
        }

        if($data[0] + 1 <= $data[1]) {
            $page1right = '  <a href="/index.php?page=' . ($data[0] + 1) . '">' . ($data[0] + 1) . '</a>';
        }

        $this->pagination = '<p><div align="center" class="navigation">';



        if ($data[1] > 1) {
            $this->pagination = '<p><div align="center" class="navigation">'
                . $pervpage . $page2left . $page1left . '<span>' . $data[0] . '</span>' . $page1right .
                $page2right . $nextpage . '</div></p>';
        }

        return $this->pagination;
    }
}