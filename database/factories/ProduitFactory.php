<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'designation' => $this->faker->word(),
            'Actif' => $this->faker->boolean(),
            'fournisseur_id' => Fournisseur::factory(), // Associe à un fournisseur existant
            'categorie_id' => Categorie::factory(),       // Associe à une catégorie existante deja
        ];
    }
}
