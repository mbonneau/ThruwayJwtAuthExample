<?php

require_once __DIR__ . '/vendor/autoload.php';

class ClientForSessionMeta extends \Thruway\Peer\Client {
    /**
     * @param \Thruway\ClientSession $session
     * @param \Thruway\Transport\TransportInterface $transport
     */
    public function onSessionStart($session, $transport)
    {
        $session->subscribe('wamp.metaevent.session.on_join', [$this, 'onSessionJoin']);
        $session->subscribe('wamp.metaevent.session.on_leave', [$this, 'onSessionLeave']);
    }

    public function onSessionLeave($args)
    {
        echo $args[0]->authid . " left.\n";
    }

    public function onSessionJoin($args)
    {
        echo $args[0]->authid . " joined.\n";
    }
}
