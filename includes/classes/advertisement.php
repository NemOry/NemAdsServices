<?php 

/* 
	BY NEMORY OLIVER MARTINEZ - nemoryoliver@gmail.com
*/

require_once(INCLUDES_PATH.DS."config.php");
require_once(CLASSES_PATH.DS."database.php");

class Advertisement extends DatabaseObject
{
	protected static $table_name 	= T_ADVERTISEMENTS;
	protected static $col_id 		= C_ADVERTISEMENT_ID;

	protected static $fields = array
									(
										C_ADVERTISEMENT_USERID, 
										C_ADVERTISEMENT_IMAGE, 
										C_ADVERTISEMENT_TEXT, 
										C_ADVERTISEMENT_URL,
										C_ADVERTISEMENT_LAUNCHIN, 
										C_ADVERTISEMENT_APPNAME, 
										C_ADVERTISEMENT_APPVERSION, 
										C_ADVERTISEMENT_TIMER, 
										C_ADVERTISEMENT_CLICKED, 
										C_ADVERTISEMENT_BGCOLOR, 
										C_ADVERTISEMENT_TEXTCOLOR
									);

	public $id;
	public $userid 			= "";
	public $image 			= "";
	public $text 			= "";
	public $url 			= "";
	public $launchin 		= "";
	public $appname 		= "";
	public $appversion 		= "";
	public $timer 			= "";
	public $clicked 		= "";
	public $bgcolor 		= "";
	public $textcolor 		= "";

	protected static function instantiate($record)
	{
		$this_class = new self;

		$this_class->id 		= $record[C_ADVERTISEMENT_ID];
		$this_class->userid 	= $record[C_ADVERTISEMENT_USERID];
		$this_class->image 		= $record[C_ADVERTISEMENT_IMAGE];
		$this_class->text 		= $record[C_ADVERTISEMENT_TEXT];
		$this_class->url 		= $record[C_ADVERTISEMENT_URL];
		$this_class->launchin 	= $record[C_ADVERTISEMENT_LAUNCHIN];
		$this_class->appname 	= $record[C_ADVERTISEMENT_APPNAME];
		$this_class->appversion = $record[C_ADVERTISEMENT_APPVERSION];
		$this_class->timer 		= $record[C_ADVERTISEMENT_TIMER];
		$this_class->clicked 	= $record[C_ADVERTISEMENT_CLICKED];
		$this_class->bgcolor 	= $record[C_ADVERTISEMENT_BGCOLOR];
		$this_class->textcolor 	= $record[C_ADVERTISEMENT_TEXTCOLOR];

		return $this_class;
	}

	public function create()
	{
		global $db;

		$sql = "INSERT INTO ".self::$table_name." (";

		$fieldIndex = 0;

		foreach (self::$fields as $field) 
		{
			$fieldIndex++;

			$endstring = ",";

			if($fieldIndex == count(self::$fields))
			{
				$endstring = "";
			}

			$sql .= $field.$endstring;
		}

		// ------------------------------------------------------------- //

		$sql .=") VALUES (";

		$classpropertycount = count(get_object_vars($this));

		$ignoreFields = array(self::$col_id);

		$classIndex = 0;

		foreach ($this as $property => $value) 
		{
			$classIndex++;

			$endstring = ",";

			if($classIndex == ($classpropertycount - count($ignoreFields)) + 1)
			{
				$endstring = "";
			}

			if(!in_array($property, $ignoreFields))
			{
				$sql .= "'".$db->escape_string($value)."'".$endstring;
			}
		}

		$sql .=")";

		// ------------------------------------------------------------- //

		if($db->query($sql))
		{
			$this->id = $db->get_last_id();
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	public function update()
	{
		global $db;

		$sql = "UPDATE ".self::$table_name." SET ";

		$classpropertycount = count(get_object_vars($this));

		$ignoreFields = array(self::$col_id);

		$classIndex = 0;

		foreach ($this as $property => $value) 
		{
			$classIndex++;

			$endstring = ",";

			if($classIndex == ($classpropertycount - count($ignoreFields)) + 1)
			{
				$endstring = "";
			}

			if(!in_array($property, $ignoreFields))
			{
				$sql .= $property."='".$db->escape_string($value)."'".$endstring;
			}
		}


		$sql .=" WHERE " . self::$col_id . "=" . $db->escape_string($this->id) 				. "";

		$db->query($sql);

		return ($db->get_affected_rows() == 1) ? true : false;
	}

	public function delete()
	{
		global $db;

		$sql = "DELETE FROM " . self::$table_name . " WHERE " . self::$col_id . "=" . $this->id . "";
		$db->query($sql);

		return ($db->get_affected_rows() == 1) ? true : false;
	}

	public static function get_all_by_userid($id)
	{
		global $db;
		$id = $db->escape_string($id);

		$sql = "SELECT * FROM " . self::$table_name;
		$sql .= " WHERE ".C_ADVERTISEMENT_USERID." = ".$id;

		$result = self::get_by_sql($sql);
		
		return !empty($result) ? $result : null;
	}
}

?>