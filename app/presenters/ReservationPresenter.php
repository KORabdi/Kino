<?php
use Nette\Security\User;
/**
 * Homepage presenter.
*/
class ReservationPresenter extends BasePresenter
{
	private $translations;
	public function __construct(Nette\Database\Connection $database, Nette\Security\User $storage, Nette\Http\Request $url){
		parent::__construct($database,$storage,$url);
		$this->database = new ReservationModel($database);
		$this->translations = new TranslationsModel($database);
		if($this->httpRequest->getMethod() != 'POST'){
			$this->error('Wrong request',Nette\Http\Response::S400_BAD_REQUEST);
			exit;
		}
		if(!$this->user->isLoggedIn()){
			$this->error('Needs authorization',Nette\Http\Response::S401_UNAUTHORIZED);
			exit;
		}
	}
	public function renderMake(){
		$idUser = $this->user->getIdentity()->getId();
		$request = $this->check('select');
		$translation = $this->translations->getTranslation($request);
		if(!isset($translation->id_translation)){
			$this->sendAPIResponse(array('error' => 'Your translation does not exists'));
			exit;
		}
		$column = $this->check('column');
		$row = $this->check('row');
		if($this->database->isReserved($column,$row,$request)){
			$this->sendAPIResponse(array('error' => 'Your sit is taken'));
			exit;					
		}
		if($this->database->createReservation($idUser, $translation->id_translation, $column, $row, date('H:i:s'))){
			$this->sendAPIResponse(array('status'=> 'OK'));
		}else{
			$this->sendAPIResponse(array('error'=> 'Reservation did not make'));
		}
	}
	
	public function renderDelete(){
			$idReservation = $this->check('id_reservation');
			if($this->database->removeReservation($idReservation)){
				$this->sendAPIResponse(array('status'=> 'OK'));
			}else{
				$this->sendAPIResponse(array('error'=> 'Reservation did not removed'));
			}
	}
}
