<?php
class ReservationModel extends BaseModel{
	
	public function createReservation($a,$b,$c,$d,$e){
		return $this->database->query('INSERT INTO `reservation` (`id_user`, `id_translation`, `reservation_column`, `reservation_row`, `reservation_time`) VALUES (?, ?, ?, ?, ?)', $a,$b,$c,$d,$e);
	}
	
	public function removeReservation($a){
		return $this->database->table('reservation')->where('id_reservation',$a)->delete();
	}
	
	public function isReserved($inputColumn,$inputRow,$idTranslation){
		$place = $this->database->table('reservation')->where(array('reservation_column'=>$inputColumn,'reservation_row'=>$inputRow,'id_translation'=>$idTranslation))->fetch();
		if(!$place){
			return FALSE;
		}
		return TRUE;
	}
}