<?php
/**
 * db.class.php
 *
 * Classe para manipulação do Banco de dados
 * Interface para GD
 *
 * @author     Felipe Augusto Gonçavelves Basilio 
 * @version    1.0 
 *
 * TODO:
 */
/* Set a timezone de São Paulo*/
date_default_timezone_set('America/Sao_Paulo');

/*
 * Classe de conexao com o banco de dados extende o PDO
 */
 
class DB__connect extends PDO
{
	private static $instancia;
	/*
	 * Funcao para conexao usando o PDO
	 * @return Object instancia objeto
	 */
	
	public static function PDOconnection($db_host, $db_user, $db_pass, $db_name)
	{
		define('DB_HOST', $db_host);
		define('DB_USER', $db_user);
		define('DB_PASS', $db_pass);
		define('DB_NAME', $db_name);
		if (!isset(self::$instancia))
		{
			try
			{
				self::$instancia = new DB__connect("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
				));
				self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (PDOException $e)
			{
				exit('Não foi possível conectar: ' . $e->getMessage());
			}
		}
		return self::$instancia;
	}
	
}

/**
 * Class para executar as query do banco de dados
 */
class DB__query
{
	public static $conn,$num_row,$success = false,$lastInsertId,$get_all_fields;
	
	private static $output = NULL,$table;
	
	/**
	 * Construtor
	 * @param $string dados de conexao
	 * @return void
	 */
	public function __construct($db_host, $db_user, $db_pass, $db_name)
	{
		self::$conn = DB__connect::PDOconnection($db_host, $db_user, $db_pass, $db_name);
	}
	
	/**
	 * SELECT
	 * @param array 	$table Tabela selecionada
	 * @param array 	$field Campos seleciionado
	 * @param string 	$clause Complemento da query
	 * @return string 	data com:
	 * [field], [fav] - "field as values", [table],[clause],[rowCount]
	 */
	public static function __SELECT($table, $field = NULL, $clause = NULL)
	{
		$output = NULL;

		if (is_array($field))
		{
			$field = implode(', ', $field);
		}
		else
		{
			if($field == NULL && $clause == NULL)
			{
				$field  = "*";
				$clause = "";
			}
			else if ($clause === NULL)
			{
				$clause = $field;
				$field  = "*";
			}
		}
		
		try
		{
			$query = self::$conn->prepare("SELECT " . $field . " FROM " . $table . " " . $clause);
			
			if($query->execute())
			{
				
				for ($k = 0; $fetch = $query->fetch(PDO::FETCH_BOTH); $k++)
				{
					for ($i = 0; $i < $query->columnCount(); $i++)
					{
						$meta = $query->getColumnMeta($i);
						$output[$k][$meta[name]] = $fetch[$meta[name]];
					}
				}
				

				self::$num_row = $query->rowCount();
				self::$success = self::$num_row >= 1 ?  true:  false;

			}
			
			
			
		}
		catch (Exception $e)
		{
			self::$success = false;
			echo "Erro ao tentar Fazer SELECT em $table: " . $e->getMessage();
		}
		
		self::$table 			= $meta[table];
		self::$output 			= $output;

		return array("data" => array("output" => self::$output,"field" => $field ,"table" => $table,"clause" => $clause,"query" => $query->queryString ), "rowCount" => self::$num_row);
	}
	
	
	/**
	 * Catch_
	 * Funcao de auxilio a funcao __SELECT
	 * @param string 	$field campo selecionado
	 * @param int	 	$index usado para loop defaut 0
	 * @return Variavel GLOBALS sendo o nome do propio campo
	 */
	public static function catch_($field, $index = "0")
	{
		if (is_array($field))
		{
			foreach ($field as $Fields)
			{
				$GLOBALS["$Fields"] = self::$output[$index][$Fields];
			}
		}
		else
		{
			 $GLOBALS["$field"] = self::$output[$index][$field];
		}
		
	}
	

	/**
	 * Catch_
	 * Funcao de auxilio a funcao __SELECT
	 * @param funct func_get_args << >> Pegar todos os parametros passados
	 * @param mixed [,$_args... , $index] onde o ultimo sempre sera o int para o loop
	 * @return variavel GLOBALS sendo o nome do propio campo
	 */
	public static function fetch_( /*mixed [,$_args... , $index]*/  )
	{
		$_args 		= func_get_args();
		$index 		= array_pop($_args);
		$array_push = array();

		if(!is_int($index))
		{
			array_push($_args,$index);
			$index = "0";
		}
		if (is_array($_args))
		{ 
			foreach ($_args as $field)
			{

				$GLOBALS[$field] =  self::$output[$index][$field];
				$array_push = array_merge_recursive($array_push, array($field => self::$output[$index][$field]));
				
			}
		}
		return array("fields" => $_args,"table" => self::$table, self::$table => $array_push );
	}

		
		
	/**
	 * __INSERT
	 * Funcao para tratamento de dados quer serao inseridos
	 * @param string 	$table tabela selecionado
	 * @param array 	$field campos que quer inserir
	 * @param array 	$value_field valor para o campo selecionado
	 * @return function query__execute que ira executar a query
	 */
	public static function __INSERT($table, $field, $value_field)
	{
		if ((is_array($field)) and (is_array($value_field)))
		{
			
			$field =  self::prepare($field);
			$value_field =  self::prepare($value_field);
			
			
			if (count($field) == count($value_field))
			{
				$__INSERT = "INSERT INTO {$table} (" . implode(', ', $field) . ") VALUES ('" . implode('\', \'', $value_field) . "')";
			}
			else
			{
				trigger_error("Um Erro foi encontrado em sua query, o numero campos nao correspondem aos numeros de valores para o mesmo!.");
				return;
			}
			
		}
		else
		{
			$__INSERT = "INSERT INTO {$table} (" . trim($field) . ") VALUES ('" . trim($value_field) . "') ";
		}
		
		return self::query__execute($__INSERT);
	}
	
	/**
	 * __INSERT__
	 * Funcao para tratamento de dados quer serao inseridos
	 * @param string 	$table tabela selecionado
	 * @param array 	$field campos que quer inserir
	 * @param array 	$value_field valor para o campo selecionado
	 * @return function query__execute que ira executar a query
	 */
	public static function __INSERT__($table, $field,$value_field, $source_table, $clause = NULL)
	{
		if ((is_array($field)))
		{
			
			$field =  self::prepare($field);
			
			if (count($field) == count($value_field))
			{
				$__INSERT__ = "INSERT INTO {$table} (" . implode(', ', $field) . ") SELECT " . implode('\', \'', $value_field) . " FROM ".$source_table." ".$clause;
			}
			else
			{
				trigger_error("Um Erro foi encontrado em sua query, o numero campos nao correspondem aos numeros de valores para o mesmo!.");
				return;
			}
			
		}
		else
		{
			$__INSERT__ = "INSERT INTO {$table} (" . trim($field) . ") SELECT " . trim($value_field) . " FROM ".$source_table." ".$clause;
		}
		
		return self::query__execute($__INSERT__);
	}
	
	/**
	 * __UPDATE
	 * Funcao para tratamento de dados quer serao atualizados
	 * @param string 	$table tabela selecionado
	 * @param array 	$field campos que quer atualizar
	 * @param array 	$new_value_field  novo valor para o campo selecionado
	 * @param string 	$clause complemento da query
	 * @return function query__execute que ira executar a query
	 */
	public static function __UPDATE($table, $field, $new_value_field, $clause = NULL)
	{
		if ((is_array($field)) and (is_array($new_value_field)))
		{

			$new_value_field =  self::prepare($new_value_field);
			
			for ($i = "0"; $i < count($field); $i++)
			{
				$set_values[$i] = trim($field[$i]) . " = '" . $new_value_field[$i] . "'  ";
			}
			
			if (count($field) == count($new_value_field))
			{
				$__UPDATE = "UPDATE {$table} SET " . implode(', ', $set_values) . " " . $clause;
			}
			else
			{
				trigger_error("Um Erro foi encontrado em sua query, o numero campos nao correspondem aos numeros de valores para o mesmo!.");
				return;
			}
			
		}
		else
		{
			$__UPDATE = "UPDATE {$table} SET " . trim($field) . " = '" . $new_value_field . "' " . $clause;
		}
		
		return self::query__execute($__UPDATE);
		
	}
	
	/**
	 * __DELETE
	 * Funcao para tratamento de dados quer serao atualizados
	 * @param string $table tabela selecionado
	 * @param string $where condicao para deletar a tabela
	 * @return function query__execute que ira executar a query
	 */
	public static function __DELETE($table, $where)
	{
		$__DELETE = "DELETE FROM {$table} WHERE {$where}";
		return self::query__execute($__DELETE);
	}
	
	/**
	 * query__execute
	 * Funcao para tratamento de dados quer serao atualizados
	 * @param string $query query a ser executada
	 * @param string $msg mensagem de retorno se ouver sucesso
	 * @return string 	queryString com o sql executado
	 */
	private static function query__execute($query,$__FUNCTION__ = "")
	{
		try
		{
			$query = self::$conn->prepare($query);
			if ($query && $query->execute())
			{			
				self::$success = true;
				self::$lastInsertId = self::$conn->lastInsertId();
			}
			
		}
		catch (Exception $e)
		{
			self::$success = false;
			echo "<div class='error'> <i>Error Found</i> : " . $e->getMessage() . "</div>";
		}
		
		return array("Success"=>self::$success,"queryString" => $query->queryString, "rowCount" => $query->rowCount,"columnCount" => $query->columnCount);
	}
	
	private static function trim_array(&$value)
	{
		return trim($value);
	}
	private static function addslashes_array(&$value)
	{
		return addslashes($value);
	}
	
	private static function prepare($str)
	{
		$str = array_map("self::trim_array", $str);
		$str = array_map("self::addslashes_array",$str);
		$str = preg_replace('/\s(?=\s)/', '', $str);
		$str = preg_replace('/[\n\r\t]/', ' ', $str);
		$str = preg_replace('/"/', "'", $str);
		
		return $str;

	}

}


define(SERVER_NAME, $_SERVER['SERVER_NAME']);

$db_host = "localhost";
$db_user = "observat_user";
$db_pass = "f17b91";
$db_name = "observat_data";

if (SERVER_NAME == "observatoriodotabaco")
{
	$db_host = "observatoriodotabaco";
	$db_user = "root";
	$db_pass = "";
	$db_name = "observ";
}



$DB_query = new DB__query($db_host, $db_user, $db_pass, $db_name);