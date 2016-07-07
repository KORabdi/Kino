<?php

class UserModel extends BaseModel{
	
	public function getUserByName($name){
		return $this->database->table('users')->where('name', $name)->fetch();
	}
	
	public function getUserReservations($idUser){
		$reservations = $this->database->table('reservation')->where('id_user', $idUser);
		$i=1;
		foreach ($reservations as $reservation) {
			$a[$i++] = array(
					'id_reservation' => $reservation->id_reservation,
					'id_translation' => $reservation->id_translation,
					'column' => $reservation->reservation_column,
					'row' => $reservation->reservation_row,
					'time' => $reservation->reservation_time
			);
		}
		return $a;
	}
	
	public function createUser($userName,$userPassword,$userEmail){
		return $this->database->query('INSERT INTO `users` (`name`,`password`,`email`,`role`) VALUES (?,?,?,?)',$userName,$userPassword,$userEmail,'guest');
	}
	
	public function ixExisting($param,$value){
		if($this->database->table('users')->where($param, $value)->get(1)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}