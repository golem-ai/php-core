<?php


namespace GolemAi\Core\Factory;


use GolemAi\Core\Entity\ResponseData;
use Symfony\Component\OptionsResolver\OptionsResolver;

trait OptionsResolverAwareTrait
{
    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function setOptionsResolver(OptionsResolver $optionsResolver)
    {
        $this->optionsResolver = $optionsResolver;
    }

    /**
     * @return array
     */
    public function getRequiredFields() {
        return array();
    }

    /**
     * @return array
     */
    public function getDefinedFields()
    {
        return array(
            'status_code',
            'call',
            'calls',
            'id_request',
            'labels',
            'request_language',
            'request_text',
            'time_ai',
            'time_total',
            'interactions',
            'type',
        );
    }

    /**
     * @return array
     */
    public function getFieldsDefault(){
        return array();
    }

    /**
     * @return array
     */
    public function getFieldsType()
    {
        return array();
    }

    public function configureOptions()
    {
        $this->optionsResolver = new OptionsResolver();
        $this->optionsResolver
            ->setRequired($this->getRequiredFields())
            ->setDefaults($this->getFieldsDefault())
            ->setDefined($this->getDefinedFields())
        ;

        foreach ($this->getFieldsType() as $key => $types) {
            $this->optionsResolver->setAllowedTypes($key, $types);
        }
    }

}