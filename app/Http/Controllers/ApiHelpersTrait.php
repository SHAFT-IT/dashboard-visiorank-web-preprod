<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/07/2018
 * Time: 17:42
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;

trait ApiHelpersTrait
{
    private function getResponse($code, $message = '')
    {
        $response = new \stdClass();
        $response->code = $code;
        $response->message = $message;
        return json_encode($response);
    }

    private function getLoginResponse($code, $message = '', $user)
    {
        $response = new \stdClass();
        $response->code = $code;
        $response->message = $message;
        $response->user = $user;
        return json_encode($response);
    }

    function toDateSQL($date)
    {
        $zDate = trim($date);
        $separator = strrpos($zDate, "/") ? '/' : '-';
        $tD = explode($separator, $zDate);
        if ($tD[0] <> "") {
            return $tD[2] . "-" . $tD[1] . "-" . $tD[0];
        }
        return "NULL";
    }

    function toDateFR($date)
    {
        $date = trim($date);
        if (strlen($date) >= 10 && $date != "0000-00-00 00:00:00") {
            $date = substr($date, 0, 10);
            $tD = explode('-', $date);
            return $tD[2] . "/" . $tD[1] . "/" . $tD[0];
        }
        return "";
    }

    function getIconByFileMimeType($mime_type)
    {
        // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
        $icon_classes = [
            // Media
            'image' => 'fa-file-image-o',
            'audio' => 'fa-file-audio-o',
            'video' => 'fa-file-video-o',
            // Documents
            'application/pdf' => 'fa-file-pdf-o',
            'application/msword' => 'fa-file-word-o',
            'application/vnd.ms-word' => 'fa-file-word-o',
            'application/vnd.oasis.opendocument.text' => 'fa-file-word-o',
            'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fa-file-word-o',
            'application/vnd.ms-excel' => 'fa-file-excel-o',
            'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fa-file-excel-o',
            'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-excel-o',
            'application/vnd.ms-powerpoint' => 'fa-file-powerpoint-o',
            'application/vnd.openxmlformats-officedocument.presentationml' => 'fa-file-powerpoint-o',
            'application/vnd.oasis.opendocument.presentation' => 'fa-file-powerpoint-o',
            'text/plain' => 'fa-file-text-o',
            'text/html' => 'fa-file-code-o',
            'application/json' => 'fa-file-code-o',
            // Archives
            'application/gzip' => 'fa-file-archive-o',
            'application/zip' => 'fa-file-archive-o',
        ];
        foreach ($icon_classes as $text => $icon) {
            if (strpos($mime_type, $text) === 0) {
                return $icon;
            }
        }
        return 'fa-file-o';
    }

    public function sendFiles(Request $request)
    {
        $paths = [];
        $files = $request->file('uploads');
        if (!empty($files)) {
            foreach ($files as $file) {
                if ($file) {
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move('uploads', $filename); // uploading file to given path
                    $paths[] = $filename;
                }
            }
        }
        return $paths;
    }
}
