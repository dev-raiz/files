<?php

namespace devraiz;

class FileService implements FileServiceInterface
{
    public function __construct()
    {
    }

    public function save(File $file): array
    {
        if (file_exists($file->getPath()) === false) {
            mkdir($file->getPath(), intval($file->getPermission()), true);
        }
        
        $contents = base64_decode($file->getContents());

        if (file_put_contents($file->getFullPath(), $contents) === false) {
            throw new \Exception('Falha ao salvar arquivo!');
            
        }

        return ['result' => 'success', 'message' => 'Arquivo salvo com sucesso!'];
    }

    public function delete(File $file): array
    {
        if (unlink($file->getPathToDelete()) === false) {
            throw new \Exception('Falha ao excluir arquivo!');
        }

        return ['result' => 'success', 'message' => 'Arquivo excluído com sucesso!'];
    }

    public function deleteByPath(string $fullPath): array
    {
        if (unlink($fullPath) === false) {
            throw new \Exception('Falha ao excluir arquivo!');
        }

        return ['result' => 'success', 'message' => 'Arquivo excluído com sucesso!'];
    }
}
