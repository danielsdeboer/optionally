<?php

namespace Tests;

use Aviator\Optionally\Optionally;
use PHPUnit\Framework\TestCase;

class OptionallyTest extends TestCase
{
    protected $options = ['option1' => true, 'option2' => false];
    protected $replace = ['option2' => false, 'option4' => true];
    protected $add = ['option1' => false, 'option3' => true, 'option4' => true];

    protected $intOption = [0 => true];

    /** @test */
    public function it_sets_an_array_of_options ()
    {
        $options = Optionally::make($this->options);

        $this->assertInstanceOf(Optionally::class, $options);
        $this->assertSame($this->options, $options->all());
    }

    /** @test */
    public function it_ignores_non_string_keys_silently ()
    {
        $options = Optionally::make($this->options + $this->intOption);

        $this->assertSame($this->options, $options->all());
    }

    /** @test */
    public function it_ignores_non_boolean_values_silently ()
    {
        $options = Optionally::make(['test' => 'string']);

        $this->assertSame([], $options->all());
    }

    /** @test */
    public function it_returns_all_the_keys ()
    {
        $options = Optionally::make($this->options);

        $expected = ['option1', 'option2'];

        $this->assertSame($expected, $options->keys());
    }
    
    /** @test */
    public function it_retrieves_a_single_option_by_key ()
    {
        $options = Optionally::make($this->options);

        $expected = true;

        $this->assertSame($expected, $options->get('option1'));

        $expected = false;

        $this->assertSame($expected, $options->get('option2'));
    }

    /** @test */
    public function it_returns_null_if_the_key_doesnt_exist ()
    {
        $options = Optionally::make($this->options);

        $expected = null;

        $this->assertSame($expected, $options->get('someOptionThatDoesntExist'));
    }

    /** @test */
    public function it_checks_if_an_option_is_set ()
    {
        $options = Optionally::make($this->options);

        $this->assertSame(true, $options->has('option1'));
        $this->assertSame(true, $options->has('option2'));
        $this->assertSame(false, $options->has('someOptionThatDoesntExist'));
    }
    
    /** @test */
    public function it_can_completely_replace_all_the_options ()
    {
        $options = Optionally::make($this->options);
        
        $options->replaceWith($this->replace);

        $this->assertSame($this->replace, $options->all());
    }

    /** @test */
    public function it_can_add_a_new_array_of_options ()
    {
        $options = Optionally::make($this->options);

        $options->add($this->add);
        $expected = array_replace($this->options, $this->add);

        $this->assertSame($expected, $options->all());
    }

    /** @test */
    public function it_can_set_a_single_option ()
    {
        $options = Optionally::make($this->options);

        $options->set('option0', true);

        $this->assertTrue($options->has('option0'));
    }

    /** @test */
    public function it_can_unset_a_single_option ()
    {
        $options = Optionally::make($this->options);

        $options->remove('option1');

        $this->assertFalse($options->has('option1'));
    }

    /** @test */
    public function it_is_iterable ()
    {
        $options = Optionally::make($this->options);

        foreach ($options as $key => $value) {
            $this->assertInternalType('string', $key);
            $this->assertInternalType('bool', $value);
        }
    }

    /** @test */
    public function it_is_countable ()
    {
        $options = Optionally::make($this->options);

        $this->assertCount(2, $options);
    }
}
