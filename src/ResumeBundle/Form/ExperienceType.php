<?php

namespace ResumeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ResumeBundle\Form;
use ResumeBundle\Entity\skill;
use ResumeBundle\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ExperienceType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('entreprise')
                ->add('poste')
//                ->add('date', 'date')
                ->add('debut', DateType::class, array(
                    'input' => 'datetime',
                    'years' => range(1988, 2019),
                    'widget' => 'choice'))
                ->add('fin', DateType::class, array(
                    'input' => 'datetime',
                    'years' => range(1988, 2019),
                    'widget' => 'choice'))
                ->add('description')
                ->add('image')
                ->add('active')
                ->add('formation')
//                ->add('skills')
                ->add('skills', EntityType::class, array('class' => 'ResumeBundle:Skill',
                    'choice_label' => 'nom', 'multiple' => true, 'expanded' => true))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ResumeBundle\Entity\Experience'
        ));
    }

}
