<?php


namespace BlackFramework\Flex\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Package\Package;
use Composer\Plugin\PluginInterface;

class Initialize implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {

        $manager = $composer->getDownloadManager();

        $package = new Package(
            "blackframework\\website-files",
            "1.0",
            "1.0"
        );
        $package->setDistUrl("https://github.com/kasa2001/BlackFrameowrk-WebsiteFiles.git");
        $package->setDistType('git');

        $package->setSourceUrl("https://github.com/kasa2001/BlackFrameowrk-WebsiteFiles.git");
        $package->setSourceType("git");

        try {
            $manager->download(
                $package,
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
