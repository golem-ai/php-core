<?php

namespace GolemAi\Core\Entity;

class Response
{
    const ERROR_TYPE = 'error';
    const ANSWER_TYPE = 'answer_request';
    const PONG_TYPE = 'pong';

    private $statusCode;
    private $type;
    private $data;

    /**
     * Response constructor.
     *
     * @param int $statusCode
     * @param string $type
     * @param ResponseData|null $data
     */
    public function __construct(
        $statusCode,
        $type = '',
        ResponseData $data = null
    )
    {
        $this->statusCode = $statusCode;
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return ResponseData|null
     */
    public function getData()
    {
        return $this->data;
    }
}