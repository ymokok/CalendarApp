<?php
class Calendar_model extends CI_Model{

	public static function getCalendarList($year,$month){

		// SQL
		$sql = "";
		$sql .= "SELECT ";
		$sql .= "	TO_DATE(year || '/' || month || '/' || day, 'YYYY/MM/DD') AS date, ";
		$sql .= "	tc.* ";
		$sql .= "FROM ";
		$sql .= "	calendar.t_calendar tc ";
		$sql .= "WHERE ";
		$sql .= "	year = ? ";
		$sql .= "AND month = ? ";
		$sql .= "ORDER BY ";
		$sql .= "	year, ";
		$sql .= "	month, ";
		$sql .= "	date, ";
		$sql .= "	id ";
		// param
		$paramArr = array();
		array_push($paramArr,$year);
		array_push($paramArr,$month);

		// 実行
		$ci =& get_instance();
		$query = $ci->db->query($sql,$paramArr);
		$result = $query->result_array();

		return $result;
	}

	public static function getCalendarInfo($id){

		// SQL
		$sql = "";
		$sql .= "SELECT ";
		$sql .= "	* ";
		$sql .= "FROM ";
		$sql .= "	calendar.t_calendar ";
		$sql .= "WHERE ";
		$sql .= "	id = ? ";

		// param
		$paramArr = array();
		array_push($paramArr,$id);

		// 実行
		$ci =& get_instance();
		$query = $ci->db->query($sql,$paramArr);
		$result = $query->result_array();

		return $result[0];
	}

	public function insertCalendar($year,$month,$day,$title_text,$biko_text) {

		$data = array(
			'year' => $year,
			'month' => $month,
			'day' => $day,
			'title_text' => $title_text,
			'biko_text' => $biko_text,
			'insert_datetime' => date('Y/m/d H:i:s'),
			'update_datetime' => date('Y/m/d H:i:s')
		);

		$result = $this->db->insert('calendar.t_calendar', $data);

		return $result;
	}


	public function updateCalendar($id,$year,$month,$day,$title_text,$biko_text) {

		$this->db->set('year', $year);
		$this->db->set('month', $month);
		$this->db->set('day', $day);
		$this->db->set('title_text', $title_text);
		$this->db->set('biko_text', $biko_text);
		$this->db->set('update_datetime', date('Y/m/d H:i:s'));
		$this->db->where('id', $id);
		$this->db->update('calendar.t_calendar');
	}
}
