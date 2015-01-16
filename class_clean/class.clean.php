<?php
//--- DS ---//
//3/09/2010//

// SUPERGLOBAL INPUT SANITIZATION CLASS 
// Only 2 dimentional arrays max
// Datbase arrays are str_replaced to MSSQL spec.  simply  '  ==>   ''  

// E X A M P L E   O F   U S E  //
//
/*
include('clean.php');
$post = new clean($_POST);												// <--- Create the clean object, with the array you want to clean.
if($post->set()):																// <--- Test to see if the array isset && not empty
	extract($post->forHTML,EXTR_PREFIX_ALL,'clean'); 	// <--- google "extract() PHP" to see why this is REALLY useful
	echo $clean_firstname;												// <--- echo a posted key using the extracted variable
	print_r($post->forDisplay); 										// <--- will show you the clean array
endif;
*/

class clean {
	var $orig; 
	# Raw copy of the superglobal array at time of creation. 
	# Rewritten with exclusions if/when @reprocess($exclusions) is called .
	
	var $forHTML;  
	# Safe for use on a live DOM.
	# result of @processforDisplay().
	
	var $forMySQL;
	# safe for use in a MsSQL Query.
	# result of @processForDatabase().
	
	var $customReplace;
	# Perameters set by user
	
	# @constructor method
	function clean($array) 
	{
		if(isset($array)&&!empty($array)):
			$this->orig		=	$array;
			$this->forHTML 	=	$this->processforHTML($this->orig);
			$this->forMsSQL	= 	$this->processForMsSQL($this->orig);
			$this->forMySQL	= 	$this->processForMySQL($this->orig);
		endif;
	}
	
	# Check if POST exists
	function set(){
		if(isset($this->orig) && !empty($this->orig)):
			return true;
		else:
			return false;	
		endif;
	}
	
	# @process orig array for use in MsSQL.
	function processForMySQL()
	{
		if(isset($this->orig)&&!empty($this->orig)):
			foreach($this->orig as $k=>$v):
				if(!is_array($v)):
				$r[$k]=  addslashes(filter_var(trim($v), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
				else:
					foreach($v as $chk_k=>$chk_v):
						$r[$k][]=  addslashes(filter_var(trim($v), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 
					endforeach;
				endif;
			endforeach;
		return $r;
		else:	
			return false;
		endif;
	}
	// @process orig array for use in MsSQL.
	function processForMsSQL()
	{
		if(isset($this->orig)&&!empty($this->orig)):
			foreach($this->orig as $k=>$v):
				if(!is_array($v)):
				$r[$k]=  preg_replace("/'/","''",filter_var(trim($v), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
				else:
					foreach($v as $chk_k=>$chk_v):
						$r[$k][]=  (filter_var(trim($v), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 
					endforeach;
				endif;
			endforeach;
		return $r;
		else:	
			return false;
		endif;
	}
	
	# @Process for use in a live DOM as HTML
	function processforHTML()
	{
		$array = $this->orig;
		if(isset($array)&&!empty($array)):
			foreach($array as $k=>$v):
				if(!is_array($v)):
				$r[$k]=  filter_var(trim($v), FILTER_SANITIZE_SPECIAL_CHARS); 
				else:
					foreach($v as $chk_k=>$chk_v):
						$r[$k][]=  filter_var(trim($chk_v), FILTER_SANITIZE_SPECIAL_CHARS); 
					endforeach;
				endif;
			endforeach;
		return $r;
		else:	
			return false;
		endif;
	}
	function customReplace($regex,$replace)
	{
		$array = $this->orig;
		if(isset($array)&&!empty($array)):
			foreach($array as $k=>$v):
				if(!is_array($v)):
				$r[$k]=  preg_replace($regex,$replace,trim($v)); 
				else:
					foreach($v as $chk_k=>$chk_v):
						$r[$k][]=  preg_replace($regex,$replace,trim($chk_v));  
					endforeach;
				endif;
			endforeach;
		$this->customReplace = $r;
		return $r;
		else:	
			return false;
		endif;
	}
	
	# replace the $orig array
	# and reprocess all outputs
	# excluding keys included in the $xnay array
	function reprocess($xnay)
	{
		foreach($this->orig as $k=>$v):
			if(!in_array($k,$xnay)):
				$array[$k]=$v;
			endif;
		endforeach;
		$this->clean($array);
	}
}

?>