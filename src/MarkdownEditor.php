<?php

namespace Leboclub\MarkdownEditor;

use Leboclub\MarkdownEditor\Lib\Parsedown;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class MarkdownEditor
{
    static $_errors = array();

    protected static function addError($message)
    {
        if (!empty($message)) {
            self::$_errors[] = $message;
        }
    }

    protected static function getLastError()
    {
        return empty(self::$_errors) ? '' : array_pop(self::$_errors);
    }

    // 文件上传
    public static function upload()
    {
        try {
            if (Request::hasFile('editormd-image-file')) {
                $file = Request::file('editormd-image-file');
                if ($file->isValid()) {

                    $folder_name = date("Ym/d", time());

                    $upload_path = config('markdown.disks.local.root', 'uploads/images') . '/' . $folder_name;

                    $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

                    $filename = time() . '_' . Str::random(10) . '.' . $extension;

                    $file->move($upload_path, $filename);

                } else {
                    self::addError('The file is invalid');
                }
            } else {
                self::addError('Not File');
            }
        } catch (\Exception $e) {
            self::addError($e->getMessage());
        }

        $data = array(
            'success' => empty(self::getLastError()) ? 1 : 0,
            'message' => self::getLastError() ?: 'success',
            'url'     => asset($upload_path . '/' . $filename)
        );

        return $data;
    }

    // 解析markdown文件
    public static function parse($markdownText)
    {
        $parsedown = new Parsedown();

        return $parsedown->text($markdownText);
    }
}