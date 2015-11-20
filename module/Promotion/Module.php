<?php
namespace Promotion;

 use Promotion\Model\Promotion;
 use Promotion\Model\PromotionTable;
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
                 'Promotion\Model\PromotionTable' =>  function($sm) {
                     $tableGateway = $sm->get('PromotionTableGateway');
                     $table = new PromotionTable($tableGateway);
                     return $table;
                 },
                 'PromotionTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Promotion());
                     return new TableGateway('Promotion', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
 
 ?>