<?php

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();

    $me = yield $MadelineProto->getSelf();

    $MadelineProto->logger($me);

    if (!$me['bot']) {
        yield $MadelineProto->messages->sendMessage(['peer' => '@heiio', 'message' => "Hi!\nThanks for creating MadelineProto! <3"]);
        //yield $MadelineProto->channels->joinChannel(['channel' => '@MadelineProto']);

        try {
            //yield $MadelineProto->messages->importChatInvite(['hash' => 'https://t.me/joinchat/Bgrajz6K-aJKu0IpGsLpBg']);
        } catch (\danog\MadelineProto\RPCErrorException $e) {
            $MadelineProto->logger($e);
        }

        yield $MadelineProto->messages->sendMessage(['peer' => '@heiio', 'message' => 'Testing MadelineProto!']);
    }
    yield $MadelineProto->echo('OK, done!');
});
