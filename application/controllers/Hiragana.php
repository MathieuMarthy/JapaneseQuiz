<?php
defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH.'models'.DIRECTORY_SEPARATOR.'symbols.php');
require(APPPATH.'models'.DIRECTORY_SEPARATOR.'dao.php');

class Hiragana extends CI_Controller {
	# private array $symbols;

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model("dao");
		$this->load->model("symbols");
		$this->load->helper("url");
	}

	public function index()	{
		session_start();

		if (!isset($_COOKIE["try"], $_COOKIE["good"])) {
			setcookie("try", 0);
			setcookie("good", 0);
			redirect("Hiragana");
		}

		$data = array(
			"hiragana" => $this->symbols->getRandomHiragana(),
			"try" => $_COOKIE["try"],
			"good" => $_COOKIE["good"],
		);

 
		if (isset($_SESSION["data"])) {
			$data = array_merge($data, $_SESSION["data"]);
			unset($_SESSION["data"]);
		}

		$this->load->view("hiragana", $data);
	}

	public function checkResponse()	{
		if (!isset($_POST["hiragana"], $_POST["response"])) {
			redirect("Hiragana");
			die();
		}

		$data = array(
			"correct" => $this->symbols->verifyIfRomanjiIsHiragana($_POST["response"], $_POST["hiragana"]),
			"message" => "Incorrect! The romanji of ".$_POST["hiragana"]." was ".$this->symbols->getRomanjiFromHiragana($_POST["hiragana"]),
		);

		setcookie("try", $_COOKIE["try"] + 1);

		if ($data["correct"]) {
			setcookie("good", $_COOKIE["good"] + 1);
		}
	

		session_start();
		$_SESSION["data"] = $data;
		redirect("Hiragana");
	}
}
