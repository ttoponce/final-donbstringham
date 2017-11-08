<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
/*
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'user_id'    => $faker->unique(),
                'name'       => $faker->firstName . " " . $faker->lastName,
                'email'      => $faker->email,
                'password'   => $faker->password,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),

            ];
        }
        $users = $this->table('users');
        $users->insert($data)->save();
*/
        $data[] = [
            'user_id'    => '000',
            'name'       => 'Anne Anderson',
            'email'      => 'anne@example.com',
            'password'   => '1234pass',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        $data[] = [
            'user_id'    => '001',
            'name'       => 'Ben Bennett',
            'email'      => 'ben@example.com',
            'password'   => '1234pass',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        $data[] = [
            'user_id'    => '002',
            'name'       => 'Chris Christensen',
            'email'      => 'chris@example.com',
            'password'   => '1234pass',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        $users = $this->table('users');
        $users->insert($data)->save();
    }
}
