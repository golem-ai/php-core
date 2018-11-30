<?php

namespace GolemAi\Core\Tests\Factory\Entity;

use GolemAi\Core\Factory\OptionsResolverAwareTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OptionsResolverAwareTraitTest extends TestCase
{
    private $trait;

    public function setUp()
    {
        $this->trait = $this->getMockBuilder(OptionsResolverAwareTrait::class)
            ->getMockForTrait()
        ;
        $this->trait->setOptionsResolver(new OptionsResolver());
    }

    public function testGetDefinedFields()
    {
        $this->assertTrue(is_array($this->trait->getDefinedFields()));
    }

    public function testGetRequiredFields()
    {
        $this->assertTrue(is_array($this->trait->getRequiredFields()));
    }

    public function testGetFieldsDefault()
    {
        $this->assertTrue(is_array($this->trait->getFieldsDefault()));
    }
}