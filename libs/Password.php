<?php
/*
* Clase para el manejo de contraseñas
*
*/
class Password{
	/**
	 * Método constructor
	 * @return none No devuelve nada
	 */
	public function __construct(){
		$this->checkBlowfish();
	}
	/**
	 * Método  para verificar blowfish 
	 * @return none No devuelve nada
	 */
	private function checkBlowfish(){
		if (!defined("CRYPT_BLOWFISH") && !CRYPT_BLOWFISH) {
			echo "Algoritmo Blowfish no roportado";
			die();
		}
	}
	/**
	 * Método para conseguir la contraseña 
	 * @return none No devuelve nada
	 */
	public function getPassword($password, $dig = 7){
		$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$salt = sprintf('$2a$%02d$', $dig);
		for ($i=0; $i < 22; $i++) { 
			$salt .= $set_salt[mt_rand(0, 22)];
		}

		return crypt($password, $salt);
	}
	/**
	 * Método para validar la contraseña o comprobarla
	 * @return none No devuelve nada
	 */
	public function isValid($pass1, $pass2){
		if (crypt($pass1, $pass2) == $pass2) {
			return true;
		}
		
		return false;	
	}
	/**
	 * Método verifica la contraseña
	 * @return none No devuelve nada
	 */
	public function passwordVerify($pass1, $pass2){
		if (password_verify($pass1, $pass2)) {
			return true;
		}
		return false;
	}
}