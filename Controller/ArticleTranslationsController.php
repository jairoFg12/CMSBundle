<?php

namespace Tucompu\CmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tucompu\CmsBundle\Entity\ArticleTranslations;
use Tucompu\CmsBundle\Form\ArticleTranslationsType;

/**
 * ArticleTranslations controller.
 *
 * @Route("/admin/article-trans")
 */
class ArticleTranslationsController extends Controller
{

    /**
     * Lists all ArticleTranslations entities.
     *
     * @Route("/", name="admin_article-trans")
     * @Method("GET")
     * @Template("CmsBundle:ArticleTranslations:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(ArticleTranslations::class)->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ArticleTranslations entity.
     *
     * @Route("/", name="admin_article-trans_create")
     * @Method("POST")
     * @Template("CmsBundle:ArticleTranslations:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ArticleTranslations();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
            return $this->redirect($this->generateUrl('admin_article-trans_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ArticleTranslations entity.
     *
     * @param ArticleTranslations $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ArticleTranslations $entity)
    {
        $form = $this->createForm(new ArticleTranslationsType(), $entity, array(
            'action' => $this->generateUrl('admin_article-trans_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ArticleTranslations entity.
     *
     * @Route("/new", name="admin_article-trans_new")
     * @Method("GET")
     * @Template("CmsBundle:ArticleTranslations:new.html.twig")
     */
    public function newAction()
    {
        $entity = new ArticleTranslations();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ArticleTranslations entity.
     *
     * @Route("/{id}", name="admin_article-trans_show")
     * @Method("GET")
     * @Template("CmsBundle:ArticleTranslations:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(ArticleTranslations::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleTranslations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ArticleTranslations entity.
     *
     * @Route("/{id}/edit", name="admin_article-trans_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(ArticleTranslations::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleTranslations entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a ArticleTranslations entity.
    *
    * @param ArticleTranslations $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ArticleTranslations $entity)
    {
        $form = $this->createForm(new ArticleTranslationsType(), $entity, array(
            'action' => $this->generateUrl('admin_article-trans_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

       // $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ArticleTranslations entity.
     *
     * @Route("/{id}", name="admin_article-trans_update")
     * @Method("PUT")
     * @Template("CmsBundle:ArticleTranslations:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(ArticleTranslations::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArticleTranslations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');

            return $this->redirect($this->generateUrl('admin_article-trans_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ArticleTranslations entity.
     *
     * @Route("/{id}", name="admin_article-trans_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(ArticleTranslations::class)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ArticleTranslations entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Bien hecho!');
        }

        return $this->redirect($this->generateUrl('admin_article-trans'));
    }

    /**
     * Creates a form to delete a ArticleTranslations entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_article-trans_delete', array('id' => $id)))
            ->setMethod('DELETE')
            //->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
