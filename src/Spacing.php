<?php

namespace trendyminds\spacing;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\helpers\Json;
use craft\services\Fields;
use Exception;
use Illuminate\Support\Collection;
use trendyminds\spacing\fields\Field;
use yii\base\Event;

/**
 * Spacing plugin
 *
 * @method static Spacing getInstance()
 *
 * @author TrendyMinds <dev@trendyminds.com>
 * @copyright TrendyMinds
 * @license MIT
 */
class Spacing extends Plugin
{
    public string $schemaVersion = '1.0.0';

    public function init()
    {
        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function () {
            $this->attachEventHandlers();
        });
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = Field::class;
            }
        );
    }

    public static function options(): Collection
    {
        try {
            $file = Craft::getAlias('@config').DIRECTORY_SEPARATOR.'spacing.json';
            $file = file_get_contents($file);
            $options = Json::decode($file);
        } catch (\Exception $e) {
            throw new Exception('Could not locate a config/spacing.json file for your Spacer field. Does it exist?');
        }

        return collect($options);
    }
}
