<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\PrivateInformations;
use App\Entity\PublicInformations;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
                'required' => true,
                'attr' => ['class' => 'block w-full h-8 border border-gray-300 rounded-lg shadow focus:ring-gray-500 focus:border-gray-300 sm:text-sm px-2']
            ])
            ->add('content', null, [
                'required' => true,
                'attr' => ['class' => 'block w-full border border-gray-300 rounded-lg shadow focus:ring-gray-500 focus:border-gray-300 sm:text-sm px-2', 'rows' => 2]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
