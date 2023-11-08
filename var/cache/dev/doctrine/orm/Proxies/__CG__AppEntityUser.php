<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \App\Entity\User implements \Doctrine\ORM\Proxy\InternalProxy
{
     use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'email' => [parent::class, 'email', null],
        "\0".parent::class."\0".'fname' => [parent::class, 'fname', null],
        "\0".parent::class."\0".'id' => [parent::class, 'id', null],
        "\0".parent::class."\0".'lname' => [parent::class, 'lname', null],
        "\0".parent::class."\0".'password' => [parent::class, 'password', null],
        "\0".parent::class."\0".'ratings' => [parent::class, 'ratings', null],
        "\0".parent::class."\0".'reports' => [parent::class, 'reports', null],
        "\0".parent::class."\0".'reviewRatings' => [parent::class, 'reviewRatings', null],
        "\0".parent::class."\0".'roles' => [parent::class, 'roles', null],
        'email' => [parent::class, 'email', null],
        'fname' => [parent::class, 'fname', null],
        'id' => [parent::class, 'id', null],
        'lname' => [parent::class, 'lname', null],
        'password' => [parent::class, 'password', null],
        'ratings' => [parent::class, 'ratings', null],
        'reports' => [parent::class, 'reports', null],
        'reviewRatings' => [parent::class, 'reviewRatings', null],
        'roles' => [parent::class, 'roles', null],
    ];

    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {
        if ($cloner !== null) {
            return;
        }

        self::createLazyGhost($initializer, [
            "\0".parent::class."\0".'id' => true,
        ], $this);
    }

    public function __isInitialized(): bool
    {
        return isset($this->lazyObjectState) && $this->isLazyObjectInitialized();
    }

    public function __serialize(): array
    {
        $properties = (array) $this;
        unset($properties["\0" . self::class . "\0lazyObjectState"], $properties['__isCloning']);

        return $properties;
    }
}
