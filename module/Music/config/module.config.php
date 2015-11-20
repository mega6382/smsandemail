<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Music\Controller\Music' => 'Music\Controller\MusicController',
         ),
     ),
	      'router' => array(
         'routes' => array(
             'music' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/music[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Music\Controller\Music',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'music' => __DIR__ . '/../view',
         ),
     ),
 );
 ?>