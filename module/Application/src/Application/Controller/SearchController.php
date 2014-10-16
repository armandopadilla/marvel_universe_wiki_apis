<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\Dao\Search as SearchDao;
use Zend\View\Model\JsonModel;

class SearchController extends AbstractActionController {
	
	
	/**
	 * Search the system for a specific term and return as JSON.
	 * 
	 * @return \Zend\View\Model\JsonModel
	 */
	public function indexAction(){
		
		//Fetch the parameters
		$term = $this->getEvent()->getRouteMatch()->getParam('term');
		
		//Filter and Validate.
		
		try{
			//Do the search
			$SearchObj = new SearchDao;
			$data = $SearchObj->doSearch($term);
			
		}
		catch(Exception $e){

			$data = array();
		}
		
		//Present the data as JSON
		$results =  new JsonModel($data);
		return $results;
		
	}
	
}