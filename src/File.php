<?php

namespace devraiz;

class File
{
    private ?string $name         = NULL;
    private ?string $nameToSave   = NULL;
    private ?string $mimeType     = NULL;
    private ?int $size            = NULL;
    private ?string $extension    = NULL;
    private ?string $contents     = NULL; // Validação no método
    private ?string $path         = NULL;
    private ?string $fullPath     = NULL;
    private ?string $pathToDelete = NULL;
    private ?string $permission   = '0755';
    private ?string $url          = NULL;

    /**
     * Get the value of name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of nameToSave
     */
    public function getNameToSave(): ?string
    {
        return $this->nameToSave;
    }

    /**
     * Set the value of nameToSave
     */
    public function setNameToSave(?string $nameToSave): self
    {
        $this->nameToSave = $nameToSave;

        return $this;
    }

    /**
     * Get the value of mimeType
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * Set the value of mimeType
     */
    public function setMimeType(?string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set the value of size
     */
    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of extension
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * Set the value of extension
     */
    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get the value of contents
     */
    public function getContents(): ?string
    {
        return $this->contents;
    }

    /**
     * Set the value of contents
     */
    public function setContents(?string $contents): self
    {
        $vector = explode(',', $contents);

        if (isset($vector[1]) === true) {
            $contents = $vector[1];
        }

        $this->contents = $contents;

        return $this;
    }

    /**
     * Get the value of path
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set the value of path
     */
    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of fullPath
     */
    public function getFullPath(): ?string
    {
        return $this->fullPath;
    }

    /**
     * Set the value of fullPath
     */
    public function setFullPath(?string $fullPath): self
    {
        $this->fullPath = $fullPath;

        return $this;
    }

    /**
     * Get the value of pathToDelete
     */
    public function getPathToDelete(): ?string
    {
        return $this->pathToDelete;
    }

    /**
     * Set the value of pathToDelete
     */
    public function setPathToDelete(?string $pathToDelete): self
    {
        $this->pathToDelete = $pathToDelete;

        return $this;
    }

    /**
     * Get the value of permission
     */
    public function getPermission(): ?string
    {
        return $this->permission;
    }

    /**
     * Set the value of permission
     */
    public function setPermission(?string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get the value of url
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set the value of url
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getBase64ByPath(string $fullPath): string
    {
        return base64_encode(file_get_contents($fullPath));
    }

    public function getBase64ByUrl(string $url): string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        $result = curl_exec($curl);
        curl_close($curl);

        return base64_encode($result);
    }

    public function getMimeTypeExtension(string $mimeType): string
    {
        $vector1 = explode(';', $mimeType);
        $vector2 = explode('/', $vector1[0]);

        $extension = end($vector2);

        return $extension;
    }
}
