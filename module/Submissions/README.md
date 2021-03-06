### ZF2-Submissions Mass mailings Service v 2
---------
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/stanislav-web/ZF2-Submissions/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/stanislav-web/ZF2-Submissions/?branch=master)
---------
This module is designed to organize mass mailings SMS and Email. 
The module serves as a container for multiple providers, organizing mass mailings Email and SMS. 

#### MailSender | BulkSMS Mass mailing service inside!

![Alt text](http://www.MailSender.com/images/logo.png "MailSender.com")
![Alt text](https://bulksms.vsms.net/c/img/logo.jpg "Bulksms.vsms.net")

---------------------------------------------------------------

#### Installation:

Require PHP 5.4+ extends SPL Library

1.  Add module "Submissions" in your application.config.php

2.  To load default settings provider, add in your "config_global_path"   array( './vendor/Submissions/config/providers/*.php') 
```php
<?php 
            'config_glob_paths' => array(
                './vendor/Submissions/config/providers/*.php'
            ) 
?>
```

2. In the directory /config/providers/*.php provider settings are located. When you add new, follow the pattern of the floor.
Then you have to create the same name used by the API methods and properties (example API reside in the same directory ../src/Submissions/Provider/*.php ... Look there and do the same)

3. How to use in the controller actions?

```php
<?php  

        // Get Factory container
        $factory        = $this->getServiceLocator()->get('Submissions\Factory\ProviderFactory');

        // Get Provider @see /src/Submissions/Provider/MailSender.php etc..
        $provider       = $factory->getProvider('MailSender');   
        
        // Get config from selected provider (ex. /config/providers/MailSender.php )
        $provider->getConfig();

        // email subscribe
        $provider->subscribe(['email' => 'test@mail.ua'], $list_id = 12345);
        
        // email unsubscribe
        $provider->unsubscribe('test@mail.ua', $list_id = 12345);
        
        // export contacts from provider service
        $provider->exportContacts();
        
        // import contacts
        $provider->importContacts($params);

        $provider->createEmailMessage('Sender Name', 'email@email.com', 'Subject', '<b>Message...</b>', $subscriber_list_id);

        // send created message
        $provider->sendMessage($message_id);

		.....
		// Using BulkSMS Gateway
		$provider       = $factory->getProvider('BulkSMS');
		
		$provider->send(['msisdn' => 18909889780, 'message' => 'Test SMS']);
		
        //... end more operations
?>
```
--------------------------------------

#### Notice

In order to start using the module clone the repo in your vendor directory or add it as a submodule if you're already using git for your project:

    git clone https://github.com/stanislav-web/ZF2-Submissions.git vendor/Submissions
    or
    git submodule add     git clone https://github.com/stanislav-web/ZF2-Submissions.git vendor/Submissions

The module will also be available as a Composer package soon.
Learn more and discuss can always in the group of ZendFramework 2 developers http://vk.com/zf2development
