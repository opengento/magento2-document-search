<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\ViewModel\Search;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\Document\Model\ResourceModel\Document\Collection;
use Opengento\DocumentSearch\Api\QueryInterface;

final class Result implements ArgumentInterface
{
    /**
     * @var QueryInterface
     */
    private $query;

    public function __construct(
        QueryInterface $query
    ) {
        $this->query = $query;
    }

    public function getResults(): Collection
    {
        return $this->query->getResults();
    }
}
