<?php

class TraitFile extends FilePhp
{
    const REGEX = 'trait\s+\w+';
    const ELEMENTS = [FileAttribute::class, FileMethod::class];
}
