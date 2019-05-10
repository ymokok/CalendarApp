<?php
header("Content-Type: text/html; charset=UTF-8");
class Edit extends MY_Controller {

	public function index(){

		// モデル
		$model = $this->model('Calendar');

		// mode
		$mode = $this->input->get('mode');

		if($mode == 'new'){
			return $this->new_index();
		}elseif($mode == 'update'){
			return $this->update_index();
		}
		return;
	}

	private function new_index(){

		$dispArr = array(
			'url_str' => 'mode=new',
			'date' => date('Y') . '-' . date('m') . '-' . date('d'),
			'title' => '',
			'biko' => '',
			'err' => array(),
		);

		$this->load->view('layout/Edit',$dispArr);
	}

	private function update_index(){

		// モデル
		$model = $this->model('Calendar');

		// id
		$id = $this->input->get('id');

		// mode
		$info = $model->getCalendarInfo($id);

		$dispArr = array(
			'url_str' => 'mode=update&id=' . $id,
			'date' => date('Y-m-d',strtotime($info['year'] . '-' . $info['month'] . '-' . $info['day'])),
			'title' => $info['title_text'],
			'biko' => $info['biko_text'],
			'err' => array(),
		);

		$this->load->view('layout/Edit',$dispArr);
	}

	public function submit(){

		// mode
		$mode = $this->input->get('mode');

		if($mode == 'new'){
			return $this->new_submit();
		}elseif($mode == 'update'){
			return $this->update_submit();
		}

		return;
	}

	private function new_submit(){

		// エラーチェック
		$err = $this->errCh($this->input->post('date'),$this->input->post('title'));

		if(count($err) >= 1){

			if($this->input->post('date') != null){
				$date = date('Y-m-d',strtotime($this->input->post('date')));
			}else{
				$date = '';
			}

			// エラー時
			$dispArr = array(
				'url_str' => 'mode=new',
				'date' => $date,
				'title' => $this->input->post('title'),
				'biko' => $this->input->post('biko'),
				'err' => $err,
			);

			$this->load->view('layout/Edit',$dispArr);
			return;
		}

		// モデル
		$model = $this->model('Calendar');

		// 日付分解
		$year = date('Y',strtotime($this->input->post('date')));
		$month = date('m',strtotime($this->input->post('date')));
		$day = date('d',strtotime($this->input->post('date')));

		// insert
		$model->insertCalendar(
			$year,
			$month,
			$day,
			$this->input->post('title'),
			$this->input->post('biko')
		);

		// カレンダー画面へ
		header("location: " . AppMethod::SetDocRoot('Calendar/index?year=' . date('Y'). '&month=' . date('m')));
	}

	private function update_submit(){
	
		// id
		$id = $this->input->get('id');

		// エラーチェック
		$err = $this->errCh($this->input->post('date'),$this->input->post('title'));

		if(count($err) >= 1){

			if($this->input->post('date') != null){
				$date = date('Y-m-d',strtotime($this->input->post('date')));
			}else{
				$date = '';
			}

			// エラー時
			$dispArr = array(
				'url_str' => 'mode=update&id=' . $id,
				'date' => $date,
				'title' => $this->input->post('title'),
				'biko' => $this->input->post('biko'),
				'err' => $err,
			);

			$this->load->view('layout/Edit',$dispArr);
			return;
		}

		// モデル
		$model = $this->model('Calendar');

		// 日付分解
		$year = date('Y',strtotime($this->input->post('date')));
		$month = date('m',strtotime($this->input->post('date')));
		$day = date('d',strtotime($this->input->post('date')));

		// insert
		$model->updateCalendar(
			$id,
			$year,
			$month,
			$day,
			$this->input->post('title'),
			$this->input->post('biko')
		);

		// カレンダー画面へ
		header("location: " . AppMethod::SetDocRoot('Calendar/index?year=' . date('Y'). '&month=' . date('m')));
	}

	private function errCh($date,$title){

		$errArr = array();

		if($date == ""){
			array_push($errArr,'日付が入力されていません。');
		}

		if($title == ""){
			array_push($errArr,'タイトルが入力されていません。');
		}
		return $errArr;
	}
}
