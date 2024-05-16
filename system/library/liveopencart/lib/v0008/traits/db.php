<?php

namespace liveopencart\lib\v0008\traits;

trait db {
 
    public function existTable($table_name) {
		
		$query = $this->db->query("SHOW TABLES LIKE '".DB_PREFIX.$table_name."'");
		return $query->num_rows;
	}
    
    protected function existColumn($table_name, $column_name) {
        return $this->db->query("SHOW COLUMNS FROM `".DB_PREFIX.$table_name."` WHERE field='".$this->db->escape($column_name)."'	")->num_rows;
    }
    
    protected function addTableColumnIfNotExists($table_name, $column_name, $column_type) {
		if ( !$this->existColumn($table_name, $column_name) ) {
			$this->db->query("ALTER TABLE `".DB_PREFIX.$table_name."`	ADD COLUMN `".$column_name."` ".$column_type." " );
		}
	}
    
}