<?php
class Mycal_model extends CI_Model{

	var $conf;

	function Mycal_model(){
		parent::__construct();
		$this -> conf = array(
			"start_day" => "monday",
			"show_next_prev" =>true,
			"next_prev_url" => base_url() . "mycal/display"
		);

		$this->conf["template"] = '
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

			{heading_row_start}<tr>{/heading_row_start}

			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

			{heading_row_end}</tr>{/heading_row_end}

			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}

			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}

			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}

			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

			{cal_cell_blank}&nbsp;{/cal_cell_blank}

			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}

			{table_close}</table>{/table_close}';
	}

	function get_calendar_data($year, $month){

		// カレンダーテーブルから、dateとdataを選択し、dateを取得
		// 生成されるSQL : date LIKE "2014-08%"
		$query = $this->db->select("date, data") -> from("calendar") -> like("date", "$year-$month", "after") -> get();

		$cal_data = array();

		foreach ( $query -> result() as $row ){
			// $queryで日付を取得しているので、substrを利用している
			// 例：2014-08-15の場合⇒15が取得される
			// substr(8, 2)⇒8番目の文字から2文字を取得するという意味
			// 最後の+0の意味：Mysqlは数字を(01, 02, 03,,,)のように返しますが、カレンダークラスは(1,2,3,4,,,)のうように返します。その問題を+0で解決しています。
			$cal_data[substr($row->date, 8,2) +0 ] = $row -> data;
		}

		return $cal_data;

	}

	function add_calendar_data($date, $data){

		// カレンダーDBのdateを選択し、データをカウントする
		if( $this->db->select("date")->from("calendar")->where("date", $date)->count_all_results()){
			// 情報をアップデートする
			$this->db->where("date", $date)->update("calendar", array(
				"date" => $date,
				"data"  => $data
			));
		}else{
			// calendarのDB内にarrayした情報を挿入する
			$this->db->insert("calendar", array(
				"date" => $date,
				"data"  => $data
			));
		}
	}

	function generate ($year, $month){

		$this->load->library("calendar", $this->conf);

		// get_calendar_dataを実行して、取得情報を$cal_dataに挿入する
		$cal_data = $this->get_calendar_data($year, $month);

		return $this->calendar->generate($year, $month, $cal_data);
	}
}