<?php

namespace Plugin\ContactNoticeSlack\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="plg_contact_notice_slack_config")
 * @ORM\Entity(repositoryClass="Plugin\ContactNoticeSlack\Repository\ConfigRepository")
 */
class Config
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="webhook_url", type="string", length=255, nullable=true)
     */
    private $webhook_url;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_name", type="string", length=255, nullable=true)
     */
    private $channel_name;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255, nullable=true)
     */
    private $user_name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWebhookUrl()
    {
        return $this->webhook_url;
    }

    /**
     * @param string $webhook_url
     *
     * @return $this;
     */
    public function setWebhookUrl($webhook_url)
    {
        $this->webhook_url = $webhook_url;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannelName()
    {
        return $this->channel_name;
    }

    /**
     * @param string $channel_name
     *
     * @return $this;
     */
    public function setChannelName($channel_name)
    {
        $this->channel_name = $channel_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     *
     * @return $this;
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;

        return $this;
    }
}
