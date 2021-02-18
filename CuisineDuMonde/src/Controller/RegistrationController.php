<?php

namespace App\Controller;

use App\Entity\Creator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    private $filesystem;

    /**
     * RegistrationController constructor.
     */
    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }


    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Creator();
        //$form = $this->createForm(RegistrationFormType::class, $user);
        $form = $this->createFormBuilder($user)
                     ->add("email", EmailType::class)
                     ->add("firstname", TextType::class)
                     ->add("lastname", TextType::class)
                     ->add("password", PasswordType::class)
                     ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $role = [];
            $role[] = "ROLE_USER";

            $user->setRoles($role);
            $user->setDatecreated(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $creator_repo = $this->getDoctrine()->getRepository(Creator::class);
            $c_id = $creator_repo->findCreatorIdByEmail($user->getEmail());

            $path = $this->pathCreator($c_id,$user);

            try {
                $this->filesystem->mkdir('images/user/'.$path, 0700);
                $u_path = "images/user/".$path;
                $creator_repo->updateFolderCreator($c_id,$u_path);

            } catch (IOExceptionInterface $ex){
                return $this->render('error/error.html.twig', [
                    'code' => $ex->getCode(),
                    'message'=> $ex->getMessage(),
                ]);
            }


            return $this->redirectToRoute('app_login');

        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    private function pathCreator($id, Creator $user){

        $path = $id."_".str_replace(' ','', $user->getFirstname()).'_'.str_replace(' ','', $user->getLastname());

        return $path;
    }


}
