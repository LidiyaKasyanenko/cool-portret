<div class="modal fade" id="myModalCalck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="container">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="" id="myform2">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
							<span aria-hidden="true"></span>
						</button>
						<h4 class="modal-title" id="myModalLabel">РАССЧЕТ СТОИМОСТИ ЗАКАЗА</h4>
					</div>
					<div class="modal-body">
						<form>
							<div class="info">
								<div class="form-group">
									<select class="form-control" id="size">
										<option selected="selected" hidden value="">Размер холста</option>
										%sizies%
									</select>
								</div>
								<div class="form-group">
									<input type="text" id="count_people" class="form-control" placeholder="Количество человек на холсте">
								</div>
								<!-- <div class="form-group">
									<input type="text" class="form-control" id="city" placeholder="Город доставки"> -->
									<!-- <select class="form-control" id="city" disabled>
										<option selected="selected" hidden value="" id="check-city-option">Загрузка городов...</option>
										<optgroup id="cities" label="Города">
										</optgroup>
										<optgroup id="regions" label="Регионы">
										</optgroup>
									</select> -->
								<!-- </div>
								<div class="form-group">
									<input type="text" id="date" class="form-control" placeholder="Дата доставки (день.месяц.год)">
								</div> -->
							</div>
						</form>

					</div>
					<div class="modal-footer">
						<p class="red form_info"></p>
						<button class="page_btn">
							<div class="btn_bgc0">
								<div class="btn_bgc1">
									<div class="btn_bgc2">
										<p>рассчитать стоимость</p>
									</div>
								</div>
							</div>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Модальное окно -->
<div class="modal fade" id="myModalCalck2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="container">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="" id="myform2">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
							<span aria-hidden="true"></span>
						</button>
						<h4 class="modal-title" id="myModalLabel">РАССЧЕТ СТОИМОСТИ ЗАКАЗА</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div id="cost_info">
									<p class="item">
										<span class="title">Цена портрета:</span>
										<span class="text"><span id="cost_port">2522</span> руб.</span>
									</p>
									<p id="cost_add_people" class="info"><span class="portret-cost">2900</span> руб (портрет <span class="size">20x20 см</span>) +<span>300</span> руб (<span class="count">1</span> доп человек)</p>
									<!-- <p class="item isOrder" id="additionally">
										<span class="title">Дополнительно:</span>
										<span class="text">Не выбрано</span>
									</p> -->
									<p class="item">
										<span class="title">Стоимость доставки:</span>
										<span class="text"><span id="cost_delivery">1899</span> руб.</span>
									</p>
									<div id="cheaper">
										<!-- <a id="cheaper_btn" data-toggle="collapse" data-target="#cheaper_block2">Хочу доставку дешевле!</a> -->
										<div id="cheaper_block2">
                                            <label class="info"><input id="pickup" type="radio" name="delivery" value="pickup"><span class="">Самовывоз</span> - 0 руб. <a href="/?page=delivery" target="_blank">Пункты самовывоза</a></label>
                                            <label class="info"><input id="postSdak" type="radio" name="delivery" value="postSdak"><span class="">Доставка до отделения СДЭК/почты</span> – <span>300</span> руб., 2-5 дней.</label>
                                            <label class="info"><input id="courier" type="radio" name="delivery" value="courier" checked><span class="">доставка курьером</span> – <span>400</span> руб., 2-5 дней.</label>
                                            <label class="info"><input id="fast" type="radio" name="delivery" value="fast" checked><span class="">срочная доставка курьером </span> – <span>600</span> руб., 1-2 дня.</label>
<!--											<label class="info"><input id="post" type="radio" name="delivery" value="post"><span class="">Посылка</span> – <span>300</span> руб., 5-14 дней.</label>-->
										</div>
										<small class="info">*стоимость и сроки доставки могут меняться.</small>
									</div>
									<p class="item">
										<span class="pink title">Стоимость заказа:</span>
										<span class="text"><span id="cost_order">2600</span> руб.</span>
									</p>
									<div id="additionally2">
										<p id="additionally_title">
											<a id="additionally_btn" data-toggle="collapse" data-target="#additionally_block" class="" aria-expanded="false"><b class="title green">Можно дополнительно заказать</b> <img class="title" src="../../img/down-arrow-angle-green.png"></a><span class="text"></span></p>
										<div id="additionally_block" class="collapse" aria-expanded="true" style="">
											<div class="checkbox">
												<label title=""><input name="set[]" value="0" type="checkbox">Лак для покрытия готовой картины - <span class="cost">200</span> р</label>
											</div>
											<div class="checkbox">
												<label title=""><input name="set[]" value="1" type="checkbox">Надпись/логтип - <span class="cost">200</span> р</label>
											</div>
											<div class="checkbox">
												<label title=""><input name="set[]" value="2" type="checkbox">Доп. набор 1 краска + 1 кисть - <span class="cost">200</span> р</label>
											</div>
										</div>
									</div>
								</div>

							</div>



							<!-- <div class="col-md-5">
								<div id="short_info">
									<p class="item isOrder">
										<span class="title">Имя:</span>
										<span id="name" class="text">Вася</span>
									</p>
									<p class="item isOrder">
										<span class="title">Телефон:</span>
										<span id="phone" class="text phone">+78945</span>
									</p>
									<p class="item">
										<span class="title">Размер:</span>
										<span id="size" class="text">10x20</span>
									</p>
									<p class="item">
										<span class="title">Количество человек:</span>
										<span id="count_people" class="text">3</span>
									</p>
									<p class="item">
										<span class="title">Город:</span>
										<span id="city" class="text">Припять</span>
									</p>
									<p class="item">
										<span class="title">Дата:</span>
										<span id="date" class="text">18.07.2017</span>
									</p>
								</div>
							</div> -->

						</div>

						<div id="info_time">
							<p id="info_post" class="warning info">ВНИМАНИЕ! При оформлении заказа сегодня, портрет будет доставлен не раньше, чем <span class="date">00.00.0000</span></p>
							<!-- <p>Срок выполнения заказа: 1-2 дня.</p>
								<p>Время выполнения эскиза: 5 часов.</p> -->
							</div>

						</div>
						<div class="modal-footer">
							<p class="red upload_info"></p>
							<div class="row">
								<div class="col-md-5 col-md-offset-7">

								</div>
							</div>
							<div class="row">
								<div class="col-md-7">
									<div id="edit_data" class="page_btn purple_btn">
										<div class="btn_bgc0">
											<div class="btn_bgc1">
												<div class="btn_bgc2">
													<p>Редактировать данные</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="page_btn" id="order_btn">
										<div class="btn_bgc0">
											<div class="btn_bgc1">
												<div class="btn_bgc2">
													<p>Заказать</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Модальное окно -->
	<div class="modal fade" id="myModalOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="container">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="" id="myform">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
								<span aria-hidden="true"></span>
							</button>
							<h4 class="modal-title" id="myModalLabel">ФОРМА ЗАКАЗА</h4>
						</div>
						<div class="modal-body">
							<div class="row">


								<div class="col-md-7">
									<div id="file_upload">
										<input type="file" id="file2" name="file2[]" multiple>
										<div id="file_info">
											<img id="foto" data-src="img/modal/preview-foto.png" src="" alt="фото">
											<div id="files"></div>
											<div id="description_form_file">
												<h4>Загрузить фото</h4>
												<button>выберите</button>
												<p id="text">максимум 5 фотографий, общий объем до 10 мб</p>
												<p id="count_foto">Загружено: <span></span></p>
											</div>
										</div>
									</div>


									<div id="form_info">
										<a class="collapsed" data-target="#demands" data-toggle="collapse" aria-expanded="false">
											<p class="title">Фотография должна соответствовать критериям:
												<img src="../../img/down-arrow-angle.png">
											</p>
										</a>
										<div id="demands" class="collapse" aria-expanded="false">
											<p>- портретное фото, то есть по грудь.</p>
											<p>- желательно смотреть прямо в камеру, а на лице не должно быть резких теней или засвеченных участков.</p>
										</div>

										<div class="where_send">
											<p class="title">Куда отправить эскиз?</p>
											<div class="radio">
												<label><input id="mail" type="radio" name="optradio" value="mail">Почта</label>
											</div>
											<div class="radio">
												<label><input id="viber" type="radio" name="optradio" value="viber">Viber</label>
											</div>
											<div class="radio">
												<label><input id="whatsapp" type="radio" name="optradio" value="Whatsapp">Whatsapp</label>
											</div>
										</div>

										<div class="form-group">
											<textarea id="message" class="form-control" placeholder="Ваше сообщение (необязательно)" rows="5"></textarea>
										</div>


									</div>
								</div>

								<div class="col-md-5">
									<div class="form-group">
										<input type="text" class="form-control" required placeholder="Ваше имя*" id="name">
									</div>
									<div class="form-group">
										<input type="text" class="form-control phone" required placeholder="Ваш телефон*" id="phone">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" required placeholder="Ваш E-mail*" id="email">
									</div>
									<div class="form-group">
										<select class="form-control" id="size">
											<option selected="selected" hidden value="">Размер холста</option>
											%sizies%
										</select>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" required placeholder="Количество человек на холсте*" id="count_people">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" id="city" placeholder="Город доставки">
									</div>
									<div class="form-group">
										<input type="text" class="form-control date" placeholder="Дата доставки (день.месяц.год)">
									</div>

								</div>
							</div>

                            <div class="check_terms_block">
                                <!--                                            <p class="title">Куда отправить эскиз?</p>-->
                                <!-- <div class="checkbox">
                                    <label><input id="check_data" type="checkbox" name="terms-check" value="1">Я даю согласие на обработку персональных данных</label>
                                </div> -->
                                <div class="checkbox">
                                    <label><input id="check_terms" type="checkbox" name="terms-check" value="1">Я принимаю условия <a href="/?page=terms-of-use" target="_blank">пользовательского соглашения</a></label>
                                </div>
                            </div>

                            <!--										<p id="spam">* -Мы не рассылаем спам и соблюдаем политку конфиденциальности</p>-->

						</div>
						<div class="modal-footer">
							<div class="row">
								<div class="col-md-7">
									<p class="form_info red"></p>
								</div>
								<div class="col-md-5">
									<button id="btn_mymodal" class="page_btn">
										<div class="btn_bgc0">
											<div class="btn_bgc1">
												<div class="btn_bgc2">
													<p>Заказать</p>
												</div>
											</div>
										</div>
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



	<div class="modal fade" id="myModalSend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="container">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
								<span aria-hidden="true"></span>
							</button>
							<h4 class="modal-title" id="myModalLabel">СПАСИБО!</h4>
						</div>
						<div class="modal-body">

							<h3 class="form_info text-center"><span class="pink">Ваша заявка принята! Мы с Вами свяжемся в ближайшее время.</span></h3>


						</div>
						<div class="modal-footer">
						</div>

				</div>
			</div>
		</div>
	</div>
