<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Config;
use \Firebase\JWT\JWT;

class User extends Model {

		CONST USER   = 1; // nguoi dung
	    
	    CONST ARTIST = 2; // Nghe si
	    
	    CONST ADMIN  = 3; // Admin
	    
		/**
		* The database table used by the model.
		*
		* @var string
		*/
		protected $table      = 'user';
		
		/**
		* The attributes that are mass assignable.
		*
		* @var array
		*/
		protected $fillable   = ['name', 'email', 'password'];
		
		/**
		* The attributes excluded from the model's JSON form.
		*
		* @var array
		*/
		protected $hidden     = ['password', 'remember_token'];
		public $timestamps 	  = false;

		public static function checkLogin($email,$password) {
			return User::where('email',$email)->where('password',$password)->whereIn('level',[1,2])->first();
		}

		public static function createToken($user){
			$token = array(
	            "exp"  => time() + 86400*30,
	            'data' => $user
	        );

	        try {
	            $jwt = JWT::encode($token, Config::get('app.key'));
	        } catch (Exception $e) {
	            return false;
	        }

	        return [
	            'token' => $jwt,
	            'exp'   => $token['exp']
	        ];
		}

		static function existsEmail($email){
			return User::where('email', $email)->select('id')->first();
		}

}
