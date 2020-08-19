<?php

namespace MIA3\Template\Service;

use GeorgRinger\News\Domain\Model\Category;
use TYPO3\CMS\Core\Service\AbstractService;

class SerializerService extends AbstractService
{
    public static function serializePage(array $page): array
    {
        return [
            'uid' => $page['uid'],
            'title' => $page['title'],
        ];
    }

    public static function serializeCategory(Category $category): array
    {
        return [
            'uid' => $category->getUid(),
            'title' => $category->getTitle(),
        ];
    }
}
