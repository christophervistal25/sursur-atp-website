<?php

namespace App\Http\Controllers\Repositories;


class Encryptor
{

    // 124 is ASCII Code in Character equals to = |
    public const DATA_SEPERATOR = '124';
    public const CHARACTER_SEPERATOR = ':';

    public static function splitByCharacter(string $data) : array
    {
        return str_split($data);
    }

   public static function process(string $data)
   {
        $data_array  = self::splitByCharacter($data);
        $text = null;
        foreach($data_array as $data) {
            $text .= ord($data) . self::CHARACTER_SEPERATOR;
        }
        return rtrim($text, self::CHARACTER_SEPERATOR);
   }

   public static function decrypt(string $data)
   {
       $data = explode(self::DATA_SEPERATOR, $data);
       $text = null;
       foreach($data as $information) {
            foreach(explode(self::CHARACTER_SEPERATOR, $information) as $character) {
                $text .= chr($character);
            }
            $text .= chr(self::DATA_SEPERATOR);
       }
      
       return rtrim($text, chr(self::DATA_SEPERATOR));
   }
}