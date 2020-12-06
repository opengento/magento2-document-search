<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\ViewModel\Search;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Opengento\DocumentSearch\Api\QueryInterface;
use function in_array;

final class Term implements ArgumentInterface
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

    public function getTerm(): string
    {
        return $this->query->getTerm();
    }

    public function isChecked(int $documentTypeId): bool
    {
        return in_array($documentTypeId, $this->query->getDocumentTypeIds(), true);
    }
}
