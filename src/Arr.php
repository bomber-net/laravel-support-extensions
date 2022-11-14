<?php

namespace BomberNet\LaravelSupportExtensions;

use Illuminate\Support\Collection;
use function is_array;
use function is_callable;

class Arr extends \Illuminate\Support\Arr
	{
		public static function snake (array $arr):array
			{
				$result=[];
				foreach ($arr as $k=>$v)
					{
						$k=Str::snake ($k);
						if (is_array ($v)) $v=self::snake ($v);
						$result[$k]=$v;
					}
				return $result;
			}
		
		public static function kebab (array $arr):array
			{
				$result=[];
				foreach ($arr as $k=>$v)
					{
						$k=Str::kebab ($k);
						if (is_array ($v)) $v=self::kebab ($v);
						$result[$k]=$v;
					}
				return $result;
			}
		
		public static function camel (array $arr):array
			{
				$result=[];
				foreach ($arr as $k=>$v)
					{
						$k=Str::camel ($k);
						if (is_array ($v)) $v=self::camel ($v);
						$result[$k]=$v;
					}
				return $result;
			}
		
		public static function lower (array $arr):array
			{
				$result=[];
				foreach ($arr as $k=>$v)
					{
						$k=Str::lower ($k);
						if (is_array ($v)) $v=self::lower ($v);
						$result[$k]=$v;
					}
				return $result;
			}
		
		public static function curlPrep (array $arr):array
			{
				return array_map (static fn ($item) => is_array ($item)?json_encode ($item,JSON_UNESCAPED_UNICODE):$item,$arr);
			}
		
		public static function collection (array $arr):Collection
			{
				return collect (arraY_map (static fn ($item) => is_array ($item)?self::collection ($item):$item,$arr));
			}
		
		public static function normalize (array $arr):array
			{
				$result=[];
				foreach ($arr as $k=>$v)
					{
						$result[$k]=match (get_debug_type ($v))
							{
							'string'=>str_normalize ($v),
							'array'=>self::normalize ($v),
							default=>$v
							};
					}
				return $result;
			}
		
		public static function make (int $start=0,int $count=1,mixed $value=null):array
			{
				if (!is_callable ($value)) return array_fill ($start,$count,$value);
				$arr=[];
				$i=$start;
				while ($count--) $arr[$i++]=$value ();
				return $arr;
			}
	}
