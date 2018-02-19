<?php

// Подключение драйвера БД
require_once('model/M_DriverDB.php');


/**
 * Базовый контроллер
 */

abstract class C_Base extends C_Controller
{
	protected $title;		// Title страницы
	protected $content;		// содержание страницы
	protected $h1;			// Заголовок страницы
	private $table = 'menu_item'; // Таблица БД
	
	// Запрос на вывод всех позиций
	protected function itemsAll()
	{
		$sql = M_DriverDB::getInstance();
		$items = $sql->allItems($this->table);
		return $items;
	}

	// Получение одной позиции
	protected function itemGet($id)
	{
		$sql = M_DriverDB::getInstance();
		$item = $sql->oneItem($this->table, "id_item=$id");
		return $item;
	}

	// Добавление позиции
	protected function itemAdd($object)
	{
		$sql = M_DriverDB::getInstance();
		$sql->insert($this->table, $object);
	}

	// Обновление позиции
	public function itemUpd($object, $id)
	{
		$sql = M_DriverDB::getInstance();
		$sql->update($this->table, $object, "id_item=$id");
	}

	// Удаление позиции
	public function itemDel($id)
	{
		$sql = M_DriverDB::getInstance();
		$sql->delete($this->table, "id_item=$id");
	}
	
	// Метод, срабатывающий до отрисовки шаблона
	protected function before()
	{
		$this->title = 'Служба доставки Home Pizza';
		$this->h1 = 'Товарные позиции ресторана';
		$this->content = '';
		$this->left = '';
	}

	// Генерация левой колонки
	private function leftSide()
	{
		$items = $this->itemsAll();
		$left = $this->template(
			(isset($_GET['admin'])) ? 'left_edit' : 'left_view',
			array('items'=>$items)
		);
		return $left;
	}
	
	// Генерация базового шаблона
	public function render()
	{
		$vars = array(
			'title' => $this->title,
			'content' => $this->content,
			'h1' => $this->h1,
			'left' => $this->leftSide()
		);
		$page = $this->template('layout/main', $vars);				
		echo $page;
	}	
}
