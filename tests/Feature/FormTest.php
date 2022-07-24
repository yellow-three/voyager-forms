<?php

namespace YellowThree\VoyagerForms\Tests\Feature;

use Tests\TestCase;
use YellowThree\VoyagerForms\Form;
//use YellowThree\VoyagerFrontend\Page;
use YellowThree\VoyagerForms\FormInput;
use Illuminate\Foundation\Testing\RefreshDatabase;
use YellowThree\VoyagerForms\Tests\Utilities\FactoryUtilities;

class FormTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        \YellowThree\VoyagerForms\Tests\Unit\FormTest::createForm();

        factory(Page::class)->make([
            'slug' => 'contact',
            'title' => 'Contact Us',
            'body' => Form::inRandomOrder()->get()->first()->shortcode,
        ]);
    }

    public function testIfFormRendersShortcodeToTheFrontend()
    {
        $response = $this->get('/contact');

        return $response->assertStatus(200)
            ->assertSee('My Form');
    }
}
