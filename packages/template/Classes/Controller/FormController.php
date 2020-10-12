<?php

namespace MIA3\Template\Controller;

use MIA3\Template\Domain\Model\ContactFormRequest;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Fluid\View\StandaloneView;

class FormController extends ActionController
{
    /**
     * @param ContactFormRequest|null $formData
     * @throws NoSuchArgumentException
     * @throws StopActionException
     */
    public function contactFormAction(ContactFormRequest $formData = null)
    {
        if ($formData) {
            /** @var FlexFormService $flexFormService */
            $flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
            $settings = $flexFormService->convertFlexFormContentToArray(
                $this->configurationManager->getContentObject()->data['pi_flexform']
            );
            $this->sendEmail($formData, $settings['settings']);
            if ($this->request->getArgument('redirect')) {
                $this->redirectToUri($this->request->getArgument('redirect'));
            }

        }
        $this->view->assign('contact', $formData ? $formData : new ContactFormRequest());
    }

    protected function sendEmail(ContactFormRequest $contact, array $pluginSettings)
    {
        if ($contact->isHoneyPotHit()) {
            return;
        }

        $settings = $this->getExtensionSettings('template');
        $from = !!$pluginSettings['email']['fromAlias']
            ? [$pluginSettings['email']['from'] => $pluginSettings['email']['fromAlias']]
            : $pluginSettings['email']['from'];

        /** @var MailMessage $mail */
        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail
            ->setFrom($from)
            ->setTo($pluginSettings['email']['to'])
            ->setSubject(
                array_key_exists(
                    'subject',
                    $pluginSettings['email']
                ) ? $pluginSettings['email']['subject'] : $settings['contactForm']['subject']
            )
            ->html($this->renderEMailView(['contact' => $contact]))
            ->send();
    }


    private function renderEMailView($variables)
    {
        /** @var StandaloneView $emailView */
        $emailView = $this->objectManager->get(StandaloneView::class);
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
            'template'
        );
        $layoutRootPath = GeneralUtility::getFileAbsFileName(
            $extbaseFrameworkConfiguration['view']['layoutRootPaths'][0]
        );
        $partialRootPath = GeneralUtility::getFileAbsFileName(
            $extbaseFrameworkConfiguration['view']['partialRootPaths'][0]
        );
        $templateRootPath = GeneralUtility::getFileAbsFileName(
            $extbaseFrameworkConfiguration['view']['templateRootPaths'][0]
        );
        $emailView->setLayoutRootPaths([$layoutRootPath]);
        $emailView->setPartialRootPaths([$partialRootPath]);
        $emailView->setTemplatePathAndFilename($templateRootPath.'Form/ContactFormEmail.html');
        $emailView->assignMultiple($variables);

        return $emailView->render();
    }

    private function getExtensionSettings($extensionName = '')
    {
        return $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            $extensionName
        );
    }
}
