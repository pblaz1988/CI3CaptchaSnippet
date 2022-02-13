<?php
const _CAPTCHAKEY = yourcaptchakey; //put your captcha secret key here

private function challengeCaptcha ($secretKey, $captcha)
{
	$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
	$response = file_get_contents($url);
	$responseKeys = json_decode($response,true);
	if($responseKeys["success"]==1) return true;		// success	=> return true
	return false;										// fail		=> return false
}

// captcha validation
private function index()
{ 
	$captchaResponse = false;
	if ($this->request->getMethod() == 'post')
	{
		// does captcha exist?
		$captchaPostResponse = $this->request->getVar('g-recaptcha-response');
		if($captchaPostResponse != null)
		{
			$captchaResponse = $this->challengeCaptcha(self::_CAPTCHAKEY,$captchaPostResponse);
		}
		
		if (isset($captchaResponse) && $captchaResponse)
		{
			// your code goes here - success
		} else
		{
			// your code goes here - failure
		}
	}
	return ;
}
?>