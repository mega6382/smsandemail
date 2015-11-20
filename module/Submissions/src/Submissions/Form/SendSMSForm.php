<?php
 namespace Submissions\Form;

 use Zend\Form\Form;

 class SendSMSForm extends Form
 {

     public function __construct($values,$name = null)
     {

         parent::__construct('sendsms');
        
        $multiCheckbox = new \Zend\Form\Element\MultiCheckbox('to');
        $multiCheckbox->setLabel('Phone#');
        $multiCheckbox->setAttributes(array('id'=>'to'));
        $multiCheckbox->setValueOptions($values);
        $this->add($multiCheckbox);
//         $this->add(array(
//             'name' => 'subject',
//             'type' => 'Text',
//             'options' => array(
//                 'label' => 'Subject',
//             ),
//	));
         $this->add(array(
             'name' => 'body',
             'type' => 'textarea',
             'options' => array(
                 'label' => 'SMS Body:',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
?>