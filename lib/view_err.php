<?php
require_once "view.php";


class ViewErr extends View{
	private $code;
	public function __construct($code){
		$this->code = $code;
		parent::__construct();
	}

	public function getContent(){
		$sr["page_title"] = "Ошибка ".$this->code.". Страница не найдена";
		$sr["meta_key"] = "Ошибка ".$this->code.". Страница не найдена";
		$sr["meta_desc"] = "Ошибка ".$this->code.". Страница не найдена";

		$sr["css_block"] = $this->getCSSBlock();
		$sr["js_block"] = $this->getJSBlock();
		$sr["modal_block"] = "";

		$sr["header"] = $this->getHeaderBlock();
		$sr["main_block"] = $this->getMainBlock();
		$sr["footer_block"] = "";

		return $this->getReplaceTemplate($sr, "main");
	}

	public function getCSSBlock(){
		$sr["css"] = $this->config->css;
		return $this->getReplaceTemplate($sr, "css_err_block");
	}

	public function getJSBlock(){
		$sr["js"] = $this->config->js;
		return $this->getReplaceTemplate($sr, "js_err_block");
	}

	public function getMainBlock(){
		if ($this->code === 302){
			return $this->getTemplate("err_block_302");
		}else{
			return $this->getTemplate("err_block");
		}
	}
}

?>