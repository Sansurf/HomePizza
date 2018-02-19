<?php

/**
 *
 * Драйвер БД
 *
 */

/**
 * Определение констант
 */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "restorant");

class M_DriverDB
{
	private $link;
	private static $instance;

	/**
	 * В конструкторе создаем подключение к БД,
	 * задаем языковые настройки и локаль
	 */
	private function __construct()
	{
		// Языковая настройка.
		setlocale(LC_ALL, 'ru_RU.UTF-8'); // Устанавливаем нужную локаль (для дат, денег, запятых и пр.)
		mb_internal_encoding('UTF-8'); // Устанавливаем кодировку строк
		
		// Подключение к БД.
		$this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error: ". mysqli_error($this->link));

		mysqli_query($this->link, 'SET NAMES utf8');
	}

	/**
	 * Проверка на существование экземпляра класса
	 * и если не существует, то получаем экземпляр класса
	 */
	public static function getInstance()
	{
		if (self::$instance == null) self::$instance = new M_DriverDB();
		return self::$instance;
	}

	/**
	 * Проверка выполнения запроса
	 */
	private function tryResult($sql)
	{
		$result = mysqli_query($this->link, $sql);
		if (!$result) die("Error: " . mysqli_error($this->link));
		return $result;
	}

	/**
	 * Запрос для вывода всех записей таблицы
	 */
	public function allItems($table)
	{
		$sql = "SELECT * FROM $table";
		$result = $this->tryResult($sql);
		$count = mysqli_num_rows($result);
		$rows = array();
		for ($i=0; $i < $count; $i++) { 
			$rows[] = mysqli_fetch_assoc($result);
		}

		return $rows;
	}

	/**
	 * Запрос на вывод одной записи
	 */
	public function oneItem($table, $where)
	{
		$sql = "SELECT * FROM $table WHERE $where";
		$result = $this->tryResult($sql);
		$item = mysqli_fetch_assoc($result);

		return $item;
	}

	/**
	 * Вставка записи в таблицу
	 * @return Идентификатор новой позиции
	 */
	public function insert($table, $object)
	{			
		$columns = array();
		$values = array();
	
		foreach ($object as $key => $value)
		{
			$key = mysqli_real_escape_string($this->link, $key);
			$columns[] = $key;
			
			if ($value === null)
			{
				$values[] = 'NULL';
			}
			else
			{
				$value = mysqli_real_escape_string($this->link, $value);				
				$values[] = "'$value'";
			}
		}
		
		$columns_s = implode(',', $columns);
		$values_s = implode(',', $values);
			
		$sql = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
		$result = $this->tryResult($sql);
			
		return mysqli_insert_id($this->link);
	}

	/**
	 * Обновление записи в таблице
	 */
	public function update($table, $object, $where)
	{
		$sets = array();
			
		foreach($object as $key => $value){
			$key = mysqli_real_escape_string($this->link, $key);
			$value = mysqli_real_escape_string($this->link, $value);
			if($value == NULL) {
				$sets[] = "$key=NULL";
			} else {
				$sets[] = "$key='$value'";
			}
		}
		
		$sets_s = implode(",",$sets);		

		$sql = "UPDATE $table SET $sets_s WHERE $where";
		$result = $this->tryResult($sql);
		
		return mysqli_affected_rows($this->link);	
	}

	/**
	 * Удаление записи
	 */
	public function delete($table, $where)
	{
		$sql = "DELETE FROM $table WHERE $where";
		$result = $this->tryResult($sql);

		return mysqli_affected_rows();
	}
}
