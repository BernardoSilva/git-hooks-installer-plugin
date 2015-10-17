<?php

namespace BernardoSilva\GitHooksInstallerPlugin\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{

    /**
     * {@inheritdoc}
     */
    public function supports( $packageType )
    {
        return 'git-hook' === $packageType;
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