<?php
/**
 * Setting connection to the Provider. 
 * For each individual they are. So be careful when you try to connect a new supplier
 */
$r = [   
        // Internet SMS Gateway
        
        'ClickaTell'  =>  [

            // Request params
           
            'api_url_pattern'   =>  'http://api.clickatell.com/http/auth?user=:username&password=:password&api_id=:api_id', 
            'username'          =>  'champhero',                                                         // service username
            'password'          =>  'compteng119743',                                                    // service password
            'api_id'          =>  '3517811',                                                    // service password
            'description'       =>  'Internet SMS Gateway',                                         // description
            'icon'              =>  '',                                // icon url
            
            // required Adapter request configurations
            
            'adapter'           =>  [
                CURLOPT_POST                =>  1,
                CURLOPT_RETURNTRANSFER      =>  true,
                CURLOPT_TIMEOUT             =>  30
            ],
        ]
];