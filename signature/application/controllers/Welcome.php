<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$this->load->view('single');
	}
	Public function get_sign()
	{

	$img = $_POST['image'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = './signature-image/' . uniqid() . '.png';
	$success = file_put_contents($file, $data);
	$image=str_replace('./','',$file);

     echo '<img src="'.base_url().$image.'">';

     
	}
	public function multiple()
	{	
			$this->load->view('header');
		$this->load->view('multiple_sign');
	}

	Public function get_multiple()
	{
		echo "<pre>";
		print_r($_POST);
	}


}
