<?php

namespace YellowThree\VoyagerForms\Tests\Unit;

use Tests\TestCase;
use YellowThree\VoyagerForms\Form;
use YellowThree\VoyagerForms\FormInput;
use Illuminate\Foundation\Testing\RefreshDatabase;
use YellowThree\VoyagerForms\Tests\Utilities\FactoryUtilities;

class InputTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        \YellowThree\VoyagerForms\Tests\Unit\FormTest::createForm();
    }

    public function testIfInputHasAFormAssigned()
    {
        $input = FormInput::inRandomOrder()->get()->first();
        $form = $input->form()->first();

        return $this->assertInstanceOf(Form::class, $form);
    }

    public function testIfInputHasALabel()
    {
        $form = FormInput::inRandomOrder()->get()->first();

        return $this->assertArrayHasKey('label', $form);
    }

    public function testIfInputHasAClass()
    {
        $form = FormInput::inRandomOrder()->get()->first();

        return $this->assertArrayHasKey('class', $form);
    }

    public function testIfInputHasAType()
    {
        $form = FormInput::inRandomOrder()->get()->first();

        return $this->assertArrayHasKey('type', $form);
    }

    public function testIfInputIsRequired()
    {
        $form = FormInput::inRandomOrder()->get()->first();

        return $this->assertEquals(true, $form->required);
    }
}
