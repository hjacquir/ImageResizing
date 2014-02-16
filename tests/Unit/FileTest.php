<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Tests\Unit;

use \Hj\File;
use \PHPUnit_Framework_TestCase;

require '../../vendor/autoload.php';

/**
 * @covers \Hj\File
 */
class FileTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string $filename
     * 
     * @return File
     */
    private function getFile($filename)
    {
        return new File($filename);
    }
    
    public function testFileIsAnSplFileObject()
    {
        $file = $this->getFile('fixtures/test.jpg');
        
        $this->assertTrue($file->isFile());
        $this->assertInstanceOf('\SplFileObject', $file);
    }
    
    public function testFileShouldHaveTheCorrectOpenMode()
    {
        $file = $this->getFile('fixtures/test.png');
        
        $this->assertTrue($file->isFile());
        $this->assertAttributeEquals('r', 'openMode', $file);
    }
    
    public function testMethodGenerateFileNameOfTheCopyShouldReturnAString()
    {
        $file = $this->getFile('fixtures/test.jpg');
        
        $this->assertTrue($file->isFile());
        $this->assertContains('test.jpg', $file->generateFilenameOfTheCopy());
        $this->assertContains('fixtures/', $file->generateFilenameOfTheCopy());
    }
    
    /**
     * @dataProvider provideSupportedFormatOfFile
     * 
     * @param string $filename
     */
    public function testMethodIsImageShouldReturnTrueWhenTheFileIsSupported($filename)
    {
        $file = $this->getFile($filename);
        
        $this->assertTrue($file->isFile());
        $this->assertTrue($file->isImage());
    }
    
    /**
     * @return array
     */
    public function provideSupportedFormatOfFile()
    {
        return array(
            array('fixtures/test.jpg'),
            array('fixtures/test.png'),
            array('fixtures/test.jpeg'),
        );
    }
    
    /**
     * @dataProvider provideNotSupportedFormatOfFile
     * 
     * @param string $filename
     */
    public function testMethodIsImageShouldReturnFalseWhenTheFileIsNotSupported($filename)
    {
        $file = $this->getFile($filename);
        
        $this->assertTrue($file->isFile());
        $this->assertFalse($file->isImage());
    }
    
    /**
     * @return array
     */
    public function provideNotSupportedFormatOfFile()
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
