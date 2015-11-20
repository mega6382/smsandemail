<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Coupon\Controller\Coupon' => 'Coupon\Controller\CouponController',
         ),
     ),
	      'router' => array(
         'routes' => array(
             'coupon' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/coupon[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Coupon\Controller\Coupon',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'coupon' => __DIR__ . '/../view',
         ),
     ),
 );
 ?>