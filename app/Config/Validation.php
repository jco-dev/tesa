<?php

namespace Config;

use CodeIgniter\Validation\StrictRules\Rules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\CreditCardRules;

use CodeIgniter\Config\BaseConfig;

use App\Validation\VerificarUniqueEmailEditar;
use App\Validation\VerificarUniqueCiEditar;
use App\Validation\VerificarUniqueCelularEditar;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        VerificarUniqueCiEditar::class,
        VerificarUniqueCelularEditar::class,
        VerificarUniqueEmailEditar::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
