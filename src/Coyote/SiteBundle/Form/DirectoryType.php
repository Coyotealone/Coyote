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
                                    'FRANCE' => 'FRANCE',
                                    'POLOGNE' => 'POLOGNE',
                    ),
                    'label' => 'directory.country', 'translation_domain' => 'messages'
                    ))
            ->add('mail', null, array('label' => 'directory.mail', 'translation_domain' => 'messages'))
            ->add('function_service', 'choice', array(
                    'choices'   => array(
                                    '' => '',
                                    'Accueil/Secrétariat' => 'Accueil/Secrétariat',
                                    'Direction Générale' => 'Direction Générale',
                                    'Service Informatique' => 'Service Informatique',
                                    'Service Administratif et Financier' => 'Service Administratif et Financier',
                                    'Ressources Humaines' => 'Ressources Humaines',
                                    'Commercial France' => 'Commercial France',
                                    'Commercial Export' => 'Commercial Export',
                                    'Service Pièces Détachées Export' => 'Service Pièces Détachées Export',
                                    'Service Achats' => 'Service Achats',
                                    'Usine' => 'Usine',
                                    'Organisation/Qualité' => 'Organisation/Qualité',
                                    "Bureau d'étude" => "Bureau d'étude",
                                    'Ordonnancement' => 'Ordonnancement',
                                    'Sous-Traitance' => 'Sous-Traitance',
                                    'Délégué Produits' => 'Délégué Produits',
                                    'Fabrication' => 'Fabrication',
                                    'Montage' => 'Montage',
                                    'Magasin' => 'Magasin',
                                    'Logistique' => 'Logistique',
                                    'Transport' => 'Transport',
                                    'S.A.V.' => 'S.A.V.',
                                    'Maintenance' => 'Maintenance',
                                    'Bureau commercial' => 'Bureau commercial',
                                    'Gardien' => 'Gardien',
                                    'Cantine' => 'Cantine',

                    ),
                    'label' => 'directory.functionservice', 'translation_domain' => 'messages'
                    ))
            ->add('leader')
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
