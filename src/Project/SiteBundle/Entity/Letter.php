<?php
//src/Project/SiteBundle/Entity/Letter.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
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
    protected $fullName;
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
    * @ORM\Column(name="letter", type="string", nullable=false);
    **/
    protected $letter;

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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Letter
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
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
     * Set letter
     *
     * @param string $letter
     *
     * @return Letter
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;

        return $this;
    }

    /**
     * Get letter
     *
     * @return string
     */
    public function getLetter()
    {
        return $this->letter;
    }
}
