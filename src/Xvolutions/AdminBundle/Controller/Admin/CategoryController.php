<?php

namespace Xvolutions\AdminBundle\Controller\Admin;

use Xvolutions\AdminBundle\Controller\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xvolutions\AdminBundle\Entity\Category;
use Xvolutions\AdminBundle\Form\CategoryType;
use Symfony\Component\Debug\ErrorHandler;

/**
 * Description of CategoriesController
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 */
class CategoryController extends AdminController
{

    /**
     * Controller responsible to add a new category for and handling the form
     * submission and the database insertion
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type the templates for adding a new role
     */
    public function addCategoriesAction(Request $request) {
        parent::verifyaccess();

        $category = new Category();
        $categoryType = new CategoryType();

        $form = $this->createForm($categoryType, $category)
                ->add('Criar', 'submit')
        ;

        $form->handleRequest($request);

        $status = null;
        $error = null;
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $status = 'Categoria adicionado com sucesso';

            $categoryList = $this->getDoctrine()->getRepository('XvolutionsAdminBundle:Category')->findAll();

            return $this->render('XvolutionsAdminBundle:blog:category/categories.html.twig', array(
                        'title' => 'Categorias',
                        'categoryList' => $categoryList,
                        'status' => $status,
                        'error' => $error,
            ));
        }

        return $this->render('XvolutionsAdminBundle:blog:category/add_categories.html.twig', array(
                    'form' => $form->createView(),
                    'title' => 'Adicionar uma nova Categoria',
                    'status' => $status,
                    'error' => $error
        ));
    }

    /**
     * Controller responsible to edit an existing category for and handling the form
     * submission and the database insertion
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param type $id the id of an existing category
     * @return type the template for editing a category
     */
    public function editCategoriesAction(Request $request, $id) {
        parent::verifyaccess();

        $categoryType = new CategoryType();

        $category = $this->getDoctrine()->getRepository( 'XvolutionsAdminBundle:Category' )->find( $id );

        $form = $this->createForm( $categoryType, $category )
                ->add( 'Guardar', 'submit' )
        ;

        $status = null;
        $error = null;

        $form->handleRequest( $request );

        if ( $form->isValid() )
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $status = 'Categoria actualizada com sucesso';

            $categoryList = $this->getDoctrine()->getRepository('XvolutionsAdminBundle:Category')->findAll();

            return $this->render('XvolutionsAdminBundle:blog:category/categories.html.twig', array(
                        'title' => 'Categorias',
                        'categoryList' => $categoryList,
                        'status' => $status,
                        'error' => $error,
            ));
        }

        return $this->render('XvolutionsAdminBundle:blog:category/add_categories.html.twig', array(
                    'form' => $form->createView(),
                    'title' => 'Editar uma Categoria',
                    'status' => $status,
                    'error' => $error
        ));
    }

    /**
     * Controller responsible to show the categories for and handling the form
     * submission and the database insertion
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type the template of the roles
     */
    public function categoriesAction($option = NULL, $id = NULL)
    {
        parent::verifyaccess();

        $status = NULL;
        $error = NULL;
        switch ($option) {
            case 'remove': {
                    $this->RemoveCategory($id, $status, $error);
                    break;
                }
            case 'removeselected': {
                    $ids = json_decode($id);
                    $this->RemoveSelectedCategories($ids, $status, $error);
                    break;
                }
        }

        if ($error != NULL) {
            return new Response($error, Response::HTTP_BAD_REQUEST);
        }
        if ($status != NULL) {
            return new Response($status, Response::HTTP_OK);
        }

        $categoryList = $this->getDoctrine()->getRepository('XvolutionsAdminBundle:Category')->findAll();

        return $this->render('XvolutionsAdminBundle:blog:category/categories.html.twig', array(
                    'categoryList' => $categoryList,
                    'status' => $status,
                    'error' => $error
        ));
    }

    /**
     * This is function is repsonsible to remove a category
     * 
     * @param type $id the id of the category to be removed
     * @return string with the information message
     */
    private function removeCategory($id, &$status, &$error)
    {
        ErrorHandler::register();
        try {
            $em = $this->getDoctrine()->getManager();
            $category = $em->getRepository('XvolutionsAdminBundle:Category')->find($id);
            if ($category != 'empty') {
                $em->remove($category);
                $em->flush();
                $status = 'Categoria removido com sucesso';
            } else {
                $error = "Erro ao remover a categoria";
            }
        } catch (Exception $ex) {
            $error = "Erro $ex ao remover a categoria";
        }
    }

    /**
     * This function is responsible to remove a list of categories
     * 
     * @param type $ids array containing the id's of the categories to be removed
     * @return string with the message
     */
    private function removeSelectedCategories($ids, &$status, &$error)
    {
        ErrorHandler::register();
        try {
            $em = $this->getDoctrine()->getManager();
            foreach ($ids as $id)
            {
                $category = $em->getRepository('XvolutionsAdminBundle:Category')->find($id);
                if ($category != 'empty') {
                        $em->remove($category);
                        $em->flush();
                        $status = 'Categoria removido com sucesso';
                } else {
                    $error = "Erro ao remover a(s) categoria(s)";
                }
            }
        } catch (Exception $ex) {
            $error = "Erro $ex ao remover a(s) categoria(s)";
        }
    }

}
