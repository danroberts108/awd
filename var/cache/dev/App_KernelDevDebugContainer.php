<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXxXWpxc\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXxXWpxc/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerXxXWpxc.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerXxXWpxc\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerXxXWpxc\App_KernelDevDebugContainer([
    'container.build_hash' => 'XxXWpxc',
    'container.build_id' => 'f3c55496',
    'container.build_time' => 1698915917,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerXxXWpxc');
