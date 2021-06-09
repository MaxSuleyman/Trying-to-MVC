<?php

if (gettype($data[0]) == 'string') {
    return $data[0];
}

/** Проверяем нужны ли стрелки назад */
if ($data[0] != 1) {
    $pervpage = '<a href="/index.php?page=1"><<</a>
        <a href="/index.php?page=' . ($data[0] - 1) . '"><</a> ';
}

/** Проверяем нужны ли стрелки вперед */
if ($data[0] != $data[1]) {
    $nextpage = '  <a href="/index.php?page=' . ($data[0] + 1) . '">></a>
        <a href="/index.php?page=' . $data[1] . '">>></a> ';
}

/** Находим две ближайшие станицы с обоих краев, если они есть */
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

if ($data[1] > 1) {
    $this->pagination = '<p><div align="center" class="navigation">'
        . $pervpage . $page2left . $page1left . '<span>' . $data[0] . '</span>' . $page1right .
        $page2right . $nextpage . '</div></p>';
}
echo $this->pagination;