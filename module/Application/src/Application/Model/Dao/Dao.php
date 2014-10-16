<?php
/**
 * Absrract class containing the bulk of the actions. 
 * Currently only supports fetching specific objects
 * and fetching the complete list.
 * 
 * @author armandop
 *
 */
namespace Application\Model\Dao;

abstract class Dao {
	
	private static $MongoConn = null;
	protected static $db = null;
	protected static $collection = null;
	
	protected function __construct(){
		
		self::$MongoConn = new \MongoClient("mongodb://localhost");
		self::$db = self::$MongoConn->marvelapi;
		
	}
	
	/**
	 * Generic Fetch function. 
	 * 
	 * @param unknown $id
	 */
	public function fetch($id){
		
		if(empty($id)){
			throw new \Exception("Invalid id.");
		}
		
		//Create the query and FETCH!  :-)
		$query = array("_id" => new \MongoID($id));
		$object = self::$collection->findOne($query);
		
		return $object;
	}

	
	/**
	 * Fetch the complete list of objects in the system
	 * 
	 * @return unknown
	 */
	public function fetchList(){
		
		$cursor = self::$collection->find();
		
		$container = array();
		foreach($cursor as $key => $item){
			$teamsContainer[] = $team;
		}
		
		return $container;
	}
	
}