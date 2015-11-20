<?php
 namespace Music\Model;

 use Zend\Db\TableGateway\TableGateway;

 class MusicTable
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

     public function getMusic($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveMusic(Music $music)
     {
         $data = array(
             'name' => $music->name,
             'file'  => $music->file,
         );

         $id = (int) $music->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getMusic($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Music id does not exist');
             }
         }
     }

     public function deleteMusic($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
 ?>