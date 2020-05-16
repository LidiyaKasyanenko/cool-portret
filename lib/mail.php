<?php
require_once "config.php";
require_once "lib/phpmailer/class.phpmailer.php";
require_once "lib/freakmailer.php";

class Mail{
	private $site;
	private $config;
	public function __construct(){
		$this->config = new Config();
		// Настройки Email
		$this->site['from_name'] = 'мое имя'; // from (от) имя
		$this->site['from_email'] = $this->config->email; // from (от) email адрес
		// На всякий случай указываем настройки
		// для дополнительного (внешнего) SMTP сервера.
		$this->site['smtp_mode'] = 'disabled'; // enabled or disabled (включен или выключен)
		$this->site['smtp_host'] = null;
		$this->site['smtp_port'] = null;
		$this->site['smtp_username'] = null;
	}

	public function sendAppFormPhone($sr){
	// инициализируем класс
		$mailer = new FreakMailer($this->site);

	// Устанавливаем тему письма
		$mailer->Subject = 'Надо позвонить!';

		//Кодировка
		$mailer->CharSet = "UTF-8";


	// Задаем тело письма
		$mailer->Body = "Телефон: ".$sr["phone"];
		$mailer->FromName = $sr["email"];

	// Добавляем адрес в список получателей
		$mailer->AddAddress($this->config->email, "Кнопка позвонить");

		$rez = !!$mailer->Send();

		$mailer->ClearAddresses();
		$mailer->ClearAttachments();

		return $rez;
	}

	public function sendAppForm($sr){
		// инициализируем класс
		$mailer = new FreakMailer($this->site);
		$mailer_customer = new FreakMailer($this->site);
		// Устанавливаем тему письма
		$mailer->Subject = 'Новый заказ!';
		$mailer_customer->Subject = 'Заказ на сайте cool-portret.ru';
		$mailer->CharSet = $mailer_customer->CharSet = "UTF-8";

		$mailer->Body = $mailer_customer->Body = $this->getHtmlBody($sr["name"], $sr["phone"], $sr["email"], $sr["city"], $sr["date"], $sr["portret"], $sr["count_people"], $sr["post"], $sr["additionally"], $sr["where_send"], $sr["message"]);

		$mailer->isHTML(true);
		$mailer_customer->isHTML(true);
		$mailer->AltBody = $mailer_customer->AltBody = $this->getTextBody($sr["name"], $sr["phone"], $sr["email"], $sr["city"], $sr["date"], $sr["portret"], $sr["count_people"], $sr["post"], $sr["additionally"], $sr["where_send"], $sr["message"]);

		$mailer->FromName = $sr["name"];
		$mailer_customer->FromName = $this->config->email_title;
		// $mailer->FromEmail = $sr["email"];

	// Добавляем адрес в список получателей
		$mailer->AddAddress($this->config->email, $sr["name"]);
		$mailer_customer->AddAddress($sr["email"], $this->config->email_title);
		// настройка класса для отправки почты
		foreach ($sr["image"] as $key => $value) {
			$file_name = $this->config->img_tmp.$sr["session_id"].'_'.$value;
			if (!file_exists($file_name)){
				$rez = false;
			}
			$mailer->AddAttachment($file_name, $value);
			$mailer_customer->AddAttachment($file_name, $value);
		}

		if(!$mailer->Send() || !$mailer_customer->Send()){
			$rez = false;
		} else {
			$rez = true;
			foreach ($sr["image"] as $key => $value) {
				$file_name = $this->config->img_tmp.$sr["session_id"].'_'.$value;
				if (file_exists($file_name)){
					unlink($file_name);
				}
			}
		}
		$mailer->ClearAddresses();
		$mailer->ClearAttachments();
		$mailer_customer->ClearAddresses();
		$mailer_customer->ClearAttachments();

		return $rez;
	}


	private function getTextBody($name, $phone, $email, $city, $date, $portret, $count_people, $post, $additionally, $where_send, $message){
		$text = "Имя: ".$name."\n";
		$text .= "Телефон: ".$phone."\n";
		$text .= "E-mail: ".$email."\n";
		$text .= "Город: ".$city."\n";
		$text .= "Дата: ".$date."\n";
		$text .= "Кол-во человек: ".$count_people."\n";
		$text .= "Доставка: ".$post["name"]." Стоимость: ".$post["cost"]." р\n";
		$text .= "Стоимость портрета: ".$this->getCostPortret($portret, $count_people)." р\n";
		$text .= "Дополнительно: ".$this->getAdditionallyText($additionally)." р\n";
		$text .= "Итоговая стоимость: ".$this->getCostPortretFull($portret, $count_people, $additionally, $post['cost'])." р\n";
		$text .= "Куда отправить: ".$where_send['where_send']."(".$where_send['val'].")\n";
		$text .= "Сообщение: ".$message."\n";
		return $text;
	}

	private function getHtmlBody($name, $phone, $email, $city, $date, $portret, $count_people, $post, $additionally, $where_send, $message){
		$html="
		<head>
			<title>HTML Email</title>
		</head>
		<body>
			<table style='text-align:left'>
				<tr>
					<th>Имя:</th>
					<th><span style='color:#7C3F99;'>$name</span></th>
				</tr>
				<tr>
					<th>Телефон:</th>
					<th><span style='color:#7C3F99;'>$phone</span></th>
				</tr>
				<tr>
					<th>E-mail:</th>
					<th><span style='color:#7C3F99;'>$email</span></th>
				</tr>
				<tr>
					<th>Город:</th>
					<th><span style='color:#7C3F99;'>$city</span></th>
				</tr>
				<tr>
					<th>Дата:</th>
					<th><span style='color:#7C3F99;'>$date</span></th>
				</tr>
				<tr>
					<th>Размер:</th>
					<th><span style='color:#7C3F99;'>".$portret["size"]." см</span></th>
				</tr>
				<tr>
					<th>Кол-во человек:</th>
					<th><span style='color:#7C3F99;'>$count_people</span></th>
				</tr>
				<tr>
					<th>Доставка:</th>
					<th><span style='color:#7C3F99;'>".$post['name']."</span></th>
				</tr>
				<tr>
					<th>Стоимость доставки:</th>
					<th><span style='color:#7C3F99;'>".$post['cost']." р</span></th>
				</tr>
			</table>
			<hr>
			<table style='text-align:left'>
				<tr>
					<th>Дополнительно:</th>
					<th><span style='color:#7C3F99;'>".$this->getAdditionallyHtml($additionally)."</span></th>
				</tr>
			</table>
			<hr>
			<table style='text-align:left'>
				<tr>
					<th>Стоимость портрета:</th>
					<th><span style='color:#7C3F99;'>".$this->getCostPortret($portret, $count_people)." р</span></th>
				</tr>
			</table>
			<hr>
			<table style='text-align:left'>
				<tr>
					<th>Итоговая стоимость:</th>
					<th><span style='color:#7C3F99;'>".$this->getCostPortretFull($portret, $count_people, $additionally, $post['cost'])." р</span></th>
				</tr>
			</table>
			<hr>
			<table style='text-align:left'>
				<tr>
					<th>Куда отправлять:</th>
					<th><span style='color:#7C3F99;'>".$where_send['where_send']."</span></th>
				</tr>
				<tr>
					<th>Сообщение:</th>
					<th>".$message."</th>
				</tr>
			</table>
		</body>
		";
		return $html;
	}










	public function sendSketch($sr){
		// инициализируем класс
		$mailer = new FreakMailer($this->site);
		$mailer_customer = new FreakMailer($this->site);
		$mailer->Subject = 'Заявка на эскиз!';
		$mailer_customer->Subject = 'Заказ на эскиз на сайте cool-portret.ru';
		$mailer->CharSet = $mailer_customer->CharSet = "UTF-8";

		// Задаем тело письма
		$mailer->Body = $mailer_customer->Body = $this->getHtmlBodySketch($sr["name"], $sr["phone"], $sr["email"], $sr["city"], $sr["date"], $sr["portret"], $sr["count_people"], $sr["where_send"], $sr["message"]);

		$mailer->isHTML(true);
		$mailer_customer->isHTML(true);
		$mailer->AltBody = $mailer_customer->AltBody = $this->getTextBodySketch($sr["name"], $sr["phone"], $sr["email"], $sr["city"], $sr["date"], $sr["portret"], $sr["count_people"], $sr["where_send"], $sr["message"]);

		$mailer->FromName = $sr["name"];
		$mailer_customer->FromName = $this->config->email_title;
		// $mailer->FromEmail = $sr["email"];

		// Добавляем адрес в список получателей
		$mailer->AddAddress($this->config->email, $sr["name"]);
		$mailer_customer->AddAddress($sr["email"], $this->config->email_title);
		// настройка класса для отправки почты
		foreach ($sr["image"] as $key => $value) {
			$file_name = $this->config->img_tmp.$sr["session_id"].'_'.$value;
			if (!file_exists($file_name)){
				$rez = false;
			}
			$mailer->AddAttachment($file_name, $key.$value);
		}

		if(!$mailer->Send() || !$mailer_customer->Send()){
			$rez = false;
		}
		else{
			$rez = true;
			foreach ($sr["image"] as $key => $value) {
				$file_name = $this->config->img_tmp.$sr["session_id"].'_'.$value;
				if (file_exists($file_name)){
					unlink($file_name);
				}
			}
		}
		$mailer->ClearAddresses();
		$mailer->ClearAttachments();
		$mailer_customer->ClearAddresses();
		$mailer_customer->ClearAttachments();

		return $rez;
	}


	private function getTextBodySketch($name, $phone, $email, $city, $date, $portret, $count_people, $where_send, $message){
		$text = "Имя: ".$name."\n";
		$text .= "Телефон: ".$phone."\n";
		$text .= "E-mail: ".$email."\n";
		$text .= "Город: ".$city."\n";
		$text .= "Дата: ".$date."\n";
		$text .= "Кол-во человек: ".$count_people."\n";
		$text .= "Стоимость портрета: ".$this->getCostPortret($portret, $count_people)." р\n";
		$text .= "Куда отправить: ".$where_send['where_send']."(".$where_send['val'].")\n";
		$text .= "Сообщение: ".$message."\n";
		return $text;
	}

	private function getHtmlBodySketch($name, $phone, $email, $city, $date, $portret, $count_people, $where_send, $message){
		$html="
		<head>
			<title>HTML Email</title>
		</head>
		<body>
			<table style='text-align:left'>
				<tr>
					<th>Имя:</th>
					<th><span style='color:#7C3F99;'>$name</span></th>
				</tr>
				<tr>
					<th>Телефон:</th>
					<th><span style='color:#7C3F99;'>$phone</span></th>
				</tr>
				<tr>
					<th>E-mail:</th>
					<th><span style='color:#7C3F99;'>$email</span></th>
				</tr>
				<tr>
					<th>Город:</th>
					<th><span style='color:#7C3F99;'>$city</span></th>
				</tr>
				<tr>
					<th>Дата:</th>
					<th><span style='color:#7C3F99;'>$date</span></th>
				</tr>
				<tr>
					<th>Размер:</th>
					<th><span style='color:#7C3F99;'>".$portret["size"]." см</span></th>
				</tr>
				<tr>
					<th>Кол-во человек:</th>
					<th><span style='color:#7C3F99;'>$count_people</span></th>
				</tr>
			</table>
			<hr>
			<table style='text-align:left'>
				<tr>
					<th>Стоимость портрета:</th>
					<th><span style='color:#7C3F99;'>".$this->getCostPortret($portret, $count_people)." р</span></th>
				</tr>
			</table>
			<hr>
			<table style='text-align:left'>
				<tr>
					<th>Куда отправлять:</th>
					<th><span style='color:#7C3F99;'>".$where_send['where_send']."</span></th>
				</tr>
				<tr>
					<th>Сообщение:</th>
					<th>".$message."</th>
				</tr>
			</table>
		</body>
		";
		return $html;
	}










	private function getCostPortret($portret, $count_people){
		if ($count_people>1){
			$text = $portret["cost"]."(+".$portret["cost_add"]." * ".($count_people-1).") => ";
			$text .= $portret["cost"]+($portret["cost_add"]*($count_people-1));
			return $text;
		}else{
			return $portret["cost"];
		}
	}

	public function getAdditionallyText($additionally){
		if (!count($additionally)){
			return "Не выбрано";
		}
		foreach ($additionally as $key => $value) {
			$html .= $value["text"];
			$html .= " - ";
			$html .= $value["cost"];
			$html .= (strcmp($value["type"], "rub") === 0)? " р": " %";
			$html .= "; ";
		}
		return $html;
	}

	public function getAdditionallyHtml($additionally){
		if (!count($additionally)){
			return "Не выбрано";
		}
		foreach ($additionally as $key => $value) {
			$html .= $value["text"];
			$html .= " - ";
			$html .= $value["cost"];
			$html .= (strcmp($value["type"], "rub") === 0)? " р": " %";
			$html .= "<br>";
		}
		return $html;
	}

	private function getCostPortretFull($portret, $count_people, $additionally, $post_cost){
		$text = $portret["cost"];
		$cost = $portret["cost"];

		$text .= " + ".$post_cost;
		$cost += $post_cost;

		if ($count_people>1){
			$text .= " + ".($portret["cost_add"]*($count_people-1));
			$cost += ($portret["cost_add"]*($count_people-1));
		}
		if (count($additionally)){
			foreach ($additionally as $key => $value) {
				if ((strcmp($value["type"], "rub") === 0)){
					$text .= " + ".$value["cost"];
					$cost += $value["cost"];
				}else{
					$text .= " + ".($portret["cost"]*($value["cost"]/100));
					$cost += ($portret["cost"]*($value["cost"]/100));
				}
			}
		}
		return $text." = ".$cost;
	}


	private function getColorsHtml($colors){
		foreach ($colors as $key => $value) {
			$color = htmlspecialchars($value);
			$html .= "<div style='display:inline-block; background-color:".$color."; width:100px; height:25px; margin: 0 5px; padding:4px 0 1px 8px;'><span>".$color."</span></div>";
		}
		return $html;
	}

	private function getColorsTXT($colors){
		foreach ($colors as $key => $value) {
			$color = htmlspecialchars($value);
			$txt .= $color." ";
		}
		return $txt;
	}

}

?>