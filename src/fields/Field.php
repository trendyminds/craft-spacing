<?php

namespace trendyminds\spacing\fields;

use Craft;
use craft\base\ElementInterface;
use craft\helpers\Json;
use trendyminds\spacing\models\Model;
use trendyminds\spacing\Spacing;
use yii\db\Schema;

/**
 * Spacing field type
 */
class Field extends craft\base\Field
{
    public static function displayName(): string
    {
        return 'Spacing';
    }

    public static function valueType(): string
    {
        return 'mixed';
    }

    public function getSettingsHtml(): ?string
    {
        return 'Configure your spacing options in a <code>config/spacing.json</code> file.';
    }

    public function getContentColumnType(): array|string
    {
        return Schema::TYPE_STRING;
    }

    public function normalizeValue(mixed $value, ElementInterface $element = null): mixed
    {
        // Use the first value from the config as the default
        if ($value === null) {
            return new Model([
                'topValue' => strtolower(Spacing::options()->keys()->first()),
                'bottomValue' => strtolower(Spacing::options()->keys()->first()),
            ]);
        }

        // If we already have an instance of our Spacing model, just return that
        if ($value instanceof Model) {
            return $value;
        }

        // If we have a string, we need to coerce it into something for our model
        if (gettype($value) === 'string') {
            $value = Json::decode($value);
        }

        return new Model($value);
    }

    protected function inputHtml(mixed $value, ElementInterface $element = null): string
    {
        $options = Spacing::options()
            ->mapWithKeys(fn ($group, $key) => [strtolower($key) => $key])
            ->toArray();

        return Craft::$app->getView()->renderTemplate('spacing/field', [
            'value' => $value,
            'name' => $this->handle,
            'options' => $options,
        ]);
    }
}
