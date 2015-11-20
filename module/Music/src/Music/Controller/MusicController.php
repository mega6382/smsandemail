<?php
namespace Music\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Music\Model\Music;
 use Music\Form\MusicForm;

 class MusicController extends AbstractActionController
 {
	 protected $musicTable;

     public function indexAction()
     {
         return new ViewModel(array(
             'musics' => $this->getMusicTable()->fetchAll(),
         ));
     }
     public function getMusicTable()
     {
         if (!$this->musicTable) {
             $sm = $this->getServiceLocator();
             $this->musicTable = $sm->get('Music\Model\MusicTable');
         }
         return $this->musicTable;
     }
     public function addAction()
     {
		   $form = new MusicForm();
         $form->get('submit')->setValue('Add');
         $form->prepare();

         $request = $this->getRequest();
         if ($request->isPost()) {
             $music = new Music();
             $post = array_merge_recursive($request->getPost()->toArray(),$request->getFiles()->toArray());
             $form->setInputFilter($music->getInputFilter());
             $form->setData($post);

             if ($form->isValid()) {
                 $music->exchangeArray($form->getData());
                 $this->getmusicTable()->savemusic($music);

                 return $this->redirect()->toRoute('music');
             }
         }
         return array('form' => $form);
     }

 }
?>