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
    public function testIfTheImageIsAnSplFileObject()
    {
        $image = new Image('fixtures/test.png');
        
        $this->assertTrue($image->isFile());
        $this->assertInstanceOf('\SplFileObject', $image);
    }
    
    public function testImageShouldHaveTheCorrectOpenMode()
    {
        $image = new Image('fixtures/test.png');
        
        $this->assertTrue($image->isFile());
        $this->assertAttributeEquals('r', 'openMode', $image);
    }
    
    /**
     * @dataProvider provideFileWhichAreNotImage
     * 
     * @param string $filename
     * 
     * @expectedException \Exception
     * @expectedExceptionMessage The file is not a valid image. Supported formats are JPEG and PNG 
     */
    public function testShouldThrowAnExceptionWhenTheFileIsNotAnImage($filename)
    {
        $image = new Image($filename);
        
        $this->assertTrue($image->isFile());
        $image->isImage();
    }
    
    public function provideFileWhichAreNotImage()
    {
        return array(
            array('fixtures/test.avi'),
            array('fixtures/test.doc'),
            array('fixtures/test.docx'),
            array('fixtures/test.mp3'),
            array('fixtures/test.ppt'),
            array('fixtures/test.xls'),
        );
    }
}
