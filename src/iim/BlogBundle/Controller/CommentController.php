<?php

namespace iim\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use iim\BlogBundle\Entity\Comment;
use iim\BlogBundle\Form\CommentType;

/**
 * Comment controller.
 *
 * @Route("/comment")
 */
class CommentController extends Controller
{

    /**
     * Lists all Comment entities.
     *
     * @Route("/", name="comment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $entities= $this->get('comment.manager')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Comment entity.
     *
     * @Route("/create", name="comment_create")
     * @Template("iimBlogBundle:Comment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm('comment', null, array(
            'action' => $this->generateUrl('comment_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $comment = $form->getData();
                $comment->setAuthor($this->getUser());
                $this->get('comment.manager')->update($comment);

                return $this->redirect($this->generateUrl('comment_show', array('id' => $comment->getId())));
            }
        }
        return array(
            'form'   => $form->createView()
        );
    }

    /**
     * Finds and displays a Comment entity.
     *
     * @Route("/{id}", name="comment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->get('comment.manager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Comment entity.
     *
     * @Route("/{id}/edit", name="comment_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $entity = $this->get('comment.manager')->find($id);


        $form = $this->createForm('comment', $entity, array(
            'action' => $this->generateUrl('comment_edit', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Edit'));

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $comment = $form->getData();
                $this->get('comment.manager')->update($comment);

                return $this->redirect($this->generateUrl('comment_show', array('id' => $comment->getId())));
            }
        }
        return array(
            'edit_form'   => $form->createView(),
            'delete_form' => $this->createDeleteForm($id)->createView()
        );
    }


    /**
     * Deletes a Comment entity.
     *
     * @Route("/{id}", name="comment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->get('comment.manager')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $this->get('comment.manager')->delete($entity);


        }

        return $this->redirect($this->generateUrl('comment'));
    }

    /**
     * Creates a form to delete a Comment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
