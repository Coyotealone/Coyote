<?php

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DirectoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'directory.name', 'translation_domain' => 'messages'))
            ->add('firstname', null, array('label' => 'directory.firstname', 'translation_domain' => 'messages'))
            ->add('job_phone_number', null, array('label' => 'directory.jobphonenumber', 'translation_domain' => 'messages'))
            ->add('quick_phone_number', null, array('label' => 'directory.quickphonenumber', 'translation_domain' => 'messages'))
            ->add('cellphone_number', null, array('label' => 'directory.cellphonenumber', 'translation_domain' => 'messages'))
            ->add('country', 'choice', array(
                    'choices'   => array(
                                    'FRANCE' => 'country.fr',
                                    'POLOGNE' => 'country.pl',
                    ),
                    'label' => 'directory.country', 'translation_domain' => 'messages'
                    ))
            ->add('mail', null, array('label' => 'directory.mail', 'translation_domain' => 'messages'))
            ->add('function_service', 'choice', array(
                    'choices'   => array(
                                    '' => 'function_service.empty',
                                    'Accueil/Secrétariat' => 'function_service.accueil',
                                    "Bureau d'étude" => "function_service.be",
                                    'Cantine' => 'function_service.cantine',
                                    'Commercial Export' => 'function_service.commercial_export',
                                    'Commercial France' => 'function_service.commercial_france',
                                    'Délégué Produits' => 'function_service.delegue_produits',
                                    'Direction Générale' => 'function_service.direction_generale',
                                    'Fabrication' => 'function_service.fabrication',
                                    'Gardien' => 'function_service.gardien',
                                    'Logistique' => 'function_service.logistique',
                                    'Magasin' => 'function_service.magasin',
                                    'Maintenance' => 'function_service.maintenance',
                                    'Montage' => 'function_service.montage',
                                    'Ordonnancement' => 'function_service.ordonnancement',
                                    'Organisation/Qualité' => 'function_service.organisation_qualite',
                                    'Ressources Humaines' => 'function_service.rh',
                                    'S.A.V.' => 'function_service.sav',
                                    'Service Achats' => 'function_service.service_achats',
                                    'Service Administratif et Financier' => 'function_service.service_administratif_financier',
                                    'Service Informatique' => 'function_service.service_informatique',
                                    'Service Pièces Détachées Export' => 'function_service.pieces_detachees_export',
                                    'Sous-Traitance' => 'function_service.sous_traitance',
                                    'Transport' => 'function_service.transport',
                                    'Usine' => 'function_service.usine',
                    ),
                    'label' => 'directory.functionservice', 'translation_domain' => 'messages'
                    ))
            ->add('leader')
            ->add('business', 'choice', array(
                    'choices'   => array(
                                    'Pichon' => 'business.pichon',
                                    'Gilibert' => 'business.gilibert',
                                    'Pichon/Gilibert' => 'business.pichongilibert',
                    ),
                    'label' => 'directory.business', 'translation_domain' => 'messages'
                    ))
            ->add('phone')
            ->add('fax')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\Directory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_sitebundle_directory';
    }
}
