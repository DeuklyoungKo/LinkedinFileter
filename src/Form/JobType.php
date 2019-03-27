<?php

namespace App\Form;

use App\Entity\Job;
use App\lib\ConvertData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    /**
     * @var ConvertData
     */
    private $convertData;

    public function __construct(ConvertData $convertData)
    {

        $this->convertData = $convertData;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $jobApplyStateArray = $this->convertData->convertAssociativeArraysFromIndexedArrays(Job::JOB_APPLY_STATE);

        $builder
            ->add('title')
            ->add('company')
            ->add('location',null,[
                'help' => '[ '.implode(', ',Job::JOB_LIST_FILTER_LOCATION).' ]',
            ])
            ->add('description')
            ->add('link')
            ->add('publishedAt', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('jobId')
            ->add('applyState',ChoiceType::class, [
                'choices'  => $jobApplyStateArray,
            ])
            ->add('etc')
            ->add('source',null,[
                'help' => '[ '.implode(', ',Job::JOB_SOURCE).' ]',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
