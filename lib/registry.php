<?php
namespace KirbySync;

$Option = new Option();

$kirby->set('blueprint', $Option->silence(), __DIR__ . DS . '../' . DS . '/blueprints/silence.yml');