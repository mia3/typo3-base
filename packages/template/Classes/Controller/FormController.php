<?php

namespace MIA3\Template\Controller;

use MIA3\Template\Domain\Model\ContactFormRequest;
use Symfony\Component\Mime\Address;
use Throwable;
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
            $feedback = $this->getFeedback($formData, 'ContactFormFeedback');
            $status = [
                'code' => '',
                'message' => '',
            ];

            // Send mail
            if ($formData->isHoneypotHit()) {
                // Form was probably submitted by a bot.
                $status = [
                    'code' => 'HONEYPOT_TEST_FAIL',
                    'message' => 'Form was probably submitted by a bot.',
                ];
            } else {
                // Form was probably submitted by a user. Try to send email.
                try {
                    GeneralUtility::makeInstance(Mailer::class)->send($email);

                    // Email (probably) sent successfully.
                    $status = [
                        'code' => 'EMAIL_SENT',
                        'message' => 'Form was probably submitted by a bot.',
                    ];
                } catch (Throwable $t) {
                    // Sending email caused an exception. Send error status.
                    $status = [
                        'code' => 'EMAIL_NOT_SENT',
                        'message' => $t->getMessage(),
                    ];
                }
            }

            // Status variable for the response template
            $feedback->assign('status', $status);

            // Output feedback to user
            echo $feedback->render();
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

        /** @var FluidEmail $email */
        $email = GeneralUtility::makeInstance(FluidEmail::class);
        $email
            ->to($this->getTo())
            ->from($this->getFrom())
            ->subject($subject)
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
