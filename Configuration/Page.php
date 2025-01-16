<?php

/**
 * This file is part of the SegmentIoBundle project.
 *
 * (c) Vladislav Marin <vladislav.marin92@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT
 */

namespace Farmatholin\SegmentIoBundle\Configuration;

use Doctrine\Common\Annotations\Annotation\Required;

/**
 * Annotation Page
 *
 * @author Vladislav Marin <vladislav.marin92@gmail.com>
 *
 * @Annotation
 * @Target("METHOD")
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
class Page implements AnalyticsInterface
{

    /**
     * @Required
     *
     * @var string
     */
    public string $category;

    /**
     * @Required
     *
     * @var string
     */
    public string $name;

    /**
     * @var array
     */
    public array $properties = [];

    /**
     * @param string $category
     */
    public function __construct(
        $category = null,
        ?string $name = null,
        array $properties = []
    ) {
        if (is_array($category)) {
            // Doctrine annotation
            $this->category = $category['category'];
            $this->name = $category['name'];
            $this->properties = $category['properties'] ?? $this->properties;
        } else {
            // PHP Attributes
            $this->category = $category;
            $this->name = $name;
            $this->properties = $properties;
        }
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     *
     * @return $this
     */
    public function setCategory(string $category): Page
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): Page
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     */
    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function getMessage(): array
    {
        return [
            'name' => $this->name,
            'category' => $this->category,
            'properties' => $this->properties,
        ];
    }
}
