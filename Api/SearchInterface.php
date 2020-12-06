<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\Api;

use Magento\Framework\Exception\LocalizedException;
use Opengento\Document\Model\ResourceModel\Document\Collection;

/**
 * @api
 */
interface SearchInterface
{
    public const QUERY_VAR_NAME = 'q';

    /**
     * @inheritdoc
     * @throws LocalizedException
     */
    public function search(string $term, array $documentTypeIds): Collection;
}
