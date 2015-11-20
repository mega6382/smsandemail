<?php
 namespace Promotion\Model;

 use Zend\Db\TableGateway\TableGateway;

 class PromotionTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select('1');
         return $resultSet;
     }

     public function getPromotion($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function savePromotion(Promotion $Promotion)
     {
         $data = array(
             'name' => $Promotion->name,
             'file'  => $Promotion->file,
         );

         $id = (int) $Promotion->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getPromotion($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Promotion id does not exist');
             }
         }
     }

     public function deletePromotion($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
 ?>