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
        $this->image = new Image('fixtures/test.jpg');
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
            0 => 441,
            1 => 286,
            2 => 2,
            3 => 'width="441" height="286"',
            'bits' => 8,
            'channels' => 3,
            'mime' => 'image/jpeg',
        );
        
        $this->assertAttributeEquals($expectedImageSize, 'imageSize', $this->image); 
    }
    
    public function testMethodGetWidthShouldReturnTheWidthOfImage()
    {
        $this->assertSame(441, $this->image->getWidth());
    }
    
    public function testMethodGetHeightShouldReturnTheHeightOfImage()
    {
        $this->assertSame(286, $this->image->getHeight());
    }
}
