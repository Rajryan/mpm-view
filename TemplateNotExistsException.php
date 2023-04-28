<?php

namespace Mpm\View;

use Exception;

class TemplateNotExistsException extends Exception
{
    /**
     * The name of the missing template.
     *
     * @var string
     */
    protected $template;

    /**
     * Create a new exception instance.
     *
     * @param  string  $template
     * @param  string|null  $message
     * @param  \Exception|null  $previous
     * @return void
     */
    public function __construct($template, $message = null, Exception $previous = null)
    {
        $this->template = $template;

        if (!$message) {
            $message = "The template '$template' could not be found.";
        }

        parent::__construct($message, 0, $previous);
    }

    /**
     * Get the name of the missing template.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
