<?php

namespace MIA3\Template\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;

class ContactFormRequest
{
    /**
     * @var string
     * @Validate("Text")
     */
    private $name;

    /**
     * @var string
     * @Validate("EmailAddress")
     * @Validate("NotEmpty")
     */
    private $email;

    /**
     * @var string
     * @Validate("NotEmpty")
     */
    private $subject;

    /**
     * @var string
     * @Validate("Text")
     */
    private $message;

    /**
     * @var string
     */
    private $additionalInformation = '';

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return ContactFormRequest
     */
    public function setSubject(string $subject): ContactFormRequest
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getAdditionalInformation(): string
    {
        return $this->additionalInformation;
    }

    /**
     * @param string $additionalInformation
     */
    public function setAdditionalInformation(string $additionalInformation): void
    {
        $this->additionalInformation = $additionalInformation;
    }

    public function isHoneyPotHit(): bool
    {
        return $this->getAdditionalInformation() !== '';
    }
}
