<?php

namespace webrgp\ignition\web;

use webrgp\ignition\services\IgnitionRenderer;

class IgnitionErrorHandler extends \craft\web\ErrorHandler
{
    /**
     * {@inheritdoc}
     */
    public $exceptionView = '@webrgp/ignition/web/views/exception.php';

    // Public Properties
    // ========================================================================

    public function renderIgnition($exception): void
    {
        service(IgnitionRenderer::class)->handleException($exception);
    }
}
