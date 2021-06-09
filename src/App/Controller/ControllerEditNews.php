<?php


namespace App\Controller;


class ControllerEditNews
{
    private $db;
    private $view;

    public function __construct(object $db, object $view)
    {
        $this->db = $db;
        $this->view = $view;
    }

    /**
     * метод обработки данных для редактирования записи
     */
    public function editArticle(string $title, string $text, string $id)
    {
        if (empty($title) or empty($text) or empty($id)) {
            return "Заполните поля формы";
        }
        try {
            $this->db->editArticle($title, $text, $id);
            return "Запись успешно отредактирована";
        }catch (\Exception $e) {
            die("Error => " . $e->getMessage());
        }
    }
}