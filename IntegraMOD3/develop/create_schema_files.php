<?php
/**
*
* @package phpBB3
* @copyright (c) 2006 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
* This file creates new schema files for every database.
* The filenames will be prefixed with an underscore to not overwrite the current schema files.
*
* If you overwrite the original schema files please make sure you save the file with UNIX linefeeds.
*/

$schema_path = dirname(__FILE__) . '/../install/schemas/';

if (!is_writable($schema_path))
{
	die('Schema path not writable');
}

$schema_data = get_schema_struct();
$dbms_type_map = array(
	'mysql_80'	=> array(
		'INT:'		=> 'int(%d)',
		'BINT'		=> 'bigint(20)',
		'UINT'		=> 'mediumint(8) UNSIGNED',
		'UINT:'		=> 'int(%d) UNSIGNED',
		'TINT:'		=> 'tinyint(%d)',
		'USINT'		=> 'smallint(4) UNSIGNED',
		'BOOL'		=> 'tinyint(1) UNSIGNED',
		'VCHAR'		=> 'varchar(255)',
		'VCHAR:'	=> 'varchar(%d)',
		'CHAR:'		=> 'char(%d)',
		'XSTEXT'	=> 'text',
		'XSTEXT_UNI'=> 'varchar(100)',
		'STEXT'		=> 'text',
		'STEXT_UNI'	=> 'varchar(255)',
		'TEXT'		=> 'text',
		'TEXT_UNI'	=> 'text',
		'MTEXT'		=> 'mediumtext',
		'MTEXT_UNI'	=> 'mediumtext',
		'TIMESTAMP'	=> 'int(11) UNSIGNED',
		'DECIMAL'	=> 'decimal(5,2)',
		'DECIMAL:'	=> 'decimal(%d,2)',
		'PDECIMAL'	=> 'decimal(6,3)',
		'PDECIMAL:'	=> 'decimal(%d,3)',
		'VCHAR_UNI'	=> 'varchar(255)',
		'VCHAR_UNI:'=> 'varchar(%d)',
		'VCHAR_CI'	=> 'varchar(255)',
		'VARBINARY'	=> 'varbinary(255)',
	),

	'mysql_40'	=> array(
		'INT:'		=> 'int(%d)',
		'BINT'		=> 'bigint(20)',
		'UINT'		=> 'mediumint(8) UNSIGNED',
		'UINT:'		=> 'int(%d) UNSIGNED',
		'TINT:'		=> 'tinyint(%d)',
		'USINT'		=> 'smallint(4) UNSIGNED',
		'BOOL'		=> 'tinyint(1) UNSIGNED',
		'VCHAR'		=> 'varbinary(255)',
		'VCHAR:'	=> 'varbinary(%d)',
		'CHAR:'		=> 'binary(%d)',
		'XSTEXT'	=> 'blob',
		'XSTEXT_UNI'=> 'blob',
		'STEXT'		=> 'blob',
		'STEXT_UNI'	=> 'blob',
		'TEXT'		=> 'blob',
		'TEXT_UNI'	=> 'blob',
		'MTEXT'		=> 'mediumblob',
		'MTEXT_UNI'	=> 'mediumblob',
		'TIMESTAMP'	=> 'int(11) UNSIGNED',
		'DECIMAL'	=> 'decimal(5,2)',
		'DECIMAL:'	=> 'decimal(%d,2)',
		'PDECIMAL'	=> 'decimal(6,3)',
		'PDECIMAL:'	=> 'decimal(%d,3)',
		'VCHAR_UNI'	=> 'blob',
		'VCHAR_UNI:'=> array('varbinary(%d)', 'limit' => array('mult', 3, 255, 'blob')),
		'VCHAR_CI'	=> 'blob',
		'VARBINARY'	=> 'varbinary(255)',
	),

	'firebird'	=> array(
		'INT:'		=> 'INTEGER',
		'BINT'		=> 'DOUBLE PRECISION',
		'UINT'		=> 'INTEGER',
		'UINT:'		=> 'INTEGER',
		'TINT:'		=> 'INTEGER',
		'USINT'		=> 'INTEGER',
		'BOOL'		=> 'INTEGER',
		'VCHAR'		=> 'VARCHAR(255) CHARACTER SET NONE',
		'VCHAR:'	=> 'VARCHAR(%d) CHARACTER SET NONE',
		'CHAR:'		=> 'CHAR(%d) CHARACTER SET NONE',
		'XSTEXT'	=> 'BLOB SUB_TYPE TEXT CHARACTER SET NONE',
		'STEXT'		=> 'BLOB SUB_TYPE TEXT CHARACTER SET NONE',
		'TEXT'		=> 'BLOB SUB_TYPE TEXT CHARACTER SET NONE',
		'MTEXT'		=> 'BLOB SUB_TYPE TEXT CHARACTER SET NONE',
		'XSTEXT_UNI'=> 'VARCHAR(100) CHARACTER SET UTF8',
		'STEXT_UNI'	=> 'VARCHAR(255) CHARACTER SET UTF8',
		'TEXT_UNI'	=> 'BLOB SUB_TYPE TEXT CHARACTER SET UTF8',
		'MTEXT_UNI'	=> 'BLOB SUB_TYPE TEXT CHARACTER SET UTF8',
		'TIMESTAMP'	=> 'INTEGER',
		'DECIMAL'	=> 'DOUBLE PRECISION',
		'DECIMAL:'	=> 'DOUBLE PRECISION',
		'PDECIMAL'	=> 'DOUBLE PRECISION',
		'PDECIMAL:'	=> 'DOUBLE PRECISION',
		'VCHAR_UNI'	=> 'VARCHAR(255) CHARACTER SET UTF8',
		'VCHAR_UNI:'=> 'VARCHAR(%d) CHARACTER SET UTF8',
		'VCHAR_CI'	=> 'VARCHAR(255) CHARACTER SET UTF8',
		'VARBINARY'	=> 'CHAR(255) CHARACTER SET NONE',
	),

	'mssql'		=> array(
		'INT:'		=> '[int]',
		'BINT'		=> '[float]',
		'UINT'		=> '[int]',
		'UINT:'		=> '[int]',
		'TINT:'		=> '[int]',
		'USINT'		=> '[int]',
		'BOOL'		=> '[int]',
		'VCHAR'		=> '[varchar] (255)',
		'VCHAR:'	=> '[varchar] (%d)',
		'CHAR:'		=> '[char] (%d)',
		'XSTEXT'	=> '[varchar] (1000)',
		'STEXT'		=> '[varchar] (3000)',
		'TEXT'		=> '[varchar] (8000)',
		'MTEXT'		=> '[text]',
		'XSTEXT_UNI'=> '[varchar] (100)',
		'STEXT_UNI'	=> '[varchar] (255)',
		'TEXT_UNI'	=> '[varchar] (4000)',
		'MTEXT_UNI'	=> '[text]',
		'TIMESTAMP'	=> '[int]',
		'DECIMAL'	=> '[float]',
		'DECIMAL:'	=> '[float]',
		'PDECIMAL'	=> '[float]',
		'PDECIMAL:'	=> '[float]',
		'VCHAR_UNI'	=> '[varchar] (255)',
		'VCHAR_UNI:'=> '[varchar] (%d)',
		'VCHAR_CI'	=> '[varchar] (255)',
		'VARBINARY'	=> '[varchar] (255)',
	),

	'oracle'	=> array(
		'INT:'		=> 'number(%d)',
		'BINT'		=> 'number(20)',
		'UINT'		=> 'number(8)',
		'UINT:'		=> 'number(%d)',
		'TINT:'		=> 'number(%d)',
		'USINT'		=> 'number(4)',
		'BOOL'		=> 'number(1)',
		'VCHAR'		=> 'varchar2(255)',
		'VCHAR:'	=> 'varchar2(%d)',
		'CHAR:'		=> 'char(%d)',
		'XSTEXT'	=> 'varchar2(1000)',
		'STEXT'		=> 'varchar2(3000)',
		'TEXT'		=> 'clob',
		'MTEXT'		=> 'clob',
		'XSTEXT_UNI'=> 'varchar2(300)',
		'STEXT_UNI'	=> 'varchar2(765)',
		'TEXT_UNI'	=> 'clob',
		'MTEXT_UNI'	=> 'clob',
		'TIMESTAMP'	=> 'number(11)',
		'DECIMAL'	=> 'number(5, 2)',
		'DECIMAL:'	=> 'number(%d, 2)',
		'PDECIMAL'	=> 'number(6, 3)',
		'PDECIMAL:'	=> 'number(%d, 3)',
		'VCHAR_UNI'	=> 'varchar2(765)',
		'VCHAR_UNI:'=> array('varchar2(%d)', 'limit' => array('mult', 3, 765, 'clob')),
		'VCHAR_CI'	=> 'varchar2(255)',
		'VARBINARY'	=> 'raw(255)',
	),

	'sqlite'	=> array(
		'INT:'		=> 'int(%d)',
		'BINT'		=> 'bigint(20)',
		'UINT'		=> 'INTEGER UNSIGNED', //'mediumint(8) UNSIGNED',
		'UINT:'		=> 'INTEGER UNSIGNED', // 'int(%d) UNSIGNED',
		'TINT:'		=> 'tinyint(%d)',
		'USINT'		=> 'INTEGER UNSIGNED', //'mediumint(4) UNSIGNED',
		'BOOL'		=> 'INTEGER UNSIGNED', //'tinyint(1) UNSIGNED',
		'VCHAR'		=> 'varchar(255)',
		'VCHAR:'	=> 'varchar(%d)',
		'CHAR:'		=> 'char(%d)',
		'XSTEXT'	=> 'text(65535)',
		'STEXT'		=> 'text(65535)',
		'TEXT'		=> 'text(65535)',
		'MTEXT'		=> 'mediumtext(16777215)',
		'XSTEXT_UNI'=> 'text(65535)',
		'STEXT_UNI'	=> 'text(65535)',
		'TEXT_UNI'	=> 'text(65535)',
		'MTEXT_UNI'	=> 'mediumtext(16777215)',
		'TIMESTAMP'	=> 'INTEGER UNSIGNED', //'int(11) UNSIGNED',
		'DECIMAL'	=> 'decimal(5,2)',
		'DECIMAL:'	=> 'decimal(%d,2)',
		'PDECIMAL'	=> 'decimal(6,3)',
		'PDECIMAL:'	=> 'decimal(%d,3)',
		'VCHAR_UNI'	=> 'varchar(255)',
		'VCHAR_UNI:'=> 'varchar(%d)',
		'VCHAR_CI'	=> 'varchar(255)',
		'VARBINARY'	=> 'blob',
	),

	'postgres'	=> array(
		'INT:'		=> 'INT4',
		'BINT'		=> 'INT8',
		'UINT'		=> 'INT4', // unsigned
		'UINT:'		=> 'INT4', // unsigned
		'USINT'		=> 'INT2', // unsigned
		'BOOL'		=> 'INT2', // unsigned
		'TINT:'		=> 'INT2',
		'VCHAR'		=> 'varchar(255)',
		'VCHAR:'	=> 'varchar(%d)',
		'CHAR:'		=> 'char(%d)',
		'XSTEXT'	=> 'varchar(1000)',
		'STEXT'		=> 'varchar(3000)',
		'TEXT'		=> 'varchar(8000)',
		'MTEXT'		=> 'TEXT',
		'XSTEXT_UNI'=> 'varchar(100)',
		'STEXT_UNI'	=> 'varchar(255)',
		'TEXT_UNI'	=> 'varchar(4000)',
		'MTEXT_UNI'	=> 'TEXT',
		'TIMESTAMP'	=> 'INT4', // unsigned
		'DECIMAL'	=> 'decimal(5,2)',
		'DECIMAL:'	=> 'decimal(%d,2)',
		'PDECIMAL'	=> 'decimal(6,3)',
		'PDECIMAL:'	=> 'decimal(%d,3)',
		'VCHAR_UNI'	=> 'varchar(255)',
		'VCHAR_UNI:'=> 'varchar(%d)',
		'VCHAR_CI'	=> 'varchar_ci',
		'VARBINARY'	=> 'bytea',
	),
);

// A list of types being unsigned for better reference in some db's
$unsigned_types = array('UINT', 'UINT:', 'USINT', 'BOOL', 'TIMESTAMP');
$supported_dbms = array('firebird', 'mssql', 'mysql_40', 'mysql_80', 'oracle', 'postgres', 'sqlite');

foreach ($supported_dbms as $dbms)
{
	$schema_data = get_schema_struct();
	if ($dbms == 'mssql')
	{
		foreach ($schema_data as $table_name => $table_data)
		{
			if (!isset($table_data['PRIMARY_KEY']))
			{
				$schema_data[$table_name]['COLUMNS']['mssqlindex'] = array('UINT', NULL, 'auto_increment');
				$schema_data[$table_name]['PRIMARY_KEY'] = 'mssqlindex';
			}
		}
	}

	$fp = fopen($schema_path . $dbms . '_schema.sql', 'wb');

	$line = '';

	// Write Header
	switch ($dbms)
	{
		case 'mysql_40':
		case 'mysql_80':
		case 'firebird':
		case 'sqlite':
			fwrite($fp, "# DO NOT EDIT THIS FILE, IT IS GENERATED\n");
			fwrite($fp, "#\n");
			fwrite($fp, "# To change the contents of this file, edit\n");
			fwrite($fp, "# phpBB/develop/create_schema_files.php and\n");
			fwrite($fp, "# run it.\n");
		break;

		case 'mssql':
		case 'oracle':
		case 'postgres':
			fwrite($fp, "/*\n");
			fwrite($fp, " * DO NOT EDIT THIS FILE, IT IS GENERATED\n");
			fwrite($fp, " *\n");
			fwrite($fp, " * To change the contents of this file, edit\n");
			fwrite($fp, " * phpBB/develop/create_schema_files.php and\n");
			fwrite($fp, " * run it.\n");
			fwrite($fp, " */\n\n");
		break;
	}

	switch ($dbms)
	{
		case 'firebird':
			$line .= custom_data('firebird') . "\n";
		break;

		case 'sqlite':
			$line .= "BEGIN TRANSACTION;\n\n";
		break;

		case 'oracle':
			$line .= custom_data('oracle') . "\n";
		break;

		case 'postgres':
			$line .= "BEGIN;\n\n";
			$line .= custom_data('postgres') . "\n";
		break;
	}

	fwrite($fp, $line);

	foreach ($schema_data as $table_name => $table_data)
	{
		// Write comment about table
		switch ($dbms)
		{
			case 'mysql_40':
			case 'mysql_80':
			case 'firebird':
			case 'sqlite':
				fwrite($fp, "# Table: '{$table_name}'\n");
			break;

			case 'mssql':
			case 'oracle':
			case 'postgres':
				fwrite($fp, "/*\n\tTable: '{$table_name}'\n*/\n");
			break;
		}

		// Create Table statement
		$generator = $textimage = false;
		$line = '';

		switch ($dbms)
		{
			case 'mysql_40':
			case 'mysql_80':
			case 'firebird':
			case 'oracle':
			case 'sqlite':
			case 'postgres':
				$line = "CREATE TABLE {$table_name} (\n";
			break;

			case 'mssql':
				$line = "CREATE TABLE [{$table_name}] (\n";
			break;
		}

		// Table specific so we don't get overlap
		$modded_array = array();

		// Write columns one by one...
		foreach ($table_data['COLUMNS'] as $column_name => $column_data)
		{
			if (strlen($column_name) > 40)
			{
				trigger_error("Column name '$column_name' on table '$table_name' is too long. The maximum is 40 characters.", E_USER_ERROR);
			}
			if (isset($column_data[2]) && $column_data[2] == 'auto_increment' && strlen($column_name) > 26) // "${column_name}_gen"
			{
				trigger_error("Index name '${column_name}_gen' on table '$table_name' is too long. The maximum is 40 characters.", E_USER_ERROR);
			}

			// Get type
			if (strpos($column_data[0], ':') !== false)
			{
				list($orig_column_type, $column_length) = explode(':', $column_data[0]);
				if (!is_array($dbms_type_map[$dbms][$orig_column_type . ':']))
				{
					$column_type = sprintf($dbms_type_map[$dbms][$orig_column_type . ':'], $column_length);
				}
				else
				{
					if (isset($dbms_type_map[$dbms][$orig_column_type . ':']['rule']))
					{
						switch ($dbms_type_map[$dbms][$orig_column_type . ':']['rule'][0])
						{
							case 'div':
								$column_length /= $dbms_type_map[$dbms][$orig_column_type . ':']['rule'][1];
								$column_length = ceil($column_length);
								$column_type = sprintf($dbms_type_map[$dbms][$orig_column_type . ':'][0], $column_length);
							break;
						}
					}

					if (isset($dbms_type_map[$dbms][$orig_column_type . ':']['limit']))
					{
						switch ($dbms_type_map[$dbms][$orig_column_type . ':']['limit'][0])
						{
							case 'mult':
								$column_length *= $dbms_type_map[$dbms][$orig_column_type . ':']['limit'][1];
								if ($column_length > $dbms_type_map[$dbms][$orig_column_type . ':']['limit'][2])
								{
									$column_type = $dbms_type_map[$dbms][$orig_column_type . ':']['limit'][3];
									$modded_array[$column_name] = $column_type;
								}
								else
								{
									$column_type = sprintf($dbms_type_map[$dbms][$orig_column_type . ':'][0], $column_length);
								}
							break;
						}
					}
				}
				$orig_column_type .= ':';
			}
			else
			{
				$orig_column_type = $column_data[0];
				$column_type = $dbms_type_map[$dbms][$column_data[0]];
				if ($column_type == 'text' || $column_type == 'blob')
				{
					$modded_array[$column_name] = $column_type;
				}
			}

			// Adjust default value if db-dependant specified
			if (is_array($column_data[1]))
			{
				$column_data[1] = (isset($column_data[1][$dbms])) ? $column_data[1][$dbms] : $column_data[1]['default'];
			}

			switch ($dbms)
			{
				case 'mysql_40':
				case 'mysql_80':
					$line .= "\t{$column_name} {$column_type} ";

					// For hexadecimal values do not use single quotes
					if (!is_null($column_data[1]) && substr($column_type, -4) !== 'text' && substr($column_type, -4) !== 'blob')
					{
						$line .= (strpos($column_data[1], '0x') === 0) ? "DEFAULT {$column_data[1]} " : "DEFAULT '{$column_data[1]}' ";
					}
					if (isset($column_data[2]) && $column_data[2] === 'null')
					{
						$line .= 'NULL';
					}
					else
					{
						$line .= 'NOT NULL';
					}

					if (isset($column_data[2]))
					{
						if ($column_data[2] == 'auto_increment')
						{
							$line .= ' auto_increment';
						}
						else if ($dbms === 'mysql_80' && $column_data[2] == 'true_sort')
						{
							$line .= ' COLLATE utf8mb4_general_ci';
						}
					}

					$line .= ",\n";
				break;

				case 'sqlite':
					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$line .= "\t{$column_name} INTEGER PRIMARY KEY ";
						$generator = $column_name;
					}
					else
					{
						$line .= "\t{$column_name} {$column_type} ";
					}

					if (isset($column_data[2]) && $column_data[2] === 'null')
					{
						$line .= 'NULL ';
					}
					else
					{
						$line .= 'NOT NULL ';
					}

					$line .= (!is_null($column_data[1])) ? "DEFAULT '{$column_data[1]}'" : '';
					$line .= ",\n";
				break;

				case 'firebird':
					$line .= "\t{$column_name} {$column_type} ";

					if (!is_null($column_data[1]))
					{
						$line .= 'DEFAULT ' . ((is_numeric($column_data[1])) ? $column_data[1] : "'{$column_data[1]}'") . ' ';
					}

					if (isset($column_data[2]) && $column_data[2] === 'null')
					{
						$line .= 'NULL';
					}
					else
					{
						$line .= 'NOT NULL';
					}

					// This is a UNICODE column and thus should be given it's fair share
					if (preg_match('/^X?STEXT_UNI|VCHAR_(CI|UNI:?)/', $column_data[0]))
					{
						$line .= ' COLLATE UNICODE';
					}

					$line .= ",\n";

					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$generator = $column_name;
					}
				break;

				case 'mssql':
					if ($column_type == '[text]')
					{
						$textimage = true;
					}

					$line .= "\t[{$column_name}] {$column_type} ";

					if (!is_null($column_data[1]))
					{
						// For hexadecimal values do not use single quotes
						if (strpos($column_data[1], '0x') === 0)
						{
							$line .= 'DEFAULT (' . $column_data[1] . ') ';
						}
						else
						{
							$line .= 'DEFAULT (' . ((is_numeric($column_data[1])) ? $column_data[1] : "'{$column_data[1]}'") . ') ';
						}
					}

					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$line .= 'IDENTITY (1, 1) ';
					}

					if (isset($column_data[2]) && $column_data[2] === 'null')
					{
						$line .= 'NULL';
					}
					else
					{
						$line .= 'NOT NULL';
					}

					$line .= " ,\n";
				break;

				case 'oracle':
					$line .= "\t{$column_name} {$column_type} ";
					$line .= (!is_null($column_data[1])) ? "DEFAULT '{$column_data[1]}' " : '';

					// In Oracle empty strings ('') are treated as NULL.
					// Therefore in oracle we allow NULL's for all DEFAULT '' entries
					if (isset($column_data[2]) && $column_data[2] === 'null')
					{
						$line .= "NULL,\n";
					}
					else
					{
						$line .= ($column_data[1] === '') ? ",\n" : "NOT NULL,\n";
					}

					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$generator = $column_name;
					}
				break;

				case 'postgres':
					$line .= "\t{$column_name} {$column_type} ";

					if (isset($column_data[2]) && $column_data[2] == 'auto_increment')
					{
						$line .= "DEFAULT nextval('{$table_name}_seq'),\n";

						// Make sure the sequence will be created before creating the table
						$line = "CREATE SEQUENCE {$table_name}_seq;\n\n" . $line;
					}
					else
					{
						$line .= (!is_null($column_data[1])) ? "DEFAULT '{$column_data[1]}' " : '';

						if (isset($column_data[2]) && $column_data[2] === 'null')
						{
							$line .= "NULL";
						}
						else
						{
							$line .= "NOT NULL";
						}

						// Unsigned? Then add a CHECK contraint
						if (in_array($orig_column_type, $unsigned_types))
						{
							$line .= " CHECK ({$column_name} >= 0)";
						}

						$line .= ",\n";
					}
				break;
			}
		}

		switch ($dbms)
		{
			case 'firebird':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n);;\n\n";
			break;

			case 'mssql':
				$line = substr($line, 0, -2);
				$line .= "\n)";// ON [PRIMARY]" . (($textimage) ? ' TEXTIMAGE_ON [PRIMARY]' : '') . "\n";
				$line .= "GO\n\n";
			break;
		}

		// Write primary key
		if (isset($table_data['PRIMARY_KEY']))
		{
			if (!is_array($table_data['PRIMARY_KEY']))
			{
				$table_data['PRIMARY_KEY'] = array($table_data['PRIMARY_KEY']);
			}

			switch ($dbms)
			{
				case 'mysql_40':
				case 'mysql_80':
				case 'postgres':
					$line .= "\tPRIMARY KEY (" . implode(', ', $table_data['PRIMARY_KEY']) . "),\n";
				break;

				case 'firebird':
					$line .= "ALTER TABLE {$table_name} ADD PRIMARY KEY (" . implode(', ', $table_data['PRIMARY_KEY']) . ");;\n\n";
				break;

				case 'sqlite':
					if ($generator === false || !in_array($generator, $table_data['PRIMARY_KEY']))
					{
						$line .= "\tPRIMARY KEY (" . implode(', ', $table_data['PRIMARY_KEY']) . "),\n";
					}
				break;

				case 'mssql':
					$line .= "ALTER TABLE [{$table_name}] WITH NOCHECK ADD \n";
					$line .= "\tCONSTRAINT [PK_{$table_name}] PRIMARY KEY  CLUSTERED \n";
					$line .= "\t(\n";
					$line .= "\t\t[" . implode("],\n\t\t[", $table_data['PRIMARY_KEY']) . "]\n";
					$line .= "\t)\n";
					$line .= "GO\n\n";
				break;

				case 'oracle':
					$line .= "\tCONSTRAINT pk_{$table_name} PRIMARY KEY (" . implode(', ', $table_data['PRIMARY_KEY']) . "),\n";
				break;
			}
		}

		switch ($dbms)
		{
			case 'oracle':
				// UNIQUE contrains to be added?
				if (isset($table_data['KEYS']))
				{
					foreach ($table_data['KEYS'] as $key_name => $key_data)
					{
						if (!is_array($key_data[1]))
						{
							$key_data[1] = array($key_data[1]);
						}

						if ($key_data[0] == 'UNIQUE')
						{
							$line .= "\tCONSTRAINT u_phpbb_{$key_name} UNIQUE (" . implode(', ', $key_data[1]) . "),\n";
						}
					}
				}

				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n)\n/\n\n";
			break;

			case 'postgres':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n);\n\n";
			break;

			case 'sqlite':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n);\n\n";
			break;
		}

		// Write Keys
		if (isset($table_data['KEYS']))
		{
			foreach ($table_data['KEYS'] as $key_name => $key_data)
			{
				if (!is_array($key_data[1]))
				{
					$key_data[1] = array($key_data[1]);
				}

				if (strlen($table_name . $key_name) > 40)
				{
					trigger_error("Index name '${table_name}_$key_name' on table '$table_name' is too long. The maximum is 40 characters.", E_USER_ERROR);
				}

				switch ($dbms)
				{
					case 'mysql_40':
					case 'mysql_80':
						$line .= ($key_data[0] == 'INDEX') ? "\tKEY" : '';
						$line .= ($key_data[0] == 'UNIQUE') ? "\tUNIQUE" : '';
						foreach ($key_data[1] as $key => $col_name)
						{
							if (isset($modded_array[$col_name]))
							{
								switch ($modded_array[$col_name])
								{
									case 'text':
									case 'blob':
										$key_data[1][$key] = $col_name . '(255)';
									break;
								}
							}
						}
						$line .= ' ' . $key_name . ' (' . implode(', ', $key_data[1]) . "),\n";
					break;

					case 'firebird':
						$line .= ($key_data[0] == 'INDEX') ? 'CREATE INDEX' : '';
						$line .= ($key_data[0] == 'UNIQUE') ? 'CREATE UNIQUE INDEX' : '';

						$line .= ' ' . $table_name . '_' . $key_name . ' ON ' . $table_name . '(' . implode(', ', $key_data[1]) . ");;\n";
					break;

					case 'mssql':
						$line .= ($key_data[0] == 'INDEX') ? 'CREATE  INDEX' : '';
						$line .= ($key_data[0] == 'UNIQUE') ? 'CREATE  UNIQUE  INDEX' : '';
						$line .= " [{$key_name}] ON [{$table_name}]([" . implode('], [', $key_data[1]) . "])\n";
						$line .= "GO\n\n";
					break;

					case 'oracle':
						if ($key_data[0] == 'UNIQUE')
						{
							continue 2;
						}

						$line .= ($key_data[0] == 'INDEX') ? 'CREATE INDEX' : '';

						$line .= " {$table_name}_{$key_name} ON {$table_name} (" . implode(', ', $key_data[1]) . ")\n";
						$line .= "/\n";
					break;

					case 'sqlite':
						$line .= ($key_data[0] == 'INDEX') ? 'CREATE INDEX' : '';
						$line .= ($key_data[0] == 'UNIQUE') ? 'CREATE UNIQUE INDEX' : '';

						$line .= " {$table_name}_{$key_name} ON {$table_name} (" . implode(', ', $key_data[1]) . ");\n";
					break;

					case 'postgres':
						$line .= ($key_data[0] == 'INDEX') ? 'CREATE INDEX' : '';
						$line .= ($key_data[0] == 'UNIQUE') ? 'CREATE UNIQUE INDEX' : '';

						$line .= " {$table_name}_{$key_name} ON {$table_name} (" . implode(', ', $key_data[1]) . ");\n";
					break;
				}
			}
		}

		switch ($dbms)
		{
			case 'mysql_40':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n);\n\n";
			break;

			case 'mysql_80':
				// Remove last line delimiter...
				$line = substr($line, 0, -2);
				$line .= "\n) CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`;\n\n";
			break;

			// Create Generator
			case 'firebird':
				if ($generator !== false)
				{
					$line .= "\nCREATE GENERATOR {$table_name}_gen;;\n";
					$line .= 'SET GENERATOR ' . $table_name . "_gen TO 0;;\n\n";

					$line .= 'CREATE TRIGGER t_' . $table_name . ' FOR ' . $table_name . "\n";
					$line .= "BEFORE INSERT\nAS\nBEGIN\n";
					$line .= "\tNEW.{$generator} = GEN_ID({$table_name}_gen, 1);\nEND;;\n\n";
				}
			break;

			case 'oracle':
				if ($generator !== false)
				{
					$line .= "\nCREATE SEQUENCE {$table_name}_seq\n/\n\n";

					$line .= "CREATE OR REPLACE TRIGGER t_{$table_name}\n";
					$line .= "BEFORE INSERT ON {$table_name}\n";
					$line .= "FOR EACH ROW WHEN (\n";
					$line .= "\tnew.{$generator} IS NULL OR new.{$generator} = 0\n";
					$line .= ")\nBEGIN\n";
					$line .= "\tSELECT {$table_name}_seq.nextval\n";
					$line .= "\tINTO :new.{$generator}\n";
					$line .= "\tFROM dual;\nEND;\n/\n\n";
				}
			break;
		}

		fwrite($fp, $line . "\n");
	}

	$line = '';

	// Write custom function at the end for some db's
	switch ($dbms)
	{
		case 'mssql':
			// No need to do this, no transaction support for schema changes
			//$line = "\nCOMMIT\nGO\n\n";
		break;

		case 'sqlite':
			$line = "\nCOMMIT;";
		break;

		case 'postgres':
			$line = "\nCOMMIT;";
		break;
	}

	fwrite($fp, $line);
	fclose($fp);
}















/**
* Define the basic structure
* The format:
*		array('{TABLE_NAME}' => {TABLE_DATA})
*		{TABLE_DATA}:
*			COLUMNS = array({column_name} = array({column_type}, {default}, {auto_increment}))
*			PRIMARY_KEY = {column_name(s)}
*			KEYS = array({key_name} = array({key_type}, {column_name(s)})),
*
*	Column Types:
*	INT:x		=> SIGNED int(x)
*	BINT		=> BIGINT
*	UINT		=> mediumint(8) UNSIGNED
*	UINT:x		=> int(x) UNSIGNED
*	TINT:x		=> tinyint(x)
*	USINT		=> smallint(4) UNSIGNED (for _order columns)
*	BOOL		=> tinyint(1) UNSIGNED
*	VCHAR		=> varchar(255)
*	CHAR:x		=> char(x)
*	XSTEXT_UNI	=> text for storing 100 characters (topic_title for example)
*	STEXT_UNI	=> text for storing 255 characters (normal input field with a max of 255 single-byte chars) - same as VCHAR_UNI
*	TEXT_UNI	=> text for storing 3000 characters (short text, descriptions, comments, etc.)
*	MTEXT_UNI	=> mediumtext (post text, large text)
*	VCHAR:x		=> varchar(x)
*	TIMESTAMP	=> int(11) UNSIGNED
*	DECIMAL		=> decimal number (5,2)
*	DECIMAL:	=> decimal number (x,2)
*	PDECIMAL	=> precision decimal number (6,3)
*	PDECIMAL:	=> precision decimal number (x,3)
*	VCHAR_UNI	=> varchar(255) BINARY
*	VCHAR_CI	=> varchar_ci for postgresql, others VCHAR
*/

/** Create Tables */

function get_schema_struct()
{
	$schema_data = array();

	$schema_data['phpbb_acl_groups'] = array(
		'COLUMNS'		=> array(
			'group_id'			=> array('UINT', 0),
			'forum_id'			=> array('UINT', 0),
			'auth_option_id'	=> array('UINT', 0),
			'auth_role_id'		=> array('UINT', 0),
			'auth_setting'		=> array('TINT:2', 0),
			'is_kb'				=> array('BOOL', 0),			
		),
		'KEYS'			=> array(
			'group_id'		=> array('INDEX', 'group_id'),
			'auth_opt_id'	=> array('INDEX', 'auth_option_id'),
			'auth_role_id'	=> array('INDEX', 'auth_role_id'),
		),
	);

	$schema_data['phpbb_acl_options'] = array(
		'COLUMNS'		=> array(
			'auth_option_id'	=> array('UINT', NULL, 'auto_increment'),
			'auth_option'		=> array('VCHAR:50', ''),
			'is_global'			=> array('BOOL', 0),
			'is_local'			=> array('BOOL', 0),
			'founder_only'		=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'auth_option_id',
		'KEYS'			=> array(
			'auth_option'		=> array('UNIQUE', 'auth_option'),
		),
	);

	$schema_data['phpbb_acl_roles'] = array(
		'COLUMNS'		=> array(
			'role_id'			=> array('UINT', NULL, 'auto_increment'),
			'role_name'			=> array('VCHAR_UNI', ''),
			'role_description'	=> array('TEXT_UNI', ''),
			'role_type'			=> array('VCHAR:10', ''),
			'role_order'		=> array('USINT', 0),
		),
		'PRIMARY_KEY'	=> 'role_id',
		'KEYS'			=> array(
			'role_type'			=> array('INDEX', 'role_type'),
			'role_order'		=> array('INDEX', 'role_order'),
		),
	);

	$schema_data['phpbb_acl_roles_data'] = array(
		'COLUMNS'		=> array(
			'role_id'			=> array('UINT', 0),
			'auth_option_id'	=> array('UINT', 0),
			'auth_setting'		=> array('TINT:2', 0),
		),
		'PRIMARY_KEY'	=> array('role_id', 'auth_option_id'),
		'KEYS'			=> array(
			'ath_op_id'			=> array('INDEX', 'auth_option_id'),
		),
	);

	$schema_data['phpbb_acl_users'] = array(
		'COLUMNS'		=> array(
			'user_id'			=> array('UINT', 0),
			'forum_id'			=> array('UINT', 0),
			'auth_option_id'	=> array('UINT', 0),
			'auth_role_id'		=> array('UINT', 0),
			'auth_setting'		=> array('TINT:2', 0),
			'is_kb'				=> array('BOOL', 0),			
		),
		'KEYS'			=> array(
			'user_id'			=> array('INDEX', 'user_id'),
			'auth_option_id'	=> array('INDEX', 'auth_option_id'),
			'auth_role_id'		=> array('INDEX', 'auth_role_id'),
		),
	);

	$schema_data['phpbb_ads'] = array(
		'COLUMNS'				=> array(
			'ad_id'				=> array('UINT', NULL, 'auto_increment'),
			'ad_name'			=> array('VCHAR', ''),
			'ad_code'			=> array('TEXT_UNI', ''),
			'ad_views'			=> array('BINT', 0),
			'ad_priority'		=> array('BOOL', 5),
			'ad_enabled'		=> array('BOOL', 1),
			'all_forums'		=> array('BOOL', 0),
			'ad_clicks'			=> array('BINT', 0),
			'ad_note'			=> array('MTEXT_UNI', ''),
			'ad_time'			=> array('UINT:11', 0),
			'ad_time_end'		=> array('UINT:11', 0),
			'ad_view_limit'		=> array('BINT', 0),	
			'ad_click_limit'	=> array('BINT', 0),
			'ad_owner'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'ad_id',
		'KEYS'			=> array(
			'ad_priority'			=> array('INDEX', 'ad_priority'),
			'ad_enabled'			=> array('INDEX', 'ad_enabled'),
			'ad_owner'				=> array('INDEX', 'ad_owner'),
		),				
	);

	$schema_data['phpbb_ads_forums'] = array(
		'COLUMNS'		=> array(
			'ad_id'			=> array('UINT', 0),
			'forum_id'		=> array('UINT', 0),
		),
		'KEYS'			=> array(
			'ad_id'			=> array('INDEX', 'ad_id'),
			'forum_id'		=> array('INDEX', 'forum_id'),
		),
	);

	$schema_data['phpbb_ads_groups'] = array(
		'COLUMNS'		=> array(
			'ad_id'			=> array('UINT', 0),
			'group_id'		=> array('UINT', 0),
		),
		'KEYS'			=> array(
			'ad_id'			=> array('INDEX', 'ad_id'),
			'group_id'		=> array('INDEX', 'group_id'),
		),	
	);
	
	$schema_data['phpbb_ads_in_positions'] = array(
		'COLUMNS'		=> array(
			'ad_id'			=> array('UINT', 0),
			'position_id'	=> array('UINT', 0),
			'ad_priority'	=> array('TINT:1', 5),
			'ad_enabled	'	=> array('TINT:1', 1),
			'all_forums	'	=> array('TINT:1', 0),
		),
		'KEYS'			=> array(
			'ad_position'	=> array('INDEX', array('ad_id', 'position_id')),
			'ad_priority'	=> array('INDEX', 'ad_priority'),
			'ad_enabled'	=> array('INDEX', 'ad_enabled'),	
			'all_forums'	=> array('INDEX', 'all_forums'),	
		),	
	);
	
	$schema_data['phpbb_ads_positions'] = array(
		'COLUMNS'		=> array(
			'position_id'	=> array('UINT', NULL, 'auto_increment'),
			'lang_key'		=> array('TEXT_UNI', ''),
		),
		'PRIMARY_KEY'			=> 'position_id',
	);
	
	$schema_data['phpbb_attachments'] = array(
		'COLUMNS'		=> array(
			'attach_id'			=> array('UINT', NULL, 'auto_increment'),
			'post_msg_id'		=> array('UINT', 0),
			'topic_id'			=> array('UINT', 0),
			'in_message'		=> array('BOOL', 0),
			'poster_id'			=> array('UINT', 0),
			'is_orphan'			=> array('BOOL', 1),
			'physical_filename'	=> array('VCHAR', ''),
			'real_filename'		=> array('VCHAR', ''),
			'download_count'	=> array('UINT', 0),
			'attach_comment'	=> array('TEXT_UNI', ''),
			'extension'			=> array('VCHAR:100', ''),
			'mimetype'			=> array('VCHAR:100', ''),
			'filesize'			=> array('UINT:20', 0),
			'filetime'			=> array('TIMESTAMP', 0),
			'thumbnail'			=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'attach_id',
		'KEYS'			=> array(
			'filetime'			=> array('INDEX', 'filetime'),
			'post_msg_id'		=> array('INDEX', 'post_msg_id'),
			'topic_id'			=> array('INDEX', 'topic_id'),
			'poster_id'			=> array('INDEX', 'poster_id'),
			'is_orphan'			=> array('INDEX', 'is_orphan'),
		),
	);

	$schema_data['phpbb_banlist'] = array(
		'COLUMNS'		=> array(
			'ban_id'			=> array('UINT', NULL, 'auto_increment'),
			'ban_userid'		=> array('UINT', 0),
			'ban_ip'			=> array('VCHAR:40', ''),
			'ban_email'			=> array('VCHAR_UNI:100', ''),
			'ban_start'			=> array('TIMESTAMP', 0),
			'ban_end'			=> array('TIMESTAMP', 0),
			'ban_exclude'		=> array('BOOL', 0),
			'ban_reason'		=> array('VCHAR_UNI', ''),
			'ban_give_reason'	=> array('VCHAR_UNI', ''),
		),
		'PRIMARY_KEY'			=> 'ban_id',
		'KEYS'			=> array(
			'ban_end'			=> array('INDEX', 'ban_end'),
			'ban_user'			=> array('INDEX', array('ban_userid', 'ban_exclude')),
			'ban_email'			=> array('INDEX', array('ban_email', 'ban_exclude')),
			'ban_ip'			=> array('INDEX', array('ban_ip', 'ban_exclude')),
		),
	);

	$schema_data['phpbb_bbcodes'] = array(
		'COLUMNS'		=> array(
			'bbcode_id'				=> array('USINT', 0),
			'bbcode_tag'			=> array('VCHAR:16', ''),
			'bbcode_helpline'		=> array('VCHAR_UNI', ''),
			'display_on_posting'	=> array('BOOL', 0),
			'bbcode_match'			=> array('TEXT_UNI', ''),
			'bbcode_tpl'			=> array('MTEXT_UNI', ''),
			'first_pass_match'		=> array('MTEXT_UNI', ''),
			'first_pass_replace'	=> array('MTEXT_UNI', ''),
			'second_pass_match'		=> array('MTEXT_UNI', ''),
			'second_pass_replace'	=> array('MTEXT_UNI', ''),
			'display_on_pm'		 	=> array('BOOL', 1),
			'display_on_sig' 		=> array('BOOL', 1),
			'abbcode' 				=> array('BOOL', 0),
			'bbcode_image' 			=> array('VCHAR_UNI', ''),
			'bbcode_order' 			=> array('USINT', 0),
			'bbcode_group' 			=> array('VCHAR_UNI', 0),
		),
		'PRIMARY_KEY'	=> 'bbcode_id',
		'KEYS'			=> array(
			'display_on_post'		=> array('INDEX', 'display_on_posting'),
			'display_order'			=> array('INDEX', 'bbcode_order'),
		),
	);

	$schema_data['phpbb_blogs'] = array(
		'COLUMNS'		=> array(
			'blog_id'				=> array('UINT', NULL, 'auto_increment'),
			'user_id'				=> array('UINT', 0),
			'user_ip'				=> array('VCHAR:40', ''),
			'blog_subject'			=> array('STEXT_UNI', '', 'true_sort'),
			'blog_text'				=> array('MTEXT_UNI', ''),
			'blog_checksum'			=> array('VCHAR:32', ''),
			'blog_time'				=> array('TIMESTAMP', 0),
			'blog_approved'			=> array('BOOL', 1),
			'blog_reported'			=> array('BOOL', 0),
			'enable_bbcode'			=> array('BOOL', 1),
			'enable_smilies'		=> array('BOOL', 1),
			'enable_magic_url'		=> array('BOOL', 1),
			'bbcode_bitfield'		=> array('VCHAR:255', ''),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'blog_edit_time'		=> array('TIMESTAMP', 0),
			'blog_edit_reason'		=> array('STEXT_UNI', ''),
			'blog_edit_user'		=> array('UINT', 0),
			'blog_edit_count'		=> array('USINT', 0),
			'blog_edit_locked'		=> array('BOOL', 0),
			'blog_deleted'			=> array('UINT', 0),
			'blog_deleted_time'		=> array('TIMESTAMP', 0),
			'blog_read_count'		=> array('UINT', 1),
			'blog_reply_count'		=> array('UINT', 0),
			'blog_real_reply_count'	=> array('UINT', 0),
			'blog_attachment'		=> array('BOOL', 0),
			'perm_guest'			=> array('TINT:1', 1),
			'perm_registered'		=> array('TINT:1', 2),
			'perm_foe'				=> array('TINT:1', 0),
			'perm_friend'			=> array('TINT:1', 2),
			'rating'				=> array('DECIMAL:6', 0),
			'num_ratings'			=> array('UINT', 0),
			'poll_title'			=> array('STEXT_UNI', '', 'true_sort'),
			'poll_start'			=> array('TIMESTAMP', 0),
			'poll_length'			=> array('TIMESTAMP', 0),
			'poll_max_options'		=> array('TINT:4', 1),
			'poll_last_vote'		=> array('TIMESTAMP', 0),
			'poll_vote_change'		=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'blog_id',
		'KEYS'			=> array(
			'user_id'				=> array('INDEX', 'user_id'),
			'user_ip'				=> array('INDEX', 'user_ip'),
			'blog_approved'			=> array('INDEX', 'blog_approved'),
			'blog_deleted'			=> array('INDEX', 'blog_deleted'),
			'perm_guest'			=> array('INDEX', 'perm_guest'),
			'perm_registered'		=> array('INDEX', 'perm_registered'),
			'perm_foe'				=> array('INDEX', 'perm_foe'),
			'perm_friend'			=> array('INDEX', 'perm_friend'),
			'rating'				=> array('INDEX', 'rating'),
		),
	);

	$schema_data['phpbb_blogs_attachment'] = array(
		'COLUMNS'		=> array(
			'attach_id'				=> array('UINT', NULL, 'auto_increment'),
			'blog_id'				=> array('UINT', 0),
			'reply_id'				=> array('UINT', 0),
			'poster_id'				=> array('UINT', 0),
			'is_orphan'				=> array('BOOL', 1),
			'physical_filename'		=> array('VCHAR', ''),
			'real_filename'			=> array('VCHAR', ''),
			'download_count'		=> array('UINT', 0),
			'attach_comment'		=> array('TEXT_UNI', ''),
			'extension'				=> array('VCHAR:100', ''),
			'mimetype'				=> array('VCHAR:100', ''),
			'filesize'				=> array('UINT:20', 0),
			'filetime'				=> array('TIMESTAMP', 0),
			'thumbnail'				=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'attach_id',
		'KEYS'			=> array(
			'blog_id'				=> array('INDEX', 'blog_id'),
			'reply_id'				=> array('INDEX', 'reply_id'),
			'filetime'				=> array('INDEX', 'filetime'),
			'poster_id'				=> array('INDEX', 'poster_id'),
			'is_orphan'				=> array('INDEX', 'is_orphan'),
		),
	);

	$schema_data['phpbb_blogs_categories'] = array(
		'COLUMNS'		=> array(
			'category_id'					=> array('UINT', NULL, 'auto_increment'),
			'parent_id'						=> array('UINT', 0),
			'left_id'						=> array('UINT', 0),
			'right_id'						=> array('UINT', 0),
			'category_name'					=> array('STEXT_UNI', '', 'true_sort'),
			'category_description'			=> array('MTEXT_UNI', ''),
			'category_description_bitfield'	=> array('VCHAR:255', ''),
			'category_description_uid'		=> array('VCHAR:8', ''),
			'category_description_options'	=> array('UINT:11', 7),
			'rules'							=> array('MTEXT_UNI', ''),
			'rules_bitfield'				=> array('VCHAR:255', ''),
			'rules_uid'						=> array('VCHAR:8', ''),
			'rules_options'					=> array('UINT:11', 7),
			'blog_count'					=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'category_id',
		'KEYS'			=> array(
			'left_right_id'			=> array('INDEX', array('left_id', 'right_id')),
		),
	);

	$schema_data['phpbb_blogs_in_categories'] = array(
		'COLUMNS'		=> array(
			'blog_id'						=> array('UINT', 0),
			'category_id'					=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> array('blog_id', 'category_id'),
	);

	$schema_data['phpbb_blogs_plugins'] = array(
		'COLUMNS'		=> array(
			'plugin_id'				=> array('UINT', NULL, 'auto_increment'),
			'plugin_name'			=> array('STEXT_UNI', '', 'true_sort'),
			'plugin_enabled'		=> array('BOOL', 0),
			'plugin_version'		=> array('XSTEXT_UNI', '', 'true_sort'),
		),
		'PRIMARY_KEY'	=> 'plugin_id',
		'KEYS'			=> array(
			'plugin_name'			=> array('INDEX', 'plugin_name'),
			'plugin_enabled'		=> array('INDEX', 'plugin_enabled'),
		),
	);
	
	$schema_data['phpbb_blogs_poll_options'] = array(
		'COLUMNS'		=> array(
			'poll_option_id'		=> array('TINT:4', 0),
			'blog_id'				=> array('UINT', 0),
			'poll_option_text'		=> array('TEXT_UNI', ''),
			'poll_option_total'		=> array('UINT', 0),
		),
		'KEYS'			=> array(
			'poll_opt_id'			=> array('INDEX', 'poll_option_id'),
			'blog_id'				=> array('INDEX', 'blog_id'),
		),
	);
	
	$schema_data['phpbb_blogs_poll_votes'] = array(
		'COLUMNS'		=> array(
			'blog_id'				=> array('UINT', 0),
			'poll_option_id'		=> array('TINT:4', 0),
			'vote_user_id'			=> array('UINT', 0),
			'vote_user_ip'			=> array('VCHAR:40', ''),
		),
		'KEYS'			=> array(
			'blog_id'				=> array('INDEX', 'blog_id'),
			'vote_user_id'			=> array('INDEX', 'vote_user_id'),
			'vote_user_ip'			=> array('INDEX', 'vote_user_ip'),
		),
	);
	
	$schema_data['phpbb_blogs_ratings'] = array(
		'COLUMNS'		=> array(
			'blog_id'						=> array('UINT', 0),
			'user_id'						=> array('UINT', 0),
			'rating'						=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> array('blog_id', 'user_id'),
	);
	
	$schema_data['phpbb_blogs_reply'] = array(
		'COLUMNS'		=> array(
			'reply_id'				=> array('UINT', NULL, 'auto_increment'),
			'blog_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'user_ip'				=> array('VCHAR:40', ''),
			'reply_subject'			=> array('STEXT_UNI', '', 'true_sort'),
			'reply_text'			=> array('MTEXT_UNI', ''),
			'reply_checksum'		=> array('VCHAR:32', ''),
			'reply_time'			=> array('TIMESTAMP', 0),
			'reply_approved'		=> array('BOOL', 1),
			'reply_reported'		=> array('BOOL', 0),
			'enable_bbcode'			=> array('BOOL', 1),
			'enable_smilies'		=> array('BOOL', 1),
			'enable_magic_url'		=> array('BOOL', 1),
			'bbcode_bitfield'		=> array('VCHAR:255', ''),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'reply_edit_time'		=> array('TIMESTAMP', 0),
			'reply_edit_reason'		=> array('STEXT_UNI', ''),
			'reply_edit_user'		=> array('UINT', 0),
			'reply_edit_count'		=> array('UINT', 0),
			'reply_edit_locked'		=> array('BOOL', 0),
			'reply_deleted'			=> array('UINT', 0),
			'reply_deleted_time'	=> array('TIMESTAMP', 0),
			'reply_attachment'		=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'reply_id',
		'KEYS'			=> array(
			'blog_id'				=> array('INDEX', 'blog_id'),
			'user_id'				=> array('INDEX', 'user_id'),
			'user_ip'				=> array('INDEX', 'user_ip'),
			'reply_approved'		=> array('INDEX', 'reply_approved'),
			'reply_deleted'			=> array('INDEX', 'reply_deleted'),
		),
	);
	
	$schema_data['phpbb_blogs_subscription'] = array(
		'COLUMNS'		=> array(
			'sub_user_id'			=> array('UINT', 0),
			'sub_type'				=> array('UINT:11', 0),
			'blog_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> array('sub_user_id', 'sub_type', 'blog_id', 'user_id'),
	);
	
	$schema_data['phpbb_blogs_users'] = array(
		'COLUMNS'		=> array(
			'user_id'				=> array('UINT', 0),
			'perm_guest'			=> array('TINT:1', 1),
			'perm_registered'		=> array('TINT:1', 2),
			'perm_foe'				=> array('TINT:1', 0),
			'perm_friend'			=> array('TINT:1', 2),
			'title'					=> array('STEXT_UNI', '', 'true_sort'),
			'description'			=> array('MTEXT_UNI', ''),
			'description_bbcode_bitfield'	=> array('VCHAR:255', ''),
			'description_bbcode_uid'		=> array('VCHAR:8', ''),
			'instant_redirect'				=> array('BOOL', 1),
			'blog_subscription_default'		=> array('UINT:11', 0),
			'blog_style'					=> array('STEXT_UNI', '', 'true_sort'),
			'blog_css'						=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'user_id',
	);
	
	$schema_data['phpbb_blog_search_wordlist'] = array(
		'COLUMNS'		=> array(
			'word_id'			=> array('UINT', NULL, 'auto_increment'),
			'word_text'			=> array('VCHAR_UNI', ''),
			'word_common'		=> array('BOOL', 0),
			'word_count'		=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'word_id',
		'KEYS'			=> array(
			'word_text'			=> array('UNIQUE', 'word_text'),
			'word_count'		=> array('INDEX', 'word_count'),
		),
	);
	
		$schema_data['phpbb_bookmarks'] = array(
		'COLUMNS'		=> array(
			'blog_id'			=> array('UINT', 0),
			'reply_id'			=> array('UINT', 0),
			'word_id'			=> array('UINT', 0),
			'title_match'		=> array('BOOL', 0),
		),
		'KEYS'			=> array(
			'unique_match'		=> array('UNIQUE', array('blog_id', 'reply_id', 'word_id', 'title_match')),
			'word_id'			=> array('INDEX', 'word_id'),
			'blog_id'			=> array('INDEX', 'blog_id'),
			'reply_id'			=> array('INDEX', 'reply_id'),
		),
	);

	$schema_data['phpbb_bookmarks'] = array(
		'COLUMNS'		=> array(
			'topic_id'			=> array('UINT', 0),
			'user_id'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'			=> array('topic_id', 'user_id'),
	);

	$schema_data['phpbb_bots'] = array(
		'COLUMNS'		=> array(
			'bot_id'			=> array('UINT', NULL, 'auto_increment'),
			'bot_active'		=> array('BOOL', 1),
			'bot_name'			=> array('STEXT_UNI', ''),
			'user_id'			=> array('UINT', 0),
			'bot_agent'			=> array('VCHAR', ''),
			'bot_ip'			=> array('VCHAR', ''),
		),
		'PRIMARY_KEY'	=> 'bot_id',
		'KEYS'			=> array(
			'bot_active'		=> array('INDEX', 'bot_active'),
		),
	);

	$schema_data['phpbb_calendar'] = array(
		'COLUMNS'		=> array(	
			'event_id'				=> array('UINT', NULL, 'auto_increment'),
			'user_id'				=> array('UINT', 0),	
			'event_name'			=> array('VCHAR', ''),
			'event_desc'			=> array('MTEXT_UNI', ''),
			'event_groups'			=> array('VCHAR', ''),
			'group_cats'			=> array('USINT', 0),
			'priv_users'			=> array('MTEXT_UNI', ''),
			'enable_bbcode'			=> array('TINT:1', 1),
			'enable_html'			=> array('TINT:1', 1),
			'enable_smilies'		=> array('TINT:1', 1),
			'enable_magic_url'		=> array('TINT:1', 1),
			'bbcode_bitfield'		=> array('VCHAR', ''),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'event_start'           => array('UINT', 0, 'null'),
			'event_end'             => array('UINT', 0, 'null'),
			'event_repeat'          => array('VCHAR:8', '', 'null'),
			'invite_attendees'      => array('BOOL', 0, 'null'),
			'event_attendees'       => array('MTEXT_UNI', '', 'null'),
			'event_non_attendees'   => array('MTEXT_UNI', '', 'null'),
		),
		'PRIMARY_KEY'	=> array('event_id'),			
	);
	
	$schema_data['phpbb_calendar_repeat_events'] = array(
		'COLUMNS' => array(
			'id'                => array('UINT:11', NULL, 'auto_increment'),
			'repeat_id'         => array('VCHAR:8', '', 'null'),
			'event_start_time'  => array('UINT', 0, 'null'),
			'event_end_time'    => array('UINT', 0, 'null'),
		),
		'PRIMARY_KEY'	=> array('id'),		
	);
	
	$schema_data['phpbb_captcha_answers'] = array(
		'COLUMNS'		=> array(
			'question_id'		=> array('UINT', 0),
			'answer_text'		=> array('VCHAR_UNI:255', ''),
		),
		'KEYS'			=> array(
			'qid'		=> array('INDEX', 'question_id'),
		),		
	);

	$schema_data['phpbb_captcha_questions'] = array(
		'COLUMNS'		=> array(
			'question_id'		=> array('UINT', NULL, 'auto_increment'),
			'strict'		    => array('BOOL', '0'),
			'lang_id'		    => array('UINT', 0),
			'lang_iso'		    => array('VCHAR:30', ''),
			'question_text'		=> array('TEXT_UNI', ''),			
		),
		'PRIMARY_KEY'			=> array('question_id'),
		'KEYS'			=> array(
			'lang'		=> array('INDEX', 'lang_iso'),
		),		
	);

	$schema_data['phpbb_cash'] = array(
		'COLUMNS'		=> array(
			'cash_id'			=> array('UINT', NULL, 'auto_increment'),
			'cash_name'		    => array('VCHAR', ''),
			'cash_value'		=> array('UINT:11', 1),	
			'cash_trade'		=> array('BOOL', 1),	
		),
		'PRIMARY_KEY'			=> array('cash_id'),
	);
	
	$schema_data['phpbb_cash_amt'] = array(
		'COLUMNS'		=> array(
			'user_id'			=> array('UINT', 0),
			'cash_id'			=> array('UINT', 1),
			'cash_amt'			=> array('UINT:15', 0),
		),
		'KEYS'			=> array(
			'cash_user'			=> array('INDEX', array('user_id', 'cash_id')),
		),		
	);
	
	$schema_data['phpbb_clicks'] = array(
		'COLUMNS'		=> array(
			'id'				=> array('UINT', NULL, 'auto_increment'),
			'url'				=> array('VCHAR', ''),
			'clicks'			=> array('UINT', 0),			
		),
		'PRIMARY_KEY'			=> array('id'),	
		'KEYS'			=> array(
			'md5'				=> array('INDEX', 'url'),
		),		
	);
	
	$schema_data['phpbb_config'] = array(
		'COLUMNS'		=> array(
			'config_name'		=> array('VCHAR', ''),
			'config_value'		=> array('VCHAR_UNI', ''),
			'is_dynamic'		=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'config_name',
		'KEYS'			=> array(
			'is_dynamic'		=> array('INDEX', 'is_dynamic'),
		),
	);

	$schema_data['phpbb_confirm'] = array(
		'COLUMNS'		=> array(
			'confirm_id'		=> array('CHAR:32', ''),
			'session_id'		=> array('CHAR:32', ''),
			'confirm_type'		=> array('TINT:3', 0),
			'code'				=> array('VCHAR:8', ''),
			'seed'				=> array('UINT:10', 0),
			'attempts'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> array('session_id', 'confirm_id'),
		'KEYS'			=> array(
			'confirm_type'		=> array('INDEX', 'confirm_type'),
		),
	);

	$schema_data['phpbb_contact_config'] = array(
		'COLUMNS'		=> array(
			'contact_confirm'			=> array('BOOL', 1),
			'contact_confirm_guests'	=> array('BOOL', 1),
			'contact_max_attempts'		=> array('UINT:3', 3),
			'contact_method'			=> array('BOOL', 0),
			'contact_bot_user'			=> array('UINT', 2),
			'contact_bot_forum'			=> array('UINT', 2),
			'contact_reasons'			=> array('MTEXT_UNI', ''),
			'contact_founder_only'		=> array('BOOL', 0),
			'contact_bbcodes_allowed'	=> array('BOOL', 0),
			'contact_smilies_allowed'	=> array('BOOL', 0),
			'contact_bot_poster'		=> array('BOOL', 0),	
			'contact_attach_allowed'	=> array('BOOL', 0),
			'contact_urls_allowed'		=> array('BOOL', 0),
			'contact_username_chk'		=> array('BOOL', 0),
			'contact_email_chk'			=> array('BOOL', 0),
		),
	);
	
	$schema_data['phpbb_digests_subscribed_forums'] = array(
		'COLUMNS'		=> array(
			'user_id'			=> array('UINT', 0),
			'forum_id'			=> array('UINT', 0),			
		),
		'PRIMARY_KEY'	=> array('user_id', 'forum_id')		
	);
	
	$schema_data['phpbb_disallow'] = array(
		'COLUMNS'		=> array(
			'disallow_id'		=> array('UINT', NULL, 'auto_increment'),
			'disallow_username'	=> array('VCHAR_UNI:255', ''),
		),
		'PRIMARY_KEY'	=> 'disallow_id',
	);

	$schema_data['phpbb_dl_auth'] = array(
		'COLUMNS'		=> array(
			'cat_id'			=> array('UINT:11', 0),	
			'group_id'			=> array('UINT:11', 0),	
			'auth_view'			=> array('BOOL', 1),
			'auth_dl'			=> array('BOOL', 1),
			'auth_up'			=> array('BOOL', 1),
			'auth_mod'			=> array('BOOL', 0),			
		),
	);
	
	$schema_data['phpbb_dl_banlist'] = array(
		'COLUMNS'		=> array(
			'ban_id'			=> array('UINT:11', NULL, 'auto_increment'),
			'user_id'			=> array('UINT', 0),
			'user_ip'			=> array('VCHAR:40', ''),
			'user_agent'		=> array('VCHAR:50', ''),
			'username'			=> array('VCHAR:25', ''),
			'guests'			=> array('BOOL', 0),				
		),
		'PRIMARY_KEY'	=> 'ban_id',
	);
	

	$schema_data['phpbb_dl_bug_history'] = array(
		'COLUMNS'		=> array(
			'report_his_id'		=> array('UINT:11', NULL, 'auto_increment'),
			'df_id'				=> array('INT:11', 0),
			'report_id'			=> array('INT:11', 0),
			'report_his_type'	=> array('CHAR:10', ''),
			'report_his_date'	=> array('TIMESTAMP', 0),
			'report_his_value'	=> array('MTEXT_UNI', ''),
			),
		'PRIMARY_KEY'	=> 'report_his_id',			
	);
	
	$schema_data['phpbb_dl_bug_tracker'] = array(
		'COLUMNS'		=> array(
			'report_id'				=> array('UINT:11', NULL, 'auto_increment'),
			'df_id'					=> array('INT:11', 0),
			'report_title'			=> array('VCHAR', ''),
			'report_text'			=> array('MTEXT_UNI', ''),
			'report_file_ver'		=> array('VCHAR:50', ''),
			'report_date'			=> array('TIMESTAMP', 0),
			'report_author_id'		=> array('UINT', 0),
			'report_assign_id'		=> array('UINT', 0),
			'report_assign_date'	=> array('TIMESTAMP', 0),
			'report_status'			=> array('BOOL', 0),
			'report_status_date'	=> array('TIMESTAMP', 0),
			'report_php'			=> array('VCHAR:50', ''),
			'report_db'				=> array('VCHAR:50', ''),
			'report_forum'			=> array('VCHAR:50', ''),
			'bug_uid'				=> array('CHAR:8', ''),
			'bug_bitfield'			=> array('VCHAR', ''),
			'bug_flags'				=> array('UINT:11', 0),
		    ),
		'PRIMARY_KEY'	=> 'report_id',
	);
	
	$schema_data['phpbb_dl_cat_traf'] = array(
		'COLUMNS'		=> array(
			'cat_id'			=> array('UINT:11', 0),
			'cat_traffic_use'	=> array('BINT', 0),
			),
		'PRIMARY_KEY'	=> 'cat_id',
	);
	
	$schema_data['phpbb_dl_comments'] = array(
		'COLUMNS'		=> array(
			'dl_id'				=> array('BINT', NULL, 'auto_increment'),
			'id'				=> array('INT:11', 0),
			'cat_id'			=> array('INT:11', 0),
			'user_id'			=> array('UINT', 0),
			'username'			=> array('VCHAR:32', ''),
			'comment_time'		=> array('TIMESTAMP', 0),
			'comment_edit_time'	=> array('TIMESTAMP', 0),
			'comment_text'		=> array('MTEXT_UNI', ''),
			'approve'			=> array('BOOL', 0),
			'com_uid'			=> array('CHAR:8', ''),
			'com_bitfield'		=> array('VCHAR', ''),
			'com_flags'			=> array('UINT:11', 0),
		),
		'PRIMARY_KEY'	=> 'dl_id',		
	);
	
	$schema_data['phpbb_dl_ext_blacklist'] = array(
		'COLUMNS'		=> array(
			'extention'	=> array('CHAR:10', ''),
		),
	);
	
	$schema_data['phpbb_dl_favorites'] = array(
		'COLUMNS'		=> array(
			'fav_id'		=> array('UINT:11', NULL, 'auto_increment'),
			'fav_dl_id'		=> array('INT:11', 0),
			'fav_dl_cat'	=> array('INT:11', 0),
			'fav_user_id'	=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'fav_id',
	);
	
	$schema_data['phpbb_dl_fields'] = array(
		'COLUMNS'		=> array(
			'field_id'				=> array('UINT:8', NULL, 'auto_increment'),
			'field_name'			=> array('MTEXT_UNI', ''),
			'field_type'			=> array('INT:4', 0),
			'field_ident'			=> array('VCHAR:20', ''),
			'field_length'			=> array('VCHAR:20', ''),
			'field_minlen'			=> array('VCHAR', ''),
			'field_maxlen'			=> array('VCHAR', ''),
			'field_novalue'			=> array('MTEXT_UNI', ''),
			'field_default_value'	=> array('MTEXT_UNI', ''),
			'field_validation'		=> array('VCHAR:60', ''),
			'field_required'		=> array('BOOL', 0),
			'field_active'			=> array('BOOL', 0),
			'field_order'			=> array('UINT:8', 0),
		),
		'PRIMARY_KEY'	=> 'field_id',
	);
	
	$schema_data['phpbb_dl_fields_data'] = array(
		'COLUMNS'		=> array(
			'df_id'			=> array('UINT:11', 0),
		),
		'PRIMARY_KEY'	=> 'df_id',
	);
	
	$schema_data['phpbb_dl_fields_lang'] = array(
		'COLUMNS'		=> array(
			'field_id'		=> array('UINT:8', 0),
			'lang_id'		=> array('UINT:8', 0),
			'option_id'		=> array('UINT:8', 0),
			'field_type'	=> array('INT:4', 0),
			'lang_value'	=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> array('field_id', 'lang_id', 'option_id'),
	);
	
	$schema_data['phpbb_dl_hotlink'] = array(
		'COLUMNS'		=> array(
			'user_id'		=> array('UINT', 0),
			'session_id'	=> array('VCHAR:32', ''),
			'hotlink_id'	=> array('VCHAR:32', ''),
			'code'			=> array('VCHAR:10', '-'),
		),
	);
	
	$schema_data['phpbb_dl_images'] = array(
		'COLUMNS'		=> array(
			'img_id'				=> array('UINT:8', NULL, 'auto_increment'),
			'dl_id'					=> array('UINT:11', 0),
			'img_name'				=> array('VCHAR:255', ''),
			'img_title'				=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'img_id',
	);
	
	$schema_data['phpbb_dl_lang'] = array(
		'COLUMNS'		=> array(
			'field_id'				=> array('UINT:8', 0),
			'lang_id'				=> array('UINT:8', 0),
			'lang_name'				=> array('MTEXT_UNI', ''),
			'lang_explain'			=> array('MTEXT_UNI', ''),
			'lang_default_value'	=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> array('field_id', 'lang_id'),
	);
	
	$schema_data['phpbb_dl_notraf'] = array(
		'COLUMNS'		=> array(
			'user_id'	=> array('UINT', 0),
			'dl_id'		=> array('INT:11', 0),
		),
	);
	
	$schema_data['phpbb_dl_ratings'] = array(
		'COLUMNS'		=> array(
			'dl_id'			=> array('INT:11', 0),
			'user_id'		=> array('UINT', 0),
			'rate_point'	=> array('CHAR:10', ''),		
		),
	);
	
	$schema_data['phpbb_dl_rem_traf'] = array(
		'COLUMNS'		=> array(
			'config_name'	=> array('VCHAR', ''),
			'config_value'	=> array('VCHAR', ''),
		),
		'PRIMARY_KEY'	=> 'config_name',
	);
	
	$schema_data['phpbb_dl_stats'] = array(
		'COLUMNS'		=> array(
			'dl_id'			=> array('BINT', NULL, 'auto_increment'),
			'id'			=> array('INT:11', 0),
			'cat_id'		=> array('INT:11', 0),
			'user_id'		=> array('UINT', 0),
			'username'		=> array('VCHAR:32', ''),
			'traffic'		=> array('BINT', 0),
			'direction'		=> array('BOOL', 0),
			'user_ip'		=> array('VCHAR:40', ''),
			'browser'		=> array('VCHAR:20', ''),
			'time_stamp'	=> array('INT:11', 0),
			'browser'		=> array('VCHAR:255', ''),
			'time_stamp'	=> array('TIMESTAMP', 0),
		),
		'PRIMARY_KEY'	=> 'dl_id',
	);
	
	$schema_data['phpbb_dl_versions'] = array(
		'COLUMNS'		=> array(
			'ver_id'			=> array('UINT:11', NULL, 'auto_increment'),
			'dl_id'				=> array('UINT:11', 0),
			'ver_file_name'		=> array('VCHAR', ''),
			'ver_real_file'		=> array('VCHAR', ''),
			'ver_file_size'		=> array('BINT', 0),
			'ver_version'		=> array('VCHAR:32', ''),
			'ver_change_time'	=> array('TIMESTAMP', 0),
			'ver_add_time'		=> array('TIMESTAMP', 0),
			'ver_add_user'		=> array('UINT', 0),
			'ver_change_user'	=> array('UINT', 0),
			'ver_file_hash'	    => array('VCHAR:255', ''),
		),
		'PRIMARY_KEY'	=> 'ver_id',
	);
	
	$schema_data['phpbb_downloads'] = array(
		'COLUMNS'		=> array(
			'id'					=> array('UINT:11', NULL, 'auto_increment'),
			'description'			=> array('VCHAR', ''),
			'file_name'				=> array('VCHAR', ''),
			'klicks'				=> array('INT:11', 0),
			'free'					=> array('BOOL', 0),
			'extern'				=> array('BOOL', 0),
			'long_desc'				=> array('MTEXT_UNI', ''),
			'sort'					=> array('INT:11', 0),
			'cat'					=> array('INT:11', 0),
			'hacklist'				=> array('BOOL', 0),
			'hack_author'			=> array('VCHAR', ''),
			'hack_author_email'		=> array('VCHAR', ''),
			'hack_author_website'	=> array('TEXT_UNI', ''),
			'hack_version'			=> array('VCHAR:32', ''),
			'hack_dl_url'			=> array('TEXT_UNI', ''),
			'test'					=> array('VCHAR:50', ''),
			'req'					=> array('MTEXT_UNI', ''),
			'todo'					=> array('MTEXT_UNI', ''),
			'warning'				=> array('MTEXT_UNI', ''),
			'mod_desc'				=> array('MTEXT_UNI', ''),
			'mod_list'				=> array('BOOL', 0),
			'file_size'				=> array('BINT', 0),
			'change_time'			=> array('TIMESTAMP', 0),
			'rating'				=> array('INT:5', 0),
			'file_traffic'			=> array('BINT', 0),
			'overall_klicks'		=> array('INT:11', 0),
			'approve'				=> array('BOOL', 0),
			'add_time'				=> array('TIMESTAMP', 0),
			'add_user'				=> array('UINT', 0),
			'change_user'			=> array('UINT', 0),
			'last_time'				=> array('TIMESTAMP', 0),
			'down_user'				=> array('UINT', 0),
			'thumbnail'				=> array('VCHAR', ''),
			'broken'				=> array('BOOL', 0),
			'mod_desc_uid'			=> array('CHAR:8', ''),
			'mod_desc_bitfield'		=> array('VCHAR', ''),
			'mod_desc_flags'		=> array('UINT:11', 0),
			'long_desc_uid'			=> array('CHAR:8', ''),
			'long_desc_bitfield'	=> array('VCHAR', ''),
			'long_desc_flags'		=> array('UINT:11', 0),
			'desc_uid'				=> array('CHAR:8', ''),
			'desc_bitfield'			=> array('VCHAR', ''),
			'desc_flags'			=> array('UINT:11', 0),
			'warn_uid'				=> array('CHAR:8', ''),
			'warn_bitfield'			=> array('VCHAR', ''),
			'warn_flags'			=> array('UINT:11', 0),
			'dl_topic'				=> array('UINT:11', 0),
			'real_file'				=> array('VCHAR', ''),
			'todo_uid'				=> array('CHAR:8', ''),
			'todo_bitfield'			=> array('VCHAR', ''),
			'todo_flags'			=> array('UINT:11', 0),
			'file_hash'				=> array('VCHAR', ''),		
		),
		'PRIMARY_KEY'	=> 'id',
		'KEYS'			=> array(
			'desc_search'		=> array('INDEX', 'description'),
		),		
	);
	
	$schema_data['phpbb_downloads_cat'] = array(
		'COLUMNS'		=> array(
			'id'				=> array('UINT:11', NULL, 'auto_increment'),
			'parent'			=> array('INT:11', 0),
			'path'				=> array('VCHAR', ''),
			'cat_name'			=> array('VCHAR', ''),
			'sort'				=> array('INT:11', 0),
			'description'		=> array('MTEXT_UNI', ''),
			'rules'				=> array('MTEXT_UNI', ''),
			'auth_view'			=> array('BOOL', 1),
			'auth_dl'			=> array('BOOL', 1),
			'auth_up'			=> array('BOOL', 0),
			'auth_mod'			=> array('BOOL', 0),
			'must_approve'		=> array('BOOL', 0),
			'allow_mod_desc'	=> array('BOOL', 0),
			'statistics'		=> array('BOOL', 1),
			'stats_prune'		=> array('UINT', 0),
			'comments'			=> array('BOOL', 1),
			'cat_traffic'		=> array('BINT', 0),
			'allow_thumbs'		=> array('BOOL', 0),
			'auth_cread'		=> array('BOOL', 0),
			'auth_cpost'		=> array('BOOL', 1),
			'approve_comments'	=> array('BOOL', 1),
			'bug_tracker'		=> array('BOOL', 0),
			'desc_uid'			=> array('CHAR:8', ''),
			'desc_bitfield'		=> array('VCHAR', ''),
			'desc_flags'		=> array('UINT:11', 0),
			'rules_uid'			=> array('CHAR:8', ''),
			'rules_bitfield'	=> array('VCHAR', ''),
			'rules_flags'		=> array('UINT:11', 0),
			'dl_topic_forum'	=> array('INT:11', 0),
			'dl_topic_text'		=> array('MTEXT_UNI', ''),
			'cat_icon'			=> array('VCHAR', ''),
			'diff_topic_user'	=> array('BINT', 0),
			'topic_user'		=> array('UINT:11', 0),
			'topic_more_details' => array('BOOL', 1),
			'show_file_hash'	=> array('BOOL', 1),
		),
		'PRIMARY_KEY'	=> 'id',
	);

	$schema_data['phpbb_drafts'] = array(
		'COLUMNS'		=> array(
			'draft_id'			=> array('UINT', NULL, 'auto_increment'),
			'user_id'			=> array('UINT', 0),
			'topic_id'			=> array('UINT', 0),
			'forum_id'			=> array('UINT', 0),
			'save_time'			=> array('TIMESTAMP', 0),
			'draft_subject'		=> array('STEXT_UNI', ''),
			'draft_message'		=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'draft_id',
		'KEYS'			=> array(
			'save_time'			=> array('INDEX', 'save_time'),
		),
	);

	$schema_data['phpbb_extensions'] = array(
		'COLUMNS'		=> array(
			'extension_id'		=> array('UINT', NULL, 'auto_increment'),
			'group_id'			=> array('UINT', 0),
			'extension'			=> array('VCHAR:100', ''),
		),
		'PRIMARY_KEY'	=> 'extension_id',
	);

	$schema_data['phpbb_extension_groups'] = array(
		'COLUMNS'		=> array(
			'group_id'			=> array('UINT', NULL, 'auto_increment'),
			'group_name'		=> array('VCHAR_UNI', ''),
			'cat_id'			=> array('TINT:2', 0),
			'allow_group'		=> array('BOOL', 0),
			'download_mode'		=> array('BOOL', 1),
			'upload_icon'		=> array('VCHAR', ''),
			'max_filesize'		=> array('UINT:20', 0),
			'allowed_forums'	=> array('TEXT', ''),
			'allow_in_pm'		=> array('BOOL', 0),
            'allow_in_blog'     => array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'group_id',
	);

	$schema_data['phpbb_forums'] = array(
		'COLUMNS'		=> array(
			'forum_id'				=> array('UINT', NULL, 'auto_increment'),
			'parent_id'				=> array('UINT', 0),
			'left_id'				=> array('UINT', 0),
			'right_id'				=> array('UINT', 0),
			'forum_parents'			=> array('MTEXT', ''),
			'forum_name'			=> array('STEXT_UNI', ''),
			'forum_desc'			=> array('TEXT_UNI', ''),
			'forum_desc_bitfield'	=> array('VCHAR:255', ''),
			'forum_desc_options'	=> array('UINT:11', 7),
			'forum_desc_uid'		=> array('VCHAR:8', ''),
			'forum_link'			=> array('VCHAR_UNI', ''),
			'forum_password'		=> array('VCHAR_UNI:40', ''),
			'forum_style'			=> array('UINT', 0),
			'forum_image'			=> array('VCHAR', ''),
			'forum_rules'			=> array('TEXT_UNI', ''),
			'forum_rules_link'		=> array('VCHAR_UNI', ''),
			'forum_rules_bitfield'	=> array('VCHAR:255', ''),
			'forum_rules_options'	=> array('UINT:11', 7),
			'forum_rules_uid'		=> array('VCHAR:8', ''),
			'forum_topics_per_page'	=> array('TINT:4', 0),
			'forum_type'			=> array('TINT:4', 0),
			'forum_status'			=> array('TINT:4', 0),
			'forum_posts'			=> array('UINT', 0),
			'forum_topics'			=> array('UINT', 0),
			'forum_topics_real'		=> array('UINT', 0),
			'forum_last_post_id'	=> array('UINT', 0),
			'forum_last_poster_id'	=> array('UINT', 0),
			'forum_last_post_subject' => array('STEXT_UNI', ''),
			'forum_last_post_time'	=> array('TIMESTAMP', 0),
			'forum_last_poster_name'=> array('VCHAR_UNI', ''),
			'forum_last_poster_colour'=> array('VCHAR:6', ''),
			'forum_flags'			=> array('TINT:4', 32),
			'forum_options'			=> array('UINT:20', 0),
			'display_subforum_list'	=> array('BOOL', 1),
			'display_on_index'		=> array('BOOL', 1),
			'enable_indexing'		=> array('BOOL', 1),
			'enable_icons'			=> array('BOOL', 1),
			'enable_prune'			=> array('BOOL', 0),
			'prune_next'			=> array('TIMESTAMP', 0),
			'prune_days'			=> array('UINT', 0),
			'prune_viewed'			=> array('UINT', 0),
			'prune_freq'			=> array('UINT', 0),
			'forum_perpost'			=> array('DECIMAL:10', 5.00),
			'forum_peredit'			=> array('DECIMAL:10', 0.05),
			'forum_pertopic'		=> array('DECIMAL:10', 15.00),
		),
		'PRIMARY_KEY'	=> 'forum_id',
		'KEYS'			=> array(
			'left_right_id'			=> array('INDEX', array('left_id', 'right_id')),
			'forum_lastpost_id'		=> array('INDEX', 'forum_last_post_id'),
		),
	);

	$schema_data['phpbb_forums_access'] = array(
		'COLUMNS'		=> array(
			'forum_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'session_id'			=> array('CHAR:32', ''),
		),
		'PRIMARY_KEY'	=> array('forum_id', 'user_id', 'session_id'),
	);

	$schema_data['phpbb_forums_track'] = array(
		'COLUMNS'		=> array(
			'user_id'				=> array('UINT', 0),
			'forum_id'				=> array('UINT', 0),
			'mark_time'				=> array('TIMESTAMP', 0),
		),
		'PRIMARY_KEY'	=> array('user_id', 'forum_id'),
	);

	$schema_data['phpbb_forums_watch'] = array(
		'COLUMNS'		=> array(
			'forum_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'notify_status'			=> array('BOOL', 0),
		),
		'KEYS'			=> array(
			'forum_id'				=> array('INDEX', 'forum_id'),
			'user_id'				=> array('INDEX', 'user_id'),
			'notify_stat'			=> array('INDEX', 'notify_status'),
		),
	);

	$schema_data['phpbb_gallery_albums'] = array(
		'COLUMNS'		=> array(
			'album_id'				=> array('UINT', NULL, 'auto_increment'),
			'parent_id'				=> array('UINT', 0),
			'left_id'				=> array('UINT', 1),
			'right_id'				=> array('UINT', 2),
			'album_parents'			=> array('MTEXT_UNI', ''),
			'album_type'			=> array('UINT:3', 1),
			'album_status'			=> array('UINT:1', 1),
			'album_contest'			=> array('UINT', 0),
			'album_name'			=> array('VCHAR:255', ''),
			'album_desc'			=> array('MTEXT_UNI', ''),
			'album_desc_options'	=> array('UINT:3', 7),
			'album_desc_uid'		=> array('VCHAR:8', ''),
			'album_desc_bitfield'	=> array('VCHAR:255', ''),
			'album_user_id'			=> array('UINT', 0),
			'album_images'			=> array('UINT', 0),
			'album_images_real'		=> array('UINT', 0),
			'album_last_image_id'	=> array('UINT', 0),
			'album_image'			=> array('VCHAR', ''),
			'album_last_image_time'	=> array('INT:11', 0),
			'album_last_image_name'	=> array('VCHAR', ''),
			'album_last_username'	=> array('VCHAR', ''),
			'album_last_user_colour' => array('VCHAR:6', ''),
			'album_last_user_id'	=> array('UINT', 0),
			'album_watermark'		=> array('UINT:1', 1),
			'album_sort_key'		=> array('VCHAR:8', ''),
			'album_sort_dir'		=> array('VCHAR:8', ''),
			'display_in_rrc'		=> array('UINT:1', 1),
			'display_on_index'		=> array('UINT:1', 1),
			'display_subalbum_list'	=> array('UINT:1', 1),
			'album_feed'			=> array('BOOL', 1),
			'album_auth_access'		=> array('TINT:1', 0),
		),
		'PRIMARY_KEY'	=> 'album_id',
	);
	
	$schema_data['phpbb_gallery_albums_track'] = array(
		'COLUMNS'		=> array(
			'user_id'				=> array('UINT', 0),
			'album_id'				=> array('UINT', 0),
			'mark_time'				=> array('TIMESTAMP', 0),
		),
		'PRIMARY_KEY'	=> array('user_id', 'album_id'),
	);
	
	$schema_data['phpbb_gallery_comments'] = array(
		'COLUMNS'		=> array(
			'comment_id'			=> array('UINT', NULL, 'auto_increment'),
			'comment_image_id'		=> array('UINT', NULL),
			'comment_user_id'		=> array('UINT', 0),
			'comment_username'		=> array('VCHAR', ''),
			'comment_user_colour'	=> array('VCHAR:6', ''),
			'comment_user_ip'		=> array('VCHAR:40', ''),
			'comment_signature'		=> array('BOOL', 0),
			'comment_time'			=> array('UINT:11', 0),
			'comment'				=> array('MTEXT_UNI', ''),
			'comment_uid'			=> array('VCHAR:8', ''),
			'comment_bitfield'		=> array('VCHAR:255', ''),
			'comment_edit_time'		=> array('UINT:11', 0),
			'comment_edit_count'	=> array('USINT', 0),
			'comment_edit_user_id'	=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'comment_id',
		'KEYS'		=> array(
			'id'			=> array('INDEX', 'comment_image_id'),
			'uid'			=> array('INDEX', 'comment_user_id'),
			'ip'			=> array('INDEX', 'comment_user_ip'),
			'time'			=> array('INDEX', 'comment_time'),
		),
	);
	
	$schema_data['phpbb_gallery_config'] = array(
		'COLUMNS'		=> array(
			'config_name'		=> array('VCHAR:255', ''),
			'config_value'		=> array('VCHAR:255', ''),
		),
		'PRIMARY_KEY'	=> 'config_name',
	);
	
	$schema_data['phpbb_gallery_contests'] = array(
		'COLUMNS'		=> array(
			'contest_id'			=> array('UINT', NULL, 'auto_increment'),
			'contest_album_id'		=> array('UINT', 0),
			'contest_start'			=> array('UINT:11', 0),
			'contest_rating'		=> array('UINT:11', 0),
			'contest_end'			=> array('UINT:11', 0),
			'contest_marked'		=> array('TINT:1', 0),
			'contest_first'			=> array('UINT', 0),
			'contest_second'		=> array('UINT', 0),
			'contest_third'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'contest_id',
	);
	
	$schema_data['phpbb_gallery_copyts_albums'] = array(
		'COLUMNS'		=> array(	
			'album_id'				=> array('UINT', NULL, 'auto_increment'),
			'parent_id'				=> array('UINT', 0),
			'left_id'				=> array('UINT', 1),
			'right_id'				=> array('UINT', 2),
			'album_name'			=> array('VCHAR:255', ''),
			'album_desc'			=> array('MTEXT_UNI', ''),
			'album_user_id'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'album_id',
	);

	$schema_data['phpbb_gallery_copyts_users'] = array(
		'COLUMNS'		=> array(
			'user_id'			=> array('UINT', 0),
			'personal_album_id'	=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'user_id',
	);
	
	$schema_data['phpbb_gallery_favorites'] = array(
		'COLUMNS'		=> array(
			'favorite_id'			=> array('UINT', NULL, 'auto_increment'),
			'user_id'				=> array('UINT', 0),
			'image_id'				=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'favorite_id',
		'KEYS'		=> array(
			'uid'		=> array('INDEX', 'user_id'),
			'id'		=> array('INDEX', 'image_id'),
		),
	);
	
	$schema_data['phpbb_gallery_images'] = array(
		'COLUMNS'		=> array(
			'image_id'				=> array('UINT', NULL, 'auto_increment'),
			'image_filename'		=> array('VCHAR:255', ''),
			'image_name'			=> array('VCHAR:255', ''),
			'image_name_clean'		=> array('VCHAR:255', ''),
			'image_desc'			=> array('MTEXT_UNI', ''),
			'image_desc_uid'		=> array('VCHAR:8', ''),
			'image_desc_bitfield'	=> array('VCHAR:255', ''),
			'image_user_id'			=> array('UINT', 0),
			'image_username'		=> array('VCHAR:255', ''),
			'image_username_clean'	=> array('VCHAR:255', ''),
			'image_user_colour'		=> array('VCHAR:6', ''),
			'image_user_ip'			=> array('VCHAR:40', ''),
			'image_time'			=> array('UINT:11', 0),
			'image_album_id'		=> array('UINT', 0),
			'image_view_count'		=> array('UINT:11', 0),
			'image_status'			=> array('UINT:3', 0),
			'image_contest'			=> array('UINT:1', 0),
			'image_contest_end'		=> array('TIMESTAMP', 0),
			'image_contest_rank'	=> array('UINT:3', 0),
			'image_filemissing'		=> array('UINT:3', 0),
			'image_has_exif'		=> array('UINT:3', 2),
			'image_exif_data'		=> array('TEXT', ''),
			'image_rates'			=> array('UINT', 0),
			'image_rate_points'		=> array('UINT', 0),
			'image_rate_avg'		=> array('UINT', 0),
			'image_comments'		=> array('UINT', 0),
			'image_last_comment'	=> array('UINT', 0),
			'image_allow_comments'	=> array('TINT:1', 1),
			'image_favorited'		=> array('UINT', 0),
			'image_reported'		=> array('UINT', 0),
			'filesize_upload'		=> array('UINT:20', 0),
			'filesize_medium'		=> array('UINT:20', 0),
			'filesize_cache'		=> array('UINT:20', 0),
		),
		'PRIMARY_KEY'				=> 'image_id',
		'KEYS'		=> array(
			'aid'			=> array('INDEX', 'image_album_id'),
			'uid'			=> array('INDEX', 'image_user_id'),
			'time'			=> array('INDEX', 'image_time'),
		),
	);
	
	$schema_data['phpbb_gallery_modscache'] = array(
		'COLUMNS'		=> array(
			'album_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'username'				=> array('VCHAR', ''),
			'group_id'				=> array('UINT', 0),
			'group_name'			=> array('VCHAR', ''),
			'display_on_index'		=> array('TINT:1', 1),
		),
		'KEYS'		=> array(
			'doi'		=> array('INDEX', 'display_on_index'),
			'aid'		=> array('INDEX', 'album_id'),
		),
	);
	
	$schema_data['phpbb_gallery_permissions'] = array(
		'COLUMNS'		=> array(
			'perm_id'				=> array('UINT', NULL, 'auto_increment'),
			'perm_role_id'			=> array('UINT', 0),
			'perm_album_id'			=> array('UINT', 0),
			'perm_user_id'			=> array('UINT', 0),
			'perm_group_id'			=> array('UINT', 0),
			'perm_system'			=> array('INT:3', 0),
		),
		'PRIMARY_KEY'			=> 'perm_id',
	);
	
	$schema_data['phpbb_gallery_rates'] = array(
		'COLUMNS'		=> array(
			'rate_image_id'			=> array('UINT', 0),
			'rate_user_id'			=> array('UINT', 0),
			'rate_user_ip'			=> array('VCHAR:40', ''),
			'rate_point'			=> array('UINT:3', 0),
		),
		'PRIMARY_KEY'	=> array('rate_image_id', 'rate_user_id'),
	);
	
	$schema_data['phpbb_gallery_reports'] = array(
		'COLUMNS'		=> array(
			'report_id'				=> array('UINT', NULL, 'auto_increment'),
			'report_album_id'		=> array('UINT', 0),
			'report_image_id'		=> array('UINT', 0),
			'reporter_id'			=> array('UINT', 0),
			'report_manager'		=> array('UINT', 0),
			'report_note'			=> array('MTEXT_UNI', ''),
			'report_time'			=> array('UINT:11', 0),
			'report_status'			=> array('UINT:3', 0),
		),
		'PRIMARY_KEY'	=> 'report_id',
	);
	
	$schema_data['phpbb_gallery_roles'] = array(
		'COLUMNS'		=> array(
			'role_id'				=> array('UINT', NULL, 'auto_increment'),
			'a_list'				=> array('UINT:3', 0),
			'i_view'				=> array('UINT:3', 0),
			'i_watermark'			=> array('UINT:3', 0),
			'i_upload'				=> array('UINT:3', 0),
			'i_edit'				=> array('UINT:3', 0),
			'i_delete'				=> array('UINT:3', 0),
			'i_rate'				=> array('UINT:3', 0),
			'i_approve'				=> array('UINT:3', 0),
			'i_lock'				=> array('UINT:3', 0),
			'i_report'				=> array('UINT:3', 0),
			'i_count'				=> array('UINT', 0),
			'i_unlimited'			=> array('UINT:3', 0),
			'c_read'				=> array('UINT:3', 0),
			'c_post'				=> array('UINT:3', 0),
			'c_edit'				=> array('UINT:3', 0),
			'c_delete'				=> array('UINT:3', 0),
			'm_comments'			=> array('UINT:3', 0),
			'm_delete'				=> array('UINT:3', 0),
			'm_edit'				=> array('UINT:3', 0),
			'm_move'				=> array('UINT:3', 0),
			'm_report'				=> array('UINT:3', 0),
			'm_status'				=> array('UINT:3', 0),
			'a_count'				=> array('UINT', 0),
			'a_unlimited'			=> array('UINT:3', 0),
			'a_restrict'			=> array('UINT:3', 0),
		),
		'PRIMARY_KEY'		=> 'role_id',
	);
	
	$schema_data['phpbb_gallery_users'] = array(
		'COLUMNS'		=> array(
			'user_id'				=> array('UINT', 0),
			'watch_own'				=> array('UINT:3', 0),
			'watch_favo'			=> array('UINT:3', 0),
			'watch_com'				=> array('UINT:3', 0),
			'user_images'			=> array('UINT', 0),
			'personal_album_id'		=> array('UINT', 0),
			'user_lastmark'			=> array('TIMESTAMP', 0),
			'user_last_update'		=> array('TIMESTAMP', 0),
			'user_viewexif'			=> array('UINT:1', 0),
			'user_permissions'		=> array('MTEXT_UNI', ''),
			'user_permissions_changed'	=> array('TIMESTAMP', 0),
			'user_allow_comments'	=> array('TINT:1', 1),
			'subscribe_pegas'		=> array('TINT:1', 0),
			),
		'PRIMARY_KEY'		=> 'user_id',
		'KEYS'		=> array(
			'pega'	=> array('INDEX', array('personal_album_id')),
		),
	);
	
	$schema_data['phpbb_gallery_watch'] = array(
		'COLUMNS'		=> array(
			'watch_id'				=> array('UINT', NULL, 'auto_increment'),
			'album_id'				=> array('UINT', 0),
			'image_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
		),
		'PRIMARY_KEY'		=> 'watch_id',
		'KEYS'		=> array(
			'uid'			=> array('INDEX', 'user_id'),
			'id'			=> array('INDEX', 'image_id'),
			'aid'			=> array('INDEX', 'album_id'),
		),
	);
	

	$schema_data['phpbb_groups'] = array(
		'COLUMNS'		=> array(
			'group_id'				=> array('UINT', NULL, 'auto_increment'),
			'group_type'			=> array('TINT:4', 1),
			'group_founder_manage'	=> array('BOOL', 0),
			'group_skip_auth'		=> array('BOOL', 0),
			'group_name'			=> array('VCHAR_CI', ''),
			'group_desc'			=> array('TEXT_UNI', ''),
			'group_desc_bitfield'	=> array('VCHAR:255', ''),
			'group_desc_options'	=> array('UINT:11', 7),
			'group_desc_uid'		=> array('VCHAR:8', ''),
			'group_display'			=> array('BOOL', 0),
			'group_avatar'			=> array('VCHAR', ''),
			'group_avatar_type'		=> array('TINT:2', 0),
			'group_avatar_width'	=> array('USINT', 0),
			'group_avatar_height'	=> array('USINT', 0),
			'group_rank'			=> array('UINT', 0),
			'group_colour'			=> array('VCHAR:6', ''),
			'group_sig_chars'		=> array('UINT', 0),
			'group_receive_pm'		=> array('BOOL', 0),
			'group_message_limit'	=> array('UINT', 0),
			'group_max_recipients'	=> array('UINT', 0),
			'group_legend'			=> array('BOOL', 1),
			'group_dl_auto_traffic'	=> array('BINT', 0),
			'group_meeting_create'	=> array('BOOL', 0),
			'group_meeting_select'	=> array('BOOL', 0),
			'display_on_registration'	=> array('BOOL', 0),			
		),
		'PRIMARY_KEY'	=> 'group_id',
		'KEYS'			=> array(
			'group_legend_name'		=> array('INDEX', array('group_legend', 'group_name')),
		),
	);

	$schema_data['phpbb_icons'] = array(
		'COLUMNS'		=> array(
			'icons_id'				=> array('UINT', NULL, 'auto_increment'),
			'icons_url'				=> array('VCHAR', ''),
			'icons_width'			=> array('TINT:4', 0),
			'icons_height'			=> array('TINT:4', 0),
			'icons_order'			=> array('UINT', 0),
			'display_on_posting'	=> array('BOOL', 1),
			'icons_group'			=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'icons_id',
		'KEYS'			=> array(
			'display_on_posting'	=> array('INDEX', 'display_on_posting'),
		),
	);

	$schema_data['phpbb_imod_config'] = array(
		'COLUMNS'		=> array(
			'id'					=> array('USINT', NULL, 'auto_increment'),
			'imod_version'			=> array('VCHAR:8', '3.0.15'),
			'imod_enabled'			=> array('BOOL', 1),
		),
		'PRIMARY_KEY'	=> 'id',
	);
	
	$schema_data['phpbb_kb_article'] = array(
		'COLUMNS'		=> array(
			'article_id'			=> array('UINT:11', NULL, 'auto_increment'),
			'cat_id'				=> array('UINT', 0),
			'type_id'				=> array('UINT', 0),
			'hits'					=> array('UINT:11', 0),
			'titel'					=> array('VCHAR', ''),
			'description'			=> array('TEXT_UNI', ''),
			'article'				=> array('MTEXT_UNI', ''),
			'user_id'				=> array('UINT', 0),
			'last_edit_user'		=> array('UINT', 0),
			'activ'					=> array('BOOL', 0),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'bbcode_bitfield'		=> array('VCHAR:255', ''),	
			'bbcode_options'		=> array('VCHAR:255', ''),	
			'enable_magic_url'		=> array('BOOL', 0),
			'enable_smilies'		=> array('BOOL', 0),
			'enable_bbcode'			=> array('BOOL', 0),
			'post_time'				=> array('TIMESTAMP', 0),
			'page_uri'				=> array('VCHAR:255', ''),	
			'last_change'			=> array('TIMESTAMP', 0),
			'post_id'				=> array('UINT', 0),
			'has_attachment'		=> array('BOOL', 0),
			'reported_id'			=> array('UINT', 0),			
			'rating'				=> array('UINT', 0),			
		),
		'PRIMARY_KEY'	=> 'article_id',
		'KEYS'			=> array(
			'activ'	         => array('INDEX', 'activ'),
			'titel_fulltext' => array('FULLTEXT', 'titel'),
		),		
	);
	
	$schema_data['phpbb_kb_article_diff'] = array(
		'COLUMNS'		=> array(
			'diff_id'				=> array('UINT', NULL, 'auto_increment'),		
			'article_id'			=> array('UINT', 0),
			'article'				=> array('MTEXT_UNI', ''),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'time'					=> array('TIMESTAMP', 0),
			'edit_reason'			=> array('VCHAR:255', ''),
			'user_id'				=> array('UINT', 0),	
		),
		'PRIMARY_KEY'	=> 'article_id',
		'KEYS'			=> array(
			'diff_id'	=> array('INDEX', 'diff_id'),
		),			
	);
	
	$schema_data['phpbb_kb_article_track'] = array(
		'COLUMNS'		=> array(
			'user_id'				=> array('UINT', 0),			
			'article_id'			=> array('UINT', 0),
			'cat_id'				=> array('UINT', 0),
			'mark_time'				=> array('TIMESTAMP', 0),
		),
		'PRIMARY_KEY'	=> 'article_id',
		'KEYS'			=> array(
			'user_id'	=> array('INDEX', 'user_id'),
		),		
	);

	$schema_data['phpbb_kb_categorie'] = array(
		'COLUMNS'		=> array(
			'cat_id'				=> array('UINT', NULL, 'auto_increment'),		
			'right_id'				=> array('UINT', 0),
			'left_id'				=> array('UINT', 0),
			'parent_id'				=> array('UINT', 0),
			'cat_mode'				=> array('BOOL', 0),
			'cat_parents'			=> array('VCHAR:255', ''),
			'show_edits'			=> array('BOOL', 0),
			'post_forum'			=> array('UINT', 0),
			'cat_title'			    => array('VCHAR:255', ''),	
			'description'			=> array('VCHAR:255', ''),	
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'bbcode_bitfield'		=> array('VCHAR:255', ''),	
			'bbcode_options'		=> array('INT:4', 0),
			'image'					=> array('VCHAR:255', ''),	
			'display_on_index'		=> array('BOOL', 0),
			'cat_articles'			=> array('UINT', 0),
			'last_article_url'		=> array('VCHAR:255', ''),
			'last_article_time'		=> array('TIMESTAMP', 0),
			'last_article_id'		=> array('UINT', 0),
			'last_article_poster_name'	 => array('VCHAR:255', ''),	
			'last_article_poster_id'	 => array('UINT', 0),
			'last_article_poster_colour' => array('VCHAR:8', ''),
			'last_article_title'	=> array('VCHAR:255', ''),	
			'ads'	 				=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'cat_id',
	);
	
	$schema_data['phpbb_kb_changelog'] = array(
		'COLUMNS'		=> array(
			'log_id'				=> array('UINT', NULL, 'auto_increment'),		
			'article_id'			=> array('UINT', 0),
			'time'					=> array('TIMESTAMP', 0),
			'user_id'				=> array('UINT', 0),
			'reason'	 			=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'log_id',
	);
	
	$schema_data['phpbb_kb_config'] = array(
		'COLUMNS'		=> array(
			'config_name'			=> array('VCHAR:100', ''),
			'config_value'			=> array('MTEXT_UNI', ''),
			'config_type'			=> array('BOOL', 1),
		),
		'PRIMARY_KEY'	=> 'config_name',
	);

	$schema_data['phpbb_kb_rating'] = array(
		'COLUMNS'		=> array(
			'article_id'			=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'points'				=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'article_id',
	);

	$schema_data['phpbb_kb_reports'] = array(
		'COLUMNS'		=> array(
			'report_id'				=> array('UINT', NULL, 'auto_increment'),
			'reason_id'				=> array('USINT', 0),
			'article_id'			=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'user_notify'			=> array('BOOL', 0),
			'report_closed'			=> array('BOOL', 0),
			'report_time'			=> array('TIMESTAMP', 0),
			'report_text'	 		=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'report_id',
	);
	
	$schema_data['phpbb_kb_types'] = array(
		'COLUMNS'		=> array(
			'type_id'				=> array('UINT', NULL, 'auto_increment'),
			'name'					=> array('VCHAR:255', ''),	
		),
		'PRIMARY_KEY'	=> 'type_id',
	);
	
	$schema_data['phpbb_k_blocks'] = array(
		'COLUMNS'		=> array(
			'id'					=> array('UINT', NULL, 'auto_increment'),
			'ndx'					=> array('UINT', '0'),
			'title'					=> array('VCHAR:50', ''),
			'position'				=> array('CHAR:1', 'L'),
			'type'					=> array('CHAR:1', 'H'),
			'active'				=> array('BOOL', '1'),
			'html_file_name'		=> array('VCHAR', ''),
			'var_file_name'			=> array('VCHAR', 'none.gif'),
			'img_file_name'			=> array('VCHAR', 'none.gif'),
			'view_all'				=> array('BOOL', '1'),
			'view_groups'			=> array('VCHAR:100', ''),
			'view_pages'			=> array('VCHAR:100', ''),
			'`groups`'				=> array('UINT', '0'),
			'scroll'				=> array('BOOL', '0'),
			'block_height'			=> array('USINT', '0'),
			'has_vars'				=> array('BOOL', '0'),
			'is_static'				=> array('BOOL', '0'),
			'minimod_based'			=> array('BOOL', '0'),
			'mod_block_id'			=> array('UINT', '0'),
			'block_cache_time'		=> array('UINT', '600'),
		),
		'PRIMARY_KEY'	=> 'id',
		'KEYS'			 => array(
			'ndx' => array('INDEX', 'ndx'),
		),		
	);
	
	$schema_data['phpbb_k_blocks_config'] = array(
		'COLUMNS'		=> array(
			'id'					=> array('UINT', NULL, 'auto_increment'),
			'use_external_files'	=> array('BOOL', '0'),
			'update_files'			=> array('BOOL', '0'),
			'layout_default'		=> array('BOOL', '2'),
			'portal_config'			=> array('VCHAR:10', 'Site'),
		),
		'PRIMARY_KEY'	=> 'id',
	);
	
	$schema_data['phpbb_k_config_vars'] = array(
		'COLUMNS'		=> array(
			'config_name'		=> array('VCHAR', ''),
			'config_value'		=> array('VCHAR', ''),
			'is_dynamic'		=> array('BOOL', '0'),
		),
		'PRIMARY_KEY'	=> 'config_name',		
		'KEYS'			 => array(
			'is_dynamic' => array('INDEX', 'is_dynamic'),
		),			
	);
	
	$schema_data['phpbb_k_menus'] = array(
		'COLUMNS'		=> array(
			'm_id'					=> array('UINT', NULL, 'auto_increment'),
			'ndx'					=> array('UINT', '0'),
			'menu_type'				=> array('USINT', '0'),
			'name'					=> array('VCHAR:50', ''),
			'link_to'				=> array('VCHAR', ''),
			'extern'				=> array('BOOL', '0'),
			'menu_icon'				=> array('VCHAR:30', 'none.gif'),
			'append_sid'			=> array('BOOL', '1'),
			'append_uid'			=> array('BOOL', '0'),
			'view_all'				=> array('BOOL', '1'),
			'view_groups'			=> array('VCHAR:100', ''),
			'soft_hr'				=> array('BOOL', '0'),
			'sub_heading'			=> array('BOOL', '0'),
		),
		'PRIMARY_KEY'	=> 'm_id',
	);
	
	$schema_data['phpbb_k_pages'] = array(
		'COLUMNS'		=> array(
			'page_id'				=> array('UINT', NULL, 'auto_increment'),
			'page_name'				=> array('VCHAR_UNI:100', ''),
		),
		'PRIMARY_KEY'	=> 'page_id',
	);
	
	$schema_data['phpbb_k_resources'] = array(
		'COLUMNS'		=> array(
			'id'					=> array('UINT', NULL, 'auto_increment'),
			'word'					=> array('VCHAR:30', ''),
			'type'					=> array('CHAR:1', 'V'),
		),
		'PRIMARY_KEY'	=> 'id',
	);

	$schema_data['phpbb_lang'] = array(
		'COLUMNS'		=> array(
			'lang_id'				=> array('TINT:4', NULL, 'auto_increment'),
			'lang_iso'				=> array('VCHAR:30', ''),
			'lang_dir'				=> array('VCHAR:30', ''),
			'lang_english_name'		=> array('VCHAR_UNI:100', ''),
			'lang_local_name'		=> array('VCHAR_UNI:255', ''),
			'lang_author'			=> array('VCHAR_UNI:255', ''),
		),
		'PRIMARY_KEY'	=> 'lang_id',
		'KEYS'			=> array(
			'lang_iso'				=> array('INDEX', 'lang_iso'),
		),
	);

	$schema_data['phpbb_likes'] = array(
		'COLUMNS'		=> array(
			'like_id'				=> array('UINT:11', NULL, 'auto_increment'),
			'post_id'				=> array('UINT', 0),
			'topic_id'				=> array('UINT', 0),
			'poster_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'like_date'				=> array('INT:11', 0),
			'like_state'			=> array('UINT', 0),
			'like_read'				=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'like_id',
	);

	$schema_data['phpbb_log'] = array(
		'COLUMNS'		=> array(
			'log_id'				=> array('UINT', NULL, 'auto_increment'),
			'log_type'				=> array('TINT:4', 0),
			'user_id'				=> array('UINT', 0),
			'forum_id'				=> array('UINT', 0),
			'topic_id'				=> array('UINT', 0),
			'reportee_id'			=> array('UINT', 0),
			'log_ip'				=> array('VCHAR:40', ''),
			'log_time'				=> array('TIMESTAMP', 0),
			'log_operation'			=> array('TEXT_UNI', ''),
			'log_data'				=> array('MTEXT_UNI', ''),
			'album_id'				=> array('UINT', 0),
			'image_id'				=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'log_id',
		'KEYS'			=> array(
			'log_type'				=> array('INDEX', 'log_type'),
			'forum_id'				=> array('INDEX', 'forum_id'),
			'topic_id'				=> array('INDEX', 'topic_id'),
			'reportee_id'			=> array('INDEX', 'reportee_id'),
			'user_id'				=> array('INDEX', 'user_id'),
		),
	);

	$schema_data['phpbb_login_attempts'] = array(
		'COLUMNS'		=> array(
			'attempt_ip'			=> array('VCHAR:40', ''),
			'attempt_browser'		=> array('VCHAR:150', ''),
			'attempt_forwarded_for'	=> array('VCHAR:255', ''),
			'attempt_time'			=> array('TIMESTAMP', 0),
			'user_id'				=> array('UINT', 0),
			'username'				=> array('VCHAR_UNI:255', 0),
			'username_clean'		=> array('VCHAR_CI', 0),
		),
		'KEYS'			=> array(
			'att_ip'				=> array('INDEX', array('attempt_ip', 'attempt_time')),
			'att_for'				=> array('INDEX', array('attempt_forwarded_for', 'attempt_time')),
			'att_time'				=> array('INDEX', array('attempt_time')),
			'user_id'				=> array('INDEX', 'user_id'),
		),
	);

	$schema_data['phpbb_mchat'] = array(
		'COLUMNS'		=> array(
			'message_id'			=> array('UINT', NULL, 'auto_increment'),
			'user_id'				=> array('UINT', 0),
			'user_ip'				=> array('VCHAR:40', ''),
			'message'				=> array('MTEXT_UNI', ''),
			'bbcode_bitfield'		=> array('VCHAR', ''),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'bbcode_options'		=> array('BOOL', 7),
			'message_time'			=> array('TIMESTAMP', 0),
			'forum_id'				=> array('UINT', 0),
			'post_id'				=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'message_id',
		'KEYS'			=> array(
			'user_id'				=> array('INDEX', 'user_id'),
		),	
	);
	
	$schema_data['phpbb_mchat_config'] = array(
		'COLUMNS'		=> array(
			'config_name'			=> array('VCHAR', ''),
			'config_value'			=> array('VCHAR', ''),
		),
		'PRIMARY_KEY'	=> 'config_name',		
	);

	$schema_data['phpbb_mchat_sessions'] = array(
		'COLUMNS'		=> array(
			'user_id'				=> array('UINT', 0),
			'user_lastupdate'		=> array('TIMESTAMP', 0),
			'user_ip'				=> array('VCHAR:40', ''),
		),
	);
	
	$schema_data['phpbb_meeting_comment'] = array(
		'COLUMNS'		=> array(
			'comment_id'			=> array('UINT', NULL, 'auto_increment'),
			'meeting_id'			=> array('UINT', 0),
			'user_id'				=> array('INT:8', 0),
			'meeting_comment'		=> array('MTEXT_UNI', ''),
			'meeting_edit_time'		=> array('INT:11', 0),
			'approve'				=> array('BOOL', 0),
			'uid'					=> array('VCHAR:8', ''),
			'bitfield'				=> array('VCHAR:255', ''),
			'flags'					=> array('UINT:11', 0),
		),
		'PRIMARY_KEY'	=> 'comment_id',
	);
	
	$schema_data['phpbb_meeting_data'] = array(
		'COLUMNS'		=> array(
			'meeting_id'			=> array('UINT', 0),
			'meeting_time'			=> array('INT:11', 0),
			'meeting_until'			=> array('INT:11', 0),
			'meeting_location'		=> array('VCHAR', ''),
			'meeting_subject'		=> array('STEXT_UNI', ''),
			'meeting_desc'			=> array('MTEXT_UNI', ''),
			'meeting_link'			=> array('VCHAR', ''),
			'meeting_places'		=> array('UINT:8', 0),
			'meeting_by_user'		=> array('UINT:8', 0),
			'meeting_edit_by_user'	=> array('UINT:8', 0),
			'meeting_start_value'	=> array('UINT:8', 0),
			'meeting_recure_value'	=> array('UINT:8', 0),
			'meeting_notify'		=> array('BOOL', 0),
			'meeting_guest_overall'	=> array('INT:8', 0),
			'meeting_guest_single'	=> array('INT:8', 0),
			'meeting_guest_names'	=> array('BOOL', 0),
			'uid'					=> array('CHAR:8', ''),
			'bitfield'				=> array('VCHAR', ''),
			'flags'					=> array('UINT:11', 0),
			'meeting_end'			=> array('INT:11', 0),
		),
		'PRIMARY_KEY'	=> 'meeting_id'
	);
	
	$schema_data['phpbb_meeting_guestnames'] = array(
		'COLUMNS'		=> array(
			'meeting_id'			=> array('INT:8', 0),
			'user_id'				=> array('INT:8', 0),
			'guest_prename'			=> array('VCHAR', ''),
			'guest_name'			=> array('VCHAR', ''),
		),
	);
	
	$schema_data['phpbb_meeting_user'] = array(
		'COLUMNS'		=> array(
			'meeting_id'			=> array('UINT', 0),
			'user_id'				=> array('INT:8', 0),
			'meeting_sure'			=> array('TINT:4', 0),
			'meeting_guests'		=> array('INT:8', 0),
		),
	);
	
	$schema_data['phpbb_meeting_usergroup'] = array(
		'COLUMNS'		=> array(
			'meeting_id'			=> array('UINT', 0),
			'meeting_group'			=> array('INT:8', 0),
		),
	);
	

	$schema_data['phpbb_moderator_cache'] = array(
		'COLUMNS'		=> array(
			'forum_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'username'				=> array('VCHAR_UNI:255', ''),
			'group_id'				=> array('UINT', 0),
			'group_name'			=> array('VCHAR_UNI', ''),
			'display_on_index'		=> array('BOOL', 1),
		),
		'KEYS'			=> array(
			'disp_idx'				=> array('INDEX', 'display_on_index'),
			'forum_id'				=> array('INDEX', 'forum_id'),
		),
	);

	$schema_data['phpbb_mods'] = array(
		'COLUMNS'		=> array(
			'mod_id'				=> array('UINT', NULL, 'auto_increment'),
			'mod_active'			=> array('BOOL', 0),
			'mod_time'				=> array('TIMESTAMP', 0),
			'mod_dependencies'		=> array('MTEXT_UNI', ''),
			'mod_name'				=> array('TEXT_UNI', ''),
			'mod_description'		=> array('TEXT_UNI', ''),
			'mod_version'			=> array('VCHAR:25', ''),
			'mod_author_notes'		=> array('TEXT_UNI', ''),
			'mod_author_name'		=> array('VCHAR_UNI:100', ''),
			'mod_author_email'		=> array('VCHAR_UNI:100', ''),
			'mod_author_url'		=> array('VCHAR_UNI:100', ''),
			'mod_actions'			=> array('MTEXT_UNI', ''),
			'mod_languages'			=> array('VCHAR_UNI:255', ''),
			'mod_template'			=> array('VCHAR_UNI:255', ''),
			'mod_path'				=> array('VCHAR_UNI:255', ''),
			'mod_contribs'			=> array('VCHAR_UNI:255', ''),			
		),
		'PRIMARY_KEY'	=> 'mod_id'
	);
	
	$schema_data['phpbb_mods_database'] = array(
		'COLUMNS'		=> array(
			'mod_id'				=> array('USINT', NULL, 'auto_increment'),
			'mod_title'				=> array('VCHAR:50', ''),
			'mod_version'			=> array('VCHAR_UNI:10', ''),
			'mod_version_type'		=> array('VCHAR:10', ''),
			'mod_desc'				=> array('TEXT_UNI', ''),
			'mod_url'				=> array('VCHAR_UNI:100', ''),
			'mod_author'			=> array('VCHAR:50', ''),
			'mod_download'			=> array('VCHAR', ''),
			'mod_phpbb_version'		=> array('VCHAR_UNI:10', ''),
			'mod_comments'			=> array('TEXT_UNI', ''),
			'mod_access'			=> array('BOOL', 0),
			'mod_author_email'		=> array('VCHAR_UNI:100', ''),
			'mod_install_date'		=> array('TIMESTAMP', 0),
		),
		'PRIMARY_KEY'	=> 'mod_id'		
	);

	$schema_data['phpbb_modules'] = array(
		'COLUMNS'		=> array(
			'module_id'				=> array('UINT', NULL, 'auto_increment'),
			'module_enabled'		=> array('BOOL', 1),
			'module_display'		=> array('BOOL', 1),
			'module_basename'		=> array('VCHAR', ''),
			'module_class'			=> array('VCHAR:10', ''),
			'parent_id'				=> array('UINT', 0),
			'left_id'				=> array('UINT', 0),
			'right_id'				=> array('UINT', 0),
			'module_langname'		=> array('VCHAR', ''),
			'module_mode'			=> array('VCHAR', ''),
			'module_auth'			=> array('VCHAR', ''),
		),
		'PRIMARY_KEY'	=> 'module_id',
		'KEYS'			=> array(
			'left_right_id'			=> array('INDEX', array('left_id', 'right_id')),
			'module_enabled'		=> array('INDEX', 'module_enabled'),
			'class_left_id'			=> array('INDEX', array('module_class', 'left_id')),
		),
	);

	$schema_data['phpbb_notes'] = array(
		'COLUMNS'		=> array(
			'note_id'				=> array('UINT:11', 0),
			'note_user_id'			=> array('UINT:11', 0),
			'note_subject'			=> array('STEXT_UNI', ''),
			'note_text'				=> array('MTEXT_UNI', ''),
			'note_time'				=> array('UINT:11', 0),
			'note_uid'				=> array('CHAR:8', 1),
			'note_bitfield'			=> array('VCHAR', ''),
			'note_flags'			=> array('UINT:11', 0),
			'note_mem'				=> array('UINT:11', 0),
			'note_memx'				=> array('BOOL', 1),
		),
		'PRIMARY_KEY'	=> 'note_id',
		'KEYS'			=> array(
			'note_user_id'	=> array('INDEX', 'note_user_id'),
		),		
	);
	
	$schema_data['phpbb_pages'] = array(
		'COLUMNS'		=> array(
			'page_id'				=> array('UINT:11', 0),
			'page_title'			=> array('VCHAR', ''),
			'page_desc'				=> array('MTEXT_UNI', ''),
			'page_content'			=> array('MTEXT_UNI', ''),
			'page_url'				=> array('VCHAR', ''),
			'page_title'			=> array('VCHAR', ''),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'bbcode_bitfield'		=> array('VCHAR', ''),
			'page_time'				=> array('TIMESTAMP', 0),
			'page_order'			=> array('UINT:11', 0),
			'page_display'			=> array('BOOL', 0),
			'page_display_guests'	=> array('BOOL', 0),
			'page_author'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'page_id',		
	);
	
	$schema_data['phpbb_points_bank'] = array(
		'COLUMNS'		=> array(
			'id'					=> array('UINT:10', NULL, 'auto_increment'),
			'user_id'				=> array('UINT:10', 0),
			'holding'				=> array('DECIMAL:20', 0.00),
			'totalwithdrew'			=> array('DECIMAL:20', 0.00),
			'totaldeposit'			=> array('DECIMAL:20', 0.00),
			'opentime'				=> array('UINT:10', 0),
			'fees'					=> array('CHAR:5', 'on'),
		),
		'PRIMARY_KEY'	=> 'id',
	);
	
	$schema_data['phpbb_points_config'] = array(
		'COLUMNS'		=> array(
			'config_name'			=> array('VCHAR', ''),
			'config_value'			=> array('VCHAR_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'config_name',
	);
	
	$schema_data['phpbb_points_log'] = array(
		'COLUMNS'		=> array(
			'id'					=> array('UINT:11', NULL, 'auto_increment'),
			'point_send'			=> array('UINT:11', NULL, ''),
			'point_recv'			=> array('UINT:11', NULL, ''),
			'point_amount'			=> array('DECIMAL:20', 0.00),
			'point_sendold'			=> array('DECIMAL:20', 0.00),
			'point_recvold'			=> array('DECIMAL:20', 0.00),
			'point_comment'			=> array('MTEXT_UNI', ''),
			'point_type'			=> array('UINT:11', NULL, ''),
			'point_date'			=> array('UINT:11', NULL, ''),
		),
		'PRIMARY_KEY'	=> 'id',
	);
	
/** TO DO    phpbb_points_lottery_history ( */
	$schema_data['phpbb_points_lottery_history'] = array(
		'COLUMNS'					=> array(
			'id'					=> array('UINT:11', NULL, 'auto_increment'),
			'user_id'				=> array('UINT', 0),
			'user_name'				=> array('VCHAR', ''),
			'time'					=> array('UINT:11', 0),
			'amount'				=> array('DECIMAL:20', 0.00),
		),
		'PRIMARY_KEY'	=> 'id',
	);
	
	$schema_data['phpbb_points_lottery_tickets'] = array(
		'COLUMNS'		=> array(
			'ticket_id'	=> array('UINT:11', NULL, 'auto_increment'),
			'user_id'	=> array('UINT:11', 0),
		),
		'PRIMARY_KEY'	=> 'ticket_id',
	);
	
	$schema_data['phpbb_points_values'] = array(
		'COLUMNS'		=> array(
			'bank_cost'						=> array('DECIMAL:10', 0.00),
			'bank_fees'						=> array('DECIMAL:10', 0.00),
			'bank_interest'					=> array('DECIMAL:10', 0.00),
			'bank_interestcut'				=> array('DECIMAL:20', 0.00),
			'bank_last_restocked'			=> array('UINT:11', NULL),
			'bank_min_deposit'				=> array('DECIMAL:10', 0.00),
			'bank_min_withdraw'				=> array('DECIMAL:10', 0.00),
			'bank_name'						=> array('VCHAR:100', NULL),
			'bank_pay_period'				=> array('UINT:10', 2592000),
			'lottery_base_amount'			=> array('DECIMAL:10', 0.00),
			'lottery_chance'				=> array('DECIMAL', 50.00),
			'lottery_draw_period'			=> array('UINT:10', 3600),
			'lottery_jackpot'				=> array('DECIMAL:20', 50.00),
			'lottery_last_draw_time'		=> array('UINT:11', NULL),
			'lottery_max_tickets'			=> array('UINT:10', 10),
			'lottery_name'					=> array('VCHAR:100', ''),
			'lottery_prev_winner'			=> array('VCHAR', ''),
			'lottery_prev_winner_id'		=> array('UINT:10', 0),
			'lottery_ticket_cost'			=> array('DECIMAL:10', 0.00),
			'lottery_winners_total'			=> array('UINT', 0),
			'number_show_per_page'			=> array('UINT:10', 0),
			'number_show_top_points'		=> array('UINT', 0),
			'points_dl_cost_per_attach'		=> array('DECIMAL:10', 0.00),
			'points_per_attach'				=> array('DECIMAL:10', 0.00),
			'points_per_attach_file'		=> array('DECIMAL:10', 0.00),
			'points_per_poll'				=> array('DECIMAL:10', 0.00),
			'points_per_poll_option'		=> array('DECIMAL:10', 0.00),
			'points_per_post_character'		=> array('DECIMAL:10', 0.00),
			'points_per_post_word'			=> array('DECIMAL:10', 0.00),
			'points_per_topic_character'	=> array('DECIMAL:10', 0.00),
			'points_per_topic_word'			=> array('DECIMAL:10', 0.00),
			'points_per_warn'				=> array('DECIMAL:10', 0.00),
			'reg_points_bonus'				=> array('DECIMAL:10', 0.00),
			'robbery_chance'				=> array('DECIMAL:5', 0.00),
			'robbery_loose'					=> array('DECIMAL:5', 0.00),
			'robbery_max_rob'				=> array('DECIMAL:5', 10.00),
			'lottery_pm_from'				=> array('UINT:10', 0),
			'forum_topic'					=> array('DECIMAL:10', 0.00),
			'forum_post'					=> array('DECIMAL:10', 0.00),
			'forum_edit'					=> array('DECIMAL:10', 0.00),			
			'gallery_upload'				=> array('DECIMAL:10', 0.00),
			'gallery_remove'				=> array('DECIMAL:10', 0.00),
			'gallery_view'					=> array('DECIMAL:10', 0.00),
		),
	);
	

	$schema_data['phpbb_poll_options'] = array(
		'COLUMNS'		=> array(
			'poll_option_id'		=> array('TINT:4', 0),
			'topic_id'				=> array('UINT', 0),
			'poll_option_text'		=> array('TEXT_UNI', ''),
			'poll_option_total'		=> array('UINT', 0),
		),
		'KEYS'			=> array(
			'poll_opt_id'			=> array('INDEX', 'poll_option_id'),
			'topic_id'				=> array('INDEX', 'topic_id'),
		),
	);

	$schema_data['phpbb_poll_votes'] = array(
		'COLUMNS'		=> array(
			'topic_id'				=> array('UINT', 0),
			'poll_option_id'		=> array('TINT:4', 0),
			'vote_user_id'			=> array('UINT', 0),
			'vote_user_ip'			=> array('VCHAR:40', ''),
		),
		'KEYS'			=> array(
			'topic_id'				=> array('INDEX', 'topic_id'),
			'vote_user_id'			=> array('INDEX', 'vote_user_id'),
			'vote_user_ip'			=> array('INDEX', 'vote_user_ip'),
		),
	);

	$schema_data['phpbb_posts'] = array(
		'COLUMNS'		=> array(
			'post_id'				=> array('UINT', NULL, 'auto_increment'),
			'topic_id'				=> array('UINT', 0),
			'forum_id'				=> array('UINT', 0),
			'poster_id'				=> array('UINT', 0),
			'icon_id'				=> array('UINT', 0),
			'poster_ip'				=> array('VCHAR:40', ''),
			'post_time'				=> array('TIMESTAMP', 0),
			'post_approved'			=> array('BOOL', 1),
			'post_reported'			=> array('BOOL', 0),
			'enable_bbcode'			=> array('BOOL', 1),
			'enable_smilies'		=> array('BOOL', 1),
			'enable_magic_url'		=> array('BOOL', 1),
			'enable_sig'			=> array('BOOL', 1),
			'post_username'			=> array('VCHAR_UNI:255', ''),
			'post_subject'			=> array('STEXT_UNI', '', 'true_sort'),
			'post_text'				=> array('MTEXT_UNI', ''),
			'post_checksum'			=> array('VCHAR:32', ''),
			'post_attachment'		=> array('BOOL', 0),
			'bbcode_bitfield'		=> array('VCHAR:255', ''),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'post_postcount'		=> array('BOOL', 1),
			'post_edit_time'		=> array('TIMESTAMP', 0),
			'post_edit_reason'		=> array('STEXT_UNI', ''),
			'post_edit_user'		=> array('UINT', 0),
			'post_edit_count'		=> array('USINT', 0),
			'post_edit_locked'		=> array('BOOL', 0),
  			'points_received'		=> array('DECIMAL:20', 0.00),
  			'points_poll_received'	=> array('DECIMAL:20', 0.00),
  			'points_attachment_received'	=> array('DECIMAL:20', 0.00),
  			'points_topic_received'	=> array('DECIMAL:20', 0.00),
  			'points_post_received'	=> array('DECIMAL:20', 0.00),
		),
		'PRIMARY_KEY'	=> 'post_id',
		'KEYS'			=> array(
			'forum_id'				=> array('INDEX', 'forum_id'),
			'topic_id'				=> array('INDEX', 'topic_id'),
			'poster_ip'				=> array('INDEX', 'poster_ip'),
			'poster_id'				=> array('INDEX', 'poster_id'),
			'post_approved'			=> array('INDEX', 'post_approved'),
			'post_username'			=> array('INDEX', 'post_username'),
			'tid_post_time'			=> array('INDEX', array('topic_id', 'post_time')),
		),
	);

	$schema_data['phpbb_privmsgs'] = array(
		'COLUMNS'		=> array(
			'msg_id'				=> array('UINT', NULL, 'auto_increment'),
			'root_level'			=> array('UINT', 0),
			'author_id'				=> array('UINT', 0),
			'icon_id'				=> array('UINT', 0),
			'author_ip'				=> array('VCHAR:40', ''),
			'message_time'			=> array('TIMESTAMP', 0),
			'enable_bbcode'			=> array('BOOL', 1),
			'enable_smilies'		=> array('BOOL', 1),
			'enable_magic_url'		=> array('BOOL', 1),
			'enable_sig'			=> array('BOOL', 1),
			'message_subject'		=> array('STEXT_UNI', ''),
			'message_text'			=> array('MTEXT_UNI', ''),
			'message_edit_reason'	=> array('STEXT_UNI', ''),
			'message_edit_user'		=> array('UINT', 0),
			'message_attachment'	=> array('BOOL', 0),
			'bbcode_bitfield'		=> array('VCHAR:255', ''),
			'bbcode_uid'			=> array('VCHAR:8', ''),
			'message_edit_time'		=> array('TIMESTAMP', 0),
			'message_edit_count'	=> array('USINT', 0),
			'to_address'			=> array('TEXT_UNI', ''),
			'bcc_address'			=> array('TEXT_UNI', ''),
			'message_reported'		=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'msg_id',
		'KEYS'			=> array(
			'author_ip'				=> array('INDEX', 'author_ip'),
			'message_time'			=> array('INDEX', 'message_time'),
			'author_id'				=> array('INDEX', 'author_id'),
			'root_level'			=> array('INDEX', 'root_level'),
		),
	);

	$schema_data['phpbb_privmsgs_folder'] = array(
		'COLUMNS'		=> array(
			'folder_id'				=> array('UINT', NULL, 'auto_increment'),
			'user_id'				=> array('UINT', 0),
			'folder_name'			=> array('VCHAR_UNI', ''),
			'pm_count'				=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'folder_id',
		'KEYS'			=> array(
			'user_id'				=> array('INDEX', 'user_id'),
		),
	);

	$schema_data['phpbb_privmsgs_rules'] = array(
		'COLUMNS'		=> array(
			'rule_id'				=> array('UINT', NULL, 'auto_increment'),
			'user_id'				=> array('UINT', 0),
			'rule_check'			=> array('UINT', 0),
			'rule_connection'		=> array('UINT', 0),
			'rule_string'			=> array('VCHAR_UNI', ''),
			'rule_user_id'			=> array('UINT', 0),
			'rule_group_id'			=> array('UINT', 0),
			'rule_action'			=> array('UINT', 0),
			'rule_folder_id'		=> array('INT:11', 0),
		),
		'PRIMARY_KEY'	=> 'rule_id',
		'KEYS'			=> array(
			'user_id'				=> array('INDEX', 'user_id'),
		),
	);

	$schema_data['phpbb_privmsgs_to'] = array(
		'COLUMNS'		=> array(
			'msg_id'				=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'author_id'				=> array('UINT', 0),
			'pm_deleted'			=> array('BOOL', 0),
			'pm_new'				=> array('BOOL', 1),
			'pm_unread'				=> array('BOOL', 1),
			'pm_replied'			=> array('BOOL', 0),
			'pm_marked'				=> array('BOOL', 0),
			'pm_forwarded'			=> array('BOOL', 0),
			'folder_id'				=> array('INT:11', 0),
		),
		'KEYS'			=> array(
			'msg_id'				=> array('INDEX', 'msg_id'),
			'author_id'				=> array('INDEX', 'author_id'),
			'usr_flder_id'			=> array('INDEX', array('user_id', 'folder_id')),
		),
	);

	$schema_data['phpbb_profile_fields'] = array(
		'COLUMNS'		=> array(
			'field_id'				=> array('UINT', NULL, 'auto_increment'),
			'field_name'			=> array('VCHAR_UNI', ''),
			'field_type'			=> array('TINT:4', 0),
			'field_ident'			=> array('VCHAR:20', ''),
			'field_length'			=> array('VCHAR:20', ''),
			'field_minlen'			=> array('VCHAR', ''),
			'field_maxlen'			=> array('VCHAR', ''),
			'field_novalue'			=> array('VCHAR_UNI', ''),
			'field_default_value'	=> array('VCHAR_UNI', ''),
			'field_validation'		=> array('VCHAR_UNI:20', ''),
			'field_required'		=> array('BOOL', 0),
			'field_show_novalue'	=> array('BOOL', 0),
			'field_show_on_reg'		=> array('BOOL', 0),
			'field_show_on_vt'		=> array('BOOL', 0),
			'field_show_profile'	=> array('BOOL', 0),
			'field_hide'			=> array('BOOL', 0),
			'field_no_view'			=> array('BOOL', 0),
			'field_active'			=> array('BOOL', 0),
			'field_order'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'field_id',
		'KEYS'			=> array(
			'fld_type'			=> array('INDEX', 'field_type'),
			'fld_ordr'			=> array('INDEX', 'field_order'),
		),
	);

	$schema_data['phpbb_profile_fields_data'] = array(
		'COLUMNS'		=> array(
			'user_id'				=> array('UINT', 0),
			'pf_fcol'				=> array('TEXT_UNI', ''),
			'pf_reg_reason'			=> array('TEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'user_id',
	);

	$schema_data['phpbb_profile_fields_lang'] = array(
		'COLUMNS'		=> array(
			'field_id'				=> array('UINT', 0),
			'lang_id'				=> array('UINT', 0),
			'option_id'				=> array('UINT', 0),
			'field_type'			=> array('TINT:4', 0),
			'lang_value'			=> array('VCHAR_UNI', ''),
			'group_id'				=> array('UINT', 0),
			'group_name'			=> array('VCHAR_UNI', ''),
		),
		'PRIMARY_KEY'	=> array('field_id', 'lang_id', 'option_id'),
	);

	$schema_data['phpbb_profile_lang'] = array(
		'COLUMNS'		=> array(
			'field_id'				=> array('UINT', 0),
			'lang_id'				=> array('UINT', 0),
			'lang_name'				=> array('VCHAR_UNI', ''),
			'lang_explain'			=> array('TEXT_UNI', ''),
			'lang_default_value'	=> array('VCHAR_UNI', ''),
		),
		'PRIMARY_KEY'	=> array('field_id', 'lang_id'),
	);

	$schema_data['phpbb_qa_confirm'] = array(
		'COLUMNS'		=> array(
			'session_id'	=> array('CHAR:32', ''),
			'confirm_id'	=> array('CHAR:32', ''),
			'lang_iso'		=> array('VCHAR:30', ''),
			'question_id'	=> array('UINT', 0),
			'attempts'		=> array('UINT', 0),
			'confirm_type'	=> array('USINT', 0),
		),
		'PRIMARY_KEY'	=> 'confirm_id',
		'KEYS'			=> array(
			'session_id'			=> array('INDEX', 'session_id'),
			'lookup'			=> array('INDEX', 'confirm_id', 'session_id', 'lang_iso'),
		),
	);

	$schema_data['phpbb_ranks'] = array(
		'COLUMNS'		=> array(
			'rank_id'				=> array('UINT', NULL, 'auto_increment'),
			'rank_title'			=> array('VCHAR_UNI', ''),
			'rank_min'				=> array('UINT', 0),
			'rank_special'			=> array('BOOL', 0),
			'rank_image'			=> array('VCHAR', ''),
		),
		'PRIMARY_KEY'	=> 'rank_id',
	);

	$schema_data['phpbb_reports'] = array(
		'COLUMNS'		=> array(
			'report_id'				=> array('UINT', NULL, 'auto_increment'),
			'reason_id'				=> array('USINT', 0),
			'post_id'				=> array('UINT', 0),
			'pm_id'					=> array('UINT', 0),
			'user_id'				=> array('UINT', 0),
			'user_notify'			=> array('BOOL', 0),
			'report_closed'			=> array('BOOL', 0),
			'report_time'			=> array('TIMESTAMP', 0),
			'report_text'			=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'report_id',
		'KEYS'			=> array(
			'post_id'			=> array('INDEX', 'post_id'),
			'pm_id'				=> array('INDEX', 'pm_id'),
		),
	);

	$schema_data['phpbb_reports_reasons'] = array(
		'COLUMNS'		=> array(
			'reason_id'				=> array('USINT', NULL, 'auto_increment'),
			'reason_title'			=> array('VCHAR_UNI', ''),
			'reason_description'	=> array('MTEXT_UNI', ''),
			'reason_order'			=> array('USINT', 0),
		),
		'PRIMARY_KEY'	=> 'reason_id',
	);

	$schema_data['phpbb_search_results'] = array(
		'COLUMNS'		=> array(
			'search_key'			=> array('VCHAR:32', ''),
			'search_time'			=> array('TIMESTAMP', 0),
			'search_keywords'		=> array('MTEXT_UNI', ''),
			'search_authors'		=> array('MTEXT', ''),
		),
		'PRIMARY_KEY'	=> 'search_key',
	);

	$schema_data['phpbb_search_wordlist'] = array(
		'COLUMNS'		=> array(
			'word_id'			=> array('UINT', NULL, 'auto_increment'),
			'word_text'			=> array('VCHAR_UNI', ''),
			'word_common'		=> array('BOOL', 0),
			'word_count'		=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'word_id',
		'KEYS'			=> array(
			'wrd_txt'			=> array('UNIQUE', 'word_text'),
			'wrd_cnt'			=> array('INDEX', 'word_count'),
		),
	);

	$schema_data['phpbb_search_wordmatch'] = array(
		'COLUMNS'		=> array(
			'post_id'			=> array('UINT', 0),
			'word_id'			=> array('UINT', 0),
			'title_match'		=> array('BOOL', 0),
		),
		'KEYS'			=> array(
			'unq_mtch'			=> array('UNIQUE', array('word_id', 'post_id', 'title_match')),
			'word_id'			=> array('INDEX', 'word_id'),
			'post_id'			=> array('INDEX', 'post_id'),
		),
	);

	$schema_data['phpbb_sessions'] = array(
		'COLUMNS'		=> array(
			'session_id'			=> array('CHAR:32', ''),
			'session_user_id'		=> array('UINT', 0),
			'session_forum_id'		=> array('UINT', 0),
			'session_last_visit'	=> array('TIMESTAMP', 0),
			'session_start'			=> array('TIMESTAMP', 0),
			'session_time'			=> array('TIMESTAMP', 0),
			'session_ip'			=> array('VCHAR:40', ''),
			'session_browser'		=> array('VCHAR:150', ''),
			'session_forwarded_for'	=> array('VCHAR:255', ''),
			'session_page'			=> array('VCHAR_UNI', ''),
			'session_viewonline'	=> array('BOOL', 1),
			'session_autologin'		=> array('BOOL', 0),
			'session_admin'			=> array('BOOL', 0),
            'session_album_id'		=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'session_id',
		'KEYS'			=> array(
			'session_time'		=> array('INDEX', 'session_time'),
			'session_user_id'	=> array('INDEX', 'session_user_id'),
			'session_fid'		=> array('INDEX', 'session_forum_id'),
			'session_aid'		=> array('INDEX', 'session_album_id'),			
		),
	);

	$schema_data['phpbb_sessions_keys'] = array(
		'COLUMNS'		=> array(
			'key_id'			=> array('CHAR:32', ''),
			'user_id'			=> array('UINT', 0),
			'last_ip'			=> array('VCHAR:40', ''),
			'last_login'		=> array('TIMESTAMP', 0),
		),
		'PRIMARY_KEY'	=> array('key_id', 'user_id'),
		'KEYS'			=> array(
			'last_login'		=> array('INDEX', 'last_login'),
		),
	);

	$schema_data['phpbb_shoutbox'] = array(
		'COLUMNS'		=> array(
			'shout_id'				=> array('UINT', NULL, 'auto_increment'),
			'shout_user_id'			=> array('UINT', 0),
			'shout_time'			=> array('TIMESTAMP', 0),
			'shout_ip'				=> array('VCHAR:40', ''),
			'shout_text'			=> array('MTEXT', ''),
			'shout_bbcode_bitfield'	=> array('VCHAR:255', ''),
			'shout_bbcode_uid'		=> array('VCHAR:8', ''),
			'shout_bbcode_flags'	=> array('INT:11', 7),
		),
		'PRIMARY_KEY'		=> 'shout_id',
	);

	$schema_data['phpbb_sitelist'] = array(
		'COLUMNS'		=> array(
			'site_id'		=> array('UINT', NULL, 'auto_increment'),
			'site_ip'		=> array('VCHAR:40', ''),
			'site_hostname'	=> array('VCHAR', ''),
			'ip_exclude'	=> array('BOOL', 0),
		),
		'PRIMARY_KEY'		=> 'site_id',
	);

	$schema_data['phpbb_smilies'] = array(
		'COLUMNS'		=> array(
			'smiley_id'			=> array('UINT', NULL, 'auto_increment'),
			// We may want to set 'code' to VCHAR:50 or check if unicode support is possible... at the moment only ASCII characters are allowed.
			'code'				=> array('VCHAR_UNI:50', ''),
			'emotion'			=> array('VCHAR_UNI:50', ''),
			'smiley_url'		=> array('VCHAR:50', ''),
			'smiley_width'		=> array('USINT', 0),
			'smiley_height'		=> array('USINT', 0),
			'smiley_order'		=> array('UINT', 0),
			'display_on_posting'	=> array('BOOL', 1),
			'smiley_group'		=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'smiley_id',
		'KEYS'			=> array(
			'display_on_post'		=> array('INDEX', 'display_on_posting'),
		),
	);

	$schema_data['phpbb_sn_config'] = array(
		'COLUMNS'		 => array(
			'config_name'	 => array('VCHAR', ''),
			'config_value'	 => array('VCHAR', ''),
			'is_dynamic'	 => array('BOOL', 0),
		),
		'PRIMARY_KEY'	 => array('config_name'),
		'KEYS'			 => array(
			'a'	 => array('INDEX', array('is_dynamic')),
		),
	);

	$schema_data['phpbb_sn_users'] = array(
		'COLUMNS'		 => array(
			'user_id'					 => array('UINT', 0),
			'user_status'				 => array('TEXT', ''),
			'user_im_online'			 => array('BOOL', 1),
			'user_zebra_alert_friend'	 => array('BOOL', 1),
			'user_note'					 => array('TEXT', ''),
			'user_im_sound'				 => array('TINT:1', '1'),
			'user_im_soundname'			 => array('VCHAR:255', 'IM_New-message-1.mp3'),
			'hometown'					 => array('VCHAR:255', ''),
			'sex'						 => array('TINT:1', 0),
			'interested_in'				 => array('TINT:1', 0),
			'languages'					 => array('TEXT', ''),
			'about_me'					 => array('TEXT', ''),
			'employer'					 => array('TEXT', ''),
			'university'				 => array('TEXT', ''),
			'high_school'				 => array('TEXT', ''),
			'religion'					 => array('TEXT', ''),
			'political_views'			 => array('TEXT', ''),
			'quotations'				 => array('TEXT', ''),
			'music'						 => array('TEXT', ''),
			'books'						 => array('TEXT', ''),
			'movies'					 => array('TEXT', ''),
			'games'						 => array('TEXT', ''),
			'foods'						 => array('TEXT', ''),
			'sports'					 => array('TEXT', ''),
			'sport_teams'				 => array('TEXT', ''),
			'activities'				 => array('TEXT', ''),
			'skype'						 => array('VCHAR:32', ''),
			'facebook'					 => array('VCHAR:255', ''),
			'twitter'					 => array('VCHAR:255', ''),
			'youtube'					 => array('VCHAR:255', ''),
			'profile_views'				 => array('UINT:11', 0),
			'profile_last_change'		 => array('UINT:11', 0),
		),
		'PRIMARY_KEY'	 => array('user_id'),
	);

	$schema_data['phpbb_sn_im'] = array(
		'COLUMNS'	 => array(
			'uid_from'			 => array('UINT', 0),
			'uid_to'			 => array('UINT', 0),
			'message'			 => array('TEXT', ''),
			'sent'				 => array('PDECIMAL:20', 0),
			'recd'				 => array('BOOL', 0),
			'bbcode_bitfield'	 => array('VCHAR:255', ''),
			'bbcode_uid'		 => array('VCHAR:8', ''),
		),
		'KEYS'		 => array(
			'a'	 => array('INDEX', array('sent')),
		),
	);
			
	$schema_data['phpbb_sn_im_chatboxes'] = array(			
				'COLUMNS'	 => array(
					'uid_from'		 => array('UINT', 0),
					'uid_to'		 => array('UINT', 0),
					'username_to'	 => array('VCHAR:255', ''),
					'starttime'		 => array('UINT:11', 0),
				),
				'KEYS'		 => array(
					'a'	 => array('UNIQUE', array('uid_from', 'uid_to')),
					'b'	 => array('INDEX', array('uid_from', 'uid_to', 'starttime')),
				),
			);

	$schema_data['phpbb_sn_status'] = array(			
				'COLUMNS'		 => array(
					'status_id'			 => array('UINT', NULL, 'auto_increment'),
					'poster_id'			 => array('UINT', 0),
					'status_time'		 => array('UINT:11', 0),
					'status_text'		 => array('TEXT', ''),
					'bbcode_bitfield'	 => array('VCHAR:255', ''),
					'bbcode_uid'		 => array('VCHAR:8', ''),
					'page_data'			 => array('TEXT', NULL),
					'wall_id'			 => array('UINT:8', 0),
				),
				'PRIMARY_KEY'	 => array('status_id'),
				'KEYS'			 => array(
					'b' => array('INDEX', array('poster_id', 'status_time')), ),
			);

	$schema_data['phpbb_sn_entries'] = array(
				'COLUMNS'		 => array(
					'entry_id'			 => array('UINT', NULL, 'auto_increment'),
					'user_id'			 => array('UINT', 0),
					'entry_target'		 => array('UINT', 0),
					'entry_type'		 => array('UINT:11', 0),
					'entry_time'		 => array('UINT:11', 0),
					'entry_additionals'	 => array('TEXT', ''),
				),
				'PRIMARY_KEY'	 => array('entry_id'),
				'KEYS'			 => array(
					'a'	 => array('INDEX', array('user_id', 'entry_target', 'entry_type', 'entry_time')),
				),
			);

	$schema_data['phpbb_sn_notify'] = array(
				'COLUMNS'		 => array(
					'ntf_id'	 => array('UINT:11', NULL, 'auto_increment'),
					'ntf_time'	 => array('UINT:11', 0),
					'ntf_type'	 => array('USINT', 0),
					'ntf_user'	 => array('UINT', 0),
					'ntf_poster' => array('UINT', 0),
					'ntf_read'	 => array('USINT', 0),
					'ntf_change' => array('UINT:11', 0),
					'ntf_data'	 => array('TEXT', ''),
				),
				'PRIMARY_KEY'	 => array('ntf_id'),
				'KEYS'			 => array(
					'a'	 => array('INDEX', array('ntf_read', 'ntf_user')),
					'b'	 => array('INDEX', array('ntf_read', 'ntf_time')),
					'c'	 => array('INDEX', array('ntf_read', 'ntf_change')),
				),
			);

	$schema_data['phpbb_sn_reports'] = array(
				'COLUMNS'		 => array(
					'report_id'		 => array('UINT', NULL, 'auto_increment'),
					'reason_id'		 => array('USINT', 0),
					'report_text'	 => array('TEXT', ''),
					'user_id'		 => array('UINT', 0),
					'reporter'		 => array('UINT', 0),
					'report_closed'	 => array('TINT:1', '0'),
				),
				'PRIMARY_KEY'	 => array('report_id'),
			);
			
	$schema_data['phpbb_sn_reports_reasons'] = array(			
				'COLUMNS'		 => array(
					'reason_id'		 => array('USINT', NULL, 'auto_increment'),
					'reason_text'	 => array('TEXT', ''),
				),
				'PRIMARY_KEY'	 => array('reason_id'),
			);
			
	$schema_data['phpbb_sn_menu'] = array(			
				'COLUMNS'		 => array(
					'button_id'				 => array('UINT', NULL, 'auto_increment'),
					'button_url'			 => array('TEXT', ''),
					'button_name'			 => array('VCHAR', ''),
					'button_external'		 => array('BOOL', 0),
					'button_display'		 => array('BOOL', 1),
					'button_only_registered' => array('BOOL', 0),
					'button_only_guest'		 => array('BOOL', 0),
					'left_id'				 => array('UINT', 0),
					'right_id'				 => array('UINT', 0),
					'parent_id'				 => array('UINT', 0),
				),
				'PRIMARY_KEY'	 => array('button_id'),
				'KEYS'			 => array(
					'a'	 => array('INDEX', 'left_id'),
					'b'	 => array('INDEX', 'right_id'),
					'c'	 => array('INDEX', 'parent_id'),
					'd'	 => array('INDEX', 'parent_id', 'left_id'),
				),
			);

	$schema_data['phpbb_sn_family'] = array(			
				'COLUMNS'		 => array(
					'id'				 => array('UINT', NULL, 'auto_increment'),
					'user_id'			 => array('UINT', '0'),
					'relative_user_id'	 => array('UINT', '0'),
					'status_id'			 => array('UINT', '0'),
					'approved'			 => array('TINT:1', '0'),
					'anniversary'		 => array('VCHAR:10', ''),
					'family'			 => array('TINT:1', '0'),
					'name'				 => array('VCHAR:255', ''),
				),
				'PRIMARY_KEY'	 => array('id'),
				'KEYS'			 => array(
					'a'	 => array('INDEX', 'user_id'),
					'b'	 => array('INDEX', 'relative_user_id'),
					'c'	 => array('INDEX', 'status_id'),
					'd'	 => array('INDEX', 'approved'),
				),
			);
			
	$schema_data['phpbb_sn_profile_visitors'] = array(			
				'COLUMNS'	 => array(
					'profile_uid'	 => array('UINT', '0'),
					'visitor_uid'	 => array('UINT', '0'),
					'visit_time'	 => array('UINT:11', '0'),
				),
				'KEYS'		 => array(
					'a'	 => array('INDEX', 'profile_uid'),
					'b'	 => array('INDEX', 'visitor_uid'),
					'c'	 => array('INDEX', 'visit_time')
				),
			);
			
	$schema_data['phpbb_sn_fms_groups'] = array(			
				'COLUMNS'		 => array(
					'fms_gid'		 => array('UINT', NULL, 'auto_increment'),
					'user_id'		 => array('UINT', '0'),
					'fms_name'		 => array('VCHAR:255', ''),
					'fms_clean'		 => array('VCHAR:255', ''),
					'fms_collapse'	 => array('BOOL', 0),
				),
				'KEYS'			 => array(
					'a'	 => array('UNIQUE', array('user_id', 'fms_name')),
					'b'	 => array('INDEX', array('fms_gid', 'user_id')),
					'c'	 => array('INDEX', array('user_id')),
					'd'	 => array('INDEX', array('fms_gid', 'user_id', 'fms_clean')),
					'e'	 => array('INDEX', array('fms_gid', 'user_id', 'fms_clean', 'fms_collapse')),
					'f'	 => array('UNIQUE', array('user_id', 'fms_clean')),
				),
			);
			
	$schema_data['phpbb_sn_fms_users_group'] = array(			
				'COLUMNS'		 => array(
					'fms_gid'	 => array('UINT', '0'),
					'user_id'	 => array('UINT', '0'),
					'owner_id'	 => array('UINT:11', 0),
				),
				'PRIMARY_KEY'	 => array('fms_gid', 'user_id', 'owner_id'),
				'KEYS'			 => array(
					'a'	 => array('INDEX', array('user_id')),
					'b'	 => array('INDEX', array('fms_gid')),
					'c'	 => array('INDEX', array('fms_gid', 'owner_id')),
				),
			);

	$schema_data['phpbb_sn_comments_modules'] = array(
				'COLUMNS'		 => array(
					'cmtmd_id'	 => array('UINT', NULL, 'auto_increment'),
					'cmtmd_name' => array('VCHAR:255', ''),
				),
				'PRIMARY_KEY'	 => array('cmtmd_id', 'cmtmd_name'),
				'KEYS'			 => array(
					'a'	 => array('UNIQUE', array('cmtmd_name')),
				),
			);
			
	$schema_data['phpbb_sn_comments'] = array(			
				'COLUMNS'		 => array(
					'cmt_id'			 => array('UINT', NULL, 'auto_increment'),
					'cmt_module'		 => array('UINT', 0),
					'cmt_time'			 => array('UINT:11', 0),
					'cmt_mid'			 => array('UINT', 0),
					'cmt_poster'		 => array('UINT', 0),
					'cmt_text'			 => array('TEXT', ''),
					'bbcode_bitfield'	 => array('VCHAR:255', ''),
					'bbcode_uid'		 => array('VCHAR:8', ''),
				),
				'PRIMARY_KEY'	 => array('cmt_id', 'cmt_module', 'cmt_mid'),
				'KEYS'			 => array(
					'a'	 => array('INDEX', array('cmt_module')),
					'b'	 => array('INDEX', array('cmt_time')),
					'c'	 => array('INDEX', array('cmt_module', 'cmt_mid')),
					'd'	 => array('INDEX', array('cmt_module', 'cmt_mid', 'cmt_time')),
					'e'	 => array('INDEX', array('cmt_module', 'cmt_mid', 'cmt_time', 'cmt_poster')),
				),
			);
			
	$schema_data['phpbb_sn_emotes'] = array(			
				'COLUMNS'		 => array(
					'emote_id'		 => array('UINT:8', NULL, 'auto_increment'),
					'emote_name'	 => array('VCHAR:255', ''),
					'emote_image'	 => array('VCHAR:255', ''),
					'emote_order'	 => array('UINT:8', 0),
				),
				'PRIMARY_KEY'	 => array('emote_id'),
				'KEYS'			 => array(
					'u'	 => array('UNIQUE', array('emote_name')),
					'a'	 => array('INDEX', array('emote_name', 'emote_order')),
					'b'	 => array('INDEX', array('emote_order')),
				)
			);
			
	$schema_data['phpbb_sn_addons_placeholder'] = array(			
				'COLUMNS'		 => array(
					'ph_id'		 => array('UINT:8', NULL, 'auto_increment'),
					'ph_script'	 => array('VCHAR:64', ''),
					'ph_block'	 => array('VCHAR:16', ''),
				),
				'PRIMARY_KEY'	 => array('ph_id'),
				'KEYS'			 => array(
					'u'	 => array('UNIQUE', array('ph_script', 'ph_block')),
					'a'	 => array('INDEX', array('ph_script')),
					'b'	 => array('INDEX', array('ph_block')),
				),
			);
			
	$schema_data['phpbb_sn_addons'] = array(			
				'COLUMNS'		 => array(
					'addon_id'			 => array('UINT:8', NULL, 'auto_increment'),
					'addon_placeholder'	 => array('UINT:8', 0),
					'addon_name'		 => array('VCHAR:64', ''),
					'addon_php'			 => array('VCHAR:32', ''),
					'addon_function'	 => array('VCHAR:32', ''),
					'addon_active'		 => array('USINT', 0),
					'addon_order'		 => array('UINT:8', 0)
				),
				'PRIMARY_KEY'	 => array('addon_id'),
				'KEYS'			 => array(
					'u'	 => array('UNIQUE', array('addon_placeholder', 'addon_name', 'addon_php', 'addon_function')),
					'a'	 => array('INDEX', array('addon_name', 'addon_php', 'addon_active')),
					'b'	 => array('INDEX', array('addon_order')),
				),
			);
			
	$schema_data['phpbb_sn_smilies'] = array(			
				'COLUMNS'		 => array(
					'smiley_id'		 => array('UINT:8', 0),
					'smiley_allowed' => array('TINT:1', 0),
				),
				'PRIMARY_KEY'	 => array('smiley_id'),
			);

	$schema_data['phpbb_sortables_answers'] = array(
		'COLUMNS'		=> array(
			'answer_id'				=> array('UINT', Null, 'auto_increment'),
			'question_id'			=> array('UINT', 0),
			'answer_sort'			=> array('BOOL', 0),
			'answer_text'			=> array('STEXT_UNI', ''),
		),
		'PRIMARY_KEY'		=> 'answer_id',
		'KEYS'				=> array(
			'qid'				=> array('INDEX', 'question_id'),
			'asort'				=> array('INDEX', 'answer_sort'),
		),
	);
	
	$schema_data['phpbb_sortables_confirm'] = array(
		'COLUMNS'		=> array(
			'session_id'			=> array('CHAR:32', ''),
			'confirm_id'			=> array('CHAR:32', ''),
			'lang_iso'				=> array('VCHAR:30', ''),
			'question_id'			=> array('UINT', 0),
			'attempts'				=> array('UINT', 0),
			'confirm_type'			=> array('USINT', 0),
		),
		'PRIMARY_KEY'		=> 'confirm_id',
		'KEYS'				=> array(
			'sid'				=> array('INDEX', 'session_id'),
			'lookup'			=> array('INDEX', array('confirm_id', 'session_id', 'lang_iso')),
		),
	);
	
	$schema_data['phpbb_sortables_questions'] = array(
		'COLUMNS'		=> array(
			'question_id'			=> array('UINT', Null, 'auto_increment'),
			'sort'					=> array('BOOL', 0),
			'lang_id'				=> array('UINT', 0),
			'lang_iso'				=> array('VCHAR:30', ''),
			'question_text'			=> array('TEXT_UNI', ''),
			'name_left'				=> array('STEXT_UNI', 0), // Column names
			'name_right'			=> array('STEXT_UNI', 0),
		),
		'PRIMARY_KEY'		=> 'question_id',
		'KEYS'				=> array(
			'iso'			=> array('INDEX', 'lang_iso'),
		),		
	);
	
	$schema_data['phpbb_spam_log'] = array(
		'COLUMNS'		=> array(
			'log_id'				=> array('UINT', NULL, 'auto_increment'),
			'log_type'				=> array('TINT:4', 1),
			'user_id'				=> array('UINT', 0),
			'forum_id'				=> array('UINT', 0),
			'topic_id'				=> array('UINT', 0),
			'reportee_id'			=> array('UINT', 0),
			'log_ip'				=> array('VCHAR:40', ''),
			'log_time'				=> array('TIMESTAMP', 0),
			'log_operation'			=> array('TEXT_UNI', ''),
			'log_data'				=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'log_id',
		'KEYS'			=> array(
			'log_type'				=> array('INDEX', 'log_type'),
			'forum_id'				=> array('INDEX', 'forum_id'),
			'topic_id'				=> array('INDEX', 'topic_id'),
			'reportee_id'			=> array('INDEX', 'reportee_id'),
			'user_id'				=> array('INDEX', 'user_id'),
		),
	);
	
	$schema_data['phpbb_spam_words'] = array(
		'COLUMNS'		=> array(
			'word_id'				=> array('UINT', NULL, 'auto_increment'),
			'word_text'				=> array('VCHAR_UNI', ''),
			'word_regex'			=> array('BOOL', 0),
			'word_regex_auto'		=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> 'word_id',
		'KEYS'			=> array(
			'word_text'				=> array('INDEX', 'word_text'),
		),		
	);

	$schema_data['phpbb_styles'] = array(
		'COLUMNS'		=> array(
			'style_id'				=> array('UINT', NULL, 'auto_increment'),
			'style_name'			=> array('VCHAR_UNI:255', ''),
			'style_copyright'		=> array('VCHAR_UNI', ''),
			'style_active'			=> array('BOOL', 1),
			'template_id'			=> array('UINT', 0),
			'theme_id'				=> array('UINT', 0),
			'imageset_id'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'style_id',
		'KEYS'			=> array(
			'style_name'		=> array('UNIQUE', 'style_name'),
			'template_id'		=> array('INDEX', 'template_id'),
			'theme_id'			=> array('INDEX', 'theme_id'),
			'imageset_id'		=> array('INDEX', 'imageset_id'),
		),
	);

	$schema_data['phpbb_styles_template'] = array(
		'COLUMNS'		=> array(
			'template_id'			=> array('UINT', NULL, 'auto_increment'),
			'template_name'			=> array('VCHAR_UNI:255', ''),
			'template_copyright'	=> array('VCHAR_UNI', ''),
			'template_path'			=> array('VCHAR:100', ''),
			'bbcode_bitfield'		=> array('VCHAR:255', 'kNg='),
			'template_storedb'		=> array('BOOL', 0),
			'template_inherits_id'		=> array('UINT:4', 0),
			'template_inherit_path'		=> array('VCHAR', ''),
		),
		'PRIMARY_KEY'	=> 'template_id',
		'KEYS'			=> array(
			'tmplte_nm'				=> array('UNIQUE', 'template_name'),
		),
	);

	$schema_data['phpbb_styles_template_data'] = array(
		'COLUMNS'		=> array(
			'template_id'			=> array('UINT', 0),
			'template_filename'		=> array('VCHAR:100', ''),
			'template_included'		=> array('TEXT', ''),
			'template_mtime'		=> array('TIMESTAMP', 0),
			'template_data'			=> array('MTEXT_UNI', ''),
		),
		'KEYS'			=> array(
			'tid'					=> array('INDEX', 'template_id'),
			'tfn'					=> array('INDEX', 'template_filename'),
		),
	);

	$schema_data['phpbb_styles_theme'] = array(
		'COLUMNS'		=> array(
			'theme_id'				=> array('UINT', NULL, 'auto_increment'),
			'theme_name'			=> array('VCHAR_UNI:255', ''),
			'theme_copyright'		=> array('VCHAR_UNI', ''),
			'theme_path'			=> array('VCHAR:100', ''),
			'theme_storedb'			=> array('BOOL', 0),
			'theme_mtime'			=> array('TIMESTAMP', 0),
			'theme_data'			=> array('MTEXT_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'theme_id',
		'KEYS'			=> array(
			'theme_name'		=> array('UNIQUE', 'theme_name'),
		),
	);

	$schema_data['phpbb_styles_imageset'] = array(
		'COLUMNS'		=> array(
			'imageset_id'				=> array('UINT', NULL, 'auto_increment'),
			'imageset_name'				=> array('VCHAR_UNI:255', ''),
			'imageset_copyright'		=> array('VCHAR_UNI', ''),
			'imageset_path'				=> array('VCHAR:100', ''),
		),
		'PRIMARY_KEY'		=> 'imageset_id',
		'KEYS'				=> array(
			'imgset_nm'			=> array('UNIQUE', 'imageset_name'),
		),
	);

	$schema_data['phpbb_styles_imageset_data'] = array(
		'COLUMNS'		=> array(
			'image_id'				=> array('UINT', NULL, 'auto_increment'),
			'image_name'			=> array('VCHAR:200', ''),
			'image_filename'		=> array('VCHAR:200', ''),
			'image_lang'			=> array('VCHAR:30', ''),
			'image_height'			=> array('USINT', 0),
			'image_width'			=> array('USINT', 0),
			'imageset_id'			=> array('UINT', 0),
		),
		'PRIMARY_KEY'		=> 'image_id',
		'KEYS'				=> array(
			'i_d'			=> array('INDEX', 'imageset_id'),
		),
	);

	$schema_data['phpbb_topics'] = array(
		'COLUMNS'		=> array(
			'topic_id'					=> array('UINT', NULL, 'auto_increment'),
			'forum_id'					=> array('UINT', 0),
			'icon_id'					=> array('UINT', 0),
			'topic_attachment'			=> array('BOOL', 0),
			'topic_approved'			=> array('BOOL', 1),
			'topic_reported'			=> array('BOOL', 0),
			'topic_title'				=> array('STEXT_UNI', '', 'true_sort'),
			'topic_poster'				=> array('UINT', 0),
			'topic_time'				=> array('TIMESTAMP', 0),
			'topic_time_limit'			=> array('TIMESTAMP', 0),
			'topic_views'				=> array('UINT', 0),
			'topic_replies'				=> array('UINT', 0),
			'topic_replies_real'		=> array('UINT', 0),
			'topic_status'				=> array('TINT:3', 0),
			'topic_type'				=> array('TINT:3', 0),
			'topic_first_post_id'		=> array('UINT', 0),
			'topic_first_poster_name'	=> array('VCHAR_UNI', ''),
			'topic_first_poster_colour'	=> array('VCHAR:6', ''),
			'topic_last_post_id'		=> array('UINT', 0),
			'topic_last_poster_id'		=> array('UINT', 0),
			'topic_last_poster_name'	=> array('VCHAR_UNI', ''),
			'topic_last_poster_colour'	=> array('VCHAR:6', ''),
			'topic_last_post_subject'	=> array('STEXT_UNI', ''),
			'topic_last_post_time'		=> array('TIMESTAMP', 0),
			'topic_last_view_time'		=> array('TIMESTAMP', 0),
			'topic_moved_id'			=> array('UINT', 0),
			'topic_bumped'				=> array('BOOL', 0),
			'topic_bumper'				=> array('UINT', 0),
			'poll_title'				=> array('STEXT_UNI', ''),
			'poll_start'				=> array('TIMESTAMP', 0),
			'poll_length'				=> array('TIMESTAMP', 0),
			'poll_max_options'			=> array('TINT:4', 1),
			'poll_last_vote'			=> array('TIMESTAMP', 0),
			'poll_vote_change'			=> array('BOOL', 0),
			'topic_calendar_time'       => array('UINT', 0, 'null'),
			'topic_calendar_duration'   => array('UINT:11', 0, 'null'),
			'event_repeat'              => array('VCHAR:8', '', 'null'),
			'invite_attendees'          => array('BOOL', 0, 'null'),
			'event_attendees'           => array('MTEXT_UNI', '', 'null'),
			'event_non_attendees'       => array('MTEXT_UNI', '', 'null'),
			'topic_first_post_show'     => array('BOOL', 0, 'null'),
		),
		'PRIMARY_KEY'	=> 'topic_id',
		'KEYS'			=> array(
			'forum_id'			=> array('INDEX', 'forum_id'),
			'forum_id_type'		=> array('INDEX', array('forum_id', 'topic_type')),
			'last_post_time'	=> array('INDEX', 'topic_last_post_time'),
			'topic_approved'	=> array('INDEX', 'topic_approved'),
			'forum_appr_last'	=> array('INDEX', array('forum_id', 'topic_approved', 'topic_last_post_id')),
			'fid_time_moved'	=> array('INDEX', array('forum_id', 'topic_last_post_time', 'topic_moved_id')),
		),
	);

	$schema_data['phpbb_topics_track'] = array(
		'COLUMNS'		=> array(
			'user_id'			=> array('UINT', 0),
			'topic_id'			=> array('UINT', 0),
			'forum_id'			=> array('UINT', 0),
			'mark_time'			=> array('TIMESTAMP', 0),
		),
		'PRIMARY_KEY'	=> array('user_id', 'topic_id'),
		'KEYS'			=> array(
			'topic_id'			=> array('INDEX', 'topic_id'),
			'forum_id'			=> array('INDEX', 'forum_id'),
		),
	);

	$schema_data['phpbb_topics_posted'] = array(
		'COLUMNS'		=> array(
			'user_id'			=> array('UINT', 0),
			'topic_id'			=> array('UINT', 0),
			'topic_posted'		=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> array('user_id', 'topic_id'),
	);

	$schema_data['phpbb_topics_watch'] = array(
		'COLUMNS'		=> array(
			'topic_id'			=> array('UINT', 0),
			'user_id'			=> array('UINT', 0),
			'notify_status'		=> array('BOOL', 0),
		),
		'KEYS'			=> array(
			'topic_id'			=> array('INDEX', 'topic_id'),
			'user_id'			=> array('INDEX', 'user_id'),
			'notify_stat'		=> array('INDEX', 'notify_status'),
		),
	);

	$schema_data['phpbb_user_group'] = array(
		'COLUMNS'		=> array(
			'group_id'			=> array('UINT', 0),
			'user_id'			=> array('UINT', 0),
			'group_leader'		=> array('BOOL', 0),
			'user_pending'		=> array('BOOL', 1),
		),
		'KEYS'			=> array(
			'group_id'			=> array('INDEX', 'group_id'),
			'user_id'			=> array('INDEX', 'user_id'),
			'group_leader'		=> array('INDEX', 'group_leader'),
		),
	);

	$schema_data['phpbb_users'] = array(
		'COLUMNS'		=> array(
			'user_id'					=> array('UINT', NULL, 'auto_increment'),
			'user_type'					=> array('TINT:2', 0),
			'group_id'					=> array('UINT', 3),
			'username'					=> array('VCHAR_CI', ''),
			'username_clean'			=> array('VCHAR_CI', ''),
			'user_regdate'				=> array('TIMESTAMP', 0),
			'user_password'				=> array('VCHAR_UNI:40', ''),
			'user_email'				=> array('VCHAR_UNI:100', ''),
			'user_lang'					=> array('VCHAR:30', ''),
			'user_style'				=> array('UINT', 0),
			'user_rank'					=> array('UINT', 0),
			'user_colour'				=> array('VCHAR:6', ''),
			'user_posts'				=> array('UINT', 0),
			'user_permissions'			=> array('MTEXT', ''),
			'user_ip'					=> array('VCHAR:40', ''),
			'user_birthday'				=> array('VCHAR:10', ''),
			'user_lastpage'				=> array('VCHAR_UNI:200', ''),
			'user_last_confirm_key'		=> array('VCHAR:10', ''),
			'user_post_sortby_type'		=> array('VCHAR:1', 't'),
			'user_post_sortby_dir'		=> array('VCHAR:1', 'a'),
			'user_topic_sortby_type'	=> array('VCHAR:1', 't'),
			'user_topic_sortby_dir'		=> array('VCHAR:1', 'd'),
			'user_avatar'				=> array('VCHAR', ''),
			'user_sig'					=> array('MTEXT_UNI', ''),
			'user_sig_bbcode_uid'		=> array('VCHAR:8', ''),
			'user_from'					=> array('VCHAR_UNI:100', ''),
			'user_fb'					=> array('VCHAR_UNI', ''),
			'user_ig'					=> array('VCHAR_UNI', ''),
			'user_pt'					=> array('VCHAR_UNI', ''),
			'user_twr'					=> array('VCHAR_UNI', ''),
			'user_skp'					=> array('VCHAR_UNI', ''),
			'user_tg'					=> array('VCHAR_UNI', ''),
			'user_li'					=> array('VCHAR_UNI', ''),
			'user_tt'					=> array('VCHAR_UNI', ''),
			'user_dc'					=> array('VCHAR_UNI', ''),
			'user_icq'					=> array('VCHAR:15', ''),
			'user_aim'					=> array('VCHAR_UNI', ''),
			'user_yim'					=> array('VCHAR_UNI', ''),
			'user_msnm'					=> array('VCHAR_UNI', ''),
			'user_jabber'				=> array('VCHAR_UNI', ''),
			'user_website'				=> array('VCHAR_UNI:200', ''),
			'user_occ'					=> array('TEXT_UNI', ''),
			'user_interests'			=> array('TEXT_UNI', ''),
			'user_actkey'				=> array('VCHAR:32', ''),
			'user_newpasswd'			=> array('VCHAR_UNI:40', ''),
			'user_allow_massemail'		=> array('BOOL', 1),
			'user_perm_from'			=> array('UINT', 0),
			'user_passchg'				=> array('TIMESTAMP', 0),
			'user_pass_convert'			=> array('BOOL', 0),
			'user_email_hash'			=> array('BINT', 0),
			'user_lastvisit'			=> array('TIMESTAMP', 0),
			'user_lastmark'				=> array('TIMESTAMP', 0),
			'user_lastpost_time'		=> array('TIMESTAMP', 0),
			'user_last_search'			=> array('TIMESTAMP', 0),
			'user_warnings'				=> array('TINT:4', 0),
			'user_last_warning'			=> array('TIMESTAMP', 0),
			'user_login_attempts'		=> array('TINT:4', 0),
			'user_inactive_reason'		=> array('TINT:2', 0),
			'user_inactive_time'		=> array('TIMESTAMP', 0),
			'user_timezone'				=> array('DECIMAL', 0),
			'user_dst'					=> array('BOOL', 0),
			'user_dateformat'			=> array('VCHAR_UNI:30', 'd M Y H:i'),
			'user_new_privmsg'			=> array('INT:4', 0),
			'user_unread_privmsg'		=> array('INT:4', 0),
			'user_last_privmsg'			=> array('TIMESTAMP', 0),
			'user_message_rules'		=> array('BOOL', 0),
			'user_full_folder'			=> array('INT:11', -3),
			'user_emailtime'			=> array('TIMESTAMP', 0),
			'user_topic_show_days'		=> array('USINT', 0),
			'user_post_show_days'		=> array('USINT', 0),
			'user_notify'				=> array('BOOL', 0),
			'user_notify_pm'			=> array('BOOL', 1),
			'user_notify_type'			=> array('TINT:4', 0),
			'user_allow_pm'				=> array('BOOL', 1),
			'user_allow_viewonline'		=> array('BOOL', 1),
			'user_allow_viewemail'		=> array('BOOL', 1),
			'user_options'				=> array('UINT:11', 230271),
			'user_avatar_type'			=> array('TINT:2', 0),
			'user_avatar_width'			=> array('USINT', 0),
			'user_avatar_height'		=> array('USINT', 0),
			'user_sig_bbcode_bitfield'	=> array('VCHAR:255', ''),
			'user_form_salt'			=> array('VCHAR_UNI:32', ''),
			'user_new'					=> array('BOOL', 1),
			'user_reminded'				=> array('TINT:4', 0),
			'user_reminded_time'		=> array('TIMESTAMP', 0),
  			'user_left_blocks'					=> array('VCHAR_CI', ''),
			'user_center_blocks'				=> array('VCHAR_CI', ''),
  			'user_right_blocks'					=> array('VCHAR_CI', ''),
  			'user_flagged'						=> array('BOOL', 0),
  			'user_flag_new'						=> array('BOOL', 0),
  			'user_im3_config'					=> array('UINT:10', 1743781891),
  			'user_allow_fav_download_email'		=> array('BOOL', 1),
  			'user_allow_fav_download_popup'		=> array('BOOL', 1),
  			'user_allow_new_download_email'		=> array('BOOL', 0),
  			'user_allow_new_download_popup'		=> array('BOOL', 1),
  			'user_dl_note_type'					=> array('BOOL', 1),
  			'user_dl_sort_dir'					=> array('BOOL', 0),
  			'user_dl_sort_fix'					=> array('BOOL', 0),
  			'user_dl_sort_opt'					=> array('BOOL', 0),
  			'user_dl_sub_on_index'				=> array('BOOL', 1),
  			'user_dl_update_time'				=> array('UINT:11', 0),
  			'user_new_download'					=> array('BOOL', 0),
  			'user_traffic'						=> array('BINT', 0),
  			'user_allow_fav_comment_email'		=> array('BOOL', 1),
  			'user_popup_notes'					=> array('BOOL', 0),
  			'user_mchat_index'					=> array('BOOL', 1),
  			'user_mchat_portal'					=> array('BOOL', 1),
  			'user_mchat_sound'					=> array('BOOL', 1),
  			'user_mchat_stats_index'			=> array('BOOL', 1),
  			'user_mchat_topics'					=> array('BOOL', 1),
  			'user_mchat_avatars'				=> array('BOOL', 1),
  			'user_mchat_input_area'				=> array('BOOL', 1),
  			'ad_owner'							=> array('BOOL', 0),
  			'user_digest_new_posts_only'		=> array('TINT:4', 0),
  			'user_digest_ever_unsubscribed'		=> array('TINT:4', 0),
  			'user_digest_no_post_text'			=> array('TINT:4', 0),
  			'user_digest_filter_type'			=> array('VCHAR:3', 'ALL'),
  			'user_digest_format'				=> array('VCHAR:4', 'HTML'),
  			'user_digest_max_display_words'		=> array('UINT:4', 0),
  			'user_digest_max_posts'				=> array('UINT', 0),
  			'user_digest_min_words'				=> array('UINT', 0),
  			'user_digest_pm_mark_read'			=> array('TINT:4', 0),
  			'user_digest_remove_foes'			=> array('TINT:4', 0),
			'user_digest_reset_lastvisit'		=> array('TINT:4', 1),
  			'user_digest_send_hour_gmt'			=> array('DECIMAL:5', 0.00),
  			'user_digest_send_on_no_posts'		=> array('TINT:4', 0),
  			'user_digest_show_mine'				=> array('TINT:4', 1),
  			'user_digest_show_pms'				=> array('TINT:4', 1),
  			'user_digest_sortby'				=> array('VCHAR:13', 'board'),
  			'user_digest_type'					=> array('VCHAR:4', 'NONE'),
  			'user_digest_has_unsubscribed'		=> array('TINT:4', 0),
  			'user_digest_attachments'			=> array('TINT:4', 1),
  			'user_digest_block_images'			=> array('TINT:4', 0),
  			'user_digest_toc'					=> array('TINT:4', 0),
  			'user_digest_last_sent'				=> array('UINT:11', 0),
  			'user_abbcode_mod'					=> array('BOOL', 1),
  			'user_abbcode_compact'				=> array('BOOL', 0),
  			'user_points'						=> array('DECIMAL:20', 0.00),
			'user_lastrefresh'			        => array('INT:11', 0),			
			'show_likes'				        => array('TINT:3', 1),
			'blog_count'                        => array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'user_id',
		'KEYS'			=> array(
			'user_birthday'				=> array('INDEX', 'user_birthday'),
			'user_email_hash'			=> array('INDEX', 'user_email_hash'),
			'user_type'					=> array('INDEX', 'user_type'),
			'username_clean'			=> array('UNIQUE', 'username_clean'),
		),
	);

	$schema_data['phpbb_warnings'] = array(
		'COLUMNS'		=> array(
			'warning_id'			=> array('UINT', NULL, 'auto_increment'),
			'user_id'				=> array('UINT', 0),
			'post_id'				=> array('UINT', 0),
			'log_id'				=> array('UINT', 0),
			'warning_time'			=> array('TIMESTAMP', 0),
		),
		'PRIMARY_KEY'	=> 'warning_id',
	);

	$schema_data['phpbb_words'] = array(
		'COLUMNS'		=> array(
			'word_id'				=> array('UINT', NULL, 'auto_increment'),
			'word'					=> array('VCHAR_UNI', ''),
			'replacement'			=> array('VCHAR_UNI', ''),
		),
		'PRIMARY_KEY'	=> 'word_id',
	);

	$schema_data['phpbb_zebra'] = array(
		'COLUMNS'		=> array(
			'user_id'				=> array('UINT', 0),
			'zebra_id'				=> array('UINT', 0),
			'friend'				=> array('BOOL', 0),
			'foe'					=> array('BOOL', 0),
			'approval'				=> array('BOOL', 0),
		),
		'PRIMARY_KEY'	=> array('user_id', 'zebra_id'),
		'KEYS'			=> array(
			'c'				=> array('INDEX', 'user_id', 'zebra_id', 'approval'),
		),		
	);

	return $schema_data;
}


/**
* Data put into the header for various dbms
*/
function custom_data($dbms)
{
	switch ($dbms)
	{
		case 'oracle':
			return <<<EOF
/*
  This first section is optional, however its probably the best method
  of running phpBB on Oracle. If you already have a tablespace and user created
  for phpBB you can leave this section commented out!

  The first set of statements create a phpBB tablespace and a phpBB user,
  make sure you change the password of the phpBB user before you run this script!!
*/

/*
CREATE TABLESPACE "PHPBB"
	LOGGING
	DATAFILE 'E:\ORACLE\ORADATA\LOCAL\PHPBB.ora'
	SIZE 10M
	AUTOEXTEND ON NEXT 10M
	MAXSIZE 100M;

CREATE USER "PHPBB"
	PROFILE "DEFAULT"
	IDENTIFIED BY "phpbb_password"
	DEFAULT TABLESPACE "PHPBB"
	QUOTA UNLIMITED ON "PHPBB"
	ACCOUNT UNLOCK;

GRANT ANALYZE ANY TO "PHPBB";
GRANT CREATE SEQUENCE TO "PHPBB";
GRANT CREATE SESSION TO "PHPBB";
GRANT CREATE TABLE TO "PHPBB";
GRANT CREATE TRIGGER TO "PHPBB";
GRANT CREATE VIEW TO "PHPBB";
GRANT "CONNECT" TO "PHPBB";

COMMIT;
DISCONNECT;

CONNECT phpbb/phpbb_password;
*/
EOF;

		break;

		case 'postgres':
			return <<<EOF
/*
	Domain definition
*/
CREATE DOMAIN varchar_ci AS varchar(255) NOT NULL DEFAULT ''::character varying;

/*
	Operation Functions
*/
CREATE FUNCTION _varchar_ci_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) = LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_not_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) != LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_less_than(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) < LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_less_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) <= LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_greater_than(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) > LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_greater_equals(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) >= LOWER($2)' LANGUAGE SQL STRICT;

/*
	Operators
*/
CREATE OPERATOR <(
  PROCEDURE = _varchar_ci_less_than,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = >,
  NEGATOR = >=,
  RESTRICT = scalarltsel,
  JOIN = scalarltjoinsel);

CREATE OPERATOR <=(
  PROCEDURE = _varchar_ci_less_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = >=,
  NEGATOR = >,
  RESTRICT = scalarltsel,
  JOIN = scalarltjoinsel);

CREATE OPERATOR >(
  PROCEDURE = _varchar_ci_greater_than,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <,
  NEGATOR = <=,
  RESTRICT = scalargtsel,
  JOIN = scalargtjoinsel);

CREATE OPERATOR >=(
  PROCEDURE = _varchar_ci_greater_equals,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <=,
  NEGATOR = <,
  RESTRICT = scalargtsel,
  JOIN = scalargtjoinsel);

CREATE OPERATOR <>(
  PROCEDURE = _varchar_ci_not_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <>,
  NEGATOR = =,
  RESTRICT = neqsel,
  JOIN = neqjoinsel);

CREATE OPERATOR =(
  PROCEDURE = _varchar_ci_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = =,
  NEGATOR = <>,
  RESTRICT = eqsel,
  JOIN = eqjoinsel,
  HASHES,
  MERGES,
  SORT1= <);

EOF;
		break;
	}

	return '';
}

echo 'done';