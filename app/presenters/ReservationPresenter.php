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
    	$this->translations = new MoviesModel($database);
    }
    
    public function startup() {
        parent::startup();
        $method = $this->httpRequest->getMethod();
        $this->requestValidation = new requestValid();
        $this->requestValidation->setMethod($method);
        $this->requestValidation->checkPost();
        $this->checkUserLogin();
    }
    public function renderMake(){
        // Get data from post
        $validation = $this->requestValidation;
        $idUser = $this->user->getIdentity()->getId();
	$movie = $this->httpRequest->getPost('movie');
        $column = $this->httpRequest->getPost('column');
	$row = $this->httpRequest->getPost('row');
        
        // Check the format
        $validation->checkEmpty($movie,$column,$row);
        $validation->checkNumeric($movie,$column,$row);
        $this->database->checkReserved($column,$row,$movie);
        // Send data to model to create database query
        // TODO: ReservationModel check
	$this->database->createReservation($idUser, $movie, $column, $row, date('H:i:s'));
    }
	
    public function renderDelete(){
        $idReservation = $this->httpRequest->getPost('id_reservation');
        
        $this->requestValidation->checkEmpty($idReservation);
        $this->requestValidation->checkNumeric($idReservation);
        
        //TODO: Model Try Catch
	$this->database->removeReservation($idReservation);
    }
}
