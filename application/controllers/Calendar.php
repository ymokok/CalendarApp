<?php
header("Content-Type: text/html; charset=UTF-8");
class Calendar extends MY_Controller {

	public function index(){

		// モデル
		$model = $this->model('Calendar');

		// year
		$year = $this->input->get('year');

		if($year == null){
			$year = date('Y');
		}

		// month
		$month = $this->input->get('month');

		if($month == null){
			$month = date('m');
		}

		// カレンダー情報
		$list = $model->getCalendarList($year,intval($month));

		$dispArr = array(
			'year' => $year,
			'month' => $month,
			'list' => $list
		);

		$this->load->view('layout/Calendar',$dispArr);
	}
}
