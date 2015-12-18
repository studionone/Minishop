<?php
/**
 * Created by PhpStorm.
 * User: raymond
 * Date: 6/12/15
 * Time: 11:50 PM
 */
namespace Minishop\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mini_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Minishop\ShopBundle\Entity\Order", mappedBy="user")
     */
    private $orders;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}