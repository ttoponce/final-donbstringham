<?php
/**
 * Created by PhpStorm.
 * User: stringhamdb
 * Date: 12/4/17
 * Time: 6:03 PM
 */

namespace Tests\Storage;

use App\Storage\EloquentPlugin;
use App\Storage\MemoryPlugin;
use App\Storage\UserRepository;
use Slim\App;


class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Slim\Container $c */
    private $c;

    public function setUp() {
        $settings = include __DIR__ . '/../../src/settings.php';
        $app = new App($settings);

        require __DIR__ . '/../../src/dependencies.php';
        $this->c = $app->getContainer();
    }

    public function testNewUserRepository() {
        // arrange
        $builder = $this->c->get('db')->table('users');
        $adapter = new EloquentPlugin($builder); // $this->c->get(MemoryPlugin::class);
        $actual = $this->c->get(UserRepository::class);
        // act
        $actual->SetAdapter($adapter);
        // assert
        $this->assertNotNull($actual);
    }
}