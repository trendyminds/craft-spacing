<?php

namespace trendyminds\spacing\variables;

use Illuminate\Support\Collection;
use trendyminds\spacing\Spacing;

class Variable
{
	public function config(): Collection
	{
    return Spacing::options();
	}
}
