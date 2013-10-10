<?php

namespace Eliberty\Cache\ElibertyZendCacheBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ElibertyZendCacheBundle extends Bundle
{
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function getPath()
    {
        return strtr(__DIR__, '\\', '/');
    }
}
