<?php

namespace Pivchenberg\SvgIconBuilder;

/**
 * Class SvgIcon
 *
 * @package Pivchenberg\SvgIconBuilder
 */
class SvgIcon
{
    /**
     * @var array
     */
    protected $iconDescription;

    /**
     * SvgIcon constructor.
     *
     * @param array $arSvgDescription
     */
    public function __construct($arSvgDescription)
    {
        $this->iconDescription = $arSvgDescription;
    }


    public function extendDescription($arDescription)
    {
        foreach ($arDescription as $key => $value) {
            $this->setDescriptionField($key, $value);
        }

        return $this;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    protected function setDescriptionField($offset, $value)
    {
        // silently ignore this keys, you can't overwrite it
        $ignoreKeys = ['name', 'viewBox', 'path'];
        if (!in_array($offset, $ignoreKeys)) {
            $this->iconDescription[$offset] = $value;
        }
    }

    /**
     * @param int $heightToCalculateWidth
     * @param int $actualHeight
     *
     * @return $this
     */
    public function calculateSizes($heightToCalculateWidth, $actualHeight = 0)
    {
        if (
            isset($this->iconDescription['width']) &&
            isset($this->iconDescription['height']) &&
            $heightToCalculateWidth > 0
        ) {
            $calculatedWidth = $heightToCalculateWidth / $this->iconDescription['height'] * $this->iconDescription['width'];
            $this->iconDescription['width'] = $calculatedWidth;
            $this->iconDescription['height'] = $actualHeight > 0 ? $actualHeight : $heightToCalculateWidth;
        }

        return $this;
    }

    public function generateMarkup()
    {
        $markup = '';

        if (!empty($this->iconDescription['path'])) {
            $svgAttributes = $this->iconDescription;

            $svgAttributes['version'] = '1.1';
            $svgAttributes['aria-hidden'] = 'true';
            unset($svgAttributes['name']);
            unset($svgAttributes['path']);

            $arrayToString = function ($arr) {
                return implode(' ', array_map(function($key, $value) {
                    return $key . '="' . $value . '"';
                }, array_keys($arr), $arr));
            };

            $strSvgAttributes = $arrayToString($svgAttributes);

            if (!empty($strSvgAttributes))
            {
                $markup = "<svg $strSvgAttributes>";

                $pathAttributes['d'] = $this->iconDescription['path'];
                $pathAttributes['fill-rule'] = 'evenodd';
                $strPathAttributes = $arrayToString($pathAttributes);
                $markup .= "<path $strPathAttributes></path>";

                $markup .= "</svg>";
            }
        } else {
            //TODO:
        }

        return $markup;
    }
}