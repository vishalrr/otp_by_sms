<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function message()
	{
		//load registration view form
		$this->load->view('signup');
		//Check submit button 
		if($this->input->post('save'))
		{
		$phone=$this->input->post(‘phone’);
		$user_message=$this->input->post(‘message’);
		//Your authentication key
		$authKey = "3456655757gEr5a019b18";
		//Multiple mobiles numbers separated by comma
		$mobileNumber = $phone; //Sender ID,While using route4 sender id should be 6 characters long. $senderId = "ABCDEF"; //Your message to send, Add URL encoding here. $rndno=rand(1000, 9999); $message = urlencode(“OTP number.".$rndno); //Define route 
		$route = "route=4";
		//Prepare you post parameters
		$postData = array(
		'authkey' => $authKey,
		'mobiles' => $mobileNumber,
		'message' => $message,
		'sender' => $senderId,
		'route' => $route
		);
		//API URL
		$url="https://control.msg91.com/api/sendhttp.php";
		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postData
		//,CURLOPT_FOLLOWLOCATION => true
		));
		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//get response
		$output = curl_exec($ch);
		//Print error if any
		if(curl_errno($ch))
		{
		echo 'error:' . curl_error($ch);
		}
		curl_close($ch);
		echo "OTP Sent Successfully !";
		}
	}
}
