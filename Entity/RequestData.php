<?php

namespace GolemAi\Core\Entity;

class RequestData
{
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
        $type = 'request',
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
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return RequestData
     */
    public function setToken(string $token): RequestData
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return RequestData
     */
    public function setText(string $text): RequestData
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return RequestData
     */
    public function setLanguage(string $language): RequestData
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return RequestData
     */
    public function setType(string $type): RequestData
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLabelling(): bool
    {
        return $this->labelling;
    }

    /**
     * @param bool $labelling
     * @return RequestData
     */
    public function setLabelling(bool $labelling): RequestData
    {
        $this->labelling = $labelling;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasParametersDetail(): bool
    {
        return $this->parametersDetail;
    }

    /**
     * @param bool $parametersDetail
     * @return RequestData
     */
    public function setParametersDetail(bool $parametersDetail): RequestData
    {
        $this->parametersDetail = $parametersDetail;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisableVerbose(): bool
    {
        return $this->disableVerbose;
    }

    /**
     * @param bool $disableVerbose
     * @return RequestData
     */
    public function setDisableVerbose(bool $disableVerbose): RequestData
    {
        $this->disableVerbose = $disableVerbose;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMultipleInteractionSearch(): bool
    {
        return $this->multipleInteractionSearch;
    }

    /**
     * @param bool $multipleInteractionSearch
     * @return RequestData
     */
    public function setMultipleInteractionSearch(bool $multipleInteractionSearch): RequestData
    {
        $this->multipleInteractionSearch = $multipleInteractionSearch;
        return $this;
    }
}