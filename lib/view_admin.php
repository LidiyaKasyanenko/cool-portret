<?php
require_once "view.php";


class ViewAdmin extends View{
	public function __construct(){
		parent::__construct();
		$this->data = json_decode(file_get_contents($this->config->json."json.json"), true);
	}

	public function getContent2($message){
		$ar = $this->data;
		$sr["page_title"] = "Админка";

		$sr["css_block"] = $this->getCSSBlock();
		$sr["js_block"] = $this->getJSBlock();

		// $sr["header"] = $this->getHeaderBlock();
		// $sr["main_block"] = $this->getMainBlock();
		$sr["header_block"] = $this->getHeader2($message);
		$ar["message"] = $message;
		$sr["main_block"] = $this->getReplaceTemplate($ar, "admin/main_block");
		$sr["main_block"] .= $this->getJustBlock();
		$sr["main_block"] .= $this->getWhyWeBlock();
		$sr["main_block"] .= $this->getCostSizeBlock();
		$sr["main_block"] .= $this->getCompositionBlock();
		$sr["main_block"] .= $this->getHowWorkBlock();
		$sr["main_block"] .= $this->getDiscountBlock();
		$sr["main_block"] .= $this->getDeliveryBlock();
		$sr["main_block"] .= $this->getTermsOfUseBlock();
		$sr["main_block"] .= $this->getRuleBlock();

		$sr["footer_block"] = $this->getTemplate("admin/footer_block");

		return $this->getReplaceTemplate($sr, "admin/main");
	}

	public function getHeader2($message){
		$sr["login"] = $this->data["login"];
		$sr["message"] = $message;
		return $this->getReplaceTemplate($sr,"admin/header_block");
	}

	public function getJustBlock(){
		$sr["just_title"] = $this->data["just"]["title"];
		for ($i = 0, $n = count($this->data["just"]["blocks"]); $i < $n; $i++){
			$sr["just_block_title".($i+1)] = $this->data["just"]["blocks"]["just".($i+1)]["title"];
			$sr["just_block_text".($i+1)] = $this->data["just"]["blocks"]["just".($i+1)]["text"];
			$sr["just_block_img".($i+1)] = $this->data["just"]["blocks"]["just".($i+1)]["img"];
		}
		return $this->getReplaceTemplate($sr,"admin/just_block");
	}

	public function getWhyWeBlock(){
		$sr["why_we_title"] = $this->data["why_we"]["title"];
		for ($i = 0, $n = count($this->data["why_we"]["blocks"]); $i < $n; $i++){
			$sr["why_we_block_title".($i+1)] = $this->data["why_we"]["blocks"][$i]["title"];
			$sr["why_we_block_text".($i+1)] = $this->data["why_we"]["blocks"][$i]["text"];
		}
		return $this->getReplaceTemplate($sr,"admin/why_we_block");
	}

	public function getCostSizeBlock(){
		$sr["cost_size_title"] = $this->data["cost_size"]["title"];
		for ($i = 0, $n = count($this->data["cost_size"]["blocks"]); $i < $n; $i++){
			$sr["cost_size_block_size".($i+1)] = $this->data["cost_size"]["blocks"]["size".($i+1)]["size"];
			$sr["cost_size_block_cost".($i+1)] = $this->data["cost_size"]["blocks"]["size".($i+1)]["cost"];
			$sr["cost_size_block_max_people".($i+1)] = $this->data["cost_size"]["blocks"]["size".($i+1)]["max_people"];
			$sr["cost_size_block_img".($i+1)] = $this->data["cost_size"]["blocks"]["size".($i+1)]["img"];
			$sr["cost_size_block_people".($i+1)] = $this->data["cost_size"]["blocks"]["size".($i+1)]["people"];
			$sr["cost_size_block_text".($i+1)] = $this->data["cost_size"]["blocks"]["size".($i+1)]["text"];
		}
		return $this->getReplaceTemplate($sr,"admin/cost_size_block");
	}

	public function getCompositionBlock(){
		$sr["composition_title"] = $this->data["composition"]["title"];
		return $this->getReplaceTemplate($sr,"admin/composition_block");
	}



	public function getHowWorkBlock(){
		$sr["how_work_title"] = $this->data["how_work"]["title"];
		for ($i = 0, $n = count($this->data["why_we"]["blocks"]); $i < $n; $i++){
			$sr["how_work_block_title".($i+1)] = $this->data["how_work"]["blocks"][$i]["title"];
			$sr["how_work_block_text".($i+1)] = $this->data["how_work"]["blocks"][$i]["text"];
			$sr["how_work_block_img".($i+1)] = $this->data["how_work"]["blocks"][$i]["img"];
		}
		return $this->getReplaceTemplate($sr,"admin/how_work_block");
	}



    public function getDiscountBlock(){
		$sr["discount_title"] = $this->data["discount"]["title"];
		$sr["discount_text"] = $this->data["discount"]["text"];
		return $this->getReplaceTemplate($sr,"admin/discount_block");
	}

    public function getDeliveryBlock(){
        $sr["delivery_title"] = $this->data["delivery"]["title"];
        $sr["delivery_text"] = $this->data["delivery"]["text"];
        return $this->getReplaceTemplate($sr,"admin/delivery_block");
    }

    public function getTermsOfUseBlock(){
        $sr["terms_of_use_title"] = $this->data["terms_of_use"]["title"];
        $sr["terms_of_use_text"] = $this->data["terms_of_use"]["text"];
        return $this->getReplaceTemplate($sr,"admin/terms_of_use_block");
    }


    public function getRuleBlock(){
        return $this->getTemplate("admin/rule_block");
    }









	public function getContentAuth($message){
		$sr["page_title"] = "Авторизация";

		$sr["css_block"] = $this->getCSSBlock();
		$sr["js_block"] = $this->getJSBlock();

		$sr["header_block"] = "";
		$ar["message"] = $message;
		$sr["main_block"] = $this->getReplaceTemplate($ar, "admin/main_auth_block");
		// $sr["footer_block"] = "";

		return $this->getReplaceTemplate($sr, "admin/main");
	}

	public function getCSSBlock(){
		$sr["css"] = $this->config->css;
		return $this->getReplaceTemplate($sr, "admin/css_block");
	}
	public function getJSBlock(){
		$sr["js"] = $this->config->js;
		return $this->getReplaceTemplate($sr, "admin/js_block");
	}

	public function getMainBlock(){
		$sr["front_block"] = $this->getFrontBlock();
		return $this->getReplaceTemplate($sr, "admin/main_block");
	}
}

?>