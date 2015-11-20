<?php
 namespace Submissions\Form;

 use Zend\Form\Form;

 class AddCustomerForm extends Form
 {
     public function __construct($name = null)
     {

         parent::__construct('submissions');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Name',
             ),
         ));
         $this->add(array(
             'name' => 'age',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Age',
             ),
			 ));
         $this->add(array(
             'name' => 'phone',
             'type' => 'text',
             'options' => array(
                 'label' => 'Phone',
             ),
			 ));
         $this->add(array(
             'name' => 'email',
             'type' => 'email',
             'options' => array(
                 'label' => 'Email',
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