<?php

namespace GolemAi\Core\Entity;

class Interaction
{
    private $interactionId;
    private $contextId;
    private $parameters;
    private $incomplete;

    public function __construct(
        $interactionId = '',
        $contextId = '',
        $parameters = [],
        $incomplete = false
    )
    {
        $this->interactionId = $interactionId;
        $this->contextId = $contextId;
        $this->parameters = $parameters;
        $this->incomplete = $incomplete;
    }

    /**
     * @return string
     */
    public function getInteractionId(): string
    {
        return $this->interactionId;
    }

    /**
     * @return string
     */
    public function getContextId(): string
    {
        return $this->contextId;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return bool
     */
    public function isIncomplete(): bool
    {
        return $this->incomplete;
    }
}