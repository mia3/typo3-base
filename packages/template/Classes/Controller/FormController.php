<?php

namespace MIA3\Template\Controller;

use MIA3\Template\Domain\Model\ContactFormRequest;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class FormController extends ActionController
{
    public function contactFormAction(ContactFormRequest $formData = null): void
    {
        if ($formData) {
            $email = $this->getEmail($formData, 'ContactForm');

            // Send mail
            if (!$formData->isHoneypotHit()) {
                try {
                GeneralUtility::makeInstance(Mailer::class)->send($email);
                }
                catch (\Exception $exception) {
                    dd($exception);
                }
            }

            // Output feedback to user
            $feedbackView = $this->getFeedback($formData, 'ContactFormFeedback');
            header('Content-Type: application/json');
            echo json_encode(['html' => $feedbackView->render()]);
            exit(0);
        }

        $this->view->assign('contactFormRequest', new ContactFormRequest);
    }

    protected function getEmail(ContactFormRequest $formData, string $templateName): FluidEmail
    {
        $context = Environment::getContext();
        $subjectPrefix = $context->isProduction() ? '' : "[$context]";
        $subjectSuffix = '('.$this->getPageTitle().')';
        $subject = $subjectPrefix.' '.$this->settings['email']['subject'].' '.$subjectSuffix;

        $email = new FluidEmail;
        $email
            ->to($this->getTo())
            ->from($this->getFrom())
            ->format('html') // only HTML mail
            ->setTemplate($templateName)
            ->assignMultiple(
                [
                    'formData' => $formData,
                    'subject' => $subject,
                ]
            );

        return $email;
    }

    protected function getFeedback(ContactFormRequest $formData, string $templateName): StandaloneView
    {
        $view = new StandaloneView;
        $view->setControllerContext($this->getControllerContext());
        $view->setTemplate($templateName);
        $view->assign('formData', $formData);

        return $view;
    }

    protected function getFrom(): Address
    {
        /** @var TypoScriptFrontendController $frontendController */
        $frontendController = $GLOBALS['TSFE'];
        $host = $frontendController->getSite()->getBase()->getHost();

        return new Address("typo3@$host", $this->getPageTitle());
    }

    protected function getTo(): Address
    {
        return new Address($this->settings['email']['to'], $this->settings['email']['toAlias']);
    }

    protected function getPageTitle()
    {
        /** @var TypoScriptFrontendController $frontendController */
        $frontendController = $GLOBALS['TSFE'];

        return $frontendController->generatePageTitle();
    }
}
