<?php

namespace PurpleSpider\AssetAltText;

use SilverStripe\ORM\DataExtension;

class ImageExtension extends DataExtension
{
    
    private static $db = [
        "AltText" => "Text",
    ];

}