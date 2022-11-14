<?php

namespace BomberNet\LaravelSupportExtensions;

class Carbon extends \Illuminate\Support\Carbon
	{
		public static function makeNotNull ($var):\Illuminate\Support\Carbon
			{
				return parent::make ($var)??now ();
			}
	}
