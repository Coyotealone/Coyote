<?php

namespace Coyote\Bundle\DirectoryBundle\Form;

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
                                    'Achats/Export/Marketing' => 'function_service.achats_export_marketing',
                                    'Adm des ventes' => 'function_service.adm_ventes',
                                    'Approvisionnement' => 'function_service.approvisionnement',
                                    "Bureau d'étude" => "function_service.be",
                                    'Cantine' => 'function_service.cantine',
                                    'Commercial Export' => 'function_service.commercial_export',
                                    'Commercial France' => 'function_service.commercial_france',
                                    'Co Nord Est' => 'function_service.co_nord_est',
                                    'Co Sud Est' => 'function_service.co_sud_est',
                                    'Co Sud Ouest' => 'function_service.co_sud_ouest',
                                    "Comité d'Entreprise" => 'function_service.comite_entreprise',
                                    "Compta fournisseurs" => 'function_service.compta_fournisseurs',
                                    'Débit' => 'function_service.debit',
                                    'Délégué Produits' => 'function_service.delegue_produits',
                                    'Direction' => 'function_service.direction',
                                    'Direction Commerciale' => 'function_service.direction_commerciale',
                                    'Direction Générale' => 'function_service.direction_generale',
                                    'Direction Production' => 'function_service.direction_production',
                                    'Export' => 'function_service.export',
                                    'Fabrication' => 'function_service.fabrication',
                                    'Gardien' => 'function_service.gardien',
                                    'Informatique' => 'function_service.informatique',
                                    'Logistique' => 'function_service.logistique',
                                    'Magasin' => 'function_service.magasin',
                                    'Maintenance' => 'function_service.maintenance',
                                    'Méthodes' => 'function_service.methodes',
                                    'Montage' => 'function_service.montage',
                                    'Ordonnancement' => 'function_service.ordonnancement',
                                    'Organisation/Qualité' => 'function_service.organisation_qualite',
                                    "Pièces/SAV" => 'function_service.pieces_sav',
                                    'Ressources Humaines' => 'function_service.rh',
                                    'S.A.V.' => 'function_service.sav',
                                    'Salle informatique' => 'function_service.salle_informatique',
                                    "Salle réunion à l'étage" => 'function_service.salle_reunion_etage',
                                    "Salle réunion rez de chaussé" => 'function_service.salle_reunion_rdc',
                                    'Service Achats' => 'function_service.service_achats',
                                    'Service Administratif et Financier' => 'function_service.service_administratif_financier',
                                    'Service Informatique' => 'function_service.service_informatique',
                                    'Service Pièces Détachées Export' => 'function_service.pieces_detachees_export',
                                    'Soudure' => 'function_service.soudure',
                                    'Sous-Traitance' => 'function_service.sous_traitance',
                                    'Stagiaire BE' => 'function_service.stagiaire_be',
                                    'Transport' => 'function_service.transport',
                                    'Usine' => 'function_service.usine',
                    ),
                    'label' => 'directory.functionservice', 'translation_domain' => 'messages'
                    ))
            ->add('leader')
            ->add('business', 'choice', array(
                    'choices'   => array(
                                    'PICHON' => 'business.pichon',
                                    'GILIBERT' => 'business.gilibert',
                                    'PICHON/GILIBERT' => 'business.pichongilibert',
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
            'data_class' => 'Coyote\Bundle\DirectoryBundle\Entity\Directory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_bundle_directorybundle_directory';
    }
}
