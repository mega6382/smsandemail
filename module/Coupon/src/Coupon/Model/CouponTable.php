<?php
 namespace Coupon\Model;

 use Zend\Db\TableGateway\TableGateway;

 class CouponTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getCoupon($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveCoupon(Coupon $coupon)
     {
         $data = array(
             'total' => $coupon->total,
             'cashed'  => $coupon->cashed,
             'valid_from'  => $coupon->valid_from,
             'valid_till'  => $coupon->valid_till,
             'desc'  => $coupon->desc,
         );

         $id = (int) $coupon->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getCoupon($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Coupon id does not exist');
             }
         }
     }

     public function deleteCoupon($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
 ?>