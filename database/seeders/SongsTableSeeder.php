<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song; // Update the namespace to App\Models\Song

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = '{
            "songs": [
                {
                    "id": 1,
                    "title": "Peaceful Piano Music",
                    "artist": "Relaxing Piano Music"
                },
                {
                    "id": 2,
                    "title": "Peaceful Guitar Music",
                    "artist": "Relaxing Guitar Music"
                },
                {
                    "id": 3,
                    "title": "Peaceful Trumpet Music",
                    "artist": "Relaxing Trumpet Music"
                },
                {
                    "id": 4,
                    "title": "Peaceful Drumbeat Music",
                    "artist": "Relaxing Drumbeat Music"
                },
                {
                    "id": 5,
                    "title": "Peaceful Violin Music",
                    "artist": "Relaxing Violin Music"
                },
                {
                    "id": 6,
                    "title": "Peaceful Tuba Music",
                    "artist": "Relaxing Tuba Music"
                }
            ]
        }';

        $data = json_decode($json, true);

        foreach ($data['songs'] as $songData) {
            Song::factory()->create([
                'title' => $songData['title'],
                'artist' => $songData['artist'],
            ]);
        }
    }
}
