<?php
require_once "config.php";


class View{
	protected $config;
	protected $data;
	public function __construct(){
		$this->config = new Config();
		$this->data = json_decode(file_get_contents($this->config->json."json.json"), true);
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
		$sr["front_block"] = $this->getFrontBlock();
		$sr["video_block"] = $this->getVideoBlock();
		$sr["just_block"] = $this->getJustBlock();
		$sr["why_we_block"] = $this->getWhyWeBlock();
		$sr["cost_size_block"] = $this->getCostSizeBlock();
		$sr["composition_block"] = $this->getCompositionBlock();
		$sr["how_work_block"] = $this->getHowWorkBlock();
		return $this->getReplaceTemplate($sr, "main_block");
	}

	public function getHeaderBlock(){
		$sr["phone"] = $this->data["phone"];
		$sr["phone_view"] = $this->data["phone_view"];
		$sr["whatsapp"] = $this->data["whatsapp"];
		$sr["viber"] = $this->data["viber"];
		$sr["vk"] = $this->data["vk"];
		$sr["instagram"] = $this->data["instagram"];
		$sr["ok"] = $this->data["ok"];
		$sr["facebook"] = $this->data["facebook"];

		return $this->getReplaceTemplate($sr, "header_block");
	}

	public function getFrontBlock(){
		return $this->getTemplate("front_block");
	}

	public function getVideoBlock(){
		$sr["link"] = $this->data["video"];

		return $this->getReplaceTemplate($sr, "video_block");
	}

	public function getJustBlock(){
		$sr["title"] = $this->data["just"]["title"];
		for ($i = 0, $n = count($this->data["just"]["blocks"]); $i < $n; $i++){
			$ar["index"] = $i+1;
			$ar["title"] = $this->data["just"]["blocks"]["just".($i+1)]["title"];
			$ar["text"] = $this->data["just"]["blocks"]["just".($i+1)]["text"];
			$ar["img"] = $this->data["just"]["blocks"]["just".($i+1)]["img"];
			$sr["blocks"] .= $this->getReplaceTemplate($ar, "just_block/block");
		}

		return $this->getReplaceTemplate($sr, "just_block/main");
	}

	public function getWhyWeBlock(){
		$sr["title"] = $this->data["why_we"]["title"];
		for ($i = 0, $n = count($this->data["why_we"]["blocks"]); $i < $n; $i++){
			$ar["index"] = $i+1;
			$ar["title"] = $this->data["why_we"]["blocks"][$i]["title"];
			$ar["text"] = $this->data["why_we"]["blocks"][$i]["text"];
			$sr["blocks"] .= $this->getReplaceTemplate($ar, "why_we_block/block");
		}

		return $this->getReplaceTemplate($sr, "why_we_block/main");
	}

	public function getCostSizeBlock(){
		$sr["title"] = $this->data["cost_size"]["title"];
		for ($i = 0, $n = count($this->data["cost_size"]["blocks"]); $i < $n; $i++){
			$ar["index"] = $i+1;
			$ar["size"] = $this->data["cost_size"]["blocks"]["size".($i+1)]["size"];
			$ar["cost"] = $this->data["cost_size"]["blocks"]["size".($i+1)]["cost"];
			$ar["img"] = $this->data["cost_size"]["blocks"]["size".($i+1)]["img"];
			$ar["people"] = $this->data["cost_size"]["blocks"]["size".($i+1)]["people"];
			$ar["text"] = $this->data["cost_size"]["blocks"]["size".($i+1)]["text"];
			$sr["blocks"] .= $this->getReplaceTemplate($ar, "cost_size_block/block");
		}

		return $this->getReplaceTemplate($sr, "cost_size_block/main");
	}

	public function getCompositionBlock(){
		$sr["title"] = $this->data["composition"]["title"];
		return $this->getReplaceTemplate($sr, "composition_block");
	}

	public function getHowWorkBlock(){
		$sr["title"] = $this->data["how_work"]["title"];
		for ($i = 0, $n = count($this->data["how_work"]["blocks"]); $i < $n; $i++){
			$ar["index"] = $i+1;
			$ar["title"] = $this->data["how_work"]["blocks"][$i]["title"];
			$ar["text"] = $this->data["how_work"]["blocks"][$i]["text"];
			$ar["img"] = $this->data["how_work"]["blocks"][$i]["img"];
			$sr["blocks"] .= $this->getReplaceTemplate($ar, "how_work_block/block");
		}

		return $this->getReplaceTemplate($sr, "how_work_block/main");
	}

	public function getFooterBlock(){
		$sr["phone"] = $this->data["phone"];
		$sr["phone_view"] = $this->data["phone_view"];
		$sr["whatsapp"] = $this->data["whatsapp"];
		$sr["viber"] = $this->data["viber"];
		$sr["vk"] = $this->data["vk"];
		$sr["instagram"] = $this->data["instagram"];
		$sr["ok"] = $this->data["ok"];
		$sr["facebook"] = $this->data["facebook"];
		return $this->getReplaceTemplate($sr, "footer_block");
	}

	public function getModalBlock(){
		for ($i = 0, $n = count($this->data["cost_size"]["blocks"]); $i < $n; $i++){
			$ar["index"] = $i+1;
			$ar["size"] = $this->data["cost_size"]["blocks"]["size".($i+1)]["size"];
			$ar["max_people"] = $this->data["cost_size"]["blocks"]["size".($i+1)]["max_people"];
			$sr["sizies"] .= $this->getReplaceTemplate($ar, "modal_block/size");
		}
		for ($i = 0, $n = count($this->data["additionally"]); $i < $n; $i++){
			$ar["index"] = $i;
			$ar["text"] = $this->data["additionally"][$i]["text"];
			$ar["price"] = $this->data["additionally"][$i]["price"];
			$ar["type"] = (strcmp($this->data["additionally"][$i]["type"], "rub") === 0)? " р": "%";
			$ar["description"] = $this->data["additionally"][$i]["description"];

			$sr["additionally"] .= $this->getReplaceTemplate($ar, "modal_block/additionally");
		}
		return $this->getReplaceTemplate($sr, "modal_block/main");
	}
		//получить шаблон
	protected function getTemplate($name){
		$text = file_get_contents($this->config->tmpl.$name.".tmpl.php");
		return str_replace("%address%", $this->config->address, $text);
	}

	//заменить сразу кучу (массив данных, шаблон)
	protected function getReplaceTemplate($sr, $template){
		return $this->getReplaceContent($sr, $this->getTemplate($template));
	}

	//замена
	protected function getReplaceContent($sr, $content){
		$search = array();//массив заменяемых эл-в
		$replase = array();//массив эл-в замены
		$i = 0;
		foreach ($sr as $key => $value){
			$search[$i] = "%$key%";
			$replace[$i] = $value;
			$i++;
		}
		return str_replace($search, $replace, $content);
	}
}

?>