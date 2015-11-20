<?php
namespace Music;

 use Music\Model\Music;
 use Music\Model\MusicTable;
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
                 'Music\Model\MusicTable' =>  function($sm) {
                     $tableGateway = $sm->get('MusicTableGateway');
                     $table = new MusicTable($tableGateway);
                     return $table;
                 },
                 'MusicTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Music());
                     return new TableGateway('music', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
 
 ?>