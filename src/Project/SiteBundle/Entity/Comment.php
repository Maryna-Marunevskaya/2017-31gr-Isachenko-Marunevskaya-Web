<?php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
*@ORM\Entity(repositoryClass="Project\SiteBundle\Entity\Repository\CommentRepository")
*@ORM\Table(name="comment")
*@ORM\HasLifecycleCallbacks
**/

class Comment
{
    /**
    *@ORM\Id
    *@ORM\Column(name="id", type="integer")
    *@ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
    *@ORM\Column(name="created", type="datetime", nullable=false)
    **/
    protected $created;

    /**
    *@ORM\Column(name="comment", type="text", nullable=false);
    **/
    protected $comment;

    /**
    *@ORM\ManyToOne(targetEntity="User", inversedBy="comments")
    *@ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
    **/
    protected $user;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('comment', new NotBlank());
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Comment
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

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set user
     *
     * @param \Project\SiteBundle\Entity\User $user
     *
     * @return Comment
     */
    public function setUser(\Project\SiteBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Project\SiteBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
