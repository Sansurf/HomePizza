<!-- Шаблон страницы редактирования -->

<a href="index.php">Главная</a> | <a href="index.php?admin&act=New">Добавление новой позиции</a>
<hr />
	<h3>Исходная позиция:</h3>
	<b><?= $item['title'] ?></b><br />
	<p><?php echo str_replace("\n", "<br />", $item['description']) ?></p>
	<p>Стоимость: <?= $item['cost'] ?> руб.</p>
	<p>Время приготовления: <?= $item['cook_time'] ?> сек.</p>
	<hr/>

<b>Внесите поправки в существующую позицию:</b>
<br />
<form method="post">
	
	<p>Название:</p>
	<input type="text" name="title" value="<?=htmlspecialchars($item['title'])?>" />
	
	<p>Описание:</p>
	<textarea name="description"><?= $item['description'] ?></textarea>
	
	<p>Стоимость, руб.:</p>
	<input type="number" name="cost" value="<?= $item['cost'] ?>" />
	
	<p>Время приготовления, сек.:</p>
	<input type="number" name="time" value="<?= $item['cook_time'] ?>" />
	
	<br><br>
	<input type="submit" value="Редактировать" />
</form>
	