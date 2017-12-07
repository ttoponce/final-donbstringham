<?php
/**
 * Created by PhpStorm.
 * User: stringhamdb
 * Date: 12/4/17
 * Time: 7:24 PM
 */

namespace Tests\Middleware;

use Illuminate\Database\Capsule\Manager;


class PasswordAuthenticationTest
{
    /** @var \Illuminate\Database\Capsule\Manager */
    protected $db;

    public function setUp() {

        $this->db = new Manager();
        $this->db->addConnection(array(
            'driver'    => 'mysql',
            'host'      => '165.227.109.168',
            'database'  => 'web4350',
            'username'  => 'appuser',
            'password'  => 'letmein',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ));
        $this->db->bootEloquent();
        $this->db->setAsGlobal();

        $this->db::statement('CREATE TABLE users
(id int auto_increment
		primary key,
	user_id int not null,
	name varchar(255) not null,
	email varchar(255) not null,
	password varchar(255) not null,
	created_at datetime not null,
	updated_at datetime not null);
create index id
	on users (id);');

    }


    public function tearDown() {
        $this->db::statement('DROP TABLE users');
    }
}