<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['bootstrap/cache','deploy','storage','vendor'])
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2'                  => true,
        'no_unused_imports'      => true,
        'ordered_imports'        => ['sortAlgorithm' => 'alpha'],
        'binary_operator_spaces' => [
            'operators' => [
                '=>' => 'align_single_space_minimal',
            ],
        ],
    ])
    ->setFinder($finder);
