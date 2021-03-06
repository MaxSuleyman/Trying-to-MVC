<?php

namespace src\App\Controller;

use mysql_xdevapi\Exception;

class ControllerFindNews
{
    private $db;
    private $view;

    public function __construct(object $db, object $view)
    {
        $this->db = $db;
        $this->view = $view;
    }

    /**
     * метод обработки данных передающий их в метод поиска в таблице записи и передача ее во View
     * $id - ID записи по которому производится поиск в таблице
     */
    public function findOneArticle(int $id)
    {
        try {
            $data = $this->db->findOne($id);
            if (empty($data)) {
                echo "Запись в id=$id не найдена";
                throw new \Exception("Запись в id=$id не найдена");
            }

            $this->view->display($data, 'articles.php');
        } catch (Exception $e) {
            return ("Exception => " . $e->getMessage());
        }
    }
}