<?php

class SubmitBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('label');
        $this->addProperty('name', 'submit');
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= '    <div class="col-md-4">';
        $result .= "        <input name=\"{$this->name}\" type=\"submit\" class=\"btn btn-primary\" value=\"{$this->label}\">";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}
