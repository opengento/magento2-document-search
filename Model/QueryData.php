<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\Model;

/**
 * @api
 */
final class QueryData
{
    /**
     * @var string
     */
    private $term = '';

    /**
     * @var int[]
     */
    private $documentTypeIds = [];

    public function getTerm(): string
    {
        return $this->term;
    }

    public function setTerm(string $term): void
    {
        $this->term = $term;
    }

    public function getDocumentTypeIds(): array
    {
        return $this->documentTypeIds;
    }

    public function setDocumentTypeIds(array $documentTypesIds): void
    {
        $this->documentTypeIds = $documentTypesIds;
    }
}
