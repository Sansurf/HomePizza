<!-- Шаблон вывода одной позиции -->

<a href="index.php">Главная</a> | <a href="index.php?admin&act=New">Консоль редактора</a>

<hr/>
<b><?=$item["title"]?></b><br />
<p><?=str_replace("\n", "<br />", $item['description'])?></p>
<p>Стоимость: <?= $item['cost'] ?> руб.</p>
<p>Время приготовления: <?= $item['cook_time'] ?> сек.</p>
