<?php

namespace src\App\View;


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
    public function viewArticles(array $data)
    {
        ob_start();
        require_once DOCUMENT_ROOT . '/src/templates/articles.php';
        echo ob_get_clean();
    }

    /**
     * @param $data - данные для формирования меню навигации
     * @return mixed|string - возвращает строку с меню навигации
     */
    public function viewPagination(array $data)
    {
        ob_start();
        require_once DOCUMENT_ROOT . '/src/templates/pagination.php';
        ob_get_contents();
    }
}