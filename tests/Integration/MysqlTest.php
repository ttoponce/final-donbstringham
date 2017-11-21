<?php

namespace Tests\Integration;

use \Illuminate\Database\Capsule\Manager;

class MysqlTest extends BaseTestCase
{
    /**
     * @expectedException \PDOException
     */
    public function testPDO_Mysql_DigitalOcean_Failure()
    {
        // arrange
        $dsn = 'mysql:dbname=web4350;host=165.227.109.168';
        $user = 'appuse';
        $password = 'letmein';
        // act & assert
        new \PDO($dsn, $user, $password);
    }

    public function testPDO_Mysql_DigitalOcean_Success()
    {
        // arrange
        $dsn = 'mysql:dbname=web4350;host=165.227.109.168';
        $user = 'appuser';
        $password = 'letmein';
        // act
        $dbh = new \PDO($dsn, $user, $password);
        // assert
        $this->assertInstanceOf('PDO', $dbh);
    }
}

