<?php

namespace PurpleSpider\AssetAltText;

use SilverStripe\Core\Extension;

class ImageExtension extends Extension
{
    private static array $db = [
        "AltText" => "Text",
    ];

    /**
     * Apply alt attribute if a non empty string, automatically
     * via ImageManipulation trait extension
     * @param array $attributes
     */
    public function updateAttributes(array &$attributes): void
    {
        if(!is_null($this->owner->AltText) && $this->owner->AltText !== '') {
            $attributes['alt'] = $this->owner->AltText;
        }
    }
}
