<?php

Collective\Html\FormFacade::macro('field', function ($field) {
    $form = Formx::getForm();
    if ($form) return $form->field($field);
});
