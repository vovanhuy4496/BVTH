<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\RoleHierarchy;

class UsersAndNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = 1;
        $numberOfCatalogNew = 10;
        $numberOfDepartments = 10;
        $numberOfPhotoCat = 10;
        $numberOfNew = 200;
        $numberOfDoctor = 50;
        $numberOfNotifies = 10;
        $numberOfInfrastructure = 10;
        $numberOfPersonalInformation = 6;
        // $usersIds = array();
        $statusIds = array();
        $faker = Faker::create();
        /* Create roles */
        $adminRole = Role::create(['name' => 'admin']); 
        RoleHierarchy::create([
            'role_id' => $adminRole->id,
            'hierarchy' => 1,
        ]);
        $userRole = Role::create(['name' => 'user']);
        RoleHierarchy::create([
            'role_id' => $userRole->id,
            'hierarchy' => 2,
        ]);
        $guestRole = Role::create(['name' => 'guest']); 
        RoleHierarchy::create([
            'role_id' => $guestRole->id,
            'hierarchy' => 3,
        ]);
        
        /*  insert status  */
        DB::table('status')->insert([
            'name' => 'đang diễn ra',
            'class' => 'badge badge-pill badge-primary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'dừng lại',
            'class' => 'badge badge-pill badge-secondary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'hoàn thành',
            'class' => 'badge badge-pill badge-success',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'hết hạn',
            'class' => 'badge badge-pill badge-warning',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        /*  insert users   */
        $user = User::create([ 
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'admin' 
        ]);
        $user->assignRole('admin');
        // $user->assignRole('user');
        // for($i = 0; $i<$numberOfUsers; $i++){
        //     $user = User::create([ 
        //         'name' => $faker->name(),
        //         'email' => $faker->unique()->safeEmail(),
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'remember_token' => Str::random(10),
        //         'menuroles' => 'user'
        //     ]);
        //     $user->assignRole('user');
        //     array_push($usersIds, $user->id);
        // }
        /*  insert danh mục tin tuc  */
        for($i = 0; $i<$numberOfCatalogNew; $i++){
            // $noteType = $faker->word();
            // if(random_int(0,1)){
            //     $noteType .= ' ' . $faker->word();
            // }
            // DB::table('notes')->insert([
            //     'title'         => $faker->sentence(4,true),
            //     'content'       => $faker->paragraph(3,true),
            //     'status_id'     => $statusIds[random_int(0,count($statusIds) - 1)],
            //     'note_type'     => $noteType,
            //     'applies_to_date' => $faker->date(),
            //     'users_id'      => $usersIds[random_int(0,$numberOfUsers-1)]
            // ]);
            DB::table('catalog_newspapers')->insert([
                'name'         => $faker->sentence(6,true),
                'status'       => random_int(0,1),
                'sort'     => $i + 1,
                'created_at' => $faker->date(),
            ]);
        }

        // /*  insert danh mục tin tuc  */
        // for($i = 0; $i<$numberOfDepartments; $i++){
        //     DB::table('departments')->insert([
        //         'name'         => $faker->sentence(6,true),
        //         'status'       => random_int(0,1),
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }

        // $paragraphs = $faker->paragraphs(rand(10, 30));
        // $title = $faker->sentence(5,true);
        // $content = "<h4>".$title."</h4>";
        // foreach ($paragraphs as $para) {
        //     $content .= "<p>".$para."</p>";
        // }

        // /*  insert tin tuc  */
        // for($i = 0; $i<$numberOfNew; $i++){
        //     $paragraphs = $faker->paragraphs(rand(10, 30));
        //     $title = $faker->sentence(5,true);
        //     $content = "<h4>".$title."</h4>";
        //     foreach ($paragraphs as $para) {
        //         $content .= "<p>".$para."</p>";
        //     }
        //     DB::table('newspapers')->insert([
        //         'title'         => $title,
        //         'content'       => $content,
        //         'keyword'       => $faker->paragraph(3,true),
        //         'meta_title'       => $faker->paragraph(3,true),
        //         'meta_description'       => $faker->paragraph(3,true),
        //         'describe'       => $faker->paragraph(3,true),
        //         'image_file_name' => '640x480.png',
        //         'departments'       => '["'.random_int(1,10).'"]',
        //         'catalogues'       => '["'.random_int(1,10).'"]',
        //         'status'       => 1,
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }

        // /*  insert doctor  */
        // for($i = 0; $i<$numberOfDoctor; $i++){
        //     $paragraphs = $faker->paragraphs(rand(10, 30));
        //     $title = $faker->sentence(4,true);
        //     $content = "<h4>".$title."</h4>";
        //     foreach ($paragraphs as $para) {
        //         $content .= "<p>".$para."</p>";
        //     }
        //     DB::table('doctor_bvths')->insert([
        //         'name'         => $title,
        //         'content'       => $content,
        //         'position'       => $faker->sentence(4,true),
        //         'specialized'       => $faker->sentence(5,true),
        //         'experience'       => $faker->sentence(6,true),
        //         'language'       => $faker->sentence(7,true),
        //         'image_file_name' => '640x480.png',
        //         'departments'       => '["'.random_int(1,10).'"]',
        //         'status'       => 1,
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }

        // // thông báo
        // for($i = 0; $i<$numberOfNotifies; $i++){
        //     $paragraphs = $faker->paragraphs(rand(10, 30));
        //     $title = $faker->sentence(4,true);
        //     $content = "";
        //     // $content = "<h4>".$title."</h4>";
        //     foreach ($paragraphs as $para) {
        //         $content .= "<p>".$para."</p>";
        //     }
        //     DB::table('notifies')->insert([
        //         'title'         => $title,
        //         'content'       => $content,
        //         'status'       => 1,
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }

        // // gioi thieu
        // DB::table('about_bvths')->insert([
        //     'title'         => $title,
        //     'content'       => $content,
        //     'keyword'       => $faker->paragraph(3,true),
        //     'meta_title'       => $faker->paragraph(3,true),
        //     'meta_description'       => $faker->paragraph(3,true),
        //     'describe'       => $faker->paragraph(3,true),
        //     'status'       => 1,
        //     'sort'     => 1,
        //     'created_at' => $faker->date(),
        // ]);

        // /*  insert danh mục ảnh  */
        // for($i = 0; $i<$numberOfPhotoCat; $i++){
        //     DB::table('photo_catalog_bvths')->insert([
        //         'name'         => $faker->sentence(6,true),
        //         'status'       => random_int(0,1),
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }

        // /*  insert cơ sở vật chất  */
        // for($i = 0; $i<$numberOfInfrastructure; $i++){
        //     $paragraphs = $faker->paragraphs(rand(10, 30));
        //     $title = $faker->sentence(5,true);
        //     $content = "<h4>".$title."</h4>";
        //     foreach ($paragraphs as $para) {
        //         $content .= "<p>".$para."</p>";
        //     }
        //     DB::table('infrastructure_bvths')->insert([
        //         'title'         => $title,
        //         'content'       => $content,
        //         'keyword'       => $faker->paragraph(3,true),
        //         'meta_title'       => $faker->paragraph(3,true),
        //         'meta_description'       => $faker->paragraph(3,true),
        //         'describe'       => $faker->paragraph(3,true),
        //         'image_file_name' => '640x480.png',
        //         'status'       => 1,
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }

        // // thông tin nhân sự
        // for($i = 0; $i<$numberOfPersonalInformation; $i++){
        //     $title = $faker->sentence(6,true);
        //     DB::table('personal_information')->insert([
        //         'title'         => $title,
        //         'number'       => random_int(10,100),
        //         'status'       => 1,
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }

        // // Khám chữa bệnh
        // DB::table('healthcares')->insert([
        //     'title'         => $title,
        //     'content'       => $content,
        //     'keyword'       => $faker->paragraph(3,true),
        //     'meta_title'       => $faker->paragraph(3,true),
        //     'meta_description'       => $faker->paragraph(3,true),
        //     'describe'       => $faker->paragraph(3,true),
        //     'image_file_name' => '640x480.png',
        //     'status'       => 1,
        //     'sort'     => 1,
        //     'created_at' => $faker->date(),
        // ]);

        // // Gói Khám Chữa Bệnh
        // DB::table('package_healthcares')->insert([
        //     'title'         => $title,
        //     'content'       => $content,
        //     'keyword'       => $faker->paragraph(3,true),
        //     'meta_title'       => $faker->paragraph(3,true),
        //     'meta_description'       => $faker->paragraph(3,true),
        //     'describe'       => $faker->paragraph(3,true),
        //     'image_file_name' => '640x480.png',
        //     'status'       => 1,
        //     'sort'     => 1,
        //     'created_at' => $faker->date(),
        // ]);

        // /*  insert Các khoa phòng  */
        // for($i = 0; $i<15; $i++){
        //     $paragraphs = $faker->paragraphs(rand(10, 30));
        //     $title = $faker->sentence(5,true);
        //     $content = "<h4>".$title."</h4>";
        //     foreach ($paragraphs as $para) {
        //         $content .= "<p>".$para."</p>";
        //     }
        //     DB::table('catalog_departments')->insert([
        //         'title'         => $title,
        //         'content'       => $content,
        //         'keyword'       => $faker->paragraph(3,true),
        //         'meta_title'       => $faker->paragraph(3,true),
        //         'meta_description'       => $faker->paragraph(3,true),
        //         'describe'       => $faker->paragraph(3,true),
        //         'image_file_name' => '640x480.png',
        //         'icon' => '200x200.png',
        //         'departments'       => '["'.random_int(1,10).'"]',
        //         'status'       => 1,
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }

        // // Mô tả tuyển dụng
        // DB::table('job_descriptions')->insert([
        //     'title'         => $title,
        //     'content'       => $content,
        //     'status'       => 1,
        //     'sort'     => 1,
        //     'created_at' => $faker->date(),
        // ]);

        // // Bài viết tuyển dụng
        // for($i = 0; $i<30; $i++){
        //     $paragraphs = $faker->paragraphs(rand(10, 30));
        //     $title = $faker->sentence(5,true);
        //     $content = "<h4>".$title."</h4>";
        //     foreach ($paragraphs as $para) {
        //         $content .= "<p>".$para."</p>";
        //     }
        //     DB::table('recruitment_articles')->insert([
        //         'title'         => $title,
        //         'content'       => $content,
        //         'amount'       => random_int(1,10),
        //         'status'       => 1,
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //         'job_posting_time' => $faker->date(),
        //     ]);
        // }

        // // Mô tả tuyển dụng
        // DB::table('contact_descriptions')->insert([
        //     'title'         => $title,
        //     'content'       => $content,
        //     'status'       => 1,
        //     'sort'     => 1,
        //     'created_at' => $faker->date(),
        // ]);

        // // Cảm nhận bệnh nhân
        // for($i = 0; $i<10; $i++){
        //     $paragraphs = $faker->paragraphs(rand(10, 30));
        //     $title = $faker->sentence(5,true);
        //     $content = "<h4>".$title."</h4>";
        //     foreach ($paragraphs as $para) {
        //         $content .= "<p>".$para."</p>";
        //     }
        //     DB::table('write_comments')->insert([
        //         'name'         => $faker->sentence(6,true),
        //         'content'       => $faker->paragraph(3,true),
        //         'status'       => 1,
        //         'sort'     => $i + 1,
        //         'created_at' => $faker->date(),
        //     ]);
        // }
    }
}