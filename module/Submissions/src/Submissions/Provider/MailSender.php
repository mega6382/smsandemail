<?php
namespace Submissions\Provider;

use Submissions\Exception;
use Submissions\Aware;


class MailSender extends \ReflectionClass implements Aware\ProviderInterface {
    
    private $_sm    =   null;
   
    private $__config  =   null; 
    
    private $__adapterConfig  =   null;
    
    public function __construct(\Zend\ServiceManager\ServiceManager $ServiceManager) 
    {
        parent::__construct(__CLASS__);

        if (null === $this->_sm) {
            $this->_sm = $ServiceManager;
        }
        $config   =   $this->_sm->get('Config');
        $this->__config =  $config["Submissions\Provider\Config"][$this->getShortName()];
        if(empty($this->__config)) {
            throw new Exception\ExceptionStrategy(print_r($config, true));
        }
    }        
  
    public function sendEmail($params)
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
        $mail = array();
        $success = array();
        $subject = $data['subject'];
        $message = $data['message'];
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'X-Confirm-Reading-To: test@qairus.org' . "\r\n";
        $headers .= 'From: test@qairus.org' . "\r\n" . 'Reply-To: test@qairus.org' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        foreach ($data['to'] as $key => $email) {
         $mail[] = mail($email,$subject,$message,$headers);
        }
        for($i=0;$i<count($mail);$i++)
            {
                 $success[] = ($mail[$i]) ? 'Sent' : '<b>Not sent!</b>';
            }
            return $success;

    }
}
