<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Otpsend extends CI_Controller 
{
	public function __construct()
	{
	//call CodeIgniter's default Constructor
		parent::__construct();
	}
	public function message()
	{
		//load registration view form
		$this->load->view('signup');
		//Check submit button 
		if($this->input->post('save'))
		{
		$phone=$this->input->post("phone");
		//$user_message=$this->input->post(‘message’);
		//Your authentication key
		$authKey = "224131AddPReDVmH5b3c6b25";
		//Multiple mobiles numbers separated by comma
		$mobileNumber = $phone; //Sender ID,While using route4 sender id should be 6 characters long. $senderId = "ABCDEF"; //Your message to send, Add URL encoding here. $rndno=rand(1000, 9999); $message = urlencode(“OTP number.".$rndno); //Define route 
		$route = "route=4";
		//Prepare you post parameters
		$postData = array(
		'authkey' => $authKey,
		'mobiles' => $mobileNumber,
		'message' => "hello",
		'sender' => "ABCDEFd",
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
?>