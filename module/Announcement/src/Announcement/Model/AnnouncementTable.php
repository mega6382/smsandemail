<?php
 namespace Announcement\Model;

 use Zend\Db\TableGateway\TableGateway;

 class AnnouncementTable
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

     public function getannouncement($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveannouncement(Announcement $announcement)
     {
         $data = array(
             'announcement' => $announcement->announcement,
             'valid_from'  => $announcement->valid_from,
             'valid_till'  => $announcement->valid_till,
             'desc'  => $announcement->desc,
         );

         $id = (int) $announcement->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getannouncement($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('announcement id does not exist');
             }
         }
     }

     public function deleteannouncement($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
 ?>