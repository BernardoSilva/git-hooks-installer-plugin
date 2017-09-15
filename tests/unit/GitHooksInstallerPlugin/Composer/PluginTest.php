<?php

namespace BernardoSilva\GitHooksInstallerPlugin\Composer;

use Composer\Installer\InstallationManager;
use Composer\TestCase;
use Composer\Composer;
use Composer\Config;

class PluginTest extends TestCase
{
    /**
     * @var Composer
     */
    protected $composer;
    protected $config;
    protected $io;

    protected function setUp()
    {
        $this->composer = new Composer();
        $this->config = new Config();
        $this->composer->setConfig($this->config);
        $this->composer->setInstallationManager(new InstallationManager());
        $this->io = $this->getMock('Composer\IO\IOInterface');
    }

    public function testActivateAddsInstallerSuccessfully()
    {
        $plugin = new Plugin();
        $plugin->activate($this->composer, $this->io);
        $installer = $this->composer->getInstallationManager()->getInstaller('git-hook');

        // Ensure the installer was added.
        $this->assertInstanceOf('BernardoSilva\GitHooksInstallerPlugin\Composer\Installer', $installer);
    }
}
