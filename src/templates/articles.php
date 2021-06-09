<?php

foreach ($data as $key => $value) {
    ?>
    <div id="container">
        <div id="container_inner">
            <div id="title">
                <?php echo $data[$key]->title;
                ?>
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