<?php

namespace App\Twig;

use League\Glide\Signatures\SignatureFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    /** @var UrlGeneratorInterface */
    private $router;

    /** @var string */
    private $secret;

    public function __construct(UrlGeneratorInterface $router, string $secret)
    {
        $this->router = $router;
        $this->secret = $secret;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('app_asset', [$this, 'appAsset'], ['is_safe' => ['html']]),
        ];
    }

    public function appAsset(string $path, array $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        $parameters['fm'] = 'pjpg';

        if ('png' === substr($path, -3)) {
            $parameters['fm'] = 'png';
        }

        $parameters['s'] = SignatureFactory::create($this->secret)->generateSignature($path, $parameters);
        $parameters['path'] = ltrim($path, '/');

        return $this->router->generate('asset_url', $parameters, $referenceType);
    }
}