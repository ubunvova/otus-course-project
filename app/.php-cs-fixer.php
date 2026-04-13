<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('config')
    ->exclude('var')
    ->exclude('tests/_support/_generated');

/** @see https://cs.symfony.com/doc/rules/ and https://cs.symfony.com/doc/ruleSets/ */
$config = (new PhpCsFixer\Config())
    ->setParallelConfig(new PhpCsFixer\Runner\Parallel\ParallelConfig(maxProcesses: 4))
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        '@DoctrineAnnotation' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP80Migration' => true,
        '@PHP80Migration:risky' => true,
        '@PHP81Migration' => true,
        '@PHP82Migration' => true,
        '@PHP82Migration:risky' => true,
        '@PHP83Migration' => true,
        '@PHP84Migration' => true,
        '@PHP85Migration' => true,
        '@PSR12' => true,
        '@PSR12:risky' => true,
        'attribute_empty_parentheses' => false,
        'single_line_empty_body' => false,
        'trailing_comma_in_multiline' => ['elements' => ['arguments', 'arrays', 'match', 'parameters']],
        'no_alias_functions' => ['sets' => ['@all']],
        'declare_parentheses' => true,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'global_namespace_import' => ['import_classes' => true, 'import_functions' => true, 'import_constants' => true],
        'ordered_imports' => ['imports_order' => ['class', 'function', 'const'], 'sort_algorithm' => 'alpha'],
        'ordered_interfaces' => ['order' => 'alpha', 'direction' => 'ascend'],
        'ordered_attributes' => ['sort_algorithm' => 'alpha'],
        'ordered_class_elements' => ['order' => ['use_trait', 'constant_public', 'constant_protected', 'constant_private', 'case', 'property_public', 'property_protected', 'property_private', 'construct', 'destruct', 'magic', 'phpunit']],
        'type_declaration_spaces' => ['elements' => ['constant', 'function', 'property']],
        'linebreak_after_opening_tag' => true,
        'mb_str_functions' => true,
        'fopen_flags' => ['b_mode' => true],
        'no_php4_constructor' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_closing_tag' => true,
        'phpdoc_order' => true,
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_list_type' => true,
        'phpdoc_array_type' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
        'concat_space' => ['spacing' => 'one'],
        'php_unit_strict' => false,
        'php_unit_data_provider_name' => false,
        'php_unit_test_case_static_method_calls' => ['call_type' => 'this'],
        'php_unit_attributes' => ['keep_annotations' => false],
        'php_unit_data_provider_method_order' => ['placement' => 'after'],
        'php_unit_test_class_requires_covers' => false,
        'control_structure_braces' => true,
        'no_multiple_statements_per_line' => true,
        'statement_indentation' => true,
        'simplified_if_return' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'heredoc_closing_marker' => true,
        'multiline_string_to_heredoc' => true,
        'numeric_literal_separator' => true,
        'unary_operator_spaces' => ['only_dec_inc' => false],
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__.'/var/.php_cs.cache');

return $config;
