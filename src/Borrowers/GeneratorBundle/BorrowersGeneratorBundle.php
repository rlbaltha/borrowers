<?php

namespace Borrowers\GeneratorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BorrowersGeneratorBundle extends Bundle
{
    public function getParent()
    {
        return 'SensioGeneratorBundle';
    }
}
