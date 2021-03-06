<?php
//src/Project/SiteBundle/Entity/Letter.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

/**
* @ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\LetterRepository")
* @ORM\Table(name="letter")
* @ORM\HasLifecycleCallbacks
*/

class Letter
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
    * @ORM\Column(name="fullname", type="string", nullable=false);
    **/
    protected $fullname;
    /**
    * @ORM\Column(name="phone", type="string", nullable=false);
    **/
    protected $phone;
    /**
    * @ORM\Column(name="email", type="string", nullable=false);
    **/
    protected $email;
    /**
    * @ORM\Column(name="theme", type="string", nullable=false);
    **/
    protected $theme;
    /**
    * @ORM\Column(name="content", type="text", nullable=false);
    **/
    protected $content;
      /**
    * @ORM\Column(name="created", type="datetime", nullable=false);
    **/
    protected $created;

         public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('fullname', new NotBlank());
        $metadata->addPropertyConstraint('phone', new NotBlank());
        $metadata->addPropertyConstraint('email', new Email());
        $metadata->addPropertyConstraint('theme', new NotBlank());
        $metadata->addPropertyConstraint('content', new NotBlank());
     }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return Letter
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Letter
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Letter
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Letter
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Letter
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Letter
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
