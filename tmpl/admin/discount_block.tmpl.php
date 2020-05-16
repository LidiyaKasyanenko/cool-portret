<section class="block">
	<div class="container">
		<h2>%discount_title%</h2>
		<form action="function.php" method="POST">
			<input type="hidden" name="block" value="discount">
			<div class="form-group row">
				<label class="col-xs-2">Заголовок</label>
				<div class="col-xs-10">
					<input class="form-control" type="text" name="discount_title" value="%discount_title%">
				</div>
			</div>
			<div class="form-group">
			<textarea class="form-control" type="text" rows="20" name="discount_text">%discount_text%</textarea>
			</div>


			<div class="form-group row">
				<input class="form-control btn" type="submit" name="save_data" value="Сохранить">
			</div>
		</form>
	</div>
</section>