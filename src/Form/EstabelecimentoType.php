<?php

namespace App\Form;

use App\Entity\Estabelecimento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstabelecimentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomeEstabelecimento')
            ->add('estoqueIdestoque')
            ->add('tipoEstabelecimentoIdtipoEstabelecimento')
            ->add('usuarioIdfuncionario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Estabelecimento::class,
        ]);
    }
}
