<?php

namespace App\Form;

use App\Entity\Funcionario;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class FuncionarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('cpf')
            ->add('endereco')
            ->add('email')
            ->add('telefone')
            ->add('foto', FileType::class, array(
                'constraints' => array(
                    new File([
                        'mimeTypes' => [
                            'application/png',
                            'application/jpg',
                            'application/jpeg',
                        ],
                        'mimeTypesMessage' => 'Carregue uma imagem .jpg,.jpeg,.png válida',
                    ])
                )
            ))
            ->add('documento')
            ->add('usuarioIdfuncionario', null, array(
                'placeholder' => 'Selecione o login do funcionário...',
                'label' => 'Login'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Funcionario::class,
        ]);
    }
}
