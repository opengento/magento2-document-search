<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\Block\Widget;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Opengento\DocumentWidget\ViewModel\DocumentType as DocumentTypeViewModel;
use Opengento\DocumentSearch\ViewModel\Search\Term as SearchViewModel;
use function array_merge;
use function array_unique;

class Search extends Template implements BlockInterface, IdentityInterface
{
    /**
     * @var SearchViewModel
     */
    private $termViewModel;

    /**
     * @var DocumentTypeViewModel
     */
    private $documentTypeViewModel;

    public function __construct(
        Template\Context $context,
        DocumentTypeViewModel $documentTypeViewModel,
        SearchViewModel $termViewModel,
        array $data = []
    ) {
        $this->documentTypeViewModel = $documentTypeViewModel;
        $this->termViewModel = $termViewModel;
        parent::__construct($context, $data);
    }

    public function getIdentities(): array
    {
        $identities = [[]];

        foreach ($this->documentTypeViewModel->getList() as $documentType) {
            if ($documentType instanceof IdentityInterface) {
                $identities[] = $documentType->getIdentities();
            }
        }

        return array_unique(array_merge(...$identities));
    }

    protected function _beforeToHtml(): Search
    {
        if (!$this->hasData('documentTypeViewModel')) {
            $this->setData('documentTypeViewModel', $this->documentTypeViewModel);
        }
        if (!$this->hasData('termViewModel')) {
            $this->setData('termViewModel', $this->termViewModel);
        }
        if (!$this->hasData('actionUrl')) {
            $this->setData('actionUrl', $this->getUrl('document/search/result'));
        }

        return parent::_beforeToHtml();
    }
}
