<?php 
/**
 * Interaction between the System and the DB.  Specifically for Teams.
 * 
 * @author armandop
 *
 */
namespace Application\Model\Dao;

class Team extends Dao {
	
	public function __construct(){
		parent::__construct();
		parent::$collection = parent::$db->teams;
	}
	
} 