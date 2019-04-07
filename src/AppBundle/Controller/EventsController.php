<?php
namespace AppBundle\Controller;
// We include the entity that we create in our Controller file
use AppBundle\Entity\Events;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType; 
use Symfony\Component\Form\Extension\Core\Type\ImageType;
use Symfony\Component\Form\Extension\Core\Type\integer;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class EventsController extends Controller{
   /**
    * @Route("/", name="test1")
    */
   public function listAction(Request $request)
   {   $tests = $this->getDoctrine()->getRepository('AppBundle:Events')->findAll();
       
   
       return $this->render('test1/index.html.twig', array('tests'=>$tests));
   }
    /**
    * @Route("/test1/create", name="test1_create")
    */
   public function createAction(Request $request){ 
    $test1 = new Events;

     $form = $this->createFormBuilder($test1)->add('name', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
     ->add('date', DateTimeType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('description', TextareaType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('image', textType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px'))) 
       ->add('capacity', textType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('email', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('phone', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('address', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('url', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('type', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px'))) 
       ->add('save', SubmitType::class, array('label'=> 'Add Event', 'attr' => array('class'=> 'btn-primary', 'style'=>'margin-bottom:15px')))
       ->getForm();
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           //fetching data
           $name = $form['name']->getData();
           $date = $form['date']->getData();
           $description = $form['description']->getData();
           $image = $form['image']->getData();
           $capacity = $form['capacity']->getData();
            $email = $form['email']->getData();
           $phone = $form['phone']->getData();
           $address = $form['address']->getData();
           $url = $form['url']->getData();
           $type = $form['type']->getData();

           $now = new\DateTime('now');

            $test1->setName($name);
           $test1->setDate($date);
           $test1->setDescription($description);
           $test1->setImage($image);
           $test1->setCapacity($capacity);
           $test1->setEmail($email);
           $test1->setPhone($phone);
           $test1->setAddress($address);
           $test1->setUrl($url);
           $test1->setType($type);
          
           $em = $this->getDoctrine()->getManager();
           $em->persist($test1);
           $em->flush();
           $this->addFlash(
                   'notice',
                   'Events Added'
                   );
           return $this->redirectToRoute('test1');
         }
       






   

       return $this->render('test1/create.html.twig', array('form' => $form->createView()));
     }
   /**
    * @Route("/test1/details/{id}", name="test1_details")
    */
           public function detailsAction($id){
               $test1 = $this->getDoctrine()->getRepository('AppBundle:Events')->find($id);
       return $this->render('test1/details.html.twig', array('test1' => $test1));
   }
  
           /**
    * @Route("/test1/edit/{id}", name="test1_edit")
    */
   public function editAction($id, Request $request){

   $test1 = $this->getDoctrine()->getRepository('AppBundle:Events')->find($id);

$now = new\DateTime('now'); 

          $test1->setName($test1->getName());

           $test1->setDate($test1->getDate());
           $test1->setDescription($test1->getDescription());
           $test1->setImage($test1->getImage());
           $test1->setCapacity($test1->getCapacity());
           $test1->setEmail($test1->getEmail());
           $test1->setPhone($test1->getphone());
           $test1->setAddress($test1->getAddress());
           $test1->setUrl($test1->getUrl());
           $test1->setType($test1->getType());
          



$form = $this->createFormBuilder($test1)->add('name', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
     ->add('date', DateTimeType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('description', TextareaType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('image', textType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px'))) 
       ->add('capacity', textType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('email', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('phone', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('address', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('url', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       ->add('type', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px'))) 
       ->add('save', SubmitType::class, array('label'=> 'Edit Event', 'attr' => array('class'=> 'btn-primary', 'style'=>'margin-bottom:15px')))
       ->getForm();
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           //fetching data
           $name = $form['name']->getData();
           $date = $form['date']->getData();
           $description = $form['description']->getData();
           $image = $form['image']->getData();
           $capacity = $form['capacity']->getData();
            $email = $form['email']->getData();
           $phone = $form['phone']->getData();
           $address = $form['address']->getData();
           $url = $form['url']->getData();
           $type = $form['type']->getData();

           $now = new\DateTime('now');
            $em = $this->getDoctrine()->getManager();
           $test1 = $em->getRepository('AppBundle:Events')->find($id);
           $test1->setName($name);
           $test1->setDate($date);
           $test1->setDescription($description);
           $test1->setImage($image);
           $test1->setCapacity($capacity);
           $test1->setEmail($email);
           $test1->setPhone($phone);
           $test1->setAddress($address);
           $test1->setUrl($url);
           $test1->setType($type);
           

           $em->flush();
           $this->addFlash(
                   'notice',
                   'Events Updated'
                   );
           return $this->redirectToRoute('test1');
       }




       return $this->render('test1/edit.html.twig', array('test1' => $test1, 'form' => $form->createView()));
   }

   /**
    * @Route("/test1/delete/{id}", name="test1_delete")
    */
   public function deleteAction($id){
                $em = $this->getDoctrine()->getManager();
           $test1 = $em->getRepository('AppBundle:Events')->find($id);
           $em->remove($test1);
            $em->flush();
           $this->addFlash(
                   'notice',
                   'Events Removed'
                   );
            return $this->redirectToRoute('test1');
   }

}

