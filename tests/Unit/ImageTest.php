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
    public function testImageIsAFile()
    {
        $image = new Image('fixtures/test.png');
        $this->assertTrue($image->isFile());
        $this->assertInstanceOf('Hj\File', $image);
    }
}
