<?php
// require_once "config.php";

class ValidForm{
	private $config;
	private $data;
	private $messsage;
	private $post;

	public function __construct($post){
		$this->config = new Config();
		$this->data = json_decode(file_get_contents ($this->config->json."json.json"), true);
		$this->post = $post;
	}

	public function getMessage(){
		return $this->message;
	}



	public function validName($name0){
		$name = trim($name0);
		if (!$name){
			$this->message = "Введите имя.";
			return false;
		}
		if (strlen($name) < $this->data["min_size_text"] || strlen($name) > $this->data["max_size_text"]){
			$this->message = "Некорректная длина имени.";
			return false;
		}
		if (!preg_match("/^[a-zа-яё]+[ ]?[a-zа-яё]+$/iu", $name)){
			$this->message = "Некорректный ввод имени. Допускаются только буквы и пробел";
			return false;
		}
		return true;
	}
	public function validPhone($phone0){
		$phone = trim($phone0);
		if (!$phone){
			$this->message = "Введите телефон.";
			return false;
		}
		if (!preg_match("/^[+ 0-9()-]+$/iu", $phone)){
			$this->message = "Некорректный ввод телефона.";
			return false;
		}

		$val = preg_replace("/[^0-9]/", "", $phone);

		if (strlen($val) !== 11){
			$this->message = "Некорректный ввод телефона (11 цифр).";
			return false;
		}

		return true;
	}
	public function validCity($city0){
		$city = trim($city0);
		if (!$city){
			$this->message = "Выберите город.";
			return false;
		}
		return true;
	}
	public function validEmail($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->message = "Некорректный E-mail.";
			return false;
		}
		return true;
	}
	public function validDate($date0){
		$date = trim($date0);
		if (!$date){
			$this->message = "Введите дату.";
			return false;
		}
		if (strlen($date) !== 10 || !preg_match("/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/", $date)){
			$this->message = "Введите дату (00.00.0000).";
			return false;
		}
		return true;
	}
	public function validSize($size0){
		$size = trim($size0);
		if (!$size){
			$this->message = "Выберите размер.";
			return false;
		}
		return true;
	}
	public function validCountPeople($count_people0, $size){
		$count_people = trim($count_people0);
		if (!$count_people){
			$this->message = "Введите количество человек.";
			return false;
		}
		if (!preg_match("/^[0-9]+$/", $count_people)){
			$this->message = "Введите количество человек (Только цифры).";
			return false;
		}
		if ($count_people < $this->data["min_size_people"] || $count_people > $this->data["max_size_people"]){
			$this->message = "Количество человек от ".$this->data["min_size_people"]." до ".$this->data["max_size_people"].".";
			return false;
		}
		if (isset($this->data["cost_size"]["blocks"][$size])){
			if ( $count_people > $this->data["cost_size"]["blocks"][$size]["max_people"]){
				$this->message = "Для данного размера допустимое количество человек: ".$this->data["cost_size"]["blocks"][$size]["max_people"].".";
				return false;
			}
		}else{
			$this->message = "Неизвестная ошибка. Повторите попытку или свяжитесь с нами.";
			return false;
		}
		return true;
	}
	public function validPalette($palette0, $size){
		$palette = json_decode($palette0, true);
		if (!is_array($palette) || count($palette) !== 3 || !isset($palette["number"]) || !isset($palette["title"]) || !isset($palette["colors"])){
			$this->message = "Выберете палитру.";
			return false;
		}
		$number = trim(htmlspecialchars($palette["number"]));
		$title = trim(htmlspecialchars($palette["title"]));
		$colors = $palette["colors"];
		if (is_numeric($name) || !$title || !is_array($colors)){
			$this->message = "Выберете палитру.00";
			return false;
		}
		if (isset($this->data["cost_size"]["blocks"][$size])){
			if ( count($colors) !== intval($this->data["cost_size"]["blocks"][$size]["count_colors"])){
				$this->message = "Для данного размера допустимое количество цветов: ".$this->data["cost_size"]["blocks"][$size]["count_colors"].".";
				return false;
			}
		}else{
			$this->message = "Неизвестная ошибка. Повторите попытку или свяжитесь с нами.";
			return false;
		}
		return true;
	}
	public function validTypePost($type_post0){
		$type_post = trim($type_post0);
		if (!$type_post){
			$this->message = "Выберите способ доставки.";
			return false;
		}
		return true;
	}
	public function validCostPost($cost_post0){
		$cost_post = trim($cost_post0);
		if (!is_numeric($cost_post)){
			$this->message = "Выберите способ доставки.";
			return false;
		}
		return true;
	}
	public function validAdditionally($additionally0){
		$additionally = json_decode($additionally0);
		if (!is_array($additionally)){
			$this->message = "Неизвестная ошибка. Повторите попытку или свяжитесь с нами.";
			return false;
		}
		if (count($additionally)){
			foreach ($additionally as $key => $value) {
				if (!isset($this->data["additionally"][$value])){
					$this->message = "Неизвестная ошибка. Повторите попытку или свяжитесь с нами.";
					return false;
				}
			}
		}
		return true;
	}
	public function getImage($files, $session_id){
		if (!count($files)){
			$this->message = "Загрузите изображение.";
			return false;
		}
		if (count($files) > $this->data["max_count_files"]){
			$this->message = "Максимальное кол-во изображений: ".$this->data["max_count_files"];
			return false;
		}

		foreach ($files as $key => $value) {
			$file_type = $value['type'];
			$allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/tiff");
			if(!in_array($file_type, $allowed)) {
				$this->message = "Недопустимый формат изображения (jpg, png, gif, tiff).";
				return false;
			}

			$file_name = $this->config->img_tmp.$session_id.'_'.$value['name'];
			if (move_uploaded_file($value['tmp_name'], $file_name)) {
				$file_names[] = $value['name'];
			} else {
				$this->message = "Ошибка сохранения файла.";
				return false;
			}
		}

		return $file_names;

	}

}
?>