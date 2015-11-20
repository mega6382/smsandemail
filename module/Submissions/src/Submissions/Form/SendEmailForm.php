<?php
 namespace Submissions\Form;

 use Zend\Form\Form;

 class SendEmailForm extends Form
 {
     public function __construct($values,$name = null)
     {

         parent::__construct('sendemail');

        $multiCheckbox = new \Zend\Form\Element\MultiCheckbox('to');
        $multiCheckbox->setLabel('EMAIL');
        $multiCheckbox->setAttributes(array('id'=>'to'));
        $multiCheckbox->setValueOptions($values);
        $this->add($multiCheckbox);
         $this->add(array(
             'name' => 'to[]',
             'type' => 'Text',
             'options' => array(
                 'label' => 'extra emails:',
                 'id' => 'extra-emails',
             ),
	));
         $this->add(array(
             'name' => 'subject',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Subject',
                 'id' => 'body',
             ),
	));
         $this->add(array(
             'name' => 'body',
             'type' => 'textarea',
             'options' => array(
                 'label' => 'Email Body:',
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