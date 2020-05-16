<section class="block">
    <div class="container">
        <h2>%terms_of_use_title%</h2>
        <form action="function.php" method="POST">
            <input type="hidden" name="block" value="terms_of_use">
            <div class="form-group row">
                <label class="col-xs-2">Заголовок</label>
                <div class="col-xs-10">
                    <input class="form-control" type="text" name="terms_of_use_title" value="%terms_of_use_title%">
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control" type="text" rows="20" name="terms_of_use_text">%terms_of_use_text%</textarea>
            </div>


            <div class="form-group row">
                <input class="form-control btn" type="submit" name="save_data" value="Сохранить">
            </div>

        </form>
    </div>
</section>