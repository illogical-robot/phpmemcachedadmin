<?php declare(strict_types=1);

namespace App\Library;

use RuntimeException;

class Vite
{
    /**
     * @var Vite
     */
    protected static $instance;

    /**
     * @var array
     */
    protected $manifest;

    /**
     * @var string
     */
    protected $viteManifestLocalPath;

    /**
     * @var string
     */
    protected $basePath;
    
    protected function __construct(string $viteManifestLocalPath, ?string $basePath = null)
    {
        $this->viteManifestLocalPath = $viteManifestLocalPath;
        $this->basePath = $basePath;
    }

    public static function getInstance(string $viteManifestLocalPath, ?string $basePath = null): Vite
    {
        if (!isset(static::$instance)) {
            static::$instance = new self($viteManifestLocalPath, $basePath);
        }
        
        return static::$instance;
    }

    function getPath(string $file): string
    {
        $manifest = $this->getManifest();

        if (!isset($manifest[$file])) {
            throw new RuntimeException("File \"$file\" does not exist in Vite manifest file.");
        }
        
        return $this->basePath . $manifest[$file]['file'];
    }
    
    protected function getManifest(): array
    {
        if (!isset($this->manifest)) {
            if (!is_file($this->viteManifestLocalPath)) {
                throw new RuntimeException("Vite manifest file \"$this->viteManifestLocalPath\" does not exist or is not a file.");
            }

            $manifestRaw = file_get_contents($this->viteManifestLocalPath);
            $this->manifest = json_decode($manifestRaw, true);
            if ($this->manifest === null) {
                throw new RuntimeException("Vite manifest file \"$this->viteManifestLocalPath\" is not a valid JSON.");
            }
        }
        
        return $this->manifest;
    }
}
