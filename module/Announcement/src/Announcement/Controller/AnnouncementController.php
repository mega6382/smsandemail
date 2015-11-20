<?php
namespace Announcement\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Announcement\Model\Announcement;
 use Announcement\Form\AnnouncementForm;

 class AnnouncementController extends AbstractActionController
 {
	 protected $announcementTable;

     public function indexAction()
     {
         return new ViewModel(array(
             'announcements' => $this->getAnnouncementTable()->fetchAll(),
         ));
     }
     public function getAnnouncementTable()
     {
         if (!$this->announcementTable) {
             $sm = $this->getServiceLocator();
             $this->announcementTable = $sm->get('Announcement\Model\AnnouncementTable');
         }
         return $this->announcementTable;
     }
     public function addAction()
     {
		   $form = new AnnouncementForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $announcement = new Announcement();
             $form->setInputFilter($announcement->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $announcement->exchangeArray($form->getData());
                 $this->getannouncementTable()->saveannouncement($announcement);

                 return $this->redirect()->toRoute('announcement');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
		 
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('announcement', array(
                 'action' => 'add'
             ));
         }

         // Get the Announcement with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $announcement = $this->getannouncementTable()->getannouncement($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('announcement', array(
                 'action' => 'index'
             ));
         }

         $form  = new announcementForm();
         $form->bind($announcement);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($announcement->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getannouncementTable()->saveannouncement($announcement);

                 return $this->redirect()->toRoute('announcement');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('announcement');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getannouncementTable()->deleteannouncement($id);
             }

             return $this->redirect()->toRoute('announcement');
         }

         return array(
             'id'    => $id,
             'announcement' => $this->getannouncementTable()->getannouncement($id)
         );
     }
 }
?>