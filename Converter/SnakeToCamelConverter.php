<?php

namespace GolemAi\Core\Converter;

class SnakeToCamelConverter
{
    /**
     * @param $string
     * @return string
     */
    public function convert($string)
    {
        if (!$this->isSnakeCase($string)) {
            return $string;
        }

        $stringParts = explode('_', $string);
        $firstPart = array_shift($stringParts);
        $stringParts = array_map('ucfirst', $stringParts);

        return $firstPart.implode('', $stringParts);
    }

    /**
     * @param $string
     * @return bool
     */
    public function isSnakeCase($string)
    {
        return is_string($string)
            && preg_match('/_/', $string) !== 0;
    }
}