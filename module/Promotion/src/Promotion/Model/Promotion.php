<?php
namespace Promotion\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 class Promotion
 {
     public $id;
     public $name;
     public $file;
     public $inputFilter;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->name = (!empty($data['name'])) ? $data['name'] : null;
         $this->file  = (!empty($data['file']['name'])) ? $data['file']['name'] : $data['file'];
     }
	 
     // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'name',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             
             $fileInput = new \Zend\InputFilter\FileInput('file');
             $fileInput->setRequired(true);
             $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
             array(
                'target'    => 'c:/xampp/htdocs/smsemail/public/uploads/',
                'randomize' => false,
                 'use_upload_extension' =>true,
                 'use_upload_name' => true,
             ));
             $inputFilter->add($fileInput);


             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
	 
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
 }
 ?>