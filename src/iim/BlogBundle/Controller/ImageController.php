<?php

namespace iim\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use iim\BlogBundle\Entity\Image;
use iim\BlogBundle\Form\ImageType;

/**
 * Image controller.
 *
 * @Route("/image")
 */
class ImageController extends Controller
{

    /**
     * Lists all Image entities.
     *
     * @Route("/", name="image")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $entities= $this->get('image.manager')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Image entity.
     *
     * @Route("/create", name="image_create")
     * @Template("iimBlogBundle:Image:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm('image', null, array(
            'action' => $this->generateUrl('image_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $image = $form->getData();
                $image->setAuthor($this->getUser());
                $this->get('image.manager')->update($image);

                return $this->redirect($this->generateUrl('image_show', array('id' => $image->getId())));
            }
        }
        return array(
            'form'   => $form->createView()
        );
    }



    /**
     * Finds and displays a Image entity.
     *
     * @Route("/{id}", name="image_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->get('image.manager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Image entity.
     *
     * @Route("/{id}/edit", name="image_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $entity = $this->get('image.manager')->find($id);

        $form = $this->createForm('image', $entity, array(
            'action' => $this->generateUrl('image_edit', array('id' => $entity->getId())),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Edit'));

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $image = $form->getData();
                $this->get('image.manager')->update($image);

                return $this->redirect($this->generateUrl('image_show', array('id' => $image->getId())));
            }
        }
        return array(
            'edit_form'   => $form->createView(),
            'delete_form' => $this->createDeleteForm($id)->createView()
        );
    }



    /**
     * Deletes a Image entity.
     *
     * @Route("/{id}", name="image_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->get('image.manager')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Image entity.');
            }

            $this->get('image.manager')->delete($entity);


        }

        return $this->redirect($this->generateUrl('image'));
    }


    /**
     * Creates a form to delete a Image entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('image_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
