<?php


namespace src\App\Controller;


class ControllerAddNews
{
    private $db;
    private $view;

    public function __construct(object $db, object $view)
    {
        $this->db = $db;
        $this->view = $view;
    }

    /**
     * метод обработки данных и передачи их в метод добавления в таблицу
     */
    public function insertArticle(string $title, string $text)
    {
        try {
            $this->db->insert($title, $text);
            return "Запись успешно добавлена";
        }catch (\Exception $e) {
            die("Error => " . $e->getMessage());
        }
    }
}