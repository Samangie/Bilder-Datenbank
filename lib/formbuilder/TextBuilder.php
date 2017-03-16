<?php

class TextBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('name');
        $this->addProperty('type');
        $this->addProperty('placeholder');
        $this->addProperty('value', null);
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= '    <div class="col-md-4">';
        $result .= "        <input name=\"{$this->name}\" type=\"{$this->type}\" placeholder=\"{$this->placeholder}\" value=\"{$this->value}\" class=\"form-control input-md\">";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}
