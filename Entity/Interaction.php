<?php

namespace GolemAi\Core\Entity;

class Interaction
{
    private $idInteraction;
    private $idContext;
    private $parameters;
    private $parametersDetail;
    private $incomplete;
    private $idMissingParameter;
    private $verboseInteraction;
    private $verboseMissingParameters;
    private $helperMessage;

    public $idx;
    public $page;
    public $generated;
    public $filename;
    public $idMissingParameters;

    public function __construct(
        $idInteraction = '',
        $idContext = '',
        $parameters = [],
        $parametersDetail = [],
        $incomplete = false,
        $idMissingParameters = [],
        $verboseInteraction = '',
        $verboseMissingParameters = [],
        $helperMessage = ''
    )
    {
        $this->idInteraction = $idInteraction;
        $this->idContext = $idContext;
        $this->parameters = $parameters;
        $this->parametersDetail = $parametersDetail;
        $this->incomplete = $incomplete;
        $this->idMissingParameters = $idMissingParameters;
        $this->verboseInteraction = $verboseInteraction;
        $this->verboseMissingParameters = $verboseMissingParameters;
        $this->helperMessage = $helperMessage;
    }

    /**
     * @return string
     */
    public function getIdInteraction()
    {
        return $this->idInteraction;
    }

    /**
     * @return string
     * @deprecated Use getIdInteraction instead.
     */
    public function getInteractionId()
    {
        return $this->getIdInteraction();
    }

    /**
     * @return string
     */
    public function getIdContext()
    {
        return $this->idContext;
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
    public function getIdMissingParameters()
    {
        return $this->idMissingParameters;
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