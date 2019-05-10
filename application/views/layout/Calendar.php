<html>
<head>
	<meta charset="utf-8">
	<title>Calendar</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link type="text/css" rel="stylesheet" href="<?php echo AppMethod::setDocRoot('assets/css/bootstrap.min.css'); ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo AppMethod::setDocRoot('assets/css/calendar.css'); ?>" />
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo AppMethod::setDocRoot('assets/js/calendar.js'); ?>"></script>
	<script type="text/javascript">
		function initCal(year,month){
			// カレンダー生成
			setCalendar(year,month);

			// カレンダーに項目をセット
			<?php foreach ($list AS $li){ ?>
				$("#<?php echo $li['date']; ?>").append("<a class='cal' href='<?php echo AppMethod::setDocRoot('Edit/index?mode=update&id=' . $li['id']); ?>'><?php echo $li['title_text']; ?></a>");
			<?php } ?>
		}
	</script>
</head>
<body onLoad="initCal('<?php echo $year; ?>','<?php echo $month; ?>')">
	<?php
		$form = array('id'=>'calendarform','enctype'=>'multipart/form-data');
		echo $this->load->helper('form');
		echo form_open(AppMethod::setDocRoot("Calendar/submit"),$form);
	?>
	<?php include APPPATH . '/views/header.php'; ?>
	<div class="container">
		<div class="row" style="margin-top:70px;">
			<div id="result"></div>
		</div>
	</div>
	<?php echo form_close(); ?>
</body>
</html>
