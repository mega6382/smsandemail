<?php
namespace Coupon\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Coupon\Model\Coupon;
 use Coupon\Form\CouponForm;

 class CouponController extends AbstractActionController
 {
	 protected $couponTable;

     public function indexAction()
     {
         return new ViewModel(array(
             'coupons' => $this->getCouponTable()->fetchAll(),
         ));
     }
     public function getCouponTable()
     {
         if (!$this->couponTable) {
             $sm = $this->getServiceLocator();
             $this->couponTable = $sm->get('Coupon\Model\CouponTable');
         }
         return $this->couponTable;
     }
     public function addAction()
     {
		   $form = new CouponForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $coupon = new Coupon();
             $form->setInputFilter($coupon->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $coupon->exchangeArray($form->getData());
                 $this->getcouponTable()->savecoupon($coupon);

                 return $this->redirect()->toRoute('coupon');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
		 
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('coupon', array(
                 'action' => 'add'
             ));
         }

         // Get the coupon with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $coupon = $this->getcouponTable()->getcoupon($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('coupon', array(
                 'action' => 'index'
             ));
         }

         $form  = new couponForm();
         $form->bind($coupon);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($coupon->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getcouponTable()->savecoupon($coupon);

                 return $this->redirect()->toRoute('coupon');
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
             return $this->redirect()->toRoute('coupon');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getCouponTable()->deleteCoupon($id);
             }

             return $this->redirect()->toRoute('coupon');
         }

         return array(
             'id'    => $id,
             'coupon' => $this->getCouponTable()->getCoupon($id)
         );
     }
     public function verifyAction()
     {
         $request = $this->getRequest();
         $id = $request->getPost('coupon_id');
         $coupon = false;
         try {
             $coupon = $this->getcouponTable()->getcoupon($id);
         }
         catch (\Exception $ex) {
             $error = 3;
         }
            if ($coupon) {
                $result = "<strong> Coupon is valid</strong>";
            } else {
                $result = "<strong> Invalid Coupon ID </strong>";
            }
        return array('request'=>$request,'coupon'=>$coupon,'result'=>$result);
     }
 }
?>