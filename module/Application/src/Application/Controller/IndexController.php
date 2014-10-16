<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

	
	/**
	 * Migrate the info from mysql to mongo.
	 * MySQL used because my bot is currently pointed to mysql...:-o
	 */
    public function migrateAction(){
    	
    	//open the mysql connection
    	$mysql = new \mysqli("localhost", "root", "", "marvelpocketguide");
    	
    	//open the mongo connection
    	$mongo = new \MongoClient();
    	$db = $mongo->marvelapi;
    	$collection = $db->characters;
    	
    	
    	//Fetch all the characters
    	$charactersQuery = "SELECT name, real_name, aliases, identify, citizenship, place_of_birth, origin, first_apperance, 
    			occupation, relatives, teams, height, weight, 
    			hair, eyes, education, powers FROM characters";
    	$characters = $mysql->query($charactersQuery);
    	
    	while($row = $characters->fetch_array(MYSQLI_ASSOC)){
    	
    		//Insert into mongo if the character is not present.
    		$row['powers'] = utf8_encode($row['powers']);
    		$row['name'] = utf8_encode($row['name']);
    		$row['real_name'] = utf8_encode($row['real_name']);
    		$row['aliases'] = utf8_encode($row['aliases']);
    		$row['identify'] = utf8_encode($row['identify']);
    		$row['citizenship'] = utf8_encode($row['citizenship']);
    		$row['place_of_birth'] = utf8_encode($row['place_of_birth']);
    		$row['origin'] = utf8_encode($row['origin']);
    		$row['first_apperance'] = utf8_encode($row['first_apperance']);
    		$row['occupation'] = utf8_encode($row['occupation']);
    		$row['relatives'] = utf8_encode($row['relatives']);
    		$row['teams'] = utf8_encode($row['teams']);
    		$row['height'] = utf8_encode($row['height']);
    		$row['weight'] = utf8_encode($row['weight']);
    		$row['hair'] = utf8_encode($row['hair']);
    		$row['eyes'] = utf8_encode($row['eyes']);
    		$row['education'] = utf8_encode($row['education']);
    		
    		$collection->insert($row);
    	
    	}
    	
    	exit;
    	
    	
    }
}
