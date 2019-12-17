<?php


namespace BlackFramework\Flex\Composer;

use BlackFramework\Flex\Composer\Model\Json;

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
            "blackframework/website-files",
            "master",
            "master"
        );

        $package->setDistUrl("https://github.com/kasa2001/BlackFrameowrk-WebsiteFiles/archive/master.zip");
        $package->setDistType('zip');

        $package->setSourceUrl("https://github.com/kasa2001/BlackFrameowrk-WebsiteFiles.git");
        $package->setSourceType("git");
        $package->setSourceReference('master');


        try {
            $manager->download(
                $package,
                "./"
            );
        } catch (\InvalidArgumentException $e) {
            echo $e->getMessage();
        } catch (\Throwable $e) {
            echo "Undefined exception: " . $e->getMessage();
            die(255);
        }

        $init = new Json();

        $init->type = 'project';
        $init->license = 'proprietary';
        $init->require = [
            "php" => "7.*",
            "blackframework/core" => "1.*",
            "blackframework/routing" => "1.*",
        ];

        $init->autoload = [
            "psr-4" => [
                "App\\\\" => "src/"
            ]
        ];


        $init->autoloadDev = [
            "psr-4" => [
                "Tests\\\\" => "tests/"
            ]
        ];

        var_dump($init);

        file_put_contents("composer.json", json_encode($init));

    }

}
