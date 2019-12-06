<?php
/**
 * Color Dropdown module for Craft CMS 3.x
 *
 * A dropdown select element to allow for colour names and hex colour fields for use in the frontend.
 *
 * @link      www.sico.co.uk
 * @copyright Copyright (c) 2019 Simon Corless
 */

namespace modules\colordropdownmodule\assetbundles\colordropdownfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Simon Corless
 * @package   ColorDropdownModule
 * @since     1.0.0
 */
class ColorDropdownFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@modules/colordropdownmodule/assetbundles/colordropdownfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/ColorDropdown.js',
        ];

        $this->css = [
            'css/ColorDropdown.css',
        ];

        parent::init();
    }
}
