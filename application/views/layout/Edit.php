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
</head>
<body>
	<?php
		$form = array('id'=>'editform','enctype'=>'multipart/form-data');
		echo $this->load->helper('form');
		echo form_open(AppMethod::setDocRoot("edit/submit?" . $url_str),$form);
	?>
	<?php include APPPATH . '/views/header.php'; ?>
	<div class="container">
		<?php
			if(count($err) != 0){
				echo '<div class="row" style="margin-top:70px;padding-left:5%;padding-right:5%;">';
				foreach($err As $str){
					echo '<div class="col-lg-12">';
					echo '	<font color="#ff584f">※' . $str . '</font>';
					echo '</div>';
				}
				echo '</div>';
				echo '<div class="row" style="margin-top:5px;padding-left:5%;padding-right:5%;">';
			}else{
				echo '<div class="row" style="margin-top:70px;padding-left:5%;padding-right:5%;">';
			}
		?>
		<div class="col-sm-12">
			日付<br>
			<?php
				$data = array(
					'type' => 'date',
					'class' => 'form-control',
					'name' => 'date',
					'value' => $date
				);
				echo form_input($data);
			?>
		</div>
		<div class="col-sm-12" style="margin-top:3%;">
			タイトル<br>
			<?php
				$data = array(
					'type' => 'text',
					'class' => 'form-control',
					'name' => 'title',
					'value' => $title
				);
				echo form_input($data);
			?>
		</div>
		<div class="col-sm-12" style="margin-top:3%;">
			備考<br>
			<?php
				$data = array(
					'type' => 'text',
					'class' => 'form-control',
					'name' => 'biko',
					'rows' => '10',
					'value' => $biko
				);
				echo form_textarea($data);
			?>
		</div>
		<div class="col-sm-12" style="margin-top:3%;">
			<div style="width:100%;text-align:right;">
				<?php
					$data = array(
						'type' => 'submit',
						'class' => 'btn btn-danger"',
						'value' => '更新'
					);
					echo form_submit($data);
				?>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</body>
</html>
