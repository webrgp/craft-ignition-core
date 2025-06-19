<?php

namespace webrgp\ignition;

use Composer\InstalledVersions;
use Craft;
use craft\web\Application as CraftWebApp;
use webrgp\ignition\services\IgnitionRenderer;
use webrgp\ignition\web\IgnitionErrorHandler;
use yii\base\BootstrapInterface;
use yii\base\Module;

/**
 * @property-read IgnitionRenderer $ignitionRenderer
 */
class Ignition extends Module implements BootstrapInterface
{
    /**
     * Bootstraps the application by registering the Ignition error handler.
     *
     * @param  \yii\base\Application  $app  The application instance.
     *
     * Only bootstraps if the application is an instance of CraftWebApp or CraftConsoleApp.
     * Registers the Ignition error handler and sets it to the application's errorHandler component.
     */
    public function bootstrap($app)
    {
        // Only bootstrap if this is a CraftWebApp
        if (! ($app instanceof CraftWebApp)) {
            return;
        }

        // If the plugin is installed, let it handle the bootstrapping
        if (InstalledVersions::isInstalled('webrgp/craft-ignition')) {
            return;
        }

        $app->set('errorHandler', [
            'class' => IgnitionErrorHandler::class,
            'errorAction' => 'templates/render-error',
        ]);

        $app->getErrorHandler()->register();

        Craft::info('Ignition module bootstrapped', __METHOD__);
    }
}
