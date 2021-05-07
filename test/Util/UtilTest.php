<?php

declare(strict_types=1);

namespace Manh20\Util;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the utils in src/util.php.
 */
class UtilTest extends TestCase
{
    /**
     * Test the function mb_str_pad().
     */
    public function testPadRight()
    {
        $res = mb_str_pad("✔ cool", 8);
        $this->assertEquals($res, "✔ cool  ");
    }

    /**
     * Test the function mb_str_pad().
     */
    public function testPadLeft()
    {
        $res = mb_str_pad("✔ cool", 8, " ", STR_PAD_LEFT);
        $this->assertEquals($res, "  ✔ cool");
    }

    /**
     * Test the function mb_str_pad().
     */
    public function testPadBoth()
    {
        $res = mb_str_pad("✔ cool", 8, " ", STR_PAD_BOTH);
        $this->assertEquals($res, " ✔ cool ");
    }
}
