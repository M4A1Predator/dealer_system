<?php
class MY_Form_validation extends CI_Form_validation{

	function __constructor(){
		parent::__constructor();
	}

	public function no_space($word){
		$pat = '[ +]';

		if(preg_match($pat, $word) == FALSE){
			return TRUE;
		}
		return FALSE;
	}
}