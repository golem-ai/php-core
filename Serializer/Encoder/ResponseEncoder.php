<?php

namespace GolemAi\Core\Serializer\Encoder;

use GolemAi\Core\Entity\Response;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class ResponseEncoder implements DecoderInterface, EncoderInterface
{
    const FORMAT = 'golem_response';

    private $jsonEncoder;

    /**
     * ResponseDecoder constructor.
     * @param JsonEncoder $jsonEncoder
     */
    public function __construct(JsonEncoder $jsonEncoder)
    {
        $this->jsonEncoder = $jsonEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function decode($data, $format, array $context = array())
    {
        if (!$data instanceof ResponseInterface && !\is_string($data)) {
            throw new \InvalidArgumentException(
                sprintf('%s argument needed, %s given',
                    ResponseInterface::class.' or string',
                    gettype($data)
                )
            );
        }

        if ($data instanceof ResponseInterface) {
            $data = (string) $data->getBody();
        }

        $dataArray = $this->jsonEncoder->decode($data, $format, $context);

        if ($data instanceof ResponseInterface && $dataArray['type'] !== Response::ERROR_TYPE) {
            $dataArray['status_code'] = $data->getStatusCode();
        }

        return $dataArray;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDecoding($format)
    {
        return self::FORMAT === $format;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = array())
    {
        return $this->jsonEncoder->encode($data, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format)
    {
        return $this->jsonEncoder->supportsEncoding($format);
    }
}