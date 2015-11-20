<?php
/**
 * Setting connection to the Provider. 
 * For each individual they are. So be careful when you try to connect a new supplier
 */
$t = [
        
        'MailSender'  =>  [

            // Request params
            
            'mime'           =>  'MIME-Version: 1.0', // API secret key
            'content'              =>  'Content-type: text/html; charset=iso-8859-1',                                       // default language
            'xcrt'   =>  'X-Confirm-Reading-To: test@qairus.org', // pattern of basic request uri 
            'from'      =>  'From: test@qairus.org' . "\r\n" . 'Reply-To: test@qairus.org' . "\r\n" . 'X-Mailer: PHP/' . phpversion(),                             // using default mail list name

            
            // required Adapter request configurations
            
            'adapter'           =>  [
                CURLOPT_POST                =>  1,
                CURLOPT_SSL_VERIFYPEER      =>  false,
                CURLOPT_SSL_VERIFYHOST      =>  false,
                CURLOPT_RETURNTRANSFER      =>  true,
                CURLOPT_TIMEOUT             =>  30
            ],
        ]
    
];