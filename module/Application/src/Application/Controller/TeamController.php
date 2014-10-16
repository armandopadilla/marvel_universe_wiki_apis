<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Application\Model\Dao\Team as TeamDao;

class TeamController extends AbstractActionController {
	
	
	/**
	 * Fetch a specific team using a unique id.
	 * @param id $id
	 * @return JSON
	 */
	public function fetchAction(){
		
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		
		//Fetch the Team
		try{
			
			$TeamDaoObj = new TeamDao;
			$data = $TeamDaoObj->fetch($id);

			
		}
		catch(Exception $e){

			$results = array();
		}
		
		$results = new JsonModel($data);
		return $results;
		
	}
	
	/**
	 * Fetch a list of teams.
	 */
	public function fetchlistAction(){}
	
}