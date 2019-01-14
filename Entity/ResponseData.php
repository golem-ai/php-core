<?php


namespace GolemAi\Core\Entity;


class ResponseData
{
    private $idRequest;
    private $requestLanguage;
    private $requestText;
    private $timeAi;
    private $timeTotal;
    private $interactions;
    private $verboseAvailableInteractions;
    private $helperMessage;
    private $conversationCode;

    /**
     * ResponseData constructor.
     * @param int $idRequest
     * @param string $requestLanguage
     * @param string $requestText
     * @param float $timeAi
     * @param float $timeTotal
     * @param array $interactions
     * @param int $conversationCode
     */
    public function __construct(
        $idRequest = 0,
        $requestLanguage = 'fr',
        $requestText = '',
        $timeAi = 0.0,
        $timeTotal = 0.0,
        array $interactions = [],
        $verboseAvailableInteractions = '[]',
        $helperMessage = '',
        $conversationCode = 0
    )
    {
        $this->idRequest = $idRequest;
        $this->requestLanguage = $requestLanguage;
        $this->requestText = $requestText;
        $this->timeAi = $timeAi;
        $this->timeTotal = $timeTotal;
        $this->interactions = $interactions;
        $this->verboseAvailableInteractions = $verboseAvailableInteractions;
        $this->helperMessage = $helperMessage;
        $this->conversationCode = $conversationCode;
    }

    /**
     * @return int
     */
    public function getIdRequest()
    {
        return $this->idRequest;
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

    /**
     * @return string
     */
    public function getVerboseAvailableInteractions()
    {
        return $this->verboseAvailableInteractions;
    }

    /**
     * @return string
     */
    public function getHelperMessage()
    {
        return $this->helperMessage;
    }
    
    /**
     * @return int
     */
    public function getConversationCode()
    {
        return $this->conversationCode;
    }
}