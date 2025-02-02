<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\User;
use App\Enum\UserCountryEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\RequestStack;

class UserType extends AbstractType
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentRoute = $this->requestStack->getCurrentRequest()->attributes->get('_route');
        $isNewPage = false;
        if ($currentRoute === 'app_user_new') {
            $isNewPage = true;
        }

        $passwordLabel = $isNewPage ? 'Password' : 'New Password';

        $builder
            ->add('username', null, [
                'required' => false,
                'empty_data' => ''
            ])
            ->add('email', null, [
                'required' => true
            ])
            ->add('plainPassword', null, [
                'mapped' => true,
                'required' => $isNewPage,
                'empty_data' => '',
                'label' => $passwordLabel
            ])
            ->add('profilePicture', null, [
                'required' => false,
                'empty_data' => ''
            ])
            ->add('banner', null, [
                'required' => false
            ])
            ->add('websiteLink', null, [
                'required' => false
            ])
            ->add('country', ChoiceType::class, [
                'choices' => array_combine(
                    array_map(fn($country) => $country->value, UserCountryEnum::cases()),
                    UserCountryEnum::cases()
                ),
                'choice_label' => function ($choice, $key, $value) {
                    return $key;
                },
                'required' => false
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Banni' => 'ROLE_BANNED',
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])
            ->add('socialMedias', SocialMediasType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('projects', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
