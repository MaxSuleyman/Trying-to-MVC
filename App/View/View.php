<?php

namespace App\View;

/**
 * Class View
 * @package App\View
 * класс визуализации интерфейса
 */
class View
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * метод выводящий найденые в таблице записи
     */
    public function viewArticles() {
        foreach ($this->data as $key => $value) {
            ?>
            <div id="container">
                <div id="container_inner">
                    <div id="title">
                        <?php echo $this->data[$key]->title; ?>
                        <a href="../index.php?id=<?php echo $this->data[$key]->id?>" name="delete" id="delete_button">Удалить</a>
                        <a name="remove" id="delete_button">ID = <?php echo $this->data[$key]->id?></a>
                    </div><br>

                    <div id="content">
                        <?php echo $this->data[$key]->text;?>
                    </div>
                </div>
            </div>

            <div id="space"></div>
            <?php
        }
    }

    public function viewPagination()
    {
        if (gettype($this->data[0]) == 'string') {
            return $this->data[0];
        }

        // Проверяем нужны ли стрелки назад */
        if ($this->data[0] != 1) {
            $pervpage = '<a href="/index.php?page=1"><<</a>
        <a href="/index.php?page=' . ($this->data[0] - 1) . '"><</a> ';
        }

        // Проверяем нужны ли стрелки вперед */
        if ($this->data[0] != $this->data[1]) {
            $nextpage = '  <a href="/index.php?page=' . ($this->data[0] + 1) . '">></a>
        <a href="/index.php?page=' . $this->data[1] . '">>></a> ';
        }

        // Находим две ближайшие станицы с обоих краев, если они есть */
        if($this->data[0] - 2 > 0) {
            $page2left = ' <a href="/index.php?page=' . ($this->data[0] - 2) . '">' . ($this->data[0] - 2) . '</a>  ';
        }

        if($this->data[0] - 1 > 0) {
            $page1left = '<a href="/index.php?page=' . ($this->data[0] - 1) . '">' . ($this->data[0] - 1) . '</a>  ';
        }

        if($this->data[0] + 2 <= $this->data[1]) {
            $page2right = '  <a href="/index.php?page=' . ($this->data[0] + 2) . '">' . ($this->data[0] + 2) . '</a>';
        }

        if($this->data[0] + 1 <= $this->data[1]) {
            $page1right = '  <a href="/index.php?page=' . ($this->data[0] + 1) . '">' . ($this->data[0] + 1) . '</a>';
        }

        if ($this->data[1] > 1) {
            $this->pagination = '<p><div align="center" class="navigation">'
                . $pervpage . $page2left . $page1left . '<span>' . $this->data[0] . '</span>' . $page1right .
                $page2right . $nextpage . '</div></p>';
        }

        return $this->pagination;
    }
}