<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'likeable_type' => $this->likeableType(...),
            'likeable_id' => Post::factory(),
        ];
    }

    protected function likeableType(array $values)
    {
        $type = $values['likeable_id'];
        $modelName = $type->modelName();
        return (new $modelName)->getMorphClass();
    }
}
