<?php
/**
 * Search through the data.
 * 
 * @author armandop
 *
 */
namespace Application\Model\Dao;

class Search extends Dao {
	
	
	public function __construct(){
		parent::__construct();
		parent::$collection = parent::$db->characters;
	}
	
	/**
	 * Search Characters.
	 */
	public function doSearch($term){
		
		//Set the query and the columns to return.
		$data = array("_id", "name");
		$query = array("name" => new \MongoRegex("/.*$term.*/i"));
		
		//Fetch the data.
		$cursor = parent::$collection->find($query, $data);
		
		//Place the data into a container to return back.
		$results = array();
		foreach($cursor as $key => $item){
			
			$item['url'] = "http://192.168.1.136:8081/character/".$item['_id'];
			$results[] = $item;
			
		}
		
		return $results;
		
	}
	
	
}