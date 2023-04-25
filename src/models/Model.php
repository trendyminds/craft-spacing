<?php

namespace trendyminds\spacing\models;

use Craft;
use Illuminate\Support\Collection;
use trendyminds\spacing\Spacing;

class Model extends craft\base\Model
{
    /**
     * The key of the selected top option
     */
    public ?string $topValue = '';

    /**
     * The key of the selected bottom
     */
    public ?string $bottomValue = '';

    /**
     * Outputs the value for the "Top" selection from the key/value pair in spacing.json
     */
    public function top(): string
    {
        return $this->_getValueForPosition($this->topValue);
    }

    /**
     * Outputs the value for the "Bottom" selection from the key/value pair in spacing.json
     */
    public function bottom(): string
    {
        return $this->_getValueForPosition($this->bottomValue);
    }

    /**
     * Outputs the configuration from spacing.json
     *
     * @return string
     */
    public function config(): Collection
    {
        return Spacing::options();
    }

    /**
     * Returns the value for a given position using the key/value pair in spacing.json
     */
    private function _getValueForPosition(string $position): string
    {
        return collect(Spacing::options() ?? [])
            ->filter(function ($selection, $key) use ($position) {
                return strtolower($key) === $position;
            })
            ->flatten()
            ->first() ?? '';
    }
}
