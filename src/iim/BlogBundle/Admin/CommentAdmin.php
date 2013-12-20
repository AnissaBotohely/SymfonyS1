<?php
/**
 * Created by PhpStorm.
 * User: anissabotohely
 * Date: 20/12/13
 * Time: 09:20
 */

namespace iim\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CommentAdmin extends Admin
{

    //liste des champs modifiables dans l'edit
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('content')
            ->end()
        ;
    }

    //liste des champs qui seront visibles dans la liste des enregistrements
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('content')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    //liste des champs qui pourraient servir à trier les enregistrements dans la liste des enregistrements
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('content')

        ;
    }


    // champs visibles dans show
    protected function configureShowField(ShowMapper $show)
    {
        $show
            ->add('content')
        ;
    }
}