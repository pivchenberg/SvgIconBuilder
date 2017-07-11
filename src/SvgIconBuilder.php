<?php

namespace Pivchenberg\SvgIconBuilder;

use Pivchenberg\SvgIconBuilder\Exception\InvalidArgumentException;

/**
 * Class SvgIconBuilder
 *
 * @package Pivchenberg\SvgIconBuilder
 */
class SvgIconBuilder
{

    /**
     * @var array
     */
    protected $iconsDescription = [];

    const ICON_NOT_FOUND_DESCRIPTION = [
        'title' => 'Icon not found',
        'width' => 20,
        'height' => 20,
        'fill' => 'tomato',
        'viewBox' => "0 0 20 20",
        'path' => 'M19.852,16.691L11.253,0.759c-0.125-0.232-0.301-0.418-0.523-0.555C10.503,0.069,10.261,0,10.001,0C9.737,0,9.495,0.068,9.271,0.204S8.872,0.525,8.745,0.759L0.148,16.691c-0.261,0.476-0.253,0.95,0.022,1.426c0.127,0.219,0.301,0.392,0.521,0.521c0.22,0.13,0.458,0.192,0.711,0.192h17.194c0.254,0,0.492-0.063,0.711-0.192c0.222-0.129,0.394-0.302,0.521-0.521C20.105,17.642,20.113,17.167,19.852,16.691z M11.433,15.56c0,0.105-0.034,0.194-0.105,0.268c-0.07,0.073-0.153,0.105-0.252,0.105H8.927c-0.098,0-0.18-0.033-0.251-0.105s-0.108-0.161-0.108-0.268v-2.148c0-0.105,0.037-0.194,0.108-0.267c0.071-0.071,0.153-0.106,0.251-0.106h2.148c0.099,0,0.182,0.035,0.252,0.106c0.071,0.071,0.105,0.16,0.105,0.267V15.56z M11.411,11.328c-0.008,0.076-0.047,0.138-0.119,0.187c-0.07,0.05-0.156,0.073-0.263,0.073H8.958c-0.104,0-0.192-0.023-0.269-0.073c-0.074-0.049-0.11-0.109-0.11-0.187L8.388,6.157c0-0.105,0.038-0.186,0.113-0.237C8.598,5.837,8.687,5.795,8.77,5.795h2.462c0.084,0,0.172,0.041,0.271,0.125c0.072,0.053,0.108,0.125,0.108,0.214L11.411,11.328z',
    ];

    /**
     * SvgIconBuilder constructor.
     *
     * @param string $iconsJsonDescriptionFilePath
     */
    public function __construct($iconsJsonDescriptionFilePath)
    {
        if (!file_exists($iconsJsonDescriptionFilePath))
            throw new InvalidArgumentException('icons json description file does not exists');

        $this->iconsDescription = json_decode(file_get_contents($iconsJsonDescriptionFilePath), true);
    }

    /**
     * @param string $descriptionName
     * @return SvgIcon
     */
    public function build($descriptionName)
    {
        $svgDescription = $this->getDescriptionByName($descriptionName);

        return new SvgIcon($svgDescription);
    }

    /**
     * @param string $descriptionName
     * @return array
     */
    protected function getDescriptionByName($descriptionName)
    {
        if (isset($this->iconsDescription[$descriptionName])) {
            return $this->iconsDescription[$descriptionName];
        } else {
            return self::ICON_NOT_FOUND_DESCRIPTION;
        }
    }
}