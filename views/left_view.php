<!-- Левая колонка в режиме просмотра пунктов меню -->
<ul>
<?php foreach ($items as $item): ?>
    <li>
        <a href="index.php?id=<?=$item['id_item']?>&act=Item">
            <?=$item['title'];?>
        </a><br /><br />
    </li>
<?php endforeach; ?>
</ul>
<br />
