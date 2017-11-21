<?php

namespace Tests\Integration;

class MemcacheTest extends BaseTestCase
{
    public function testMemcacheOnDigitalOcean()
    {
        // arrange
        $expected = 'bar';
        $m = new \Memcache();
        $m->addServer('165.227.109.168', 11211);
        // act
        $m->add('foo', 'bar', false, 1);
        $actual = $m->get('foo');
        // assert
        $this->assertEquals($expected, $actual);
    }
}

