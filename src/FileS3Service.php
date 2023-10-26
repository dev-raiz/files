<?php

namespace devraiz;

use Aws\S3\S3Client;

class FileS3Service implements FileServiceInterface
{
    protected string $bucket;
    protected S3Client $client;

    public function __construct($version, $region, $endpoint, $key, $secret, $bucket)
    {
        $this->client = new S3Client([
            'version' => $version,
            'region'  => $region,
            'endpoint' => $endpoint,
            'use_aws_shared_config_files' => false,
            'credentials' => [
                'key'     => $key,
                'secret'  => $secret,
            ],
        ]);

        $this->bucket = $bucket;
    }

    public function save(File $file): array
    {
        $contentType = $file->getMimeType();
        $key         = $file->getFullPath();
        $body        = base64_decode($file->getContents());
        $acl         = $file->getPermission();

        $result = $this->client->putObject([
            'Bucket'      => $this->bucket,
            'Key'         => $key,
            'Body'        => $body,
            'ContentType' => $contentType,
            'ACL'         => $acl
        ]);

        if (isset($result['ObjectURL']) === false) {
            return ['result' => 'warning', 'message' => 'Falha ao salvar o arquivo!'];
        }

        return ['result' => 'success', 'message' => 'Arquivo salvo com sucesso!'];
    }

    public function delete(File $file): array
    {
        $key = $file->getPathToDelete();

        $this->client->deleteObject([
            'Bucket' => $this->bucket,
            'Key'    => $key
        ]);

        return ['result' => 'success', 'message' => 'Arquivo excluído com sucesso!'];
    }

    public function deleteByPath(string $fullPath): array
    {
        $this->client->deleteObject([
            'Bucket' => $this->bucket,
            'Key'    => $fullPath
        ]);

        return ['result' => 'success', 'message' => 'Arquivo excluído com sucesso!'];
    }
}
