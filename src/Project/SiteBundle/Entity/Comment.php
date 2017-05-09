<?php
//src/Project/SiteBundle/Entity/Comment.php
namespace Project\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="comment")
* @ORM\HasLifecycleCallbacks
*/
class Comment
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;
    /**
    * @ORM\Column(name="comment", type="string", nullable=false);
    **/
    protected $comment;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

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
