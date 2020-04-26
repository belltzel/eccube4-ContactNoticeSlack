<?php
namespace Plugin\ContactNoticeSlack;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\ContactNoticeSlack\Entity\Config;
use Plugin\ContactNoticeSlack\Repository\ConfigRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager
{

    public function enable(array $meta, ContainerInterface $container)
    {
        $em = $container->get('doctrine.orm.entity_manager');

        // プラグイン設定を追加
        $this->createConfig($em);

    }

    protected function createConfig(EntityManagerInterface $em)
    {
        $Config = $em->find(Config::class, 1);
        if ($Config) {
            return $Config;
        }
        $Config = new Config();

        $em->persist($Config);
        $em->flush($Config);
    }

}
