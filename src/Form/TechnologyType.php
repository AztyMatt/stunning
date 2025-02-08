<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Technology;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TechnologyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Name <span class="text-red-500">*</span>',
                'label_attr' => [
                    'class' => 'block text-sm font-medium text-gray-700',
                ],
                'attr' => [
                    'class' => 'block w-full h-8 border border-gray-300 rounded-lg shadow focus:ring-gray-500 focus:border-gray-300 sm:text-sm px-2',
                ],
                'required' => true,
                'label_html' => true
            ])
            ->add('logo', null, [
                'label' => 'Logo',
                'label_attr' => [
                    'class' => 'block text-sm font-medium text-gray-700',
                ],
                'attr' => [
                    'class' => 'block w-full h-8 border border-gray-300 rounded-lg shadow focus:ring-gray-500 focus:border-gray-300 sm:text-sm px-2',
                ],
                'required' => false,
                'label_html' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Technology::class,
        ]);
    }
}
