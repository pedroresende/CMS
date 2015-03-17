<?php

namespace Xvolutions\AdminBundle\Controller\Admin;

use Xvolutions\AdminBundle\Controller\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\ErrorHandler;
use Xvolutions\AdminBundle\Helpers\PaginatorHelper;
use Xvolutions\AdminBundle\Helpers\Upload;
use Xvolutions\AdminBundle\Entity\File;
use Xvolutions\AdminBundle\Form\FileType;

/**
 * Description of MenuController
 *
 * @author Pedro Resende <pedroresende@mail.resende.biz>
 */
class MenuController extends AdminController
{

    public function menuAction(Request $request)
    {
        parent::verifyaccess();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p
                    FROM XvolutionsAdminBundle:Page p
                    WHERE p.id <> 1 ');

        $pages = $query->getResult();

        return $this->render('XvolutionsAdminBundle:menu:menu.html.twig', array(
                    'pages' => $pages
        ));
    }

    public function saveAction(Request $request)
    {
        parent::verifyaccess();

        //var_dump
    }

}
