<?php


namespace GolemAi\Core\Entity;


class ResponseData
{
    private $requestId;
    private $requestLanguage;
    private $requestText;
    private $timeAi;
    private $timeTotal;
    private $interactions;

    /**
     * ResponseData constructor.
     * @param int $requestId
     * @param string $requestLanguage
     * @param string $requestText
     * @param float $timeAi
     * @param float $timeTotal
     * @param array $interactions
     */
    public function __construct(
        $requestId = 0,
        $requestLanguage = 'fr',
        $requestText = '',
        $timeAi = 0.0,
        $timeTotal = 0.0,
        array $interactions = []
    )
    {
        $this->requestId = $requestId;
        $this->requestLanguage = $requestLanguage;
        $this->requestText = $requestText;
        $this->timeAi = $timeAi;
        $this->timeTotal = $timeTotal;
        $this->interactions = $interactions;
    }

    /**
     * @return int
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @return string
     */
    public function getRequestLanguage()
    {
        return $this->requestLanguage;
    }

    /**
     * @return string
     */
    public function getRequestText()
    {
        return $this->requestText;
    }

    /**
     * @return float
     */
    public function getTimeAi()
    {
        return $this->timeAi;
    }

    /**
     * @return float
     */
    public function getTimeTotal()
    {
        return $this->timeTotal;
    }

    /**
     * @return array
     */
    public function getInteractions()
    {
        return $this->interactions;
    }
}