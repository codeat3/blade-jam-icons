<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladeJamIcons\BladeJamIconsServiceProvider;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('jam-alert-f')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -1.5 24 24" preserveAspectRatio="xMinYMin" class="jam jam-alert-f" fill="currentColor"><path d='M10 20.393c-5.523 0-10-4.477-10-10 0-5.522 4.477-10 10-10s10 4.478 10 10c0 5.523-4.477 10-10 10zm0-15a1 1 0 0 0-1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0-1-1zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2z' /></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('jam-alert-f', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="-2 -1.5 24 24" preserveAspectRatio="xMinYMin" class="jam jam-alert-f" fill="currentColor"><path d='M10 20.393c-5.523 0-10-4.477-10-10 0-5.522 4.477-10 10-10s10 4.478 10 10c0 5.523-4.477 10-10 10zm0-15a1 1 0 0 0-1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0-1-1zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2z' /></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('jam-alert-f', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" viewBox="-2 -1.5 24 24" preserveAspectRatio="xMinYMin" class="jam jam-alert-f" fill="currentColor"><path d='M10 20.393c-5.523 0-10-4.477-10-10 0-5.522 4.477-10 10-10s10 4.478 10 10c0 5.523-4.477 10-10 10zm0-15a1 1 0 0 0-1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0-1-1zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2z' /></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-jam-icons.class', 'awesome');

        $result = svg('jam-alert-f')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" xmlns="http://www.w3.org/2000/svg" viewBox="-2 -1.5 24 24" preserveAspectRatio="xMinYMin" class="jam jam-alert-f" fill="currentColor"><path d='M10 20.393c-5.523 0-10-4.477-10-10 0-5.522 4.477-10 10-10s10 4.478 10 10c0 5.523-4.477 10-10 10zm0-15a1 1 0 0 0-1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0-1-1zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2z' /></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-jam-icons.class', 'awesome');

        $result = svg('jam-alert-f', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="-2 -1.5 24 24" preserveAspectRatio="xMinYMin" class="jam jam-alert-f" fill="currentColor"><path d='M10 20.393c-5.523 0-10-4.477-10-10 0-5.522 4.477-10 10-10s10 4.478 10 10c0 5.523-4.477 10-10 10zm0-15a1 1 0 0 0-1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0-1-1zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2z' /></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeJamIconsServiceProvider::class,
        ];
    }
}
