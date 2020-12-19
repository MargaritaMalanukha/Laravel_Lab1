<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class Parser extends Model
{
    use HasFactory;

    public static $contentUA;
    public static $contentRU;
    public static $parentCode;
    protected static $delimiter = '|';
    protected static $given_commands = ['images', 'link', 'container'];
    protected static $link_detector = "_//link//_";

    public static function process(Request $request) {
        $commandsUA = self::findCommands($request->input('contentUA'), 'ua');
        $commandsRU = self::findCommands($request->input('contentRU'), 'ru');

        $commands = array_merge($commandsUA, $commandsRU);

        self::validateAndExecute($commands, $request);
    }


    public static function findCommands($contentToParse, $lang) {
        $parsedArray = explode('[[', $contentToParse);
        for ($i = 0; $i < count($parsedArray); $i++)  {// now each command is in [i][0] element of array
            $parsedArray[$i] = explode(']]', $parsedArray[$i]);
        }
        for ($i = 1; $i < count($parsedArray); $i++) {
            $commands[$i] = $parsedArray[$i][0];
            if (str_contains($commands[$i], self::$given_commands[1])) {
                $counter = $i-1;
                $parsedArray[$i][0] = self::$link_detector . $counter;
            } else {
                $parsedArray[$i][0] = "";
            }
        }
        for ($i = 0; $i < count($parsedArray); $i++) {
            $contentOfRow[$i] = implode("", $parsedArray[$i]);
        }
        if ($lang == 'ua') {
            self::$contentUA = implode("", $contentOfRow);
        } else if($lang == 'ru') {
            self::$contentRU = implode("", $contentOfRow);
        }
        return $commands;
    }

    public static function validateAndExecute($commands, Request $request) {
        $countImages = 0;
        $countContainer = 0;
        for ($i = 0; $i < count($commands); $i++) {
            $command = str_replace(" ", "", $commands[$i]);
            $array = explode(self::$delimiter, $command);
            if ($array[0] == self::$given_commands[0] && $countImages < 6) {
                Image::createImage($request, $array[1]);
                $countImages++;
            }  else if ($array[0] == self::$given_commands[1]) {
                $str = '<a href="/site/' . $array[1] . '/ua">' . $array[2] . '</a>';
                self::$contentUA = str_replace(self::$link_detector . $i, $str, self::$contentUA);
                self::$contentRU = str_replace(self::$link_detector . $i, $str, self::$contentRU);
            }  else if ($array[0] == self::$given_commands[2] && $countContainer < 1) {
                self::$parentCode = $array[1];
            }
        }
    }
}
