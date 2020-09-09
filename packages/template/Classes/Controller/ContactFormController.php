<?php

namespace MIA3\Template\Controller;

use MIA3\Template\Domain\Model\ContactFormRequest;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Fluid\View\StandaloneView;

class ContactFormController extends ActionController
{

    /**
     * @param ContactFormRequest|null $contact
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function submitAction(ContactFormRequest $contactFormRequest = null){
        if($contactFormRequest){
            $flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
            $settings = $flexFormService->convertFlexFormContentToArray($this->configurationManager->getContentObject()->data["pi_flexform"]);
            $this->sendEmail($contactFormRequest, $settings["settings"]);
            if($this->request->getArgument("redirect")){
                $this->redirectToUri($this->request->getArgument("redirect"));
            }

        }
        $this->view->assign("contact", $contactFormRequest ? $contactFormRequest : new ContactFormRequest());
    }

    protected function sendEmail(ContactFormRequest $contact, array $pluginSettings){
        if($contact->isHoneyPotHit()){ return;}
        $settings = $this->getExtensionSettings("template");
        $from = !!$pluginSettings["email"]["fromAlias"] ? array($pluginSettings["email"]["from"] => $pluginSettings["email"]["fromAlias"]) : $pluginSettings["email"]["from"];
        /** @var MailMessage $mail */
        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail
            ->setFrom($from)
            ->setTo($pluginSettings["email"]["to"])
            ->setSubject(array_key_exists("subject", $pluginSettings["email"]) ? $pluginSettings["email"]["subject"] : $settings["contactForm"]["subject"])
            ->html($this->renderEMailView(["contact" => $contact]))
            ->send();
    }


    private function renderEMailView($variables){
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
        $emailView = $this->objectManager->get(StandaloneView::class);
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, "template");
        $layoutRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['layoutRootPaths'][0]);
        $partialRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPaths'][0]);
        $templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPaths'][0]);
        $emailView->setLayoutRootPaths(array($layoutRootPath));
        $emailView->setPartialRootPaths(array($partialRootPath));
        $emailView->setTemplatePathAndFilename($templateRootPath.'ContactForm/Submission.html');
        $emailView->assignMultiple($variables);
        return $emailView->render();
    }
    private function getExtensionSettings($extensionName=''){
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,$extensionName);
        return  $extbaseFrameworkConfiguration;
    }

}
