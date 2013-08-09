<?php
namespace Application\Lib\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class Entry
 * @package Application\Lib\Model
 */
class Entry extends AbstractModel {

    /**
     * @var int
     */
    private $userId;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $text;

    public function __construct() {
        parent::__construct();
        $date       = new \DateTime('now');
        $this->date = $date->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @param string $author
     *
     * @return \Application\Lib\Model\Entry
     */
    public function setUserId($author) {
        $this->userId = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param string $date
     *
     * @return \Application\Lib\Model\Entry
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return \Application\Lib\Model\Entry
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return \Application\Lib\Model\Entry
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * @return \Application\Lib\Model\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param \Application\Lib\Model\User $user
     *
     * @return \Application\Lib\Model\Entry
     */
    public function setUser(User $user) {
        $this->user = $user;

        return $this;
    }

    /**
     * @return bool
     */
    public function init() {
        $isInit = parent::init();

        if ($isInit) {
            $user = new User();
            $user->setId($this->userId)->init();

            $this->user = $user;

            return true;
        }

        return false;
    }

}
