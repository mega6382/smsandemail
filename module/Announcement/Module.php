<?php
namespace Announcement;

 use Announcement\Model\Announcement;
 use Announcement\Model\AnnouncementTable;
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
                 'Announcement\Model\AnnouncementTable' =>  function($sm) {
                     $tableGateway = $sm->get('AnnouncementTableGateway');
                     $table = new AnnouncementTable($tableGateway);
                     return $table;
                 },
                 'AnnouncementTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Announcement());
                     return new TableGateway('announcement', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
 
 ?>