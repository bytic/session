<?php

namespace Bytic\Session\SessionManager;

use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;

/**
 *
 */
trait HasStorageTrait
{
    /**
     * @var SessionStorageInterface
     */
    protected $storage = null;

    /**
     * @return SessionStorageInterface
     */
    public function getStorage(): ?SessionStorageInterface
    {
        return $this->storage;
    }

    /**
     * @param SessionStorageInterface $storage
     */
    public function setStorage(?SessionStorageInterface $storage): void
    {
        $this->storage = $storage;
    }

    protected function checkInitStorage()
    {
        if ($this->storage instanceof SessionStorageInterface) {
            return;
        }

        $this->storage = $this->createStorage();
    }

    protected function createStorage(): NativeSessionStorage
    {
        return new NativeSessionStorage();
    }
}
