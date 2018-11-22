<?php


namespace GolemAi\Core\Entity;


class ErrorResponse
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    /**
     * ErrorResponse constructor.
     *
     * @param string $type
     * @param int $code
     * @param string $message
     */
    public function __construct(string $type = '', $code = 0, $message = '')
    {
        $this->type = $type;
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}