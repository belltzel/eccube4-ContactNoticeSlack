<?php

namespace Plugin\ContactNoticeSlack;

use Eccube\Event\EventArgs;
use Plugin\ContactNoticeSlack\Repository\ConfigRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Event implements EventSubscriberInterface
{

    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    /**
     * ConfigController constructor.
     *
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository->get();
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'mail.contact' => 'onMailContact',
        ];
    }

    public function onMailContact(EventArgs $event)
    {

        if($this->configRepository->getWebhookUrl() === null){
            return;
        }

        $message = $event->getArgument('message');

        $payload['text'] = $message->getBody();

        if($this->configRepository->getChannelName() !== null){
            $payload['channel'] = $this->configRepository->getChannelName();
        }

        if($this->configRepository->getUserName() !== null){
            $payload['username'] = $this->configRepository->getUserName();
        }

        $curl = curl_init($this->configRepository->getWebhookUrl());

        $options = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_TIMEOUT_MS => 5000,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => 'payload=' . urlencode(json_encode($payload)),
        ];

        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        $message = curl_error($curl);
        curl_close($curl);

        if ($info['http_code'] !== 200) {
            log_error($message);
        }

    }
}
