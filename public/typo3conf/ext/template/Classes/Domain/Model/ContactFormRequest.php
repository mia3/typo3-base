<?php
namespace Mia3\Template\Domain\Model;


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
     * @Validate("Text")
     */
    private $comment;

    /**
     * @var string
     */
    private $additionalInformation='';


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
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
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


    public function isHoneyPotHit(){
        return $this->getAdditionalInformation() !== '';
    }


}