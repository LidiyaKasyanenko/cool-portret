<?php
require_once "view.php";
require_once "lib/config.php";

session_start();


class Manage{
	private $config;
	public function __construct(){
		$this->config = new Config();
		$this->post = $this->secureData($_POST);
		$this->data = json_decode(file_get_contents($this->config->json."json.json"), true);
	}

	public function auth(){
		if (isset($this->post["login"]) && isset($this->post["password"])){
			if (!strcmp($this->post["login"], $this->data["login"]) && !strcmp($this->post["password"], $this->data["password"])){
				$_SESSION["auth"] = true;
			}else{
				$_SESSION["message"] = "Неверный логин\пароль.";
			}
		}else{
			$_SESSION["message"] = "Неверный логин\пароль.";
		}
		$this->redirect("/myadminka.php");
	}

	public function logout(){
		unset($_SESSION["auth"]);
		$this->redirect("/myadminka.php");
	}







	public function saveData(){
		if (isset($_SESSION["auth"])){
			if (isset($this->post["block"])){
				$this->editDataBlock($this->post["block"]);
			}else{
				foreach ($this->post as $key => $value) {
					if (isset($this->data[$key])){
						$this->data[$key] = addslashes($value);
					}
				}
			}
			if (file_put_contents($this->config->json."json.json", json_encode($this->data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)) === false){
				$_SESSION["message"] = "Ошибка сохранения данных.";
			}else{
				$_SESSION["message"] = "Данные сохранены.";
			}
		}else{
			$_SESSION["message"] = "Введите логин и пароль.";
		}
		$this->redirect("/myadminka.php");
	}



	private function editDataBlock($block){
		switch ($block) {
			case 'just':
			$this->data["just"]["title"] = $this->post["just_title"];
			for ($i = 0, $n = count($this->data["just"]["blocks"]); $i < $n; $i++){
				$this->data["just"]["blocks"]["just".($i+1)]["title"] = $this->post["just_block_title".($i+1)];
				$this->data["just"]["blocks"]["just".($i+1)]["text"] = $this->post["just_block_text".($i+1)];
				$this->data["just"]["blocks"]["just".($i+1)]["img"] = $this->post["just_block_img".($i+1)];
			}
			break;
			case 'why_we':
			$this->data["why_we"]["title"] = $this->post["why_we_title"];
			for ($i = 0, $n = count($this->data["why_we"]["blocks"]); $i < $n; $i++){
				$this->data["why_we"]["blocks"][$i]["title"] = $this->post["why_we_block_title".($i+1)];
				$this->data["why_we"]["blocks"][$i]["text"] = $this->post["why_we_block_text".($i+1)];
			}
			break;
			case 'cost_size':
			$this->data["cost_size"]["title"] = $this->post["cost_size_title"];
			for ($i = 0, $n = count($this->data["cost_size"]["blocks"]); $i < $n; $i++){
				$this->data["cost_size"]["blocks"]["size".($i+1)]["size"] = $this->post["cost_size_block_size".($i+1)];
				$this->data["cost_size"]["blocks"]["size".($i+1)]["cost"] = $this->post["cost_size_block_cost".($i+1)];
				$this->data["cost_size"]["blocks"]["size".($i+1)]["max_people"] = $this->post["cost_size_block_max_people".($i+1)];
				$this->data["cost_size"]["blocks"]["size".($i+1)]["img"] = $this->post["cost_size_block_img".($i+1)];
				$this->data["cost_size"]["blocks"]["size".($i+1)]["people"] = $this->post["cost_size_block_people".($i+1)];
				$this->data["cost_size"]["blocks"]["size".($i+1)]["text"] = $this->post["cost_size_block_text".($i+1)];
			}
			break;
			case 'composition':
			$this->data["composition"]["title"] = $this->post["composition_title"];
			break;
			case 'how_work':
			$this->data["how_work"]["title"] = $this->post["how_work_title"];
			for ($i = 0, $n = count($this->data["how_work"]["blocks"]); $i < $n; $i++){
				$this->data["how_work"]["blocks"][$i]["title"] = $this->post["how_work_block_title".($i+1)];
				$this->data["how_work"]["blocks"][$i]["text"] = $this->post["how_work_block_text".($i+1)];
				$this->data["how_work"]["blocks"][$i]["img"] = $this->post["how_work_block_img".($i+1)];
			}
			break;
			case 'discount':
			$this->data["discount"]["title"] = $this->post["discount_title"];
			$this->data["discount"]["text"] = $this->post["discount_text"];
			break;
            case 'delivery':
                $this->data["delivery"]["title"] = $this->post["delivery_title"];
                $this->data["delivery"]["text"] = $this->post["delivery_text"];
                break;
            case 'terms_of_use':
                $this->data["terms_of_use"]["title"] = $this->post["terms_of_use_title"];
                $this->data["terms_of_use"]["text"] = $this->post["terms_of_use_text"];
                break;
		}
	}



	public function getSizeTitle($size){
		if (isset($this->data["cost_size"]["blocks"][$size])){
			return $this->data["cost_size"]["blocks"][$size]["size"];
		}
		return false;
	}

	public function getPost($type_post, $cost){
		switch ($type_post) {
			case 'postSdak':
			$post["name"] = "Доставка до отделения СДЭК/почты";
			$post["cost"] = $cost;
			break;
			case 'courier':
			$post["name"] = "Доставка курьером";
			$post["cost"] = $cost;
			break;
			case 'fast':
			$post["name"] = "Срочная доставка курьером";
			$post["cost"] = $cost;
			break;
			case 'pickup':
			$post["name"] = "Самовызов";
			$post["cost"] = "0";
			break;
			default:
			$post["name"] = "Неизвестная доставка";
			$post["cost"] = "0";
			break;
		}
		return $post;
	}


	public function getPortret($size){
		if (isset($this->data["cost_size"]["blocks"][$size])){
			$portret["size"] = $this->data["cost_size"]["blocks"][$size]["size"];
			$portret["cost"] = $this->data["cost_size"]["blocks"][$size]["cost"];
			$portret["cost_add"] = $this->data["cost_add_people"];
			return $portret;
		}
		return false;
	}

	public function getAdditionally($additionally){
		$add = json_decode($additionally, true);
		if (!count($add)){
			return array();
		}
		foreach ($add as $key => $value) {
			$arr["text"] = $this->data["additionally"][$value]["text"];
			$arr["cost"] = $this->data["additionally"][$value]["price"];
			$arr["type"] = $this->data["additionally"][$value]["type"];
			$mas[] = $arr;
		}
		return $mas;
	}

	public function getPalette($palette){
		$pal = json_decode($palette, true);
		if (!count($pal)){
			return array();
		}
		return $pal;
	}


	private function secureData($data){//обезопасить
		foreach ($data as $key => $value){//
			if (is_array($value)) $this->secureData($value);//массив в массивк
			else
				$data[$key] = html_entity_decode(htmlentities($value, ENT_NOQUOTES),ENT_NOQUOTES);
		}
		return $data;
	}


	//вернуться обратно на страницу
	public function redirect($link){
		header("Location: $link");
		exit;
	}

}

?>