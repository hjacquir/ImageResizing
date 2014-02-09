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
     * @var File
     */
    private $file;
    
    public function setUp()
    {
        $this->file = new File('fixtures/test.png');
    }
    
    public function testFileIsAnSplFileObject()
    {
        $this->assertTrue($this->file->isFile());
        $this->assertInstanceOf('\SplFileObject', $this->file);
    }
    
    public function testFileShouldHaveTheCorrectOpenMode()
    {
        $this->assertTrue($this->file->isFile());
        $this->assertAttributeEquals('r', 'openMode', $this->file);
    }
}
