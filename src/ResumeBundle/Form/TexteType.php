<?php

namespace ResumeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TexteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//            ->add('date', 'date')
                ->add('titre')
                ->add('description')
                ->add('image')
                ->add('cat', EntityType::class, array('class' => 'ResumeBundle:Categorie',
                    'choice_label' => 'nom', 'multiple' => true, 'expanded' => true))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ResumeBundle\Entity\Texte'
        ));
    }

}
