<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Validator\Constraints\ImageUrl;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', null, [
                'label' => 'File <span class="text-red-500">*</span>',
                'label_attr' => [
                    'class' => 'block text-sm font-medium text-gray-700',
                ],
                'attr' => [
                    'class' => 'block w-full h-8 border border-gray-300 rounded-lg shadow focus:ring-gray-500 focus:border-gray-300 sm:text-sm px-2',
                ],
                'required' => true,
                'label_html' => true,
                'constraints' => [
                    new ImageUrl(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
