<?php

namespace Skillberto\LocaleBundle\Admin;

use Skillberto\AdminBundle\Admin\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class LocaleAdmin extends Admin
{
    protected
        $container;

    /**
     * Set ContainerAware instance into this class, and construct the parent
     */
    public function __construct($code, $class, $baseControllerName, $container)
    {
        $this->container = $container;

        parent::__construct($code, $class, $baseControllerName, $container->get('doctrine')->getManager());
    }
        /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('locale')
            ->add('default')
            ->add('active')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('locale', 'choice', array("choices" => $this->getLocales()))
            ->add('default')
            ->add('active', 'checkbox', array('required' => false));
    }
    
    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {       
        $listMapper
            ->addIdentifier('locale')
            ->add('_action', 'actions', array('actions' => $this->getTemplateActions()))
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('locale')
        ;
    }

    protected function getLocales()
    {

    }
}

