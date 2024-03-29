<?php

/**
 *
 * LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 * @author	Nikhil Kumar Gupta
 * @license	http://www.gnu.org/licenses/gpl-3.0.txt
 * @version	1
 */

class Server
{
	/**
	 * @var String
	 */
	private $_hashKey;

	/**
	 * @var String
	 */
	private $_code;

	/**
	 * @var String
	 */
	private $_accessToken;

	/**
	 * @var String
	 */
	private $_secretKey;

	/**
	 * @var String
	 */
	private $_clientId = '98765';
	
	/**
	 * Set the Hash Key
	 *
	 * @uses Server::getCode()
	 * @user Server::getSecretKey()
	 */
	public function setHashKey()
	{
		$code = $this->getCode();
		$secretKey = $this->getSecretKey();
		$this->_hashKey = base64_encode(hash_hmac("sha256", utf8_encode($code), utf8_encode($secretKey), false)); 
	}
	
	/**
	 * Get Hash Key
	 *
	 * @uses Server::_hashKey
	 * @return String
	 */
	public function getHashKey()
	{
		return $this->_hashKey;
	}
	
	/**
	 * Get Access Token
	 *
	 * @uses Server::_accessToken
	 * @return String
	 */
	private function _getAccessToken()
	{
		return $this->_accessToken;
	}
	
	/**
	 * Set Code
	 * The $code parameter can be NULL or a String
	 *
	 * @param String
	 */
	public function setCode($code = NULL)
	{
		$this->_code = ($code)?$this->_code = base64_encode($code) : $this->_code = base64_encode('1234');
	}
	
	/**
	 * Get Code
	 *
	 * @return String
	 */
	public function getCode()
	{
		return $this->_code;
	}
	
	/**
	 * Check Hash Key generated by the client and the key generated 
	 * on server
	 *
	 * @param String
	 * @uses Server::getHashKey()
	 * @uses Server::_setAccessToekn()
	 * @return Boolean
	 */
	public function checkHashKey($token)
	{
		$hashKey = $this->getHashKey($this->_code, $this->_secretKey);
		
		if($hashKey == $token)
		{
			$this->_setAccessToken();
			return true;
		}
		return false;
	}
	
	/**
	 * Set Access Token
	 * Can use as same as hash key
	 *
	 * @uses Server::_accessToken
	 */
	private function _setAccessToken()
	{
		$this->_accessToken = '12345';
	}
	
	/**
	 * Get Access Token
	 *
	 * @uses Server::_accessToken
	 * @return String
	 */
	public function getAccessToken()
	{
		return $this->_accessToken;
	}
	
	/**
	 * Set Secret Key
	 * $secretKey can be a String of Numbers, Alphabets or Combination of both
	 *
	 * @uses Server::_secretKey
	 * @param String
	 */
	public function setSecretKey($secretKey)
	{
		$this->_secretKey = $secretKey;
	}
	
	/**
	 * Get Secret Key
	 *
	 * @uses Server::_secretKey
	 * @return String
	 */
	public function getSecretKey()
	{
		return $this->_secretKey;
	}
	
	/**
	 * Get Client Id
	 *
	 * @uses Server::_clientId
	 * @return String
	 */
	public function getClientId()
	{
		return $this->_clientId;
	}
	
	/**
	 * Set Client Id
	 * $clientId can be a String of Numbers, Alphabets or Combination of both
	 *
	 * @uses Server::_clientId
	 * @param String
	 */
	public function setClientId($clientId)
	{
		$this->_clientId = $clientId;
	}
}
