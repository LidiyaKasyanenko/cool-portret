<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="%js%drop.image.js"></script>
<script src="%js%valid.js"></script>
<script src="%js%modal2.js"></script>
<script src="%js%modal3.js"></script>
<script src="%js%call.js"></script>
<script src="%js%jquery.lazyload.min.js"></script>
<!--<script src="%js%js.js"></script>-->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?146"></script>


<script>
	$(".modal").on("show", function () {
		$("body").addClass("modal-open");
	}).on("hidden", function () {
		$("body").removeClass("modal-open")
	});
</script>
<script type="text/javascript">
	$(function(){

		$("img.lazyImg").lazyload({
			effect: "fadeIn"
		});
	});
</script>

<script>
	$('#front_block').ready(function() {
		$(".lazy_load").attr('src', function() {
			return $(this).attr("data-src");
		});
	});
</script>

<!-- <script type="text/javascript">
	$(function () {
		$('#datetimepicker2').datetimepicker({
			pickTime: false,
			language: 'ru'
		});
		$('#datetimepicker3').datetimepicker({
			pickTime: false,
			language: 'ru'
		});
	});
</script> -->


<script>
	window.onload = function() {
    // console.log(typeof(yaCounter45412398) !== 'undefined');
      //Для звонков в файле call на попытку и на отправку
      $('#myModalCalck').on('show.bs.modal', function (event) {
        // console.log('open_calck');
        // console.log(yaCounter45412398);
        if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('open_calck');
      });
      $('#myModalCalck2').on('show.bs.modal', function (event) {
    if (isOpenModalCalcOrder){//Расширеная форма для оформлени заказа
    //   console.log('add');
      if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('order2');//ввели на форме заказа
    }else{//ввели на калькуляторе
    	if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('calculate');
    	if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('input_data_calck');
    //   console.log('input_data_calck');
  }

});

      $('#myModalCalck2 #edit_data').on('click', function (event) {
      	if (isOpenModalCalcOrder){
      		if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('edit_data_order');
    //  console.log('edit_data_order');
   }else{//решили отредактировать на калькуляторе
   	if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('edit_data_calck');
    //  console.log('edit_data_calck');
  }
});


      $('#btn_sketch').on('click', function (event) {
        if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('sketch');//открытие формы заказа
        // console.log('sketch');
      });

		  $('#myModalSend').on('show.bs.modal', function (event) {
        if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('modalsend');//открытие формы успешной отправки
        // console.log('modalsend');
      });
      $('#myModalSend').on('show.bs.modal', function (event) {
        if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('send');//открытие формы заказа
      });


		  $('#myModalOrder').on('show.bs.modal', function (event) {
		    if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('order1');//открытие формы заказа
		  });


      $('#myModalCalck2 #order_btn').on('click', function (event) {
    if (isOpenModalCalcOrder){//отправка писма
    	if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('order3');
    //   console.log('letter');
  }
});


      $('#myModalCalck2 #btn_discount').on('click', function (event) {
		    if (isOpenModalCalcOrder){//получить скидку
		    	if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('discount');
				      // console.log('discount');
				  }
			});



      $(window).scroll(function(){
        //Пользователь долистал до низа страницы
        if  ($(window).scrollTop() == $(document).height() - $(window).height()){
            // console.log('до низа');
            if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('bottom_page');
          }
        });


      $('#myModalCalck2 #additionally_block').on('shown.bs.collapse', function () {
      //Дополнительные штуки
      if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('additionally_btn');
      // console.log('additionally_btn');
    });

      $('#myModalCalck2 #cheaper_block2').on('shown.bs.collapse', function () {
      //Хочу дешевле
      if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('cheaper_block2');
    //   console.log('cheaper_block2');
  });

      $('#video .video_wrapp').on('click', function (event) {
      //Клик видео
      $("#video iframe")[0].src += "&autoplay=1";
      $('#video .video_wrapp').hide();
      if (typeof(yaCounter45412398) !== 'undefined') yaCounter45412398.reachGoal('video_click');
    //   console.log('video_click');
  });
    }

  </script>



  <script>
  	$(document).ready(function() {
  		$("a.scrollto").click(function() {
  			var elementClick = $(this).attr("href")
  			var destination = $(elementClick).offset().top;
  			jQuery("html:not(:animated),body:not(:animated)").animate({
  				scrollTop: destination
  			}, 800);
  			return false;
  		});
  	});
  </script>




  <!-- Скрипт, вызывающий модальное окно после загрузки страницы -->
<!-- <script>
	$(document).ready(function() {
		$("#myModalOrder").modal('show');
	});
</script> -->