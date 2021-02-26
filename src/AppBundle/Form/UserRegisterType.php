<?php 
namespace AppBundle\Form;

use AppBundle\Entity\Biznes;
use AppBundle\Entity\FushaOperimi;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class UserRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emer_biznesi',TextType::class)
            // ->add('role_id', EntityType::class, [
            //     'class' => 'AppBundle:Role',
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('r')
            //                 ->where('r.id != :id')
            //                 ->setParameter('id', 4);
            //     },
            //     'choice_label' => 'emer_roli',
            // ])
            ->add('nipt',TextType::class)
            ->add('email', EmailType::class)
            ->add('adresa',TextType::class)
            ->add('logo', FileType::class, [
                'label' => 'Logo (JPEG)',
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                        ],
                    ])
                ],
            ])
//                ->add('fushe_operimi_id',EntityType::class,[
//                    'class'=> FushaOperimi::class,
//                    'choice_label' => 'emer fushe operimi',
//                    'choice_value'=>'id',
//                    'multiple' => true
//
//                ])
            ->add('numerTelefoni',NumberType::class)
            ->add('password', PasswordType::class)
            ->add('submit',SubmitType::class, ['label'=>'Regjistrohu'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Biznes::class,
        ]);
    }
}