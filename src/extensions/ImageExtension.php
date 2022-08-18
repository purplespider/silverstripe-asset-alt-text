<?php

namespace PurpleSpider\AssetAltText;

use SilverStripe\ORM\DataExtension;

class ImageExtension extends DataExtension
{
    
    private static $db = [
        "AltText" => "Text",
    ];
    
    /**
     * Apply alt attribute if available, automatically
     * via ImageManipulation trait extension
     * @param array $attributes
     */
    public function updateAttributes(array $attributes) {
        if($this->owner->AltText !== '') {
            $attributes['alt'] = $this->owner->AltText;
        }
    }

}