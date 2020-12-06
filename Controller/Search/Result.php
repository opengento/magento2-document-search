<?php
/**
 * Copyright © OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\DocumentSearch\Controller\Search;

use Exception;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Phrase;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Theme\Block\Html\Breadcrumbs;
use Opengento\DocumentSearch\Api\QueryInterface;
use Opengento\DocumentSearch\Api\SearchInterface;
use Opengento\DocumentSearch\Model\QueryData;
use function array_map;

class Result implements HttpGetActionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @var QueryData
     */
    private $queryData;

    /**
     * @var QueryInterface
     */
    private $query;

    public function __construct(
        RequestInterface $request,
        ManagerInterface $messageManager,
        PageFactory $pageFactory,
        UrlInterface $urlBuilder,
        QueryData $queryData,
        QueryInterface $query
    ) {
        $this->request = $request;
        $this->messageManager = $messageManager;
        $this->pageFactory = $pageFactory;
        $this->urlBuilder = $urlBuilder;
        $this->queryData = $queryData;
        $this->query = $query;
    }

    public function execute()
    {
        $this->queryData->setTerm($this->request->getParam(SearchInterface::QUERY_VAR_NAME, ''));
        $this->queryData->setDocumentTypeIds(array_map('\intval', (array) $this->request->getParam('types')));

        try {
            if ($this->query->hasError()) {
                $this->messageManager->addErrorMessage($this->query->getErrorMessage());
            }
        } catch (Exception $e) {
            $this->messageManager->addExceptionMessage($e, new Phrase('Please try an other search term.'));
        }

        $title = $this->queryData->getTerm()
            ? new Phrase('Search results for: \'%1\'', [$this->queryData->getTerm()])
            : new Phrase('Search result for documents');

        return $this->createPageResult($title);
    }

    private function createPageResult(Phrase $title): ResultInterface
    {
        $pageResult = $this->pageFactory->create();
        $pageResult->getConfig()->getTitle()->set($title);

        /** @var Breadcrumbs $breadcrumbs */
        $breadcrumbs = $pageResult->getLayout()->getBlock('breadcrumbs');
        if ($breadcrumbs) {
            $breadcrumbs->addCrumb(
                'home',
                [
                    'label' => new Phrase('Home'),
                    'title' => new Phrase('Go to Home Page'),
                    'link' => $this->urlBuilder->getBaseUrl(),
                ]
            )->addCrumb(
                'search',
                ['label' => $title, 'title' => $title]
            );
        }

        return $pageResult;
    }
}
