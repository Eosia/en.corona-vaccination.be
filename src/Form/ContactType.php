<?php

namespace App\Form;

use Mael\MaelRecaptchaBundle\Type\MaelRecaptchaCheckboxType;
use Mael\MaelRecaptchaBundle\Validator\MaelRecaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Dupont'
                ]
            ])


            ->add('prenom', TextType::class, [
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Jean',
                ]
            ])

            ->add('fonction', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Coordinator',
                ]
            ])

            ->add('telephone', TelType::class, [
                'required' => false,
                'constraints' => [
                    new Length(['min' => 8, 'minMessage' => "A telephone number contains at least 8 digits"]),
                    new Length(['max' => 14, 'maxMessage' => "Please enter a maximum of 14 digits"]),
                ],
                'attr' => [
                    'placeholder' => '0123456789'
                ]
            ])

            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6, 'minMessage' => "Please enter at least 6 characters"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'exemple@mail.com',
                ]
            ])

            ->add('objet', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'minMessage' => "Please enter at least 10 characters"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Subject of the message',
                ]
            ])

            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'minMessage' => "Please enter at least 10 characters"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Your message (minimum 10 characters.)',
                    'rows' => 10,
                ]
            ])

            ->add('captcha_checkvox', MaelRecaptchaCheckboxType::class, [
                'constraints' =>[
                    new MaelRecaptcha()
                ]
            ])

            ->add('send', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here


        ]);
    }
}
