<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Show\Show;
use App\Models\Admins\Admins;
use Faker\Factory as Faker;
use App\Models\Comment\Comment;
use App\Models\Episode\Episode;
use Illuminate\Database\Seeder;
use App\Models\Category\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'), 
        ]);

        // Membuat instance Faker
        $faker = Faker::create();

        // Menambahkan 5 data dummy User menggunakan Faker
        $users = [];
        foreach (range(1, 5) as $index) {
            $users[] = User::create([
                'name' => $faker->name, // Nama pengguna acak
                'email' => $faker->unique()->safeEmail, // Email acak
                'password' => Hash::make('password'), // Kata sandi default
                'image' => $faker->imageUrl(100, 100, 'people', true, 'User'), // URL gambar profil acak
            ]);
        }

        // Menambahkan 10 data dummy Show menggunakan Faker
        foreach (range(1, 10) as $index) {
            $show = Show::create([
                'name' => $faker->sentence(3),  // 3 kata acak untuk nama
                'image' => $faker->imageUrl(640, 480, 'shows', true, 'Faker'),  // URL gambar acak
                'description' => $faker->paragraph,  // Paragraf acak untuk deskripsi
                'type' => $faker->randomElement(['TV', 'Movie', 'OVA', 'Special']),  // Random type
                'studios' => $faker->company,  // Nama studio acak
                'date_aired' => $faker->date(),  // Tanggal acak
                'status' => $faker->randomElement(['Ongoing', 'Completed', 'Upcoming']),  // Random status
                'genre' => $faker->randomElement(['Action', 'Adventure', 'Comedy', 'Drama', 'Fantasy', 'Horror']),  // Random genre
                'duration' => $faker->numberBetween(20, 120) . ' min',  // Durasi acak dalam menit
                'quality' => $faker->randomElement(['HD', 'SD', '4K']),  // Random quality
            ]);

            // Menambahkan episode untuk setiap Show
            foreach (range(1, 10) as $episodeIndex) {
                Episode::create([
                    'show_id' => $show->id,  // ID Show terkait
                    'episode_name' => 'Episode ' . $episodeIndex,  // Nama episode berdasarkan index
                    'video' => $faker->url,  // URL video acak
                    'thumbnail' => $faker->imageUrl(320, 180, 'episodes', true, 'Episode'),  // Thumbnail acak
                ]);
            }

            // Menambahkan komentar untuk setiap Show
            foreach (range(1, 5) as $commentIndex) {
                $randomUser = $faker->randomElement($users); // Pilih user acak

                Comment::create([
                    'show_id' => $show->id,  // ID Show terkait
                    'user_name' => $randomUser->name,  // Nama pengguna dari user acak
                    'image' => $randomUser->image,  // Gambar pengguna dari user acak
                    'comment' => $faker->sentence(10),  // Komentar acak
                ]);
            }
        }
        $categories = [
            'Action', 'Adventure', 'Comedy', 'Drama', 'Fantasy', 'Horror'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}