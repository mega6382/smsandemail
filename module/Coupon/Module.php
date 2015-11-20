<?php
namespace Coupon;

 use Coupon\Model\Coupon;
 use Coupon\Model\CouponTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
	 public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Coupon\Model\CouponTable' =>  function($sm) {
                     $tableGateway = $sm->get('CouponTableGateway');
                     $table = new CouponTable($tableGateway);
                     return $table;
                 },
                 'CouponTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Coupon());
                     return new TableGateway('coupon', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
 
 ?>