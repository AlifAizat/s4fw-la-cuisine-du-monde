<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Course;
use App\Entity\Cuisine;
use App\Form\CuisineType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CuisineController extends AbstractController
{
    /**
     * @Route("/nouvelleCuisine", name="nouvelle_Cuisine")
     */
    public function nouvelleCuisine(Request $request) : Response
    {
        $category_repo = $this->getDoctrine()->getRepository(Category::class);

        $cuisine = new Cuisine();
        $form = $this->createForm(CuisineType::class, $cuisine);

        $form->handleRequest($request);

        //$ingredient_recipe_set = isset($_POST['ingredient_1']) && isset($_POST['recipe_1']);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            $cat_id = $form->get('category')->getData();
            $category = $this->getDoctrine()->getRepository(Category::class)->find($cat_id);
            $cuisine->setCategory($category);

            $course_id = $form->get('course')->getData();
            $course = $this->getDoctrine()->getRepository(Course::class)->find($course_id);
            $cuisine->setType($course);

            /**

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

            }


            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
            **/

            /*return $this->render('cuisine/test_cuisine.html.twig', [
                "cuisine"=>$cuisine,
            ]);*/
        }

        return $this->render('cuisine/new_cuisine.html.twig', [
            "new_cuisine"=>$form->createView(),
        ]);
    }
}
