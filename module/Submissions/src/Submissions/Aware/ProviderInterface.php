<?php
namespace Submissions\Aware;


interface ProviderInterface {
    
    /**
     * getConfig() Get provider configurations
     * @access public
     */
    public function getConfig();
    
    /**
     * getAdapterConfig() Get adapter configuration by default
     * @access public
     */
    public function getAdapterConfig();
    
    /**
     * sendRequest($uri = null, array $data = null) Send request to server
     * @param string $uri request URL
     * @param array $data request data
     * @access public
     */
    public function sendRequest($uri = null, array $data = null);
}
