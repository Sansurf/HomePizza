<!-- Шаблон главной страницы -->

<b>Главная страница</b> | <a href="index.php?admin&act=New">Консоль редактора</a>
<ul>
    <?php foreach ($items as $item): ?>
        <li>
            <b><u><?=$item['title'];?></u></b>
            <br>
            <?php
	            $str = explode (" ", $item['description']);
	            $arr = array_slice($str, 0, 15);
	            echo implode(" ", $arr). "...";
            ?>
            <br>
            <i><a href="index.php?id=<?=$item['id_item']?>&act=Item">Подробнее...</a></i>
            <br><br>
        </li>
    <?php endforeach; ?>
</ul><br />
