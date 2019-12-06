<?php
/**
 * Color Dropdown module for Craft CMS 3.x
 *
 * A dropdown select element to allow for colour names and hex colour fields for use in the frontend.
 *
 * @link      www.sico.co.uk
 * @copyright Copyright (c) 2019 Simon Corless
 */

namespace modules\colordropdownmodule;

use modules\colordropdownmodule\assetbundles\colordropdownmodule\ColorDropdownModuleAsset;
use modules\colordropdownmodule\fields\ColorDropdown as ColorDropdownField;

use Craft;
use craft\events\RegisterTemplateRootsEvent;
use craft\events\TemplateEvent;
use craft\i18n\PhpMessageSource;
use craft\web\View;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\base\Module;

/**
 * Class ColorDropdownModule
 *
 * @author    Simon Corless
 * @package   ColorDropdownModule
 * @since     1.0.0
 *
 */
class ColorDropdownModule extends Module
{
    // Static Properties
    // =========================================================================

    /**
     * @var ColorDropdownModule
     */
    public static $instance;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        Craft::setAlias('@modules/colordropdownmodule', $this->getBasePath());
        $this->controllerNamespace = 'modules\colordropdownmodule\controllers';

        // Translation category
        $i18n = Craft::$app->getI18n();
        /** @noinspection UnSafeIsSetOverArrayInspection */
        if (!isset($i18n->translations[$id]) && !isset($i18n->translations[$id.'*'])) {
            $i18n->translations[$id] = [
                'class' => PhpMessageSource::class,
                'sourceLanguage' => 'en-US',
                'basePath' => '@modules/colordropdownmodule/translations',
                'forceTranslation' => true,
                'allowOverrides' => true,
            ];
        }

        // Base template directory
        Event::on(View::class, View::EVENT_REGISTER_CP_TEMPLATE_ROOTS, function (RegisterTemplateRootsEvent $e) {
            if (is_dir($baseDir = $this->getBasePath().DIRECTORY_SEPARATOR.'templates')) {
                $e->roots[$this->id] = $baseDir;
            }
        });

        // Set this as the global instance of this module class
        static::setInstance($this);

        parent::__construct($id, $parent, $config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$instance = $this;

        if (Craft::$app->getRequest()->getIsCpRequest()) {
            Event::on(
                View::class,
                View::EVENT_BEFORE_RENDER_TEMPLATE,
                function (TemplateEvent $event) {
                    try {
                        Craft::$app->getView()->registerAssetBundle(ColorDropdownModuleAsset::class);
                    } catch (InvalidConfigException $e) {
                        Craft::error(
                            'Error registering AssetBundle - '.$e->getMessage(),
                            __METHOD__
                        );
                    }
                }
            );
        }

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = ColorDropdownField::class;
            }
        );

        Craft::info(
            Craft::t(
                'color-dropdown-module',
                '{name} module loaded',
                ['name' => 'Color Dropdown']
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================
}
