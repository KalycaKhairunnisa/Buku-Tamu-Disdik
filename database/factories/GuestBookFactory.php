<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuestBook>
 */
class GuestBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Simple signature as base64 data URL
        $signatureDataUrl = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';

        return [
            'kecamatan' => $this->faker->randomElement(getKecamatan()),
            'nama_pengambil' => $this->faker->name('male'),
            'nama_tk_kb' => 'TK/KB ' . $this->faker->word() . ' ' . $this->faker->numberBetween(1, 10),
            'tanda_tangan' => $signatureDataUrl,
        ];
    }
}
