<?php

namespace App;

use PhpMimeMailParser\Parser;

class EmailData
{
    public function __construct(Parser $parser)
    {
        $this->sender = $parser->getAddresses('from')[0]['address'];
        $this->display_from = base64_encode($parser->getAddresses('from')[0]['display']);
        if (isset($parser->getAddresses('reply-to')[0])) {
            $this->reply_to_address = $parser->getAddresses('reply-to')[0]['address'];
        }
        $this->subject = base64_encode($parser->getHeader('subject'));
        $this->text = base64_encode($parser->getMessageBody('text'));
        $this->html = base64_encode($parser->getMessageBody('html'));
        $this->attachments = [];

        foreach ($parser->getAttachments() as $attachment) {
            $this->attachments[] = [
              'stream' => base64_encode(stream_get_contents($attachment->getStream())),
              'file_name' => $attachment->getFileName(),
              'mime' => $attachment->getContentType()
          ];
        }
    }
}
