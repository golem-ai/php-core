<?php

namespace GolemAi\Core\Entity;

class Response
{
    private $requestId;
    private $type;
    private $requestLanguage;
    private $requestText;
    private $timeAi;
    private $timeTotal;
    private $interactions;

    public function __construct(
        int $requestId = 0,
        string $type = '',
        string $requestLanguage = 'fr',
        string $requestText = '',
        float $timeAi = 0,
        float $timeTotal = 0,
        array $interactions = []
    )
    {
        $this->requestId = $requestId;
        $this->type = $type;
        $this->requestLanguage = $requestLanguage;
        $this->requestText = $requestText;
        $this->timeAi = $timeAi;
        $this->timeTotal = $timeTotal;
        $this->interactions = $interactions;
    }

    /**
     * @return int
     */
    public function getRequestId(): int
    {
        return $this->requestId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getRequestLanguage(): string
    {
        return $this->requestLanguage;
    }

    /**
     * @return string
     */
    public function getRequestText(): string
    {
        return $this->requestText;
    }

    /**
     * @return float
     */
    public function getTimeAi(): float
    {
        return $this->timeAi;
    }

    /**
     * @return float
     */
    public function getTimeTotal(): float
    {
        return $this->timeTotal;
    }

    /**
     * @return array
     */
    public function getInteractions(): array
    {
        return $this->interactions;
    }
}