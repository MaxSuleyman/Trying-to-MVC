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
     * @param array $data - данные для визуализации
     * @param string $fileName - имя файла templates
     */
    public function display(array $data, string $fileName)
    {
        $dir = DOCUMENT_ROOT . '/src/templates/' . $fileName;
        if (file_exists($dir)) {
            require_once $dir;
        } else {
            echo "Не удалось подключить файл $dir";
        }
    }
}