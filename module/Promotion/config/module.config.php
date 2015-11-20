<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Promotion\Controller\Promotion' => 'Promotion\Controller\PromotionController',
         ),
     ),
	      'router' => array(
         'routes' => array(
             'Promotion' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/promotion[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Promotion\Controller\Promotion',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'Promotion' => __DIR__ . '/../view',
         ),
     ),
 );
 ?>