<?php
namespace Submissions\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Submissions\Exception;

class ProviderFactory implements FactoryInterface, ServiceLocatorAwareInterface {
    private $__provider = null;
    private $__serviceLocator;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->__serviceLocator = $serviceLocator;
        return $this;
    } 
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->__serviceLocator = $serviceLocator;
    }
    public function getServiceLocator()
    {
        return $this->__serviceLocator;
    }
    public function getProvider($provider)
    {
        // need to provide dynamic objects creations 
        
        if(null === $this->__provider) 
        {
            $object = "\\Submissions\\Provider\\$provider";
            // checking class..
            if (!class_exists($object)) {
                throw new Exception\ExceptionStrategy($provider . ' provider does not exist');
            }
            $this->__provider    =  new $object($this->__serviceLocator);
        }
        return $this->__provider;
    }
    public function getProviders()
    {
        $providers  =   $this->getServiceLocator()->get('Config')["Submissions\Provider\Config"];
        if (!$providers || empty($providers)) {
            throw new Exception\ExceptionStrategy('Providers does not exist');
        }
        return $providers;
    }    
}