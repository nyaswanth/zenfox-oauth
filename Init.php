<?php
//This code is called when the user will be redirected by us.
//Authorize the application (Check the client id)
//Authenticate the user
//Once authorization and authentication is done, paas the Request Token, UserId, and DisplayName with the Request Url(Sent by us)

//Get the Client Id and Redirecting URL from the URL
$requestUrl = $this->getRequest()->getParam('redirectUri');
$requestUrl = explode(',', $requestUrl);
$requestUrl = implode('/', $requestUrl);

$clientIdSent = $this->getRequest()->getParam('clientId');

$server = new Server();
$clientIdStored = $server->getClientId();

//Check the client id
if($clientIdSent == $clientIdStored)
{
	//Authenticate the user
	$userIsAuthenticated = true;
	if($userIsAuthenticated)
	{
		$code = null; //Or generate your own code algo.
		$server->setCode($code); //If null is passed, Server generates its own code in a default way
		$code = $server->getCode(); //Code is nothing but a request token. Will be used to generate Access Token
		//Params must be a comma seperated string
		$params['userId'] = 1;
		$params['name'] = 'nik';
	}
}
else
{
	//Code need not to be send. Can ignore the code parameter
	$code = NULL;
	$params['error'] = "Invalid Application Request";
}
$param = implode(',', $params);
$this->_redirect($requestUrl . 'code/' . $code . '/param/' . $param);


//This code is called where taashtime server will request the access token from zapak
//Decode the code passed by taashtime
$server = new Server();
$server->setCode(base64_decode($_POST['code']));
$server->setSecretKey('abcd1234');
$server->setHashKey();
$code = $server->checkHashKey($_POST['hashKey']);
if($code)
{
	$accessToken = $server->getAccessToken();
}
echo $accessToken;
?>
