<?php
namespace Promotion\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Promotion\Model\Promotion;
 use Promotion\Form\PromotionForm;

 class PromotionController extends AbstractActionController
 {
	 protected $PromotionTable;

     public function indexAction()
     {
         return new ViewModel(array(
             'Promotions' => $this->getPromotionTable()->fetchAll(),
         ));
     }
     public function getPromotionTable()
     {
         if (!$this->PromotionTable) {
             $sm = $this->getServiceLocator();
             $this->PromotionTable = $sm->get('Promotion\Model\PromotionTable');
         }
         return $this->PromotionTable;
     }
     public function addAction()
     {
		   $form = new PromotionForm();
         $form->get('submit')->setValue('Add');
         $form->prepare();

         $request = $this->getRequest();
         if ($request->isPost()) {
             $Promotion = new Promotion();
             $post = array_merge_recursive($request->getPost()->toArray(),$request->getFiles()->toArray());
             $form->setInputFilter($Promotion->getInputFilter());
             $form->setData($post);

             if ($form->isValid()) {
                 $Promotion->exchangeArray($form->getData());
                 $this->getPromotionTable()->savePromotion($Promotion);

                 return $this->redirect()->toRoute('Promotion');
             }
         }
         return array('form' => $form);
     }

 }
?>