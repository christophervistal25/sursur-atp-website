<?php
namespace App\Http\Controllers\Repositories;

use App\Checker;
use Illuminate\Support\Facades\Hash;

class CheckerRepository
{
    private $checker;

    public function hasChecker(string $username) :bool
    {
        // Fetch Checker by username.
        $checker = Checker::where(['username' => $username])
                        ->first();

        
        if(!is_null($checker)) {
            $this->setChecker($checker);
        }

        return !is_null($checker);
    }

    public function setChecker(Checker $checker) :void
    {
        $this->checker = $checker;
    }

    public function getChecker()
    {
        return $this->checker;
    }

    public function createAccount(array $data) :Checker
    {
        $checker = Checker::create([
            'username'       => $data['username'],
            'password'       => Hash::make($data['password']),
            'firstname'      => $data['firstname'],
            'middlename'     => $data['middlename'],
            'lastname'       => $data['lastname'],
            'suffix'         => $data['suffix'],
            'municipal_code' => $data['municipal_code'],
            'phone_number'   => $data['phone_number'],
        ]);
        
        return $checker;
    }

    public function generatePassword(string $username, $password) : string
    {
        $salt = null;

        // Split all characters in username
        $username = str_split($username);

        // Convert each character to ascii code then store to a variable.
        foreach($username as $character) {
            $salt .= ord($character);
        }

        // Hash the plain text password of the checker using MD5 combined with username converted to ascii code.
        return md5($password) . $salt;
    }

}
