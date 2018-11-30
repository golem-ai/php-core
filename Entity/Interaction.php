<?php

namespace GolemAi\Core\Entity;

class Interaction
{
    private $interactionId;
    private $contextId;
    private $parameters;
    private $parametersDetail;
    private $incomplete;

    public function __construct(
        $interactionId = '',
        $contextId = '',
        $parameters = [],
        $parametersDetail = [],
        $incomplete = false
    )
    {
        $this->interactionId = $interactionId;
        $this->contextId = $contextId;
        $this->parameters = $parameters;
        $this->parametersDetail = $parametersDetail;
        $this->incomplete = $incomplete;
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
}