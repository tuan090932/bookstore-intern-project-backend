<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['language_name' => 'English', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'French', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Spanish', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'German', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Chinese', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Japanese', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Korean', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Italian', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Portuguese', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Russian', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Arabic', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Hindi', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Bengali', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Punjabi', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Javanese', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Malay', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Vietnamese', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Telugu', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Marathi', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Tamil', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Urdu', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Turkish', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Persian', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Gujarati', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Polish', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Ukrainian', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Romanian', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Dutch', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Greek', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Czech', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Swedish', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Hungarian', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Finnish', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Danish', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Norwegian', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Hebrew', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Thai', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Indonesian', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Filipino', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Malayalam', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Kannada', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Odia', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Burmese', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Khmer', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Lao', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Sinhala', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Amharic', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Somali', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Zulu', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Xhosa', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Afrikaans', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Swahili', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Hausa', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Yoruba', 'created_at' => now(), 'updated_at' => now()],
            ['language_name' => 'Igbo', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
