<?php

namespace BomberNet\LaravelSupportExtensions;

use function count;

class FileSystem extends \Illuminate\Filesystem\Filesystem
	{
		public function absent (string $path):bool
			{
				return !$this->exists ($path);
			}
		
		public function nextFile (string $dir,string $pattern='*.*',string $cursorFile='current.file')
			{
				$files=array_map (static fn ($file) => Str::after ($file,"$dir/"),$this->glob ("$dir/$pattern"));
				$cursorFile="$dir/$cursorFile";
				$cursor=fopen ($cursorFile,'cb+');
				flock ($cursor,LOCK_EX);
				$size=filesize ($cursorFile);
				$current=$size?fread ($cursor,$size):null;
				$current=array_search ($current,$files,true);
				if ($current!==false && $current<count ($files)) $current++;
				else $current=0;
				$current=$files[$current];
				ftruncate ($cursor,0);
				fwrite ($cursor,$current);
				fclose ($cursor);
				return $current;
			}
	}
