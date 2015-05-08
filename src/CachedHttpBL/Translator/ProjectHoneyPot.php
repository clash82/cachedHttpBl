<?php

namespace CachedHttpBL\Translator;

use CachedHttpBL\Translator;
use CachedHttpBL\Response;

/**
 * ProjectHoneyPot's response translator.
 *
 * @package CachedHttpBL\Translator
 * @author Rafał Toborek
 */
class ProjectHoneyPot implements Translator
{
    /** @var \CachedHttpBL\Response */
    private $response;

    /**
     * {@inheritdoc}
     */
    public function translate(Response $response)
    {
        $this->response = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getActivityDescription()
    {
        return sprintf('last seen %d day(s) ago', $this->response->getActivity());
    }

    /**
     * {@inheritdoc}
     */
    public function getThreatDescription()
    {
        $threat = $this->response->getThreat();

        if ($threat < 26) {
            return '100 [msg/day]';
        }

        if ($threat > 25 & $threat < 51) {
            return '10,000 [msg/day]';
        }

        return '1,000,000 [msg/day]';
    }

    /**
     * {@inheritdoc}
     */
    public function getTypeMeaningDescription()
    {
        switch ($this->response->getTypeMeaning()) {
            case 0:
                return 'Search Engine';

            case 1:
                return 'Suspicious';

            case 2:
                return 'Harvester';

            case 4:
                return 'Comment Spammer';

            case 5:
                return 'Suspicious & Comment Spammer';

            case 6:
                return 'Harvester & Comment Spammer';

            case 7:
                return 'Suspicious & Harvester & Comment Spammer';
        }

        return 'Unknown';
    }
}
