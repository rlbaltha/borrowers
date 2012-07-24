<?php

namespace Borrowers\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BorrowersUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
