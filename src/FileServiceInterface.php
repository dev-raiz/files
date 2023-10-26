<?php

namespace devraiz;

interface FileServiceInterface
{
    public function save(File $file): array;
    public function delete(File $file): array;
    public function deleteByPath(string $fullPath): array;
}
