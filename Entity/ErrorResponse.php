<?php


namespace GolemAi\Core\Entity;


class ErrorResponse
{
    private $errorCode;
    private $errorMessage;
    private $errorDetail;

    /**
     * ErrorResponse constructor.
     *
     * @param int $errorCode
     * @param string $errorMessage
     * @param string $errorDetail
     */
    public function __construct($errorCode = 0, $errorMessage = '', $errorDetail = '')
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->errorDetail = $errorDetail;
    }

    /**
     * @return string
     */
    public function getErrorDetail()
    {
        return $this->errorDetail;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}