<?php

namespace BernardoSilva\GitHooksInstallerPlugin\Composer;

use Composer\Installer\InstallationManager;
use Composer\Composer;
use Composer\Config;
use Composer\IO\IOInterface;
use Composer\Util\Loop;
use PHPUnit\Framework\TestCase;

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

        $loop = $this->getMockBuilder(Loop::class)->disableOriginalConstructor()->getMock();
        $this->io = $this->getMock(IOInterface::class);

        $this->composer->setInstallationManager(new InstallationManager($loop, $this->io));
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
