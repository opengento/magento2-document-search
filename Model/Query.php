<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\Model;

use Magento\Framework\Exception\LocalizedException;
use Opengento\Document\Model\ResourceModel\Document\Collection;
use Opengento\Document\Model\ResourceModel\Document\CollectionFactory;
use Opengento\DocumentSearch\Api\QueryInterface;
use Opengento\DocumentSearch\Api\SearchInterface;

final class Query implements QueryInterface
{
    /**
     * @var QueryData
     */
    private $queryData;

    /**
     * @var SearchInterface
     */
    private $search;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var Collection
     */
    private $collection;

    /**
     * @var bool
     */
    private $hasError;

    /**
     * @var string
     */
    private $errorMessage;

    public function __construct(
        QueryData $queryData,
        SearchInterface $search,
        CollectionFactory $collectionFactory
    ) {
        $this->queryData = $queryData;
        $this->search = $search;
        $this->collectionFactory = $collectionFactory;
        $this->hasError = false;
        $this->errorMessage = '';
    }

    public function getTerm(): string
    {
        return $this->queryData->getTerm();
    }

    public function getDocumentTypeIds(): array
    {
        return $this->queryData->getDocumentTypeIds();
    }

    public function getResults(): Collection
    {
        return $this->loadCollection();
    }

    public function hasError(): bool
    {
        $this->loadCollection();

        return $this->hasError;
    }

    public function getErrorMessage(): string
    {
        $this->loadCollection();

        return $this->errorMessage;
    }

    private function loadCollection(): Collection
    {
        if ($this->collection === null) {
            try {
                $collection = $this->search->search($this->getTerm(), $this->getDocumentTypeIds());
            } catch (LocalizedException $e) {
                $this->hasError = true;
                $this->errorMessage = $e->getMessage();
                /** @var Collection $collection */
                $collection = $this->collectionFactory->create();
                $collection->addFieldToFilter('entity_id', -1);
            }
            $this->collection = $collection;
        }

        return $this->collection;
    }
}
