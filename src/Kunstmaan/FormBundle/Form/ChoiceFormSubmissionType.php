<?php

namespace Kunstmaan\FormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * This class represents the type for the ChoiceFormSubmissionField
 */
class ChoiceFormSubmissionType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $keys = array_fill_keys(array('label', 'required', 'expanded', 'multiple', 'choices', 'empty_value', 'constraints'), null);
        $fieldOptions = array_filter(array_replace($keys, array_intersect_key($options, $keys)), function($v) { return isset($v); });
        $fieldOptions['empty_data'] = null;

        $builder->add('value', 'choice', $fieldOptions);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kunstmaan_formbundle_choiceformsubmissiontype';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Kunstmaan\FormBundle\Entity\FormSubmissionFieldTypes\ChoiceFormSubmissionField',
                'choices' => array(),
                'empty_value' => null,
                'expanded' => null,
                'multiple' => null,
        ));
    }

    // BC for SF < 2.7
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }
}
