<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\Model;

use Magento\Framework\Data\CollectionModifierInterface;
use Magento\Framework\DB\Helper;
use Opengento\Document\Model\ResourceModel\Document\Collection;
use Opengento\Document\Model\ResourceModel\Document\CollectionFactory;
use Opengento\DocumentSearch\Api\SearchInterface;

final class FullSearch implements SearchInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionModifierInterface
     */
    private $collectionModifier;

    /**
     * @var Helper
     */
    private $dbHelper;

    public function __construct(
        CollectionFactory $collectionFactory,
        CollectionModifierInterface $collectionModifier,
        Helper $dbHelper
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->collectionModifier = $collectionModifier;
        $this->dbHelper = $dbHelper;
    }

    public function search(string $term, array $documentTypeIds): Collection
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        if ($term) {
            $collection = $this->applyTerm($collection, $term);
        }
        if ($documentTypeIds) {
            $collection->addFieldToFilter('type_id', ['in' => $documentTypeIds]);
        }

        $this->collectionModifier->apply($collection);
        $collection->getSelect()->group('main_table.entity_id');
        $collection->distinct(true);

        return $collection;
    }

    private function applyTerm(Collection $documentCollection, string $term): Collection
    {
        $term = $this->dbHelper->escapeLikeValue($term, ['position' => 'any']);
        $filters = [
            'fields' => [
                'main_table.code',
                'main_table.name',
                'main_table.file_name',
                'main_table.description',
            ],
            'conditions' => [
                ['like' => $term],
                ['like' => $term],
                ['like' => $term],
                ['like' => $term],
            ]
        ];
        $documentCollection->addFieldToFilter($filters['fields'], $filters['conditions']);

        return $documentCollection;
    }
}
