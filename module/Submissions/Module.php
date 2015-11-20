<?php
namespace Submissions;
 use Submissions\Model\Customer;
 use Submissions\Model\CustomerTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getServiceConfig()
    {
        return array(

                'factories' => array(
                    'Submissions\Factory\ProviderFactory'  => 'Submissions\Factory\ProviderFactory',
                    
                'Submissions\Model\CustomerTable' =>  function($sm) {
                    $tableGateway = $sm->get('CustomerTableGateway');
                    $table = new CustomerTable($tableGateway);
                    return $table;
                },
                'CustomerTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Customer());
                    return new TableGateway('customers', $dbAdapter, null, $resultSetPrototype);
                },
                ),

        );
    }    
        public function getViewHelperConfig()
            {
        return array(
            'factories' => array(
                'CKEditor' => function ($sm) {
                        $config = $sm->getServiceLocator()->get('config');
                        $QuCk = new View\Helper\CKEditor($config['QuConfig']['CKEditor']);
                        return $QuCk;
                },
            ),
        );

    }

    public function getAutoloaderConfig()
    {
        return array(

            'Zend\Loader\StandardAutoloader'    =>  array(
                'namespaces'    =>  array(
                    __NAMESPACE__               =>  __DIR__.'/src/'.__NAMESPACE__,
                ),
            ),

            'Zend\Loader\ClassMapAutoloader'    =>  array(
                __DIR__.'/autoload_classmap.php',
            ),

        );        
    } 
}