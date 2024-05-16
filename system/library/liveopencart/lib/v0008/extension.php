<?php

namespace liveopencart\lib\v0008;

class extension extends library {
	use traits\cache;
	use traits\language;
	use traits\resource;
	use traits\installed;
	use traits\db;
	
	protected $extension_code 	= '';
	protected $version = '';
	
	public $event = '';
	
	public function __construct() {
		call_user_func_array( array('parent', '__construct') , func_get_args());
		
		$this->event = new event_manager();
	}
	
	public function getExtensionCode() {
		return $this->extension_code;
	}
	
	public function getCurrentVersion() {
		return $this->version;
	}
	
	public function loadLanguageLazyByRoute($route) {
		
		$all = $this->language->all();
		$sub_lang_key = 'liveopencart_'.$this->extension_code;
		$this->load->language($route, $sub_lang_key);
		$lang = $this->language->get($sub_lang_key);
		
		foreach ( array_diff( array_keys($lang->all()), array_keys($all) ) as $key ) {
			$this->language->set($key, $lang->get($key));
		}
		
	}
	
	
	
	
}