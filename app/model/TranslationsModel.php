<?php
class TranslationsModel extends BaseModel{
	
	public function getTranslation($id){
		return $this->database->table('translation')->get($id);
	}
	

	public function getTranslations(){
		$translations = $this->database->table('translation');
		$count = 0;
		foreach ($translations as $translation){
				$movie = $this->database->table('movie')->get($translation->id_movie);
				$place = $this->database->table('place')->get($translation->id_place);
				$placeSize = $this->database->table('place_size')->get($place->id_place_size);
				$count++;
				$a = array( 
						'translation '.$count.'.' => array(
								'id_translation' => $translation->id_translation,
								'movie' => array(
										'id_movie' => $movie->id_movie,
										'movie_name' => $movie->movie_name
								),
								'place' => array(
										'id_place' => $place->id_place,
										'place_size' => array(
												'id_place_size' => $placeSize->id_place_size,
												'place_column_count' => $placeSize->place_column_count,
												'place_row_count' => $placeSize->place_row_count
										),
										'place_price' => $place->place_price
								),
								'translation_time' => $translation->translation_time
						)
						
				);
		}
		return $a; 
	}
}