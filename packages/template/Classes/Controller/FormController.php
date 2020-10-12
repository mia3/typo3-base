<?php

namespace MIA3\Template\Controller;

use MIA3\Template\Domain\Model\ContactFormRequest;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class FormController extends ActionController
{
    /**
     * @param string $view
     *
     * @return string
     */
    public function thankYouAction(string $view): string
    {
        return $view;
    }

    public function contactFormAction(ContactFormRequest $formData = null): void
    {
        if ($formData) {
            // Send mail
            $email = $this->getEmail($formData, 'ContactForm');
            GeneralUtility::makeInstance(Mailer::class)->send($email);

            // Redirect so the form cannot be submitted twice.
            $this->redirect('thankYou', null, null, ['view' => $email->getHtmlBody()]);
        }

        $this->view->assign('contactFormRequest', new ContactFormRequest);
    }

    protected function getEmail(ContactFormRequest $formData, string $templateName): FluidEmail
    {
        $to = $this->settings['email']['to'];
        $from = !empty($this->settings['email']['fromAlias'])
            ? new Address($this->settings['email']['from'], $this->settings['email']['fromAlias'])
            : new Address($this->settings['email']['from']);
        $subject = $this->settings['email']['subject'];

        /** @var FluidEmail $email */
        $email = GeneralUtility::makeInstance(FluidEmail::class);
        $email
            ->to($to)
            ->from($from)
            ->subject($subject)
            ->format('html') // only HTML mail
            ->setTemplate($templateName)
            ->assign('formData', $formData);

        return $email;
    }
}
