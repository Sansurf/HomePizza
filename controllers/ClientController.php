<?php

/**
 * Контроллер клиентской страницы
 */

class ClientController extends C_Base
{
	// Получение списка товарных позиций
	public function actionIndex()
	{
		$items = $this->itemsAll();
		$this->content = $this->template('index', array('items'=>$items));	
	}
	
	// Получение одной позиции
	public function actionItem()
	{
		if($this->isGet())
		{	
			$item = $this->itemGet($_GET['id']);
			$this->h1 .= "::" .$item['title'];
			$this->content = $this->template('view', array('item'=>$item));
		}	
	}
}
