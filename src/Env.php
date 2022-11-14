<?php

namespace BomberNet\LaravelSupportExtensions;

class Env extends \Illuminate\Support\Env
	{
		public static function getByPattern (string $pattern):array
			{
				return array_filter (self::all (),static fn (string $key) => preg_match ("/$pattern/",$key),ARRAY_FILTER_USE_KEY);
			}
		
		public static function all ():array
			{
				$keys=self::allKeys ();
				return array_combine ($keys,array_map (static fn (string $key) => self::get ($key),$keys));
			}
		
		public static function allKeys ():array
			{
				return array_keys ($_ENV);
			}
	}
