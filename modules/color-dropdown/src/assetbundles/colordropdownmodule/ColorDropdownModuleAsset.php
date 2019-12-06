<?php
/**
 * Color Dropdown module for Craft CMS 3.x
 *
 * A dropdown select element to allow for colour names and hex colour fields for use in the frontend.
 *
 * @link      www.sico.co.uk
 * @copyright Copyright (c) 2019 Simon Corless
 */

namespace modules\colordropdownmodule\assetbundles\ColorDropdownModule;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Simon Corless
 * @package   ColorDropdownModule
 * @since     1.0.0
 */
class ColorDropdownModuleAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@modules/colordropdownmodule/assetbundles/colordropdownmodule/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/ColorDropdownModule.js',
        ];

        $this->css = [
            'css/ColorDropdownModule.css',
        ];

        parent::init();
    }
}
