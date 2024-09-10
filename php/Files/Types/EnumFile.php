<?php

class EnumFile extends FilePhp
{
    const REGEX = 'enum\s+\w+';
    const ELEMENTS = [FileAttribute::class, FileMethod::class];
}
