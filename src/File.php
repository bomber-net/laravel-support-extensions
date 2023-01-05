<?php

namespace BomberNet\LaravelSupportExtensions;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool absent (string $path)
 * @method static mixed nextFile (string $dir,string $pattern='*.*',string $cursorFile='current.file')
 */
class File extends Facade
	{
		protected static function getFacadeAccessor ():string
			{
				return FileSystem::class;
			}
	}
