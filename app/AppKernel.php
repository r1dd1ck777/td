<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new App\MainBundle\AppMainBundle(),
            new App\AdminBundle\AppAdminBundle(),
        );

        if ($this->getEnvironment() != 'light') {
            $bundles = array_merge($bundles, array(
                new FOS\UserBundle\FOSUserBundle(),
                new FOS\RestBundle\FOSRestBundle(),
                new JMS\SerializerBundle\JMSSerializerBundle($this),
                new Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),
                new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),

                new Rid\Bundle\PageBundle\RidPageBundle(),
                new Rid\Bundle\ImageBundle\RidImageBundle(),
                // doctrine
                new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
                new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
                new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
                // admin
                new Knp\Bundle\MenuBundle\KnpMenuBundle(),
                new Sonata\BlockBundle\SonataBlockBundle(),
                new Sonata\jQueryBundle\SonatajQueryBundle(),
                new Sonata\AdminBundle\SonataAdminBundle(),
                new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
                new Sonata\FormatterBundle\SonataFormatterBundle(),
                new Sonata\MarkItUpBundle\SonataMarkItUpBundle(),
                new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
                new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
                // media
                new Sonata\MediaBundle\SonataMediaBundle(),
                new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
                new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
                // seo
                new Sonata\SeoBundle\SonataSeoBundle(),
            ));

            if (in_array($this->getEnvironment(), array('dev', 'test'))) {
                $bundles = array_merge($bundles, array(
                    new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle(),
                    new Sensio\Bundle\DistributionBundle\SensioDistributionBundle(),
                    new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle()
                ));
            }
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
