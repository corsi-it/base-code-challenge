<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected array $new_emails = [];

    protected int $email_number = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $username = $this->faker->userName();

        $email = $this->refactorEmail($this->faker->userName());

        while (in_array($email, $this->new_emails) || User::where('email', $email)->exists())
        {
            $email = $this->refactorEmail($username . $this->email_number);
            $this->email_number++;
        }

        $this->new_emails[] = $email;

        return [
            'email' => $email,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    /*public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }*/

    /**
     * Replace special italian characters with supported ones during random generation.
     *
     * @param $value
     * @return string
     */
    public function refactorEmail($value): string
    {
        $dom = '@corsi.it';

        $value = str_replace("'", '', $value);
        $value = str_replace(" ", '', $value);
        $value = str_replace("à", 'a', $value);
        $value = str_replace("è", 'e', $value);
        $value = str_replace("é", 'e', $value);
        $value = str_replace("ì", 'i', $value);
        $value = str_replace("ò", 'o', $value);
        $value = str_replace("ù", 'u', $value);

        return strtolower(trim($value.$dom));
    }

}
