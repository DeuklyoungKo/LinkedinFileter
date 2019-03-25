<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('company')
            ->add('location')
            ->add('description')
            ->add('link')
            ->add('publishedAt', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime()
            ])
            ->add('jobId')
            ->add('applyState')
            ->add('etc')
            ->add('source')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
