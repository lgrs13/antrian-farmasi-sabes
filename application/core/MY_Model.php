<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	function lq($kunci = null)
	{
		if (!empty($kunci)) {
			if ($kunci == 1) {
				echo str_replace("`", "", $this->db->last_query());
				die();
			} else if ($kunci == 2) {
				echo str_replace("`", "", $this->db->last_query());
				echo "<br><br><br>";
			} else if ($kunci == 3) {
				echo $this->db->last_query();
				die();
			}
		} else {
			echo str_replace("`", "", $this->db->last_query());
			die();
		}
	}

	function lq2($kunci = null)
	{
		if (!empty($kunci)) {
			if ($kunci == 1) {
				echo str_replace("`", "", $this->tiketing->last_query());
				die();
			} else if ($kunci == 2) {
				echo str_replace("`", "", $this->tiketing->last_query());
				echo "<br><br><br>";
			} else if ($kunci == 3) {
				echo $this->tiketing->last_query();
				die();
			}
		} else {
			echo str_replace("`", "", $this->tiketing->last_query());
			die();
		}
	}
}
