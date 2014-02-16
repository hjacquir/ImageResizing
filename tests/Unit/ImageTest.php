<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit;

use \Hj\Image;
use \PHPUnit_Framework_TestCase;

require '../../vendor/autoload.php';

/**
 * @covers \Hj\Image
 */
class ImageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Image
     */
    private $image;
    
    public function setUp()
    {
        $this->image = new Image('fixtures/dauphin.jpg');
    }

    public function testImageIsAFile()
    {
        $this->assertTrue($this->image->isFile());
        $this->assertInstanceOf('Hj\File', $this->image);
    }
    
    public function testShouldHaveTheImageSizeAttribute()
    {
        $this->assertTrue($this->image->isFile());
        $expectedImageSize = array(
            0 => 221,
            1 => 177,
            2 => 2,
            3 => 'width="221" height="177"',
            'bits' => 8,
            'channels' => 3,
            'mime' => 'image/jpeg',
        );
        
        $this->assertAttributeEquals($expectedImageSize, 'imageSize', $this->image); 
    }
    
    public function testMethodGetWidthShouldReturnTheWidthOfImage()
    {
        $this->assertSame(221, $this->image->getWidth());
    }
    
    public function testMethodGetHeightShouldReturnTheHeightOfImage()
    {
        $this->assertSame(177, $this->image->getHeight());
    }
    
    public function testMethodCopyShouldReturnAnImage()
    {
        $this->assertTrue($this->image->isFile());
        
        $copy = $this->image->copy();
        
        $this->assertTrue($copy->isFile());
        $this->assertInstanceOf('Hj\Image', $copy);
    }
    
    public function testMethodGetAverageRGBComponentValueShouldReturnAFloat()
    {
        $this->assertTrue($this->image->isFile());
        
        $resource = $this->image->imageToResource();
        
        $average = $this->image->getAverageRGBComponentValue($resource, 100, 158);
        
        $this->assertSame(173.66666666667, $average);
    }
}
