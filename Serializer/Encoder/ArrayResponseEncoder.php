<?php

namespace GolemAi\Core\Serializer\Encoder;

use GolemAi\Core\Entity\Response;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class ArrayResponseEncoder implements DecoderInterface, EncoderInterface
{
        const FORMAT = 'golem_array_response';

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
        if (!\is_array($data)) {
            throw new \InvalidArgumentException(
                sprintf('Array argument needed')
            );
        }

        return $data;
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