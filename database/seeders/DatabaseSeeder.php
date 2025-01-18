<?php
namespace Database\Seeders;

use App\Models\Show\Show;
use App\Models\Comment\Comment;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat instance Faker
        $faker = Faker::create();

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

            // Menambahkan komentar untuk setiap Show
            foreach (range(1, 5) as $commentIndex) {
                Comment::create([
                    'show_id' => $show->id,  // ID Show terkait
                    'user_name' => $faker->name,  // Nama pengguna acak
                    'image' => $faker->imageUrl(100, 100, 'people', true, 'Faker'),  // Gambar pengguna acak
                    'comment' => $faker->sentence(10),  // Komentar acak
                ]);
            }
        }
    }
}
