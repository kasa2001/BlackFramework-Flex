<?php


namespace BlackFramework\Flex\Composer;

use Composer\Composer;
use Composer\Downloader\FileDownloader;
use Composer\IO\IOInterface;
use Composer\Package\Package;
use Composer\Plugin\PluginInterface;

class Initialize implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {

        $manager = new FileDownloader($io, $composer->getConfig());

        try {
            $manager->download(
                new Package(
                    "blackframework\\website-files",
                    "*",
                    "*"
                ),
                "src"
            );
        } catch (\InvalidArgumentException $e) {
            echo $e->getMessage();
        } catch (\Throwable $e) {
            echo "Undefined exception: " . $e->getMessage();
            die(255);
        }

    }

}
