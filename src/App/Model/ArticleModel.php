<?php

namespace App\Model;

class ArticleModel
{
    /**
     * @id int - идентификатор записи
     * @title string - заголовок новости
     * @text string - текст новости
     */
    public int $id;
    public string $title;
    public string $text;
}