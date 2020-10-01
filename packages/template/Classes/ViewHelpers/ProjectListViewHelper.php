<?php

namespace MIA3\Template\ViewHelpers;

use Closure;
use GeorgRinger\News\Domain\Model\Category;
use GeorgRinger\News\Domain\Repository\CategoryRepository;
use MIA3\Template\Service\SerializerService;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class ProjectListViewHelper extends AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('slides', 'array', 'Mask Slides');
    }

    /**
     * Applies nl2br() on the specified value.
     *
     * @param array $arguments
     * @param Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $categoryRepository = $objectManager->get(CategoryRepository::class);

        /** @var PageRepository $pageRepository */
        $pageRepository = $objectManager->get(PageRepository::class);

        $tree = $categoryRepository->findTree([1, 2]);
        $vueFriendlyCategories = [];
        $vueFriendlyPages = [];

        foreach ($pageRepository->getMenu(9) as $page) {
            $vueFriendlyPages[] = [
                'uid' => $page['uid'],
                'title' => $page['title'],
            ];
        }

        foreach ($tree as $branch) {
            /** @var Category $category */
            $category = $branch['item'];
            $children = [];

            $vueFriendlyCategory = SerializerService::serializeCategory($category);

            if ($branch['children']) {
                foreach ($branch['children'] as $child) {
                    $children[] = $child['item'];
                }

                $vueFriendlyCategory['children'] = array_map(SerializerService::class.'::serializeCategory', $children);
            }

            $vueFriendlyCategories[] = $vueFriendlyCategory;
        }

        return json_encode(
            [
                'categories' => $vueFriendlyCategories,
                'projects' => $vueFriendlyPages,
            ]
        );
    }

    public static function serializeCategory(Category $category): array
    {
        return [
            'uid' => $category->getUid(),
            'title' => $category->getTitle(),
        ];
    }
}
