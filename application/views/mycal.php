<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>CodeIgniterカレンダー</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<style>
	.calendar {
		font-family: Arial;
		font-size:   12px;
	}

	table.calendar {
		margin:          auto;
		border-collapse: collapse;
	}

	.calendar .days td {
		width:            80px;
		height:           80px;
		padding:          4px;
		border:           1px solid #999;
		vertical-align:   top;
		background-color: #DEF;
	}

	.calendar .days td:hover {
		background-color: #FFF;
	}

	.calendar .highlight {
		font-weight: bold;
		color:       #00F;
	}
	</style>
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<?php echo $calendar; ?>
	<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".calendar .day").click(function(){

			// class="day_num"の次には数字が入っているので、それを.html()で取得
			day_num = $(this).find(".day_num").html();
			// alert (day_num);

			// prompt：ポップアップでテキストのインプットボックスが出現します。
			day_data = prompt("予定を入力", $(this).find(".content").html());

			if( day_data != null ){
			// ユーザーがprompt後にキャンセルしなければ以下を実行
				$.ajax({
					url:window.location,
					type:"POST",
					data:{
						// dayがPostされる
						day:day_num,

						//prompt部分で入力された情報
						data:day_data
					},
					success:function(msg){
						location.reload();
					}
				});
			}
		})
	})
	</script>
</body>
</html>