<?php

class InterfaceFile extends FilePhp
{
    const REGEX = 'interface\s+\w+';
    const ELEMENTS = [FileAttribute::class, FileMethod::class];
}
