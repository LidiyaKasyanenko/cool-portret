<section class="block">
				<div class="container">
					<form action="function.php" method="POST">
						<div class="form-group row">
							<label class="col-xs-2">Логин</label>
							<div class="col-xs-10">
								<input class="form-control" type="text" name="login" value="%login%">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-xs-2">Пароль</label>
							<div class="col-xs-10">
								<input class="form-control" type="text" name="password" value="%password%">
							</div>
						</div>
						<div class="form-group row">
							<input class="form-control btn" type="submit" name="save_data" value="Сохранить">
						</div>
					</form>
				</div>
			</section>

			<section class="block">
				<div class="container">
					<h2>Основные параметры</h2>
					<div class="row">
						<div class="columnbla col-sm-3">
							<h3>Формы</h3>
							<form action="function.php" method="POST">
								<div class="form-group row">
									<label class="col-xs-6">Макс размер имени</label>
									<div class="col-xs-6">
										<input class="form-control" type="number" min="0" name="max_size_text" value="%max_size_text%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-6">Мин размер имени</label>
									<div class="col-xs-6">
										<input class="form-control" type="number" min="0" name="min_size_text" value="%min_size_text%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-6">Макс кол чел</label>
									<div class="col-xs-6">
										<input class="form-control" type="number" min="0" name="max_size_people" value="%max_size_people%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-6">Мин кол чел</label>
									<div class="col-xs-6">
										<input class="form-control" type="number" min="0" name="min_size_people" value="%min_size_people%">
									</div>
								</div>
								<!-- <div class="form-group row">
									<label class="col-xs-6">Макс размер файла</label>
									<div class="col-xs-6">
										<input class="form-control" type="number" min="0" name="max_size_file" value="%max_size_file%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-6">Мин размер файла</label>
									<div class="col-xs-6">
										<input class="form-control" type="number" min="0" name="min_size_file" value="%min_size_file%">
									</div>
								</div> -->
								<div class="form-group row">
									<input class="form-control btn" type="submit" name="save_data" value="Сохранить">
								</div>
							</form>
						</div>
						<div class="columnbla col-sm-4">
							<h3>Страница</h3>
							<form action="function.php" method="POST">
								<div class="form-group row">
									<label class="col-xs-4">Заголовок</label>
									<div class="col-xs-8">
										<input class="form-control" type="text" name="page_title" value="%page_title%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-4">meta_key</label>
									<div class="col-xs-8">
										<textarea class="form-control" type="text" name="meta_key">%meta_key%</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-4">meta_desc</label>
									<div class="col-xs-8">
										<textarea class="form-control" type="text" name="meta_desc">%meta_desc%</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-4">Цена посылки</label>
									<div class="col-xs-8">
										<input class="form-control" type="number" min="0" name="cost_post" value="%cost_post%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-4">Цена доп чел</label>
									<div class="col-xs-8">
										<input class="form-control" type="number" min="0" name="cost_add_people" value="%cost_add_people%">
									</div>
								</div>
								<div class="form-group row">
									<input class="form-control btn" type="submit" name="save_data" value="Сохранить">
								</div>
							</form>
						</div>
						<div class="columnbla col-sm-5">
							<h3>Связь</h3>
							<form action="function.php" method="POST">
								<div class="form-group row">
									<label class="col-xs-3">Телефон</label>
									<div class="col-xs-9">
										<input class="form-control" type="text" name="phone" value="%phone%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3">Телефон представление</label>
									<div class="col-xs-9">
										<input class="form-control" type="text" name="phone_view" value="%phone_view%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3">whatsapp</label>
									<div class="col-xs-9">
										<input class="form-control" type="text" name="whatsapp" value="%whatsapp%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3">viber</label>
									<div class="col-xs-9">
										<input class="form-control" type="text" name="viber" value="%viber%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3">vk</label>
									<div class="col-xs-9">
										<input class="form-control" type="text" name="vk" value="%vk%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3">instagram</label>
									<div class="col-xs-9">
										<input class="form-control" type="text" name="instagram" value="%instagram%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3">ok</label>
									<div class="col-xs-9">
										<input class="form-control" type="text" name="ok" value="%ok%">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xs-3">facebook</label>
									<div class="col-xs-9">
										<input class="form-control" type="text" name="facebook" value="%facebook%">
									</div>
								</div>
								<div class="form-group row">
									<input class="form-control btn" type="submit" name="save_data" value="Сохранить">
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>


<section class="block">
				<div class="container">
					<h2>Видео</h2>
					<form action="function.php" method="POST">
						<div class="form-group row">
							<label class="col-xs-2">ссылка</label>
							<div class="col-xs-10">
								<input class="form-control" type="text" name="video" value="%video%">
							</div>
						</div>
						<div class="form-group row">
							<input class="form-control btn" type="submit" name="save_data" value="Сохранить">
						</div>
					</form>
				</div>
			</section>