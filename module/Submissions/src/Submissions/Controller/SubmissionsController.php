<?php
namespace Submissions\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Submissions\Exception\ExceptionStrategy;
 use Submissions\Form\SendEmailForm;
 use Submissions\Form\AddCustomerForm;
 use Submissions\Form\SendSMSForm;
 use Submissions\Model\CustomerTable;
 use Submissions\Model\Customer;
 class SubmissionsController extends AbstractActionController
 {
     protected $customerTable;

     public function indexAction()
     {

    return new ViewModel(array(
         'customers' => $this->getCustomerTable()->fetchAll(),
         ));
     }
     
     public function getCustomerTable()
     {
         if (!$this->customerTable) {
             $sm = $this->getServiceLocator();
             $this->customerTable = $sm->get('Submissions\Model\CustomerTable');
         }
         return $this->customerTable;
     }
     public function sendemailAction()
     {
         $customers = $this->getCustomerTable()->fetchAll();
        $values = array();
        foreach($customers as $customer)
            {
                $values += ["$customer->email" => "$customer->name"];
            }
         $form = new SendEmailForm($values);
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $data = $form->getData();
                 $to = $data['to'];
//             var_dump($form->getData());       
//             var_dump($to);       
             $factory = $this->getServiceLocator()->get('Submissions\Factory\ProviderFactory');
             $provider = $factory->getProvider('MailSender');
             var_dump($provider->sendEmail(['to' => $to, 'message' => $data['body'],'subject'=>$data['subject']]));
             }
         }
         return new ViewModel(array('form'=>$form));
     }
     public function sendsmsAction()
     {
         $customers = $this->getCustomerTable()->fetchAll();
        $values = array();
        foreach($customers as $customer)
            {
                $values += ["$customer->phone" => "$customer->name"];
            }
          $form = new SendSMSForm($values);
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $data = $form->getData();
                 $to = implode(',', $data['to']);
             $factory = $this->getServiceLocator()->get('Submissions\Factory\ProviderFactory');
             $provider = $factory->getProvider('ClickaTell');
             var_dump($provider->send(['to' => $to, 'message' => $data['body']]));
             
             }
         }
         return new ViewModel(array('form'=>$form));
     }
     public function addcustomerAction()
     {

         $form = new AddCustomerForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $submission = new Customer();
             $form->setInputFilter($submission->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $submission->exchangeArray($form->getData());
                 $this->getCustomerTable()->saveCustomer($submission);

                 return $this->redirect()->toRoute('submissions');
             }
         }
            return array('form' => $form);
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('submissions');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getCustomerTable()->deleteCustomer($id);
             }

             return $this->redirect()->toRoute('submissions');
         }

         return array(
             'id'    => $id,
             'customer' => $this->getCustomerTable()->getCustomer($id)
         );
     }
     
     
 }
?>