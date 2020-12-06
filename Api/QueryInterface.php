<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\Api;

use Opengento\Document\Model\ResourceModel\Document\Collection;

/**
 * @api
 */
interface QueryInterface
{
    public function getTerm(): string;

    public function getDocumentTypeIds(): array;

    public function getResults(): Collection;

    public function hasError(): bool;

    public function getErrorMessage(): string;
}
