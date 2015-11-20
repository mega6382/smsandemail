<?php
 namespace Promotion\Form;

 use Zend\Form\Form;

 class PromotionForm extends Form
 {
     public function __construct($name = null)
     {

         parent::__construct('Promotion');

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
         $this->addElements();
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }

    public function addElements()
    {
        // File Input
        $file = new \Zend\Form\Element\File('file');
        $file->setLabel('Upload Promotion File')
             ->setAttribute('id', 'file')
             ->setAttribute('accept', '.pdf');
        $this->add($file);
    }
 }
?>