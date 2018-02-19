<?php

/**
 * Контроллер страницы редактирования
 */

class AdminController extends C_Base
{
	// Подготовка принимаемых данных
	private function validatePost($field) 
	{
		$field = trim($field);
		$field = stripslashes($field);
		$field = strip_tags($field);
		$field = htmlspecialchars($field);

		return $field;
	}

	// Формирование массива введенных данных
	private function validFields() 
	{
		$title = $this->validatePost($_POST['title']);
		$description = $this->validatePost($_POST['description']);
		$cost = $this->validatePost($_POST['cost']);
		$cookTime = $this->validatePost($_POST['time']);

		$object = [
			'title' => $title,
			'description' => $description,
			'cost' => $cost,
			'cook_time' => $cookTime
		];
	
		return $object;
	}

	// Добавление позиции
	public function actionNew()
	{
		if (!empty($_POST['title'])) {
			$this->itemAdd($this->validFields());
			header('Location: index.php?admin&act=New');
		}
	
		$this->content = $this->template('new', array());
	}

	// Редактирование статьи
	public function actionEdit()
	{
		$id = $_GET['id'];
		$object = [];
		
		// Получение статьи
		if (isset($id)) 
		{
			$item = $this->itemGet($id);
			$this->content = $this->template('edit', array('item'=>$item));
		}
			
		// Обработка отправки формы.
		if (!empty($_POST['title'])) {
			$this->itemUpd($this->validFields(), $id);
			header("Location: index.php?admin&id=$id&act=Edit");
		}
	
		$this->h1 .= "::Редактирование статьи";
	}

	// Удаление статьи
	public function	actionDel()
	{ 
		if (isset($_GET['del']))
		{
			header('Location: index.php?admin&act=New');

			$id = $_GET['del'];
			$this->itemDel($id);
		}
	}
}
