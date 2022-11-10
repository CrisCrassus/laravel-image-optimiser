<?php

namespace Database\Factories;

use App\Traits\ReferenceTrait;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class FileFactory extends Factory
{
    use ReferenceTrait;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'file_name' => 'desktop.webp',
            'file_reference' => $this->generateReferenceCode(),
            'file_path' => 'storage/app/public/desktop.webp',
            'file_type' => '.webp',
            'size_in_bytes' => '25637812',
            'alt_text' => 'Generic Alt Text',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */

}
