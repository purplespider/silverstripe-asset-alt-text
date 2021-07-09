<?php

namespace PurpleSpider\AssetAltText;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class ImageExtension extends DataExtension
{
    
    private static $db = [
        "AltText" => "Text",
    ];

}