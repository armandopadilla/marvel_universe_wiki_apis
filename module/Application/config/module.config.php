<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


//Character GET endpoint. Fetch a specific character by id
$characterFetch = array( 
		'type' => 'Zend\Mvc\Router\Http\Segment',
		'options' => array(
			'verb' => 'get',
			'route' => '/character/:id',
			'defaults' => array(
				'controller' => 'Application\Controller\Character',
				'action'     => 'fetch'
			)	
		)
);


//Team GET endpoint.  Fetch a specific teams by id.
$teamFetch = array(
		'type' => 'Zend\Mvc\Router\Http\Segment',
		'options' => array(
			'verb' => 'get',
			'route' => '/team/:id',
			'defaults' => array(
				'controller' => 'Application\Controller\Team',
				'action'     => 'fetch'
			)	
		)
);

//Migration Script.
$migrateRoute = array(
		'type' => 'Zend\Mvc\Router\Http\Literal',
		'options' => array(
				'route'    => '/migrate',
				'defaults' => array(
						'controller' => 'Application\Controller\Index',
						'action'     => 'migrate',
				),
		),
);

//Search GET endpoint.  Search the system for a specific term.
$searchRoute = array(
		'type' => 'Zend\Mvc\Router\Http\Segment',
		'options' => array(
			'verb' => 'get',
			'route' => '/search/:term',
			'defaults' => array(
				'controller' => 'Application\Controller\Search',
				'action'     => 'index'
			)	
		)
);


return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        	'search'  	     => $searchRoute,
        	'migrate' 	     => $migrateRoute,
        	'characterFetch' => $characterFetch,
        	'teamFetch'	 	 => $teamFetch,
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Character' => 'Application\Controller\CharacterController',
            'Application\Controller\Team'      => 'Application\Controller\TeamController',
        	'Application\Controller\Search'	   => 'Application\Controller\SearchController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
        	'ViewJsonStrategy',
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
