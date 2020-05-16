<?php
require_once __DIR__."/../config.php";
require_once __DIR__."/../view.php";


class ViewTermsOfUse extends View{

	public function __construct(){
		parent::__construct();
	}

	public function getContent(){
		$sr["page_title"] = $this->data["page_title"];
		$sr["meta_key"] = $this->data["meta_key"];
		$sr["meta_desc"] = $this->data["meta_desc"];
		$sr["address"] = $this->config->address;

		$sr["css_block"] = $this->getCSSBlock();
		$sr["js_block"] = $this->getJSBlock();
		$sr["modal_block"] = $this->getModalBlock();

		$sr["header"] = $this->getHeaderBlock();
		$sr["main_block"] = $this->getMainBlock();
		$sr["footer_block"] = $this->getFooterBlock();

		return $this->getReplaceTemplate($sr, "main");
	}

	public function getCSSBlock(){
		$sr["css"] = $this->config->css;
		return $this->getReplaceTemplate($sr, "css_block");
	}
	public function getJSBlock(){
		$sr["js"] = $this->config->js;
		return $this->getReplaceTemplate($sr, "js_block");
	}

	public function getMainBlock(){
		$soc["vk"] = $this->data["vk"];
		$soc["instagram"] = $this->data["instagram"];
		$sr["title"] = $this->data["terms_of_use"]["title"];
		$text = explode("\n", $this->data["terms_of_use"]["text"]);
		foreach ($text as $key => $value) {
			$sr["text"] .= $this->getHtml($value, $soc);
		}
		return $this->getReplaceTemplate($sr, "page/terms_of_use");
	}


	private function getHtml($str, $soc){
		$none_class = false;
		$global_class='';
		for ($i=0, $n=strlen($str); $i<$n; $i++){
			switch ($str[$i]) {
				case '[':
				if ($none_class){
					$html .= "</span>";
					$none_class = false;
				}
				$txt = '';
				for ($j=$i+1; $j<$n; $j++){
					if ($str[$j] === ']'){
						$i = $j;
						break;
					}
					$txt .= $str[$j];
				}
				$html .= $this->getClass($txt)["html"];
				$global_class .= $this->getClass($txt)["parent_class"];

				break;
				case '{':
				if ($none_class){
					$html .= "</span>";
					$none_class = false;
				}
				$txt = '';
				for ($j=$i+1; $j<$n; $j++){
					if ($str[$j] === '}'){
						$i = $j;
						break;
					}
					$txt .= $str[$j];
				}
				$html .= $this->getSoc($txt, $soc);
				break;
				default:
				if (!$none_class){
					$none_class = true;
					$html .= "<span>";
				}
				$html .= $str[$i];
				break;
			}


		}

		return "<div class='line $global_class'>".$html."</div>";
	}



	private function getSoc($str, $soc){
		switch ($str) {
			case 'vk':
			return '<div class="soc_btn purple">
			<a id="vk" class="icon" href="'.$soc["vk"].'"></a>
			</div>';
			break;
			case 'ins':
			return '<div class="soc_btn purple">
			<a id="inst" class="icon" href="'.$soc["instagram"].'"></a>
			</div>';
			break;
			default:
			return '';
			break;
		}
	}


	private function getClass($str){
		if (stripos($str, "discount") !== false){
			$class .= " discount ";
			$str = str_ireplace("discount", "", $str);
		}
		if (stripos($str, "pink") !== false){
			$class .= " pink ";
			$str = str_ireplace("pink", "", $str);
		}
		if (stripos($str, "purple") !== false){
			$class .= " purple ";
			$str = str_ireplace("purple", "", $str);
		}
		if (stripos($str, "text-center") !== false){
			$parent_class .= " text-center ";
			$str = str_ireplace("text-center", "", $str);
		}
		if (stripos($str, "text-right") !== false){
			$parent_class .= " text-right ";
			$str = str_ireplace("text-right", "", $str);
		}
		return array("html" => "<p class='$class'>$str</p>", "parent_class" => $parent_class);
	}




	public function getModalBlock(){
		return false;
	}

}

?>