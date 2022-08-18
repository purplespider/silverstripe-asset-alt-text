<?php

namespace PurpleSpider\AssetAltText\Tests;

use SilverStripe\Assets\Image;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\View\SSViewer;

/**
 * Tests for applying Image.AltText
 */
class ImageAltTextTest extends SapphireTest
{
    
    /**
     * Test apply alt text added to image attributes
     */
    public function testImageAutoAlt() {
        $image = $this->objFromFixture(Image::class, 'imageWithTitleAndAltText');
        $tag = trim($image->getTag() ?? '');
        $attributes = $image->getAttributes();
        $this->assertEquals($image->AltText, $attributes['alt'], "alt attribute matches alt text");
    }
    
    /**
     * Test apply title text added to image attributes when no AltText present
     */
    public function testImageNoAltText() {
        $image = $this->objFromFixture(Image::class, 'imageWithTitleAndNoAltText');
        $tag = trim($image->getTag() ?? '');
        $attributes = $image->getAttributes();
        $this->assertEmpty($image->AltText);
        $this->assertEquals($image->Title, $attributes['alt'], "alt attribute matches alt text");
    }
    
}