<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('senha', PasswordType::class)
            ->add('tipoUsuarioIdtipoUsuario')
            ->add('estabelecimentoIdestabelecimento')
        ;
        if(in_array('ROLE_ADMIN', $options['roles'])){
            $builder->add('roles', ChoiceType::class,[
                'label' => 'Permissões:',
                'multiple' => true,
                'choices' => [
                    'Administrador' => 'ROLE_ADMIN',
                    'Funcionario' => 'ROLE_FUNCIONARIO',
                    'Cliente' => 'ROLE_CLIENTE',
                ]
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
            'roles' => []
        ]);
    }
}
