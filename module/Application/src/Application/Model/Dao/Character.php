<?php 
/**
 * Interaction between the System and the DB.  Specifically for Characters.
 *
 * @author armandop
 *
 */
namespace Application\Model\Dao;

class Character extends Dao {
	
	
	public function __construct(){
		parent::__construct();
		parent::$collection = parent::$db->characters;
	}

	
} 