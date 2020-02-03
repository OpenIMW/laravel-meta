<?php

namespace IMW\LaravelMeta\Contracts;

interface MetaGenerator
{
    public function generate($context): string;
}
