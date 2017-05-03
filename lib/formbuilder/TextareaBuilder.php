<?php

class TextareaBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('name');
        $this->addProperty('placeholder');
        $this->addProperty('value', null);
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= '    <div class="col-md-4">';
        $result .= "        <textarea name=\"{$this->name}\" placeholder=\"{$this->placeholder}\" value=\"{$this->value}\" class=\"form-control input-md\"></textarea>";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}