<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit;

use \Hj\Resizing;
use \PHPUnit_Framework_TestCase;

require '../../vendor/autoload.php';

/**
 * @covers \Hj\Resizing
 */
class ResizingTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideFileWhichAreNotImage
     * 
     * @expectedException \Exception
     * @expectedExceptionMessage The file is not a valid image. Supported formats are JPEG and PNG
     */
    public function testShouldThrowAnExceptionWhenTheFileIsNotAValidImage($filename, $extension)
    {
        $this->assertTrue(file_exists('fixtures/' . $filename));
        
        $file = $this->getMock(
                'Hj\File',
                array(),
                array('fixtures/' . $filename)
                );
        $file
                ->expects($this->once())
                ->method('getExtension')
                ->will($this->returnValue($extension));
        
        $resizing = new Resizing($file);
    }
    
    /**
     * @return array
     */
    public function provideFileWhichAreNotImage()
    {
        return array(
            array('test.avi', 'avi'),
            array('test.doc', 'doc'),
            array('test.docx', 'docx'),
            array('test.mp3', 'mp3'),
            array('test.ppt', 'ppt'),
            array('test.xls', 'xls'),
        );
    }
}