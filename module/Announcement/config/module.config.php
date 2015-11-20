<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Announcement\Controller\Announcement' => 'Announcement\Controller\AnnouncementController',
         ),
     ),
	      'router' => array(
         'routes' => array(
             'announcement' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/announcement[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Announcement\Controller\Announcement',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'Announcement' => __DIR__ . '/../view',
         ),
     ),
 );
 ?>