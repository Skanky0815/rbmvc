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
    private $userId = 0;

    /**
     * @var User
     */
    private $user = null;

    /**
     * @var string
     */
    private $date = '';

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $text = '';

    public function __construct() {
        parent::__construct();
        $date       = new \DateTime('now');
        $this->date = $date->format('Y-m-d');
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
     * @return Entry
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getText() {
        if (empty($this->text)) {
            $this->text = $this->loadTexts('text');
        }

        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Entry
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle() {
        if (empty($this->title)) {
            $this->title = $this->loadTexts('title');
        }

        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Entry
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser() {
        if (is_null($this->user)) {
            $user = new User();
            $user->setId($this->userId)->init();
            $this->user = $user;
        }

        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Entry
     */
    public function setUser(User $user) {
        $this->user = $user;
        $this->userId = $user->getId();
        return $this;
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
     * @return Entry
     */
    public function setUserId($author) {
        $this->userId = $author;

        return $this;
    }

}
