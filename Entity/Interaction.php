<?php

namespace GolemAi\Core\Entity;

class Interaction
{
    private $interactionId;
    private $contextId;
    private $parameters;
    private $parametersDetail;
    private $incomplete;
    private $idMissingParameter;
    private $verboseInteraction;
    private $verboseMissingParameters;
    private $helperMessage;

    public function __construct(
        $interactionId = '',
        $contextId = '',
        $parameters = [],
        $parametersDetail = [],
        $incomplete = false,
        $idMissingParameter = [],
        $verboseInteraction = '',
        $verboseMissingParameters = [],
        $helperMessage = ''
    )
    {
        $this->interactionId = $interactionId;
        $this->contextId = $contextId;
        $this->parameters = $parameters;
        $this->parametersDetail = $parametersDetail;
        $this->incomplete = $incomplete;
        $this->idMissingParameter = $idMissingParameter;
        $this->verboseInteraction = $verboseInteraction;
        $this->verboseMissingParameters = $verboseMissingParameters;
        $this->helperMessage = $helperMessage;
    }

    /**
     * @return string
     */
    public function getInteractionId()
    {
        return $this->interactionId;
    }

    /**
     * @return string
     */
    public function getContextId()
    {
        return $this->contextId;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public function getParametersDetail()
    {
        return $this->parametersDetail;
    }

    /**
     * @return bool
     */
    public function isIncomplete()
    {
        return $this->incomplete;
    }

    /**
     * @return array
     */
    public function getIdMissingParameter()
    {
        return $this->idMissingParameter;
    }

    /**
     * @return string
     */
    public function getVerboseInteraction()
    {
        return $this->verboseInteraction;
    }

    /**
     * @return array
     */
    public function getVerboseMissingParameters()
    {
        return $this->verboseMissingParameters;
    }

    /**
     * @return string
     */
    public function getHelperMessage()
    {
        return $this->helperMessage;
    }
}