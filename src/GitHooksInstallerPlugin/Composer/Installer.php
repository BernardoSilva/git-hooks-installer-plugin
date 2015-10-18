<?php

namespace BernardoSilva\GitHooksInstallerPlugin\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    /**
     * List of supported package types for this plugin.
     * View all available types: https://github.com/composer/composer/blob/master/doc/04-schema.md#type
     *
     * @var array
     */
    public static $supportedTypes = [
        'git-hook',
        'library'
    ];

    /**
     * {@inheritdoc}
     */
    public function supports( $packageType )
    {
        return in_array($packageType, self::$supportedTypes);
    }

    /**
     * Determines the install path for git hooks,
     *
     * The installation path is the standard git hooks directory documented here:
     * https://git-scm.com/book/en/v2/Customizing-Git-Git-Hooks
     *
     * @param PackageInterface $package
     *
     * @return string a path relative to the root of the composer.json that is being installed.
     */
    public function getInstallPath(PackageInterface $package)
    {
        if(!$this->supports($package->getType())) {
            throw new \InvalidArgumentException(
                'Unable to install package, git-hook packages only '
                .'support "git-hook", "library" type packages.'
            );
        }

        // Allow to LibraryInstaller to resolve the installPath for other packages.
        if($package->getType() !== 'git-hook'){
            return parent::getInstallPath($package);
        }

        return $this->getGitHooksPath();
    }

    /**
     * Return the git hooks path.
     */
    protected function getGitHooksPath()
    {
        return '.git/hooks';
    }
}