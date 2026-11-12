<?php
namespace Composer\Autoload;
/**
 * ClassLoader implements a PSR-4 class loader
 */
class ClassLoader
{
    private array $prefixDirsPsr4 = [];
    public function getPrefixesPsr4(): array
    {
        return $this->prefixDirsPsr4;
    }
    public function addPsr4(string $prefix, array|string $paths, bool $prepend = false): void
    {
        $prefix = trim($prefix, '\\') . '\\';
        $paths = (array)$paths;
        if (!isset($this->prefixDirsPsr4[$prefix])) {
            $this->prefixDirsPsr4[$prefix] = $paths;
        } elseif ($prepend) {
            $this->prefixDirsPsr4[$prefix] = array_merge($paths, $this->prefixDirsPsr4[$prefix]);
        } else {
            $this->prefixDirsPsr4[$prefix] = array_merge($this->prefixDirsPsr4[$prefix], $paths);
        }
    }
    public function setPsr4(string $prefix, array|string $paths): void
    {
        $prefix = trim($prefix, '\\') . '\\';
        $this->prefixDirsPsr4[$prefix] = (array)$paths;
    }
    public function register(bool $prepend = false): void
    {
        spl_autoload_register([$this, 'loadClass'], true, $prepend);
    }
    public function unregister(): void
    {
        spl_autoload_unregister([$this, 'loadClass']);
    }
    public function loadClass(string $class): ?bool
    {
        if ($file = $this->findFile($class)) {
            include $file;
            return true;
        }
        return null;
         }
    public function findFile(string $class): string|false
    {
        $logicalPathPsr4 = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
        $first = $class[0];
        foreach ($this->prefixDirsPsr4 as $prefix => $dirs) {
            if ($class[0] === $prefix[0] && str_starts_with($class, $prefix)) {
                $length = strlen($prefix);
                $subPath = substr($logicalPathPsr4, $length);
                foreach ($dirs as $dir) {
                    $file = $dir . DIRECTORY_SEPARATOR . $subPath;
                    if (file_exists($file)) {
                        return $file;
                    }
                }
            }
        }
        return false;
    }
}