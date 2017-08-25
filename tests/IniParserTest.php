<?php
/**
 * china-cn-dev/ini-parser
 *
 * @license Apache License Version 2.0
 */

use chinacn\parser\IniParser;

/**
 * Test suite for IniParser
 *
 * @author Timandes White <timands@gmail.com>
 */
class IniParserTest extends PHPUnit_Framework_TestCase
{
    public function test1()
    {
        $parser = new IniParser();

        $s = <<<'EOT'
[numa]
interleave          = all       # Interleave
#cpunodebind         = 1         # Bind to node 1
#membind             = 1

[mysqld]
# Network
port                = 3306
socket              = /data1/mysql/tmp/mysql.sock

large-pages                      # Enable large pages
EOT;
        $r = $parser->parse($s);
        $this->assertArrayHasKey('numa', $r);
        $this->assertArrayHasKey('interleave', $r['numa']);
        $this->assertEquals('all', $r['numa']['interleave']);
        $this->assertArrayNotHasKey('cpunodebind', $r['numa']);
        $this->assertArrayHasKey('mysqld', $r);
        $this->assertArrayHasKey('port', $r['mysqld']);
        $this->assertArrayHasKey('socket', $r['mysqld']);
        $this->assertEquals('3306', $r['mysqld']['port']);
        $this->assertEquals('/data1/mysql/tmp/mysql.sock', $r['mysqld']['socket']);
        $this->assertArrayHasKey('large-pages', $r['mysqld']);
    }
}