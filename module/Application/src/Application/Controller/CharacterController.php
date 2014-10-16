<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

use Application\Model\Dao\Character as CharacterDao;

class CharacterController extends AbstractActionController {
	
	
	/**
	 * Fetch a specific character
	 */
	public function fetchAction(){
		
		//Fetch parameters.
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		
		//Fetch the Character
		try{
				
			$CharacterDaoObj = new CharacterDao;
			$data = $CharacterDaoObj->fetch($id);
				
		}
		catch(Exception $e){
		
			$data = array();
		}
		
		$results = new JsonModel($data);
		return $results;
		
	}
	
	public function fetchlistAction(){
	}
	
	public function searchAction(){}
	
}