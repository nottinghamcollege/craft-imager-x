<?php
/**
 * Imager X plugin for Craft CMS
 *
 * Ninja powered image transforms.
 *
 * @link      https://www.spacecat.ninja
 * @copyright Copyright (c) 2020 André Elvan
 */

namespace spacecatninja\imagerx\variables;

use Craft;

use spacecatninja\imagerx\helpers\NamedTransformHelpers;
use spacecatninja\imagerx\ImagerX as Plugin;
use spacecatninja\imagerx\services\ImagerColorService;
use spacecatninja\imagerx\services\ImagerService;
use spacecatninja\imagerx\exceptions\ImagerException;
use craft\elements\Asset;

class ImagerVariable
{
    /**
     * Transforms an image
     *
     * @param Asset|string $file
     * @param array|string $transforms
     * @param array $transformDefaults
     * @param array $configOverrides
     *
     * @return mixed
     *
     * @throws ImagerException
     */
    public function transformImage($file, $transforms, $transformDefaults = null, $configOverrides = null)
    {
        $image = Plugin::$plugin->imagerx->transformImage($file, $transforms, $transformDefaults, $configOverrides);
        return $image;
    }

    /**
     * Takes an array of models that supports getUrl() and getWidth(), and returns a srcset
     * and returns a srcset string
     *
     * @param array $images
     * @param string $descriptor
     *
     * @return string
     */
    public function srcset($images, $descriptor = 'w'): string
    {
        return Plugin::$plugin->imagerx->srcset($images, $descriptor);
    }

    /**
     * Returns a base64 encoded transparent pixel.
     *
     * @param int $width
     * @param int $height
     * @param string $color
     *
     * @return string
     */
    public function base64Pixel($width = 1, $height = 1, $color = 'transparent'): string
    {
        return 'data:image/svg+xml;charset=utf-8,' . rawurlencode("<svg xmlns='http://www.w3.org/2000/svg' width='$width' height='$height' style='background:$color'/>");
    }

    /**
     * Returns an image placeholder.
     *
     * @param array|null $config
     *
     * @return string
     * @throws ImagerException
     */
    public function placeholder($config = null): string
    {
        return Plugin::$plugin->placeholder->placeholder($config);
    }

    /**
     * Gets the dominant color of an image
     *
     * @param Asset|string $image
     * @param string $colorValue
     * @param int $quality
     *
     * @return mixed
     */
    public function getDominantColor($image, $quality = 10, $colorValue = 'hex')
    {
        return Plugin::$plugin->color->getDominantColor($image, $quality, $colorValue);
    }

    /**
     * Gets a palette of colors from an image
     *
     * @param Asset|string $image
     * @param string $colorValue
     * @param int $colorCount
     * @param int $quality
     *
     * @return mixed
     */
    public function getColorPalette($image, $colorCount = 8, $quality = 10, $colorValue = 'hex')
    {
        return Plugin::$plugin->color->getColorPalette($image, $colorCount, $quality, $colorValue);
    }

    /**
     * Converts a hex color value to rgb
     *
     * @param string $color
     *
     * @return array
     */
    public function hex2rgb($color): array
    {
        return ImagerColorService::hex2rgb($color);
    }

    /**
     * Converts a rgb color value to hex
     *
     * @param array $color
     *
     * @return string
     */
    public function rgb2hex($color): string
    {
        return ImagerColorService::rgb2hex($color);
    }

    /**
     * Calculates color brightness (https://www.w3.org/TR/AERT#color-contrast) on a scale from 0 (black) to 255 (white).
     *
     * @param string|array $color
     * @return float
     */
    public function getBrightness($color): float
    {
        return Plugin::$plugin->color->getBrightness($color);
    }

    /**
     * Get the hue channel of a color.
     *
     * @param string|array $color
     * @return float
     */
    public function getHue($color): float
    {
        return Plugin::$plugin->color->getHue($color);
    }

    /**
     * Get the lightness channel of a color
     *
     * @param string|array $color
     * @return float
     */
    public function getLightness($color): float
    {
        return Plugin::$plugin->color->getLightness($color);
    }

    /**
     * Checks brightness($color) >= $threshold. Accepts an optional $threshold float as the last parameter with a default of 127.5.
     *
     * @param string|array $color
     * @param float $threshold
     * @return bool
     */
    public function isBright($color, $threshold = 127.5): bool
    {
        return Plugin::$plugin->color->isBright($color, $threshold);
    }

    /**
     * Checks lightness($color) >= $threshold. Accepts an optional $threshold float as the last parameter with a default of 50.0.
     *
     * @param string|array $color
     * @param int $threshold
     * @return bool
     */
    public function isLight($color, $threshold = 50): bool
    {
        return Plugin::$plugin->color->isLight($color, $threshold);
    }

    /**
     * Checks perceived_brightness($color) >= $threshold. Accepts an optional $threshold float as the last parameter with a default of 127.5.
     *
     * @param string|array $color
     * @param float $threshold
     * @return bool
     */
    public function looksBright($color, $threshold = 127.5): bool
    {
        return Plugin::$plugin->color->looksBright($color, $threshold);
    }

    /**
     * Calculates the perceived brightness (http://alienryderflex.com/hsp.html) of a color on a scale from 0 (black) to 255 (white).
     *
     * @param string|array $color
     * @return float
     */
    public function getPercievedBrightness($color): float
    {
        return Plugin::$plugin->color->getPercievedBrightness($color);
    }

    /**
     * Calculates the relative luminance (https://www.w3.org/TR/WCAG20/#relativeluminancedef) of a color on a scale from 0 (black) to 1 (white).
     *
     * @param string|array $color
     * @return float
     */
    public function getRelativeLuminance($color): float
    {
        return Plugin::$plugin->color->getRelativeLuminance($color);
    }

    /**
     * Get the saturation channel of a color.
     *
     * @param string|array $color
     * @return float
     */
    public function getSaturation($color): float
    {
        return Plugin::$plugin->color->getSaturation($color);
    }

    /**
     * Calculates brightness difference (https://www.w3.org/TR/AERT#color-contrast) on a scale from 0 to 255.
     *
     * @param string|array $color1
     * @param string|array $color2
     * @return float
     */
    public function getBrightnessDifference($color1, $color2): float
    {
        return Plugin::$plugin->color->getBrightnessDifference($color1, $color2);
    }

    /**
     * Calculates color difference (https://www.w3.org/TR/AERT#color-contrast) on a scale from 0 to 765.
     *
     * @param string|array $color1
     * @param string|array $color2
     * @return int
     */
    public function getColorDifference($color1, $color2): int
    {
        return Plugin::$plugin->color->getColorDifference($color1, $color2);
    }

    /**
     * Calculates the contrast ratio (https://www.w3.org/TR/WCAG20/#contrast-ratiodef) between two colors on a scale from 1 to 21.
     *
     * @param string|array $color1
     * @param string|array $color2
     * @return float
     */
    public function getContrastRatio($color1, $color2): float
    {
        return Plugin::$plugin->color->getContrastRatio($color1, $color2);
    }

    /**
     * Checks for server webp support
     *
     * @return bool
     */
    public function serverSupportsWebp(): bool
    {
        return ImagerService::hasSupportForWebP();
    }

    /**
     * Checks for server avif support
     *
     * @return bool
     */
    public function serverSupportsAvif(): bool
    {
        return ImagerService::hasSupportForAvif();
    }

    /**
     * Checks for server jxl support
     *
     * @return bool
     */
    public function serverSupportsJxl(): bool
    {
        return ImagerService::hasSupportForJxl();
    }

    /**
     * Checks for webp support in browser
     *
     * @return bool
     */
    public function clientSupportsWebp(): bool
    {
        return Craft::$app->getRequest()->accepts('image/webp');
    }

    /**
     * Checks if the browser accepts a given format.
     *
     * @param string $format
     * @return bool
     */
    public function clientSupports($format): bool
    {
        if (strpos($format, 'image/') === false) {
            $format = "image/$format";
        }
        
        return Craft::$app->getRequest()->accepts($format);
    }

    /**
     * Checks if asset is animated (only gif support atm)
     *
     * @param Asset|string $asset
     *
     * @return bool
     *
     * @throws ImagerException
     */
    public function isAnimated($asset): bool
    {
        return Plugin::$plugin->imagerx->isAnimated($asset);
    }

    /**
     * Checks if Imgix is enabled
     *
     * @return bool
     */
    public function imgixEnabled(): bool
    {
        return Plugin::$plugin->getSettings()->transformer === 'imgix';
    }
    
    /**
     * Returns transformer handle
     *
     * @return bool
     */
    public function transformer(): bool
    {
        return Plugin::$plugin->getSettings()->transformer;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasNamedTransform($name): bool
    {
        return NamedTransformHelpers::getNamedTransform($name) !== null;
    }
    
    /**
     * @param string $name
     * @return array|null
     */
    public function getNamedTransform($name)
    {
        return NamedTransformHelpers::getNamedTransform($name);
    }
}
