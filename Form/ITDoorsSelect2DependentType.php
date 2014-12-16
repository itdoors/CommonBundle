<?php

namespace ITDoors\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use ITDoors\CommonBundle\Form\DataTransformer\HiddenEntityDataTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * ITDoorsSelect2DependentType
 */
class ITDoorsSelect2DependentType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * {@inheritDoc}
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new HiddenEntityDataTransformer($this->om, $options['entity']);
        $builder->addModelTransformer($transformer);
    }

    /**
     * {@inheritDoc}
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'Invalid object',
            'entity' => null,
            'error_bubbling' => false
        ));
    }
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'hidden_entity';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'itdoors_select2_dependent';
    }
}
