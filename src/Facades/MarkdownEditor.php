<?php
namespace Leboclub\MarkdownEditor\Facades;

use Illuminate\Support\Facades\Facade;

class MarkdownEditor extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'markdown-editor';
    }
}