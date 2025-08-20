<?php

namespace PurpleSpider\AssetAltText\Tests;

use PurpleSpider\AssetAltText\ImageExtension;
use Silverstripe\Assets\Dev\TestAssetStore;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Folder;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\InterventionBackend;
use SilverStripe\Dev\SapphireTest;

/**
 * Tests for applying Image.AltText
 */
class ImageAltTextTest extends SapphireTest
{

    protected static $fixture_file = 'ImageAltTextTest.yml';

    protected $usesDatabase = true;

    protected static $required_extensions = [
        Image::class => [
            ImageExtension::class
        ]
    ];

    protected function setUp(): void
    {
        parent::setUp();

        // Set backend root to /ImageTest
        TestAssetStore::activate('ImageAltTextTest');

        // Copy test images for each of the fixture references
        /** @var File $image */
        $files = File::get()->exclude('ClassName', Folder::class);
        foreach ($files as $image) {
            $sourcePath = __DIR__ . '/ImageAltTextTest/' . $image->Name;
            $image->setFromLocalFile($sourcePath, $image->Filename);
            $image->publishSingle();
        }

        // Set default config
        InterventionBackend::config()->set('error_cache_ttl', [
            InterventionBackend::FAILED_INVALID => 0,
            InterventionBackend::FAILED_MISSING => '5,10',
            InterventionBackend::FAILED_UNKNOWN => 300,
        ]);
    }

    protected function tearDown(): void
    {
        TestAssetStore::reset();
        parent::tearDown();
    }

    /**
     * Test apply alt text added to image attributes
     */
    public function testImageAutoAlt() {
        $image = $this->objFromFixture(Image::class, 'imageWithTitleAndAltText');
        $tag = trim($image->getTag() ?? '');
        $this->assertNotFalse( strpos( $tag, "alt=\"{$image->AltText}\"") );
        $attributes = $image->getAttributes();
        $this->assertEquals($image->AltText, $attributes['alt'], "alt attribute matches alt text");
    }

    /**
     * This image has 0 as the AltText
     */
    public function testImageAutoAltNumber() {
        $image = $this->objFromFixture(Image::class, 'imageWithTitleAndAltText');
        $image->AltText = 0;
        $tag = trim($image->getTag() ?? '');
        $this->assertNotFalse( strpos( $tag, "alt=\"{$image->AltText}\"") );
        $attributes = $image->getAttributes();
        $this->assertEquals($image->AltText, $attributes['alt'], "alt attribute matches alt text");
    }

    /**
     * Test apply title text added to image attributes when no AltText present
     */
    public function testImageNoAltText() {
        $image = $this->objFromFixture(Image::class, 'imageWithTitleAndNoAltText');
        $tag = trim($image->getTag() ?? '');
        $this->assertNotFalse( strpos( $tag, "alt=\"{$image->Title}\"") );
        $attributes = $image->getAttributes();
        $this->assertEmpty($image->AltText, "Alt text is empty for this image");
        $this->assertEquals($image->Title, $attributes['alt'], "title attribute matches title text");
    }

}
