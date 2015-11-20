<?php
 namespace Coupon\Form;

 use Zend\Form\Form;

 class CouponForm extends Form
 {
     public function __construct($name = null)
     {

         parent::__construct('coupon');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'total',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Total',
             ),
         ));
         $this->add(array(
             'name' => 'cashed',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Cashed',
             ),
			 ));
         $this->add(array(
             'name' => 'valid_from',
             'type' => 'date',
             'options' => array(
                 'label' => 'Valid From',
             ),
			 ));
         $this->add(array(
             'name' => 'valid_till',
             'type' => 'date',
             'options' => array(
                 'label' => 'Valid Till',
             ),
			 ));
         $this->add(array(
             'name' => 'desc',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Description',
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