<?php

class ClassFile extends FilePhp
{
    const REGEX = '(abstract\s+)?class\s+\w+';
    const ELEMENTS = [FileAttribute::class, FileMethod::class];
}
