<?php

namespace Skillberto\LocaleBundle\Controller;

use Skillberto\AdminBundle\Controller\CRUDController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class LocaleAdminController extends CRUDController
{
    public function createAction() {
        //parent::createAction();
    }
    
    public function editAction($id = null) {
        parent::editAction($id);
    }
    
    public function deleteAction($id) {
        //parent::deleteAction($id);
    }
    
    public function showAction($id = null) {
        //parent::showAction($id);
    }
    
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $container = $this->container;

        $list = array('locale', 'locales', 'existed');

        if ($container->hasParameter("skillberto_locale.locale_file")) {
            $root = $this->get('kernel')->getRootDir();
            $filename = $root . "/config/".$container->getParameter("skillberto_locale.locale_file");

            if (!file_exists($filename)) {
                throw new \Exception("Can't find locale file: ".$filename);
            }

            $params = Yaml::parse(file_get_contents($filename));

            $key = 0;

            $locales = array();

            foreach ($params['parameters'] as $value) {
                $locales[$list[$key]] = $value;

                $key++;
            }
        } else {

            $locales = array(
                'locale'    => $container->getParameter($container->getParameter('skillberto_locale.params.actual_locale')),
                'locales'   => $container->getParameter($container->getParameter('skillberto_locale.params.actual_locales')),
                'existed'   => $container->getParameter($container->getParameter('skillberto_locale.params.existed_locales'))
            );
        }

        $options = array_merge(array('action' => 'list'), $locales);

        return $this->render("SkillbertoLocaleBundle:CRUD:list.html.twig", $options);
    }
}
