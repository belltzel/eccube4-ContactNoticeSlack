<?php

namespace Plugin\ContactNoticeSlack\Form\Type\Admin;

use Plugin\ContactNoticeSlack\Entity\Config;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ConfigType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('webhook_url', TextType::class, [
            'constraints' => [
                new NotBlank(),
                new Length(['max' => 255]),
            ],
        ])
        ->add('channel_name', TextType::class, [
            'required' => false,
            'constraints' => [
                new Length(['max' => 255]),
            ],
        ])->add('user_name', TextType::class, [
            'required' => false,
            'constraints' => [
                new Length(['max' => 255]),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Config::class,
        ]);
    }
}
