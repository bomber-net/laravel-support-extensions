<?php

namespace BomberNet\LaravelSupportExtensions;

/**
 * @method static bool absent (string $path)
 * @method static mixed nextFile (string $dir,string $pattern='*.*',string $cursorFile='current.file')
 */
class File extends \Illuminate\Support\Facades\File
	{
		protected static function getFacadeAccessor ():string
			{
				return FileSystem::class;
			}
	}
