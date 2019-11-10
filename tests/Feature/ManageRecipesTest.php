<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageRecipesTest extends TestCase
{
    use RefreshDatabase, withFaker;


    /** @test */
    public function a_user_can_view_the_recipes_page() {

        $this->withoutExceptionHandling();

        $response = $this->get('/recipes');

        $response->assertStatus(200);
    }

    /** @test */
    public function guests_cannot_manage_recipes() {

        // $this->withoutExceptionHandling();

        $recipe = factory('App\Recipe')->create();

        $this->get( $recipe->path() . '/edit' )->assertRedirect('login');
        $this->get( 'recipes/create' )->assertRedirect('login');
        $this->get( $recipe->path() )->assertRedirect('login');

    }

    /** @test */
    public function an_owner_can_create_a_recipe() {

        $this->withoutExceptionHandling();

        $this->signIn();


        $this->get('/recipes/create')->assertStatus(200);

             $attributes = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->sentence
        ];


        $response = $this->post('/recipes', $attributes);

        $recipe = Recipe::where($attributes)->first();

        $response->assertRedirect($recipe->path());

        $this->get($recipe->path())
             ->assertSee($attributes['name'])
             ->assertSee($attributes['description']);
    }

    /** @test */
    // public function an_owner_can_update_a_recipe() {

    //     $this->withoutExceptionHandling();

    //     $this->signIn();

    //     $attributes = [
    //         'name' => $this->faker->sentence,
    //         'description' => $this->faker->sentence,
    //     ];

    //    $recipe = Recipe::where($attributes)->first();

    //    $this->get($recipe->path());


    // }




}
