<?php

namespace BernardoSilva\GitHooksInstallerPlugin\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

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

    private $supportedHooks = [
        'applypatch-msg',
        'pre-applypatch',
        'post-applypatch',
        'pre-commit',
        'prepare-commit-msg',
        'commit-msg',
        'post-commit',
        'pre-rebase',
        'post-checkout',
        'post-merge',
        'pre-push',
        'pre-receive',
        'update',
        'post-receive',
        'post-update',
        'push-to-checkout',
        'pre-auto-gc',
        'post-rewrite',
        'sendemail-validate'
    ];

    /**
     * {@inheritdoc}
     */
    public function supports($packageType)
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
        if (!$this->supports($package->getType())) {
            throw new \InvalidArgumentException(
                'Unable to install package, git-hook packages only '
                .'support "git-hook", "library" type packages.'
            );
        }

        // Allow to LibraryInstaller to resolve the installPath for other packages.
        if ($package->getType() !== 'git-hook') {    
            return parent::getInstallPath($package);
        }

        return $this->getHooksInstallationPath();
    }

    /**
     * Install the plugin to the git hooks path
     *
     * Note: This method installs the plugin into a temporary directory and then only copy the git-hook
     * related files into the git hooks directory to avoid colision with other plugins.
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::install($repo, $package);
        foreach ($this->getSupportedHooks() as $gitHookName) {
            $installedHookFilePath = $this->getInstallPath($package) . DIRECTORY_SEPARATOR .$gitHookName; 
            
            if (file_exists($installedHookFilePath)) {
                $hookDestinationPath = $this->getGitHooksPath() . DIRECTORY_SEPARATOR . $gitHookName;
                copy($installedHookFilePath, $hookDestinationPath);
                chmod($hookDestinationPath, '0755');
            }
        }

        // clean up temporary data
        exec('rm -rf '. $this->getHooksInstallationPath());
    }

    /**
     * Return the git hooks path.
     */
    protected function getGitHooksPath()
    {
        return '.git/hooks';
    }

    protected function getHooksInstallationPath()
    {
        return '.git/hooks/.GitHooksInstallerPlugin';
    }

    /**
     * @return array
     */
    private function getSupportedHooks()
    {
        return $this->supportedHooks;
    }
}
