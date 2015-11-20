<?php
namespace Submissions\Provider;

use Submissions\Exception;
use Submissions\Aware\ProviderInterface;


class ClickaTell extends \ReflectionClass implements ProviderInterface {
    
    private $_sm    =   null;
   
    private $__config  =   null; 
    
    private $__adapterConfig  =   null;
    
    public function __construct(\Zend\ServiceManager\ServiceManager $ServiceManager) 
    {
        parent::__construct(__CLASS__);
        
        if (null === $this->_sm) {
            $this->_sm = $ServiceManager;
        }
        $this->__config   =   $this->_sm->get('Config')["Submissions\Provider\Config"][$this->getShortName()];
    }        
  
    public function send($params)
    {
        if (!array_key_exists('to', $params) && !array_key_exists('message', $params)) {
            throw new Exception\ExceptionStrategy($this->getShortName() . ' miss required options');
        }
        return $this->sendRequest(null, $params);
    }  
    
    public function getConfig()
    {
        if (empty($this->__config)) {
            throw new Exception\ExceptionStrategy($this->getShortName() . ' config file is empty');
        }
        return $this->__config;
    }
    
    public function getAdapterConfig()
    {
        if (empty($this->__adapterConfig)) {
            throw new Exception\ExceptionStrategy($this->getShortName() . ' connection adapter is not configured');
        }
        return $this->__adapterConfig;        
    }
    
    private function __setAdapterConfig(array $adapterConfig)
    {
        $this->__adapterConfig  =   $adapterConfig+$this->__config['adapter'];
    }
    
    public function sendRequest($uri = null, array $data = null)
    {
        // Compile URL from pattern
	$auth_url = strtr($this->__config['api_url_pattern'], [
		':username' =>  $this->__config['username'],
		':password' =>  $this->__config['password'],
		':api_id' =>  $this->__config['api_id'],
            ]
        );
        $ret = file($auth_url);
        $sess = explode(":",$ret[0]);
        $send_url = null;
        $result = null;
        if ($sess[0] == "OK")
         {
            $sess_id = trim($sess[1]); // remove any whitespace
            $to = urlencode($data['to']);
            $message = urlencode($data['message']);
            $send_url = "http://api.clickatell.com/http/sendmsg?session_id={$sess_id}&to={$to}&text={$message}";
         }
         if($send_url != null)
         {
            $ret = file($send_url);
            $send = explode(":",$ret[0]);

            if ($send[0] == "ID") {
                $result = "MESSAGE SUCCESSFULLY SENT";
            }     
         }
 
         return $result;    
     }
}
