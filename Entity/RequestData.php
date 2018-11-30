<?php

namespace GolemAi\Core\Entity;

class RequestData
{
    CONST PING_TYPE = 'ping';
    CONST REQUEST_TYPE = 'request';

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $type;

    /**
     * @var bool
     */
    private $labelling;

    /**
     * @var bool
     */
    private $parametersDetail;

    /**
     * @var bool
     */
    private $disableVerbose;

    /**
     * @var bool
     */
    private $multipleInteractionSearch;

    public function __construct(
        $token =  '',
        $text = '',
        $language = 'fr',
        $type = self::REQUEST_TYPE,
        $labelling = false,
        $parametersDetail = true,
        $disableVerbose = true,
        $multipleInteractionSearch = false
    )
    {
        $this->token = $token;
        $this->type = $type;
        $this->language = $language;
        $this->labelling = $labelling;
        $this->parametersDetail = $parametersDetail;
        $this->disableVerbose = $disableVerbose;
        $this->multipleInteractionSearch = $multipleInteractionSearch;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isLabelling()
    {
        return $this->labelling;
    }

    /**
     * @return bool
     */
    public function isParametersDetail()
    {
        return $this->parametersDetail;
    }

    /**
     * @return bool
     */
    public function isDisableVerbose()
    {
        return $this->disableVerbose;
    }

    /**
     * @return bool
     */
    public function isMultipleInteractionSearch()
    {
        return $this->multipleInteractionSearch;
    }
}