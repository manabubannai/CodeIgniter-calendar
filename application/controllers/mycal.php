<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mycal extends CI_Controller {
	public function display($year = null, $month = null){

		if( !$year ){
			// $yearが空なら現在の年を挿入
			$year = date('Y');
		}
		if( !$month ){
			// $yearが空なら現在の年を挿入
			$month = date('m');
		}

		$this->load->model("Mycal_model");

		if( $day = $this->input->post("day") ){
		// dayがPOSTされたら以下を実行。同時に、day情報を$dayに格納

			$this->Mycal_model->add_calendar_data(
				// add_calendar_dataは2つのパラメータが必要
				// add_calendar_data($date, $data)
				"$year-$month-$day", //パラメータ1つめ
				$this->input->post("data") //パラメータ2つ目
			);
		}

		$data = array(
			"calendar" => $this->Mycal_model->generate($year, $month)
		);

		$this->load->view("mycal", $data);

		// $conf = array(
		// 	"start_day" => "monday",
		// 	"show_next_prev" =>true,
		// 	"next_prev_url" => base_url() . "mycal/display"
		// );

		// $this->load->library("calendar", $conf);
		// echo $this->calendar->generate($year, $month);
	}
}